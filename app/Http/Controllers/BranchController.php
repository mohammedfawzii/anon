<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function index()
    {
        $branches = $this->branchService->getAllbranches();
        // dd($branches);
        return view('dashboard.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('dashboard.branches.create');
    }

    public function edit(Branch $Branch)
    {
        return view('dashboard.branches.edit', compact('Branch'));
    }

    public function store(StoreBranchRequest $request)
    {
        $validatedData = $request->validated();
       $this->branchService->createBranch($validatedData);
        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function show($id)
    {
        $Branch = $this->branchService->getBranchById($id);
        return view('dashboard.branches.show', compact('Branch'));
    }


    public function update(UpdateBranchRequest $request, Branch $Branch)
    {
        $this->branchService->updateBranch($Branch, $request->validated());
        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $Branch)
    {
        $this->branchService->deleteBranch($Branch);
        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}
