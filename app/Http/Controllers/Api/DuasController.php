<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DuaResource;
use App\Models\Dua;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class DuasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duas = Dua::with('duaCategory')->get();
        return response()->json([
            'Duas' => DuaResource::collection($duas),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dua_category_id' => ['required', 'integer', 'exists:dua_categories,id'],
            'dua' => ['required', 'string', 'min:3'],
            'reference' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0',
            Rule::unique('duas')
                ->where('dua_category_id', $request->dua_category_id),],
            'count' => ['required', 'integer', 'min:1'],
        ]);
        $dua = Dua::create($request->all());
        return response()->json([
            'message' => 'Dua Created Successfully',
            'Dua' => new DuaResource($dua),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dua $dua)
    {
        $dua->load('duaCategory');
        return response()->json([
            'dua' => new DuaResource($dua),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dua $dua)
    {
        $request->validate([
            'dua_category_id' => ['sometimes', 'integer', 'exists:dua_categories,id'],
            'dua' => ['sometimes', 'string', 'min:3'],
            'reference' => ['sometimes', 'nullable', 'string', 'max:255'],
            'order' => ['sometimes', 'integer', 'min:0',
            Rule::unique('duas')
                ->where('dua_category_id', $request->dua_category_id ?? $dua->dua_category_id)
                ->ignore($dua->id),],
            'count' => ['sometimes', 'integer', 'min:1'],
        ]);

        $dua->update($request->all());
        return response()->json([
            'message' => 'Dua Update Successfully',
            'dua' => new DuaResource($dua),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dua $dua)
    {
        $dua->delete();
        return response()->json([
            'message' => 'Dua Deleted Successfully',
        ], 200);
    }
}
