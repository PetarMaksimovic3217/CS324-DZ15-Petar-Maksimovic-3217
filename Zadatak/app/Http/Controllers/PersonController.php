<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons= Person::all();

       return view('crudmodel')->with('persons',$persons);
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
        $this->validate($request,[
            'username' => 'required|string|min:6|max:30',
            'email' => ['required', 'min:6', 'max:30', 'email', 'regex:/(.*)@(met|gmail)\.com/i', 'unique:users'],
            'password' => 'required|string|min:6|max:30',
        ]);

        $person = new Person;
        $person->person_username = $request->input('username');
        $person->person_email = $request->input('email');
        $person->person_password = $request->input('password');

        $person->save();

        return redirect('/person')->with('success','Person is inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->validate($request,[
            'editusername' => 'required|string|min:6|max:30',
            'editimajl' => ['required', 'min:6', 'max:30', 'email', 'regex:/(.*)@(met|gmail)\.com/i'],
            'editpassword' => 'required|string|min:6|max:30',
        ]);
 $update_array=[
     'person_username'=>$request->input('editusername'),
     'person_email'=>$request->input('editimajl'),
     'person_password'=>$request->input('editpassword')
 ];

       DB::table('persons')->where('person_id', $id)->update($update_array);

        return redirect('/person')->with('success','Person is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personToDelete = Person::find($id);
        $personToDelete->delete();

        return redirect('/person')->with('success','Person is deleted');
    }

}
