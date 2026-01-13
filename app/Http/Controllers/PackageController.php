<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\CompanyInfo;

class PackageController extends Controller
{
    /**
     * Display a listing of packages.
     */
    public function index()
    {
        $packages = Package::where('aktif', true)->get();

        return view('packages.index', compact('packages'));
    }

    /**
     * Display a specific package.
     */
    public function show($id)
    {
        $package = Package::where('idPaket', $id)->where('aktif', true)->firstOrFail();

        return view('packages.show', compact('package'));
    }
}
