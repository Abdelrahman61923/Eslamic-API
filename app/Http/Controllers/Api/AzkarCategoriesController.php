<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AzkarCategoryResource;
use App\Models\AzkarCategory;
use Illuminate\Http\Request;

class AzkarCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $azkarCategory = AzkarCategory::withCount('azkars')
            ->orderBy('order')->get();
        return response()->json([
            'azkarCategory' => AzkarCategoryResource::collection($azkarCategory),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "unique:azkar_categories,name"],
            'order' => ['nullable', 'integer', 'min:0', "unique:azkar_categories,order"]
        ]);

        $azkarCategory = AzkarCategory::create([
            'name' => $request->name,
            'order' => $request->order ?? AzkarCategory::max('order') + 1,
        ]);

        return response()->json([
            'message' => 'Azkar Catogory Created Successfully',
            'azkarCategory' => new AzkarCategoryResource($azkarCategory),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(AzkarCategory $azkarCategory)
    {
        $azkarCategory->load('azkars')->loadCount('azkars');
        return response()->json([
            'azkarCategory' => new AzkarCategoryResource($azkarCategory),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AzkarCategory $azkarCategory)
    {
        $request->validate([
            'name' => ['sometimes', "unique:azkar_categories,name,$azkarCategory->id"],
            'order' => ['sometimes', 'integer', 'min:0', "unique:azkar_categories,order,$azkarCategory->id"]
        ]);

        $azkarCategory->update($request->all());

        return response()->json([
            'message' => 'Azkar Category Update Successfully',
            'azkarCategory' => new AzkarCategoryResource($azkarCategory),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AzkarCategory $azkarCategory)
    {
        $azkarCategory->delete();
        return response()->json([
            'message' => 'Azkar Category Delete Successfully',
        ], 200);
    }
}
