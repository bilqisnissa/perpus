<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //findOrFail untuk mencari data buku berdasarkan id
    //jika tidak ditemukan maka akan muncul error not found 404
    public function readBook($id){
        return Books::findOrFail($id);
    }

    public function createBook(Request $request){
        $data = $request->all();

        try {
            $book = new Books();
            $book->nisbn = $data['nisbn'];
            $book->title = $data['title'];
            $book->description = $data['description'];
            $book->image_url = $data['image_url'];
            $book->stock = $data['stock'];
            $book->rating = $data['rating'];
            $book->publisher_id = $data['publisher_id'];
            $book->author_id = $data['author_id'];

            //buat save ke database
            $book->save();
            $status = 'succes';
            return response()->json(compact('status', 'book'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 200);
        }
    }

    public function updateBook($id, Request $request){
        $data = $request->all();

        try {
            $book = Books::findOrFail($id);

            $book->nisbn = $data['nisbn'];
            $book->title = $data['title'];
            $book->description = $data['description'];
            $book->image_url = $data['image_url'];
            $book->stock = $data['stock'];
            $book->rating = $data['rating'];
            $book->publisher_id = $data['publisher_id'];
            $book->author_id = $data['author_id'];

            //buat save ke database
            $book->save();
            $status = 'succes';
            return response()->json(compact('status', 'book'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            $status = 'error';
            return response()->json(compact('status', 'th'), 200);
        }
    }

    public function deleteBook($id){

        $book = Books::findOrFail($id);
        $book->delete();

        $status = "Delete Success";
        return response()->json(compact('status'), 200);

    }
}