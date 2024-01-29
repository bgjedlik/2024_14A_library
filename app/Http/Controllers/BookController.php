<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Type;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()  {
        $books = Book::all();

        $b=[];
        foreach($books as $book){
            $b[] = [
                'name' => $book->name,
                'pagecount' => $book->pagecount,
                'authorName' => $book->author->full_name,
                'typeName' => $book->type->name
            ];
        }

        //  $book->author->fullname()

        return response()->json($b,200);
    }

    public function booksByTypeId($id){
        $books = Type::find($id)->books;

        return response()->json($books,200);
    }

    public function booksByAuthorFullname($name,$surname){
        $books = Author::where('name','=',$name)
                        ->where('surname','=',$surname)
                        ->first();
        if ($books == null) {
            return response()->json(['message' => 'Nincs ilyen szerző!'],404);
        } else {
            return response()->json($books,200);
        }

    }


}
