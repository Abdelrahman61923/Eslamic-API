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
        $duaCategory = DuaCategory::orderBy('order')->get();
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
            'duaCategory' => $duaCategory,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $duaCategory = DuaCategory::with('duas')->findOrFail($id);
            return response()->json([
                'duaCategory' => new DuaCategoryResource($duaCategory),
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Dua category not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['sometimes', "unique:dua_categories,name,$id"],
            'order' => ['sometimes', 'integer', 'min:0', "unique:dua_categories,order,$id"]
        ]);

        $duaCategory = DuaCategory::findOrFail($id);
        $duaCategory->update($request->all());

        return response()->json([
            'message' => 'Dua Category Update Successfully',
            'duaCategory' => $duaCategory,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DuaCategory::destroy($id);
        return response()->json([
            'message' => 'Dua Category Delete Successfully',
        ], 200);
    }
}
