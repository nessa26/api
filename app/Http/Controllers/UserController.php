<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([['users'=>Users::all()]],200);
    }

    public function show($id, Request $r)
    {
        return response()->json([['users'=>Users::find($id)]],200);
    }

    public function create(Request $r)
    {
        try {
            $user = Users::create([
                'name' => $r -> name,
                'lastname' => $r -> lastname
            ]);
            return response()->json(['message'=>'Usuario creado exitosamente']);
        } catch (\Exception $e) {
            return response()->json([$e -> getMessage()]);
        }
    }

    public function update($id, Request $r)
    {
        try{
            $user = Users::find($id);
            $user->update($r->all());
            return response()->json(['message'=>'Usuario actualizado exitosamente']);
        }catch(\Exception $e){
            return response()->json([$e -> getMessage()]);
        }
    }

    public function delete($id, Request $r)
    {
        $user = Users::find($id);
        $user ->delete($r->all());
        return response()->json(['message'=>'Usaurio eliminado exitosamente']);
    }
}