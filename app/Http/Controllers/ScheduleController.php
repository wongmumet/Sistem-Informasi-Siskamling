<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('resident')->latest()->paginate(10);
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $residents = Resident::all();
        return view('schedules.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'resident_id' => 'required|exists:residents,id',
            'notes' => 'nullable',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal ronda berhasil ditambahkan');
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $residents = Resident::all();
        return view('schedules.edit', compact('schedule', 'residents'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'resident_id' => 'required|exists:residents,id',
            'notes' => 'nullable',
            'status' => 'required',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal ronda berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal ronda berhasil dihapus');
    }
    
}