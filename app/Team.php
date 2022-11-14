<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function club(){
    	return $this->hasOne(Club::class,'id','club_id');
    }
    public function players(){
    	return $this->hasMany(Player::class,'team_id','id');
    }
}
