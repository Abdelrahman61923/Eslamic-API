<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SurahResource;
use App\Models\Surah;
use Illuminate\Http\Request;

class SurahsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surahs = Surah::withCount('ayahs')->get();
        return response()->json([
            'surahs' => SurahResource::collection($surahs),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Surah $surah)
    {
        $surah->load('ayahs')
            ->loadCount('ayahs');
        return response()->json([
            'surah' => new SurahResource($surah),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
