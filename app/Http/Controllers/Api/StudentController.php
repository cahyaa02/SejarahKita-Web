<?php

namespace App\Http\Controllers\Api;

use App\Models\LogApps;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentResource;
use App\Http\Controllers\Auth\InternetProtocolAddressController;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return ['students' => StudentResource::collection($students)];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Student::create([
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'name' => $request->name,
            'school' => $request->school,
            'city' => $request->city,
            'birthyear' => $request->birthyear
        ]);

        $ip = new InternetProtocolAddressController;
        LogApps::create([
            "id_user" => Auth::user()->id,
            "log_table" => "Students",
            "log_path" => "StudentController@show",
            "log_desc" => "Create new student",
            "log_ip" => $ip->getIPAddress()
        ]);

        return ['message' => 'data has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::findOrFail($id);
        return ['students' => StudentResource::collection($students)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentDetail($id)
    {
        $students = Student::find(['id' => $id]);
        return ['students' => StudentResource::collection($students)];
    }
}
