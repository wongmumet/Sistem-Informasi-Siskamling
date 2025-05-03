<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isKetua()) {
            $reports = Report::with('reporter')->latest()->paginate(10);
        } else {
            $reports = Report::where('reporter_id', Auth::id())->latest()->paginate(10);
        }
        
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $report = new Report($request->all());
        $report->reporter_id = Auth::id();
        $report->save();

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil dibuat');
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'resolution' => 'nullable',
        ]);

        $report->update($request->all());

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}