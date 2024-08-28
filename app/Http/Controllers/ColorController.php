<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\Color\StoreColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Services\ColorService;

class ColorController extends Controller
{
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function index()
    {
        $colors = $this->colorService->getAllColors();
        return view('dashboard.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('dashboard.colors.index');
    }

    public function store(StoreColorRequest $request)
    {
        $this->colorService->createColor($request->validated());

        return redirect()->route('colors.index')->with('success', 'Color created successfully.');
    }

    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(UpdateColorRequest $request, Color $color)
    {
        $this->colorService->updateColor($color, $request->validated());

        return redirect()->route('colors.index')->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        $this->colorService->deleteColor($color);

        return redirect()->route('colors.index')->with('success', 'Color deleted successfully.');
    }
}
