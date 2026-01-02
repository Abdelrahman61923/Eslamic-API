<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Radio;
use Illuminate\Http\Request;

class RadiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $radios = Radio::all();
        return response()->json([
            'radios' => $radios,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'unique:radios,url'],
        ]);
        $radio = Radio::create($request->all());
        return response()->json([
            'message' => 'Radio Created Successfully',
            'Radio' => $radio,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Radio $radio)
    {
        return response()->json([
            'radio' => $radio,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Radio $radio)
    {
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'url' => ['sometimes', 'url', "unique:radios,url,$radio->id"],
        ]);

        $radio->update($request->all());
        return response()->json([
            'message' => 'Radio Updated Successfully',
            'Radio' => $radio,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Radio $radio)
    {
        $radio->delete();
        return response()->json([
            'message' => 'Radio Deleted Successfully',
        ], 200);
    }
}
