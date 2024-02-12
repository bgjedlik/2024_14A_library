<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Student;
use DateTime;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class StudentController extends Controller
{
    public function borrowBooks(){
        $today = date('Y-m-d h:i:s',mktime(12,0,0,9,1,2015));
        $students = Borrow::with(['student','book'])
            ->where('broughtDate', '>', $today)
            ->orderBy('broughtDate')
            ->get();

        //return response()->json($students[0]->book->author->full_name,200);
        return response()->json($students,200);
    }

    public function borrowBook(Request $request){
        $input = $request->all();
        $bookId = $input['bookId'];
        $studentId = $input['studentId'];

        $student = Student::find($studentId);

        $takenDate = new DateTime();
        $broughtDate = (new DateTime())->modify('+1 month');

        if (! $student->books->contains($bookId)){
            $student->books()->attach($bookId,[
                'takenDate'=>$takenDate,
                'broughtDate'=>$broughtDate
            ]);
            return response()->json(['message' => 'OK'],200);
        } else {
            return response()->json(['message' => 'A rekord már létezik'],400);
        }
    }

    public function returnBook(Request $request){
        $input = $request->all();
        $bookId = $input['bookId'];
        $studentId = $input['studentId'];

        $student = Student::find($studentId);
        $student->books()->detach($bookId);

        return response()->json(['message' => 'OK'],200);
    }
}
