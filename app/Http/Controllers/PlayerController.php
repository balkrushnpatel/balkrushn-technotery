<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Team;
use App\Player;
use Validator;
use DB;
use Auth;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPlayers = Player::orderBy('id','DESC')->get(); 
        return view('player.index',compact('allPlayers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::get()->pluck('name','id');
        return view('player.create',compact('teams'));
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
                'team_id' => 'required', 
            ]);
            if ($validator->fails()) {
                return back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            $player = New Player();
            $player->created_by = Auth::user()->id;
            $player->name = $request->input('name');
            $player->team_id = $request->input('team_id');
            $player->save();
            DB::commit(); 

            return redirect()->route('player.index')->with('success','Player create successfully');
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

            $teams = Team::get()->pluck('name','id');
            $player = Player::findOrFail($id);
            
            return view('player.create',compact('player','teams'));
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
