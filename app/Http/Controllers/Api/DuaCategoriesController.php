<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DuaCategoryResource;
use App\Models\DuaCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DuaCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duaCategory = DuaCategory::withCount('duas')
            ->orderBy('order')->get();
        return response()->json([
            'duaCategory' => DuaCategoryResource::collection($duaCategory),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "unique:dua_categories,name"],
            'order' => ['nullable', 'integer', 'min:0', 'unique:dua_categories,order']
        ]);

        $duaCategory = DuaCategory::create([
            'name' => $request->name,
            'order' => $request->order ?? DuaCategory::max('order') + 1,
        ]);
        return response()->json([
            'message' => 'Dua Catogory Created Successfully',
            'duaCategory' => new DuaCategoryResource($duaCategory),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(DuaCategory $duaCategory)
    {
        $duaCategory->load('duas')
            ->loadCount('duas');
        return response()->json([
            'duaCategory' => new DuaCategoryResource($duaCategory),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DuaCategory $duaCategory)
    {
        $request->validate([
            'name' => ['sometimes', "unique:dua_categories,name,$duaCategory->id"],
            'order' => ['sometimes', 'integer', 'min:0', "unique:dua_categories,order,$duaCategory->id"]
        ]);

        $duaCategory->update($request->all());

        return response()->json([
            'message' => 'Dua Category Update Successfully',
            'duaCategory' => new DuaCategoryResource($duaCategory),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DuaCategory $duaCategory)
    {
        $duaCategory->delete();
        return response()->json([
            'message' => 'Dua Category Delete Successfully',
        ], 200);
    }
}
