<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentStageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $stages = RecruitmentStage::with('creator')
            ->when($search, function ($query) use ($search) {
                $query->where('stage_name', 'like', "%{$search}%");
            })->latest()->paginate(10)->withQueryString();

        return view('recruitment-stages.index', compact('stages', 'search'));
    }

    public function create()
    {
        return view('recruitment-stages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'stage_name' => 'required|string|max:255|unique:recruitment_stages',
            'status'     => 'boolean',
        ]);

        RecruitmentStage::create([
            'stage_name' => $request->stage_name,
            'status'     => $request->has('status') ? (bool) $request->status : true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('recruitment-stages.index')
                         ->with('success', 'Recruitment stage created successfully.');
    }

    public function edit(RecruitmentStage $recruitmentStage)
    {
        return view('recruitment-stages.edit', compact('recruitmentStage'));
    }

    public function update(Request $request, RecruitmentStage $recruitmentStage)
    {
        $request->validate([
            'stage_name' => 'required|string|max:255|unique:recruitment_stages,stage_name,' . $recruitmentStage->id,
            'status'     => 'boolean',
        ]);

        $recruitmentStage->update([
            'stage_name' => $request->stage_name,
            'status'     => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('recruitment-stages.index')
                         ->with('success', 'Recruitment stage updated successfully.');
    }

    public function destroy(RecruitmentStage $recruitmentStage)
    {
        $recruitmentStage->delete();
        return redirect()->route('recruitment-stages.index')
                         ->with('success', 'Recruitment stage deleted successfully.');
    }
}
