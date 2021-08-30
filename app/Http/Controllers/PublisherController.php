<?php

namespace App\Http\Controllers;

use App\Models\Publishers;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function readPublisher($id){
        return Publishers::findOrFail($id);
    }

    public function createPublisher(Request $request){
        $data = $request->all();

        try {
            $publisher = new Publishers; 
            $publisher->name = $data['name'];
            $publisher->description = $data['description'];
            $publisher->url = $data ['url'];

            $publisher->save();
            $status = "success";
            
            return response()->json(compact('status', 'author'), 200);
        } catch (\Throwable $th) {
            $status = "failed";
            
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function updatePublisher(Request $request, $id){
        $data = $request->all();

        try {
            $publisher = Publishers::findOrFail($id); 
            $publisher->name = $data['name'];
            $publisher->description = $data['description'];
            $publisher->url = $data ['url'];

            $publisher->save();
            $status = "success";
            
            return response()->json(compact('status', 'author'), 200);
        } catch (\Throwable $th) {
            $status = "failed";
            
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function deletePublisher($id){

        $publisher = Publishers::findOrFail($id);
        $publisher->delete();

        $status = "Delete Success";
        return response()->json(compact('status'), 200);

    }
}
