<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getAll(){
        $types = Type::all();
        return response()->json($types, 200);
    }

    public function get($id){
        if(Type::where('id', $id)->exists())
        {
            $type = Type::find($id);
            return response()->json($type, 200);
        }else{
            return response()->json(["message"=>"Not found"], 404);
        }
    }

    public function create(Request $request){
        $this -> validate($request, [
            'name' => 'required'
        ]);

        $type = new Type;
        $type -> name = $request -> name;
        $type -> save();

        return response()->json([
            "message" => "Type created.",
            "id" => $type->id
        ], 201);
    }

    public function update(Request $request, $id){
        $request -> validate([
            'name' => 'required'
        ]);

        if(Type::where('id', $id)->exists())
        {
            $type = Type::find($id);
            $type -> name = $request -> name;
            $type -> save();
            
            return response()->json($type, 200);
        }else{
            return response()->json(["message"=>"Not found"], 404);
        }
    }

    public function delete($id){
        if(Type::where('id', $id)->exists())
        {
            $type = Type::find($id);
            $type -> delete();
            
            return response()->json([
                "message" => "Type deleted."
            ], 200);
        }else{
            return response()->json(["message"=>"Not found"], 404);
        }
    }
}
