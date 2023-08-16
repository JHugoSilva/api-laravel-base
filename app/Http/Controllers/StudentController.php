<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'students' => 'No Records Found'
            ], 400);
        }
        
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string|max:191',
            'email' =>'required|email|max:191',
            'phone' =>'required|digits:10',
            'course' =>'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
              'status' => 422,
              'message' => $validator->errors()
            ], 422);
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->course = $request->course;
            if($student->save()) {
                return response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully'
                ], 200);
            } else {
                return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!'
                ], 500);
            }
        }
    }

    public function show($id) {
        $student = Student::find($id);
        
        if($student) {
            return response()->json([
            'status' => 200,
            'message' => $student
            ], 200);
        } else {
            return response()->json([
            'status' => 404,
            'message' => 'Not Found!'
            ], 404);
        }
    }

    public function update(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string|max:191',
            'email' =>'required|email|max:191',
            'phone' =>'required|digits:10',
            'course' =>'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
              'status' => 422,
              'message' => $validator->errors()
            ], 422);
        } else {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->course = $request->course;
            if($student->save()) {
                return response()->json([
                'status' => 200,
                'message' => 'Student Update Successfully'
                ], 200);
            } else {
                return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!'
                ], 500);
            }
        }
    }

    public function destroy(int $id) {
        $student = Student::find($id);
        
        if($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully'
                ], 200);
        } else {
            return response()->json([
            'status' => 404,
            'message' => 'Not Found!'
            ], 404);
        }
    }
}
