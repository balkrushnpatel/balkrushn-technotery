<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use Validator;
use DB;
use Auth;
class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allClubs = Club::orderBy('id','DESC')->get(); 
        return view('club.index',compact('allClubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('club.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction(); 
            $validator = Validator::make($request->all(),[  
                'name' => 'required',
                'location' => 'required', 
            ]);
            if ($validator->fails()) {
                return back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            $club = New Club();
            $club->created_by = Auth::user()->id;
            $club->name = $request->input('name');
            $club->location = $request->input('location');
            $club->save();
            DB::commit(); 

            return redirect()->route('club.index')->with('success','Club create successfully');
        }catch(Exception $e){
            DB::rollback();
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{  
            $id = decrypt($id);

            $clubs = Club::findOrFail($id);
            
            return view('club.create',compact('clubs'));
        }catch(Exception $e){
            DB::rollback();
            dd($e->getMessage());
        }
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
}
