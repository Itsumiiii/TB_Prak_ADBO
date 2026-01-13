<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of packages.
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaPaket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'hargaDasar' => 'required|numeric|min:0',
            'inklusi' => 'required|array',
            'inklusi.*' => 'string',
            'aktif' => 'boolean'
        ]);

        $package = new Package();
        $package->idPaket = 'PKG' . strtoupper(substr(md5(uniqid()), 0, 8)); // Generate unique ID
        $package->namaPaket = $request->namaPaket;
        $package->deskripsi = $request->deskripsi;
        $package->hargaDasar = $request->hargaDasar;
        $package->inklusi = $request->inklusi;
        $package->aktif = $request->has('aktif');
        $package->save();

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully!');
    }

    /**
     * Display the specified package.
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaPaket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'hargaDasar' => 'required|numeric|min:0',
            'inklusi' => 'required|array',
            'inklusi.*' => 'string',
            'aktif' => 'boolean'
        ]);

        $package = Package::findOrFail($id);
        $package->namaPaket = $request->namaPaket;
        $package->deskripsi = $request->deskripsi;
        $package->hargaDasar = $request->hargaDasar;
        $package->inklusi = $request->inklusi;
        $package->aktif = $request->has('aktif');
        $package->save();

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully!');
    }

    /**
     * Calculate the final price for a package.
     */
    public function calculatePrice(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        // For now, just return the base price
        // In a real implementation, you might calculate based on additional options
        return response()->json(['price' => $package->hargaDasar]);
    }
}
