<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    
    public function team(){
    	return $this->hasOne(Team::class,'id','team_id');
    }
}
