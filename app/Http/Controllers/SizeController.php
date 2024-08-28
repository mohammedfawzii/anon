<?php

namespace App\Http\Controllers;

use App\Http\Requests\Size\StoreSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;
use App\Models\Size;
use App\Services\SizeService;


class SizeController extends Controller
{
    protected $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function index()
    {
        $size = $this->sizeService->getAllSizes();
        return view('dashboard.size.index', compact('size'));
    }

    public function create()
    {
        return view('dashboard.size.index');
    }

    public function store(StoreSizeRequest $request)
    {
        $this->sizeService->createSize($request->validated());

        return redirect()->route('sizes.index')->with('success', 'size created successfully.');
    }

    public function edit(Size $size)
    {
        return view('size.edit', compact('size'));
    }

    public function update(UpdateSizeRequest $request, Size $size)
    {
        $this->sizeService->updateSize($size, $request->validated());

        return redirect()->route('size.index')->with('success', 'size updated successfully.');
    }

    public function destroy(Size $size)
    {
        $this->sizeService->deleteSize($size);

        return redirect()->route('sizes.index')->with('success', 'Size deleted successfully.');
    }
}
