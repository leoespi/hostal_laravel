<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserDeactivated;
use App\Mail\UserActivated;


class UserApiController extends Controller
{
    
    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

    
    public function indexUser()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->cedula = $request->cedula;
        $user->email = $request->email;
        $user->rol_id = 2;
        $user->p_venta = $request->p_venta;
        $user->cargo = $request->cargo;
        $user->password =bcrypt($request->password);
        $user->save();
        return response()->json($user, 200);

    }
    
    
    
   
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }



}