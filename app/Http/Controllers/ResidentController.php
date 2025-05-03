<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::latest()->paginate(10);
        return view('residents.index', compact('residents'));
    }

    public function create()
    {
        return view('residents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:residents|max:16',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required|date',
        ]);

        Resident::create($request->all());

        return redirect()->route('residents.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }

    public function show(Resident $resident)
    {
        return view('residents.show', compact('resident'));
    }

    public function edit(Resident $resident)
    {
        return view('residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident)
    {
        $request->validate([
            'nik' => 'required|max:16|unique:residents,nik,'.$resident->id,
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required|date',
        ]);

        $resident->update($request->all());

        return redirect()->route('residents.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return redirect()->route('residents.index')
            ->with('success', 'Data warga berhasil dihapus');
    }
}