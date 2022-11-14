<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Team;
use Validator;
use DB;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTeams = Team::orderBy('id','DESC')->get();  
        return view('team.index',compact('allTeams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = Club::get()->pluck('name','id');
        return view('team.create',compact('clubs'));
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
                'club_id' => 'required', 
            ]);
            if ($validator->fails()) {
                return back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            $team = New Team();
            $team->created_by = Auth::user()->id;
            $team->name = $request->input('name');
            $team->club_id = $request->input('club_id');
            $team->save();
            DB::commit(); 

            return redirect()->route('team.index')->with('success','Team create successfully');
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

            $clubs = Club::get()->pluck('name','id');
            $teams = Team::findOrFail($id);
            
            return view('team.create',compact('teams','clubs'));
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
