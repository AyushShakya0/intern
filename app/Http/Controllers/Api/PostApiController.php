<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PostApiController extends Controller
{
    public function registerUser(Request $request){
        try{

            $userdata=$request->validate([
                'name'=>'string|required',
                'password'=>'min:8|required',
                'email'=>'required|email|unique:users,email',
            ]);
            $user=User::create([
                'name'=>$userdata['name'],
                'email'=>$userdata['email'],
                'password'=>Hash::make($userdata['password']),
            ]);
            return response()->json([
                "message"=>"User Signup Successfully",
                "user"=>$user
            ]);
        }
        catch(Exception $e){
            return response()->json([$e->getMessage()]);
        }
    }
    public function loginUser(Request $request){
       
       try {
        $user_login_data=$request->validate([
            'email'=>'required',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email', $user_login_data['email'])->first();
                           
        if($user&&Hash::check($user_login_data['password'], $user->password)){
           $token=$user->createToken('user-token')->accessToken;
           return response()->json([
            "message"=>"login Successfull",
            "token"=>$token
           ]);

        }else{
            return response()->json([
                "message"=>"login Unsuccessfull",
    
               ]);
        }
        
       } catch (Exception $e) {
        return response()->json([$e->getMessage()]);
       }
    }


    //get all data
    public function getAllPost(){
        $data=Post::all();
        return response()->json([$data]);
    }


    public function showPost($id){
        try{
            $postdata=Post::findOrFail($id);
            if($postdata){
                return response()->json(["data"=>$postdata]);
                
            }else{
                return response()->json(["message"=>"Data not found"]);
            }
        }catch(Exception $e){
            return response()->json([$e->getMessage()]);
        }
       
    }


        public function deletePost($id){
            try{
                $post=Post::findOrFail($id);
                if($post){
                    $post->delete();
                    return response()->json(['message'=>"Data Deleted Successfully"]);
                }

            }catch(Exception $e){
                return response()->json(["message"=>"Post not found","error"=>$e->getMessage()]);
            }
        }

        public function createPost(Request $request){
            try{
                $request->validate([
                    'title' => 'string|required',
                    'content' => 'string',
                    'catagory' => 'required',
                    'image' => 'sometimes|max:2048',
                ]);
                
            if ($request->hasFile('images')) {
                $images = $request->images;
                $imageName = rand(1, 1000) . time() . '.' . $images->extension();
                $images->move(public_path('images'), $imageName);
            } else {
                $imageName = "NUll";
            }

          $post=Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'catagory_id' => $request->catagory,
                'image' => $imageName,
                'status' => $request->status,
                'user_id' => auth()->id()

            ]);



            //get the data of post with catagory and user table
            // $post = Post::with('catagory','user')->get();
            return response()->json(["message"=>"Post Created Successfully","data"=>$post->with('catagory','user')->find($post->id)]);
            }catch(Exception $e){
                return response()->json(["message"=>"Failed to create a post","error"=>$e->getMessage()]);
            }
        }

    public function updatePost(Request $request,int $id){
        try {
            // dd($request);
            $post=Post::findOrFail($id);
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                if(file_exists(public_path('images/' . $post->image))){
                    unlink(public_path('images/' . $post->image));
                }
                
            } else {
                $imageName = $post->image;
            }

         
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'catagory_id' => $request->catagory,
                    'image' => $imageName,
                    'status' => $request->status,

                ]);
            $alldata = Post::with('catagory','user')->find($id);

            return response()->json(['message' => "Post Updated Successfully","data" => $alldata]);
        } catch (Exception $e) {

            return response()->json(["Post update failed" => false, "message" => $e->getMessage()]);
        }
    }
}
