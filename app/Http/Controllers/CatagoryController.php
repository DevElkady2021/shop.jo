<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CatagoryController extends Controller
{
    
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catagory = DB::table('catagories')->pluck('name','id');
        return response()->json([
            'cat'=>$catagory,
            'msg'=>__('messages.done'),
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
      $token = $request->token;
      if($token){
        $catagory = Catagory::create([
            'name'     => $request->name,
            'user_id'  =>$user->id,
            'type'     =>$request->type,
        ]);
        return response()->json([
            'Catagory'=>$catagory,
            'msg'=>__('messages.done')
        ],200);
      }else{
        return response()->json([
            'token'=>'',
            'msg'=>__('messages.please login')
        ],400);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function show(Catagory $catagory,$id,Request $request)
    {
   
        $catagory = Catagory::where('user_id',$id)->where('type',1)->get();
       
        if(count($catagory) < 1){
            return response()->json([
                'message'=>__('messages.no data') 
            ],400);
        }else{
            return response()->json([
                'catagories'=>$catagory,
                'message'=>__('messages.done') 
            ],200) ;
        }

       
    }

    public function sub_catagory(Catagory $catagory,$id,Request $request)
    {

        $catagory = Catagory::where('user_id',$id)->where('type',2)->get();

       
        if(count($catagory) < 1){
            return response()->json([
                'message'=>__('messages.no data') 
            ],400);
        }else{
            return response()->json([
                'catagories'=>$catagory,
                'message'=>__('messages.done') 
            ],200) ;
        }

       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catagory $catagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $catagory = Catagory::where('id',$id)->first();
       if($catagory === null){
        return response()->json([
            'msg'=>__('messages.No Have Catagory') ,
        ],400);
       }else{
        $catagory->update([
            'name'    =>$request->name,
            'user_id' =>$user->id,
            'type'=>$request->type,
        ]);
        return response()->json([
            'catagory'=>$catagory,
            'message'=>__('messages.done') 
        ],200);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catagory = Catagory::where('id',$id)->first();
        if($catagory === null){
            return response()->json([
                'msg'=>__('messages.No Have Catagory') ,
            ],400);
        }else{
            $catagory->delete();
            return response()->json([
                'message'=>__('messages.done') 
            ]);
        }
      
    }
}
