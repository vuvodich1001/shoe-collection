<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        return response()->json(User::all());
    }

    public function store(Request $request) {
        $product = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($product);
    }

    public function update(Request $request, $id) {
        $product = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json($product);
    }

    public function destroy($id) {
        $product = User::destroy($id);

        return response()->json($product);
    }

    public function show($id) {
        $product = User::find($id);
        return response()->json($product);
    }
}
