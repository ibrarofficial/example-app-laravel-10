<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentFormRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('student.list', compact('students'));
    }
    public function create()
    {
        return view('student.create');
    }

    public function store(StudentFormRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ];
            $student = Student::create($data);

            if ($student) {
                //upload avatar path
                if($request->hasFile('avatar')){
                    $avatar = $request->File('avatar')->getClientOriginalName();
                    $request->file('avatar')->storeAs('avatars',$student->id.'_'.$avatar,'');
                    $student->update(['avatar' => $student->id.'_'.$avatar]);
                }
                //end
                return redirect()->route('student.create')->with('message', 'Student Added Successfully.');
            }
            return redirect()->route('student.create')->with('message', 'Student Error.');

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $student = Student::find($id);
            return view('student.edit', compact('student'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update(StudentFormRequest $request, $id)
    {
        try {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            //upload avatar path
            if($request->hasFile('avatar')){

                //delete old avatar
                Storage::delete('avatars/'.$student->avatar);

                $avatar = $request->File('avatar')->getClientOriginalName();
                $request->file('avatar')->storeAs('avatars',$student->id.'_'.$avatar,'');
                $student->update(['avatar' => $student->id.'_'.$avatar]);
            }
            //end
            return redirect()->back()->with('message', 'Student Successfully Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $student = Student::find($request->id);
            if ($student) {
                if(Storage::delete('avatars/'.$student->avatar)){
                    $student->delete();
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Student Successfully Deleted'
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
