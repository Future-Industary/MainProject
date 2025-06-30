<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //


    public function singnup(Request $req){

        $valid = $req->validate([
            'email' => 'required|email',
            'password' =>'required'
        ]);

        $admin = Admin::where('email', $req->email)->first();
        if (! $admin || ! Hash::check($req->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'admin' => $admin
        ]);


    }
/////////////////////////////////////////
    public function showUsers(){

        $show =User::select('id','name','email', 'created_at')->orderBy('created_at', 'desc')->paginate(10);



        return response()->json([

            'massage'=> 'all users ',

            'data'=>$show

        ]);
    }

////////////////////////////////////////////////
      public function searchUser($id){

            $search = User::select('id','name','email', 'created_at')->find($id);


            if(! $search){

                return response()->json([
                    'status' => false,
                     'message' => 'User nor found !'
            ], 404);
            }


            return response()->json([

                  'status' => true,
                'message' => 'User is found !!!',
                'data' => $search

            ]);

        }

////////////////////////////////////////
        public function destroy($id){

            $user = User::find($id);


            if( ! $user){
                return response()->json([
                    'status' => false,
                     'message' => 'User nor found !'
            ], 404);

            }

            $user->delete();


            return response()->json([
                'status' => true,
                'message' => 'user delete succesfuly !!!'
            ]);


        }
        ///////////////////////////////////////////
        public function showProduct(){
            
            $product = Product::select(['images','category'])->get();


            return response()->json([

                'massage' => 'show all product !!!',
                'data'=> $product


            ]);


        }
        ///////////////////////////////////////////////////
        public function searchProduct($id){

            $prod = Product::select('id','title','description', 'created_at')->find($id);


                if(! $prod){

                    return response()->json([
                        'massage' => 'Product Not Found !!!'

                    ]);


                }


                return response()->json([
                        'massage' => 'Product Found !!!',
                        'data' => $prod
                    ]);

        }
}
