<?php

namespace App\Http\Controllers;

use App\Models\Employ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class employController extends Controller
{
    public function adddata(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|alpha_num|max:6|min:6'
        ]);
        $user = Employ::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);
        if ($user) {
            return response()->json(['res' => 'successfully']);
        } else {
            return response()->json(['res' => 'failed'], 500);  // Return a failure response
        }
    }

    public function getall(Request $request)
    {
        $query = Employ::query();

        if ($request->ajax()) {
            if (!empty($request->search)) {
                $user = $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->get();
            } else {
                $user = Employ::all();
            }

            return response()->json(['users' => $user]);
        } else {
            $user = Employ::all();
            return response()->json(['users' => $user]);
        }
    }

    // public function getall()
    // {
    //     $students = Employ::all();

    //     // Decrypt the sensitive field if necessary (NOT recommended for passwords)
    //     foreach ($students as $student) {
    //         try {
    //             $student->password = Crypt::decryptString($student->password); // assuming the 'password' field is encrypted
    //         } catch (\Exception $e) {
    //             // Handle decryption failure (optional)
    //             $student->password = 'Decryption error';
    //         }
    //     }

    //     return response()->json(['students' => $students]);
    // }

    public function updatedata($id)
    {
        $student = Employ::find($id);

        return view('edidata', ['student' => $student]);
    }

    public function updateuser(Request $request, $id)
    {
        $validuser = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|alpha_num|max:6|min:6'
        ]);
        $user = Employ::where(['id' => $id])->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);
        if ($user) {
            return response()->json(['res' => ' update successfully']);
        } else {
            return response()->json(['res' => 'failed'], 500);  // Return a failure response
        }
    }
    public function deleteUser($id)
    {
        $user = Employ::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully!'], 200);
        } else {
            return response()->json(['message' => 'User not found!'], 404);
        }
    }
}
