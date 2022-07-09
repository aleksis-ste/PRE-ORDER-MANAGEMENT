<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index() {
        return response()->json(Navigation::all());
    }

    public function update(Request $request) {
        $request->validate([
            'order' => 'required|array',
        ]);

        foreach($request->order as $key => $o) {
            Navigation::find($o)->update([
                'order' => $key,
            ]);
        }

        return response()->json(["message" => "Order changed"]);
    }
}
