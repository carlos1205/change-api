<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
        public function getAll(){
            $items = Item::all();
            return response()->json($items, 200);
        }

        public function get($id){
            if(!(Item::where('id', $id)->exists())){
                return response()->json([
                    "message" => "User don't exists."
                ], 404);
            }

            $item = Item::find($id);
            return response()->json($item, 200);
        }

        public function create(Request $request){
            $item = new Item;
            $item -> name = $request -> name;
            $item -> description = $request -> description;
            $item -> price = (float) $request -> price;
            $item -> image = $request -> image;
            $item -> user_id = (int) $request -> user_id;
            $item -> type_id =  (int) $request -> type_id;
            $item -> save();

            return response()->json([
                "message" => "Item created.",
                "id" => $item -> id
            ], 201);
        }

        public function update(Request $request, $id){
            if(Item::where('id', $id)->exists())
            {
                $item = Item::find($id);
                $item -> name = $request -> name;
                $item -> description = $request -> description;
                $item -> price = (float) $request -> price;
                $item -> image = $request -> image;
                $item -> user_id = (int) $request -> user_id;
                $item -> type_id =  (int) $request -> type_id;
                $item -> save();

                return response()->json($item, 201);
            }else{
                return response()->json(["message"=>"Not found"], 404);
            }
        }

        public function delete($id){
            if(Item::where('id', $id)->exists())
            {
                $item = Item::find($id);
                $item -> delete();
                
                return response()->json([
                    "message" => "Item deleted."
                ], 200);
            }else{
                return response()->json(["message"=>"Not found"], 404);
            }
        }
}
