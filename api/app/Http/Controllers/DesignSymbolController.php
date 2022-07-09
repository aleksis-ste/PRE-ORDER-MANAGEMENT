<?php

namespace App\Http\Controllers;

use App\Http\Resources\SymbolResource;
use App\Models\DesignSymbol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DesignSymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(SymbolResource::collection(DesignSymbol::all()));
    }

    public function show($id) {
        return response()->json(new SymbolResource(DesignSymbol::find($id)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $request->file('image')->store('public/symbols');

        DesignSymbol::create([
            'image' => $request->file('image')->hashName(),
        ]);

        return response()->json(["message" => "Design symbol uploaded"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        DesignSymbol::find($id)->update([
            'status' => $request->status,
        ]);

        return response()->json(["message" => "Status updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $symbol = DesignSymbol::find($id);

        if($symbol->status === false) {
            Storage::delete('public/symbols/'.$symbol->image);
            $symbol->delete();
            return response()->json(["message" => "Design symbol deleted"]);
        }

        return response()->json(["message" => "Design symbol is active"], 400);
    }
}
