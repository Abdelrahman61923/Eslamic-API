<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AzkarResource;
use App\Models\Azkar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AzkarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $azkar = Azkar::with('azkarCategory')->get();
        return response()->json([
            'Azkar' => AzkarResource::collection($azkar),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'azkar_category_id' => ['required', 'integer', 'exists:azkar_categories,id'],
            'zekr' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'max:255'],
            'reference' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0',
            Rule::unique('azkars')
                ->where('azkar_category_id', $request->azkar_category_id),],
            'count' => ['required', 'integer', 'min:1'],
        ]);
        $zekr = Azkar::create($request->all());
        return response()->json([
            'message' => 'Zker Created Successfully',
            'zekr' => new AzkarResource($zekr),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Azkar $azkar)
    {
        $azkar->load('azkarCategory');
        return response()->json([
            'zekr' => new AzkarResource($azkar),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Azkar $azkar)
    {
        $request->validate([
            'azkar_category_id' => ['sometimes', 'integer', 'exists:azkar_categories,id'],
            'zekr' => ['sometimes', 'string', 'min:3'],
            'description' => ['sometimes', 'string', 'max:255'],
            'reference' => ['sometimes', 'nullable', 'string', 'max:255'],
            'order' => ['sometimes', 'integer', 'min:0',
            Rule::unique('azkars')
                ->where('azkar_category_id', $request->azkar_category_id ?? $azkar->azkar_category_id)
                ->ignore($azkar->id),],
            'count' => ['sometimes', 'integer', 'min:1'],
        ]);

        $azkar->update($request->all());
        return response()->json([
            'message' => 'Zekr Update Successfully',
            'zekr' => new AzkarResource($azkar),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Azkar $zekr)
    {
        $zekr->delete();
        return response()->json([
            'message' => 'Zekr Deleted Successfully',
        ], 200);
    }
}
