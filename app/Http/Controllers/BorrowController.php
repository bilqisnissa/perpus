<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function readAuthor($id){
        return Borrow::findOrFail($id);
    }

    public function createBorrow(Request $request){
        $data = $request->all();

        try {
            $borrow = new Borrow();
            $borrow->user_id = $data['user_id'];
            $borrow->book_id = $data['book_id'];
            $borrow->return = $data['return'];
            $borrow->deadline = $data['deadline'];
            $borrow->period = $data['period'];
            //buat save ke database
            $borrow->save();
            $status = 'succes';
            return response()->json(compact('status', 'borrow'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function updateBorrow(Request $request, $id){
        $data = $request->all();

        try {
            $borrow = Borrow::findOrFail($id);
            $borrow->user_id = $data['user_id'];
            $borrow->book_id = $data['book_id'];
            $borrow->return = $data['return'];
            $borrow->deadline = $data['deadline'];
            $borrow->period = $data['period'];
            //buat save ke database
            $borrow->save();
            $status = 'succes';
            return response()->json(compact('status', 'borrow'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 401);
        }
    }

    public function deleteBorrow($id){

        $borrow = Borrow::findOrFail($id);
        $borrow->delete();

        $status = "Deleted";
        return response()->json(compact('status'), 200);

    }
}
