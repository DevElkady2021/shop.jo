<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
  
    public function show(Request $request,$id)
    {
            $token = $request ->token;
            if($token){
            $user = Profile::where('id',$id)->first();
           if($user ==''){
            return response()->json([
                'message' => __('messages.please login')],400) ;
           }
           else{
            return response()->json([ 
                'user'=>$user,
                'message' => __('messages.Users'),
                
            ],200) ;
           }
            }else{
                return response()->json([
                'message' => __('messages.please login')],400) ;
            }
  
            }

   
    public function update(Request $request,$id)
    {
        $profile = Profile::where('user_id',$id)->first();
        $user = User::where('id',$id)->first();
        // return $profile;
       // return $request->img;
        if($request->hasfile('img')){
            $file = $request->img;
            $newfile = time().'.'. $file->getClientOriginalName();
            $file->move('profile/',$newfile);
        } 

        // return 'http://localhost/shop.jo/public/profile/'.$newfile;

        $profile->update([
        'user_id'=>$id,
        'name'=>$request->name,
        'trade_name'=>$request->trade_name,
        'phone'=>$request->phone,
        'img'=>'http://localhost/shop.jo/public/profile/'.$newfile,
        'address'=>$request->address,
     ]);
        return response()->json([
            'profile'=>$profile,
            'msg'=>__('messages.done'),
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
