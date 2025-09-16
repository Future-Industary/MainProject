<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index(){
        return response()->json(User::all());

    }

    public function show($id){

        $user = User::find($id);

        if (!$user) {
            return response()->json(['massage'=>'User not found'],404);
        }

        return response()->json($user);


    }


    public function store(Request $request){

    $emailRule = 'required|email|unique:users,email';

    if ($request->filled('id')) {
        $emailRule .= ',' . $request->id;
    }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'purchase_count' => 'nullable|integer',
            'status' => 'boolean',
            'last_login' => 'nullable|date',
        ]);

   
    if (isset($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    }

    $user = User::updateOrCreate(
        ['email' => $validated['email']],$validated 
    );

    return response()->json(['user' => $user], 200);
    }


    public function update(Request $request,$id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['massage'=>'User not found'],404);
        }

        $validated = $request->validate(['name'=>'sometimes|string',
                                        'email'=>'sometimes|email|unique:users,email'.$id,
                                        'password'=>'nullable|string']);

        if(isset($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);

    }

    public function destroy($id){

        $user = User::find($id);

        if (!$user) {
            return response()->json(['massage'=>'User not found'],404);
        }

        $user->delete();

        return response()->json(['massage'=>'User deleted']);
        
    }

    public function login(Request $request){

        $credentials = $request->validate(['email'=> 'required|email',
                                           'password'=> 'required|string']);

        if(!Auth::attempt($credentials)){
            return response()->json(['massage'=>'Invalid credentials'],401);

        }

        /** @var \App\Models\User $user */
        $user=Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['massage'=>'Logged out Successfully']); 
    }
} 
