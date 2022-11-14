<?php
 
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	$howManyUserCreate = 1;
    	$roleId = 1;
    	$userS[] = array(
    		'name'=>'Super Admin',
    		'email'=>'superadmin@gmail.com', 
            'password'=> bcrypt('1234567890'),  
            'email_verified_at'	=> date('Y-m-d H:i:s'),
    	);
    	$userS[] = array(
    		'name'=>'Admin',
    		'email'=>'admin@gmail.com', 
            'password'=> bcrypt('1234567890'),  
            'email_verified_at'	=> date('Y-m-d H:i:s'),
    	);
    	$roleAssign = 1;
    	foreach($userS as $item){
    		$roleName = Role::where('id',$roleId)->first()->name;
    		$user = User::create($item);
    		if($roleAssign == $howManyUserCreate){
    			$user->assignRole($roleName);
    			$roleId++;
    		}else{
    			$user->assignRole($roleName);
    			$roleAssign++;
    		}

    	}
    }
}
