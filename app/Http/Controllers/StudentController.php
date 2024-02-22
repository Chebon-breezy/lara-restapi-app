<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    //
    public function index (){
        $student = Student::all();

        $data = [
            'status' =>200,
            'student' => $student, 
        ];

        return response()->json($data ,200);
    }

    public function upload(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages()

            ];
            return response()->json($data ,422);
        }

        else{
            $student = new Student;
            $student ->name=$request->name;
            $student ->email=$request->email;
            $student ->phone=$request->phone;
            $student ->year=$request->year;

            $student->save();

            $data=[
                'status'=> 200,
                'message'=>'data uploaded successfuly'
            ];
            return response()->json($data, 200);

        }

    }

    public function edit (Request $request, $id){
            
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages()

            ];
            return response()->json($data ,422);
        }

        else{
            $student = Student::find($id);
            $student ->name=$request->name;
            $student ->email=$request->email;
            $student ->phone=$request->phone;
            $student ->year=$request->year;

            $student->save();

            $data=[
                'status'=> 200,
                'message'=>'data updated successfuly'
            ];
            return response()->json($data, 200);

        }
    }

    public function destroy ($id){
        $student = Student::find($id);
        $student ->delete();

        $data=[
            'status'=> 200,
            'message'=>'data deleted successfuly'
        ];

        return response()->json($data,200);
    }    
}
