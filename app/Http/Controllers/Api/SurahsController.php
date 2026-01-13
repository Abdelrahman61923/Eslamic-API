<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AyahResource;
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
    public function show(Request $request, Surah $surah)
    {
        $perPage = $request->get('per_page', 10);

        $surah->loadCount('ayahs');

        $ayahs = $surah->ayahs()
            ->with('tafsirs')
            ->paginate($perPage);

        return AyahResource::collection($ayahs)
            ->additional([
                'surah' => new SurahResource($surah),
            ]);
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
