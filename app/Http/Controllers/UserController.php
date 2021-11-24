<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addLoyalty($id){
        $user = User::where($id);
        $user->loyalty += 1 ;
    }

    public function resetLoyalty($id){
        $user = User::where($id);
        $user->loyalty = 0;
    }
}
