<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios.
     */
    public function index()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created portfolio in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'gambarCover' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'aktif' => 'boolean'
        ]);

        $portfolio = new Portfolio();
        $portfolio->idPortofolio = 'PF' . strtoupper(substr(md5(uniqid()), 0, 8)); // Generate unique ID
        $portfolio->judul = $request->judul;
        $portfolio->deskripsi = $request->deskripsi;
        $portfolio->kategori = $request->kategori;

        // Handle image upload
        if ($request->hasFile('gambarCover')) {
            $image = $request->file('gambarCover');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('portfolio', $filename, 'public');
            $portfolio->gambarCover = $path;
        }

        $portfolio->aktif = $request->has('aktif');
        $portfolio->save();

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('portfolio/additional', $filename, 'public');
                
                \App\Models\PortfolioImage::create([
                    'portfolio_id' => $portfolio->idPortofolio,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio created successfully!');
    }

    /**
     * Display the specified portfolio.
     */
    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'gambarCover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'aktif' => 'boolean'
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->judul = $request->judul;
        $portfolio->deskripsi = $request->deskripsi;
        $portfolio->kategori = $request->kategori;

        // Handle image upload if provided
        if ($request->hasFile('gambarCover')) {
            // Delete old image if exists
            if ($portfolio->gambarCover) {
                Storage::disk('public')->delete($portfolio->gambarCover);
            }

            $image = $request->file('gambarCover');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('portfolio', $filename, 'public');
            $portfolio->gambarCover = $path;
        }

        $portfolio->aktif = $request->has('aktif');
        $portfolio->save();

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio updated successfully!');
    }

    /**
     * Remove the specified portfolio from storage.
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete image if exists
        if ($portfolio->gambarCover) {
            Storage::disk('public')->delete($portfolio->gambarCover);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio deleted successfully!');
    }

    /**
     * Toggle the active status of a portfolio.
     */
    public function publish(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->aktif = !$portfolio->aktif;
        $portfolio->save();

        return response()->json(['success' => true, 'aktif' => $portfolio->aktif]);
    }
}
