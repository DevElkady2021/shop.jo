<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        if(count($products)<1){
            return response()->json([
                'msg'=>__('messages.no data'),
            ],400);
        }else{
            return response()->json([
                'products' =>$products,
                'msg'=>__('messages.done'),
            ],200);
        }
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
    public function store(ProductRequest $request)
    {
        if($request->hasfile('image')){
            $file = $request->image;
            $newfile = time().'.'. $file->getClientOriginalName();
            $file->move('product/',$newfile);
        }
     $product = Product::create([
        'catagory_id'=>$request->catagory_id,
        'image'=>'product/'.$newfile,
        'name'=>$request->name,
        'status'=>$request->status,
        'description'=>$request->description,
        'price'=>$request->price,
        'unit'=>$request->unit,
        'old_price'=>$request->old_price,
        'barcode'=>$request->barcode,
        'weight'=>$request->weight,
        'link'=>$request->link,
        'button'=>$request->button,
        'coast'=>$request->coast,
        'note'=>$request->note,
        'store_place'=>$request->store_place,
        
    ]);
     return response()->json([
        'product'=>$product,
        'msg'=>__('messages.done'),
     ],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       

        $product = Product::findOrFail($id); 
        $product->update([
            'catagory_id'=>$request->catagory_id,
            'name'=>$request->name,
            'status'=>$request->status,
            'description'=>$request->description,
            'price'=>$request->price,
            'unit'=>$request->unit,
            'old_price'=>$request->old_price,
            'barcode'=>$request->barcode,
            'weight'=>$request->weight,
            'link'=>$request->link,
            'button'=>$request->button,
            'coast'=>$request->coast,
            'note'=>$request->note,
            'store_place'=>$request->store_place,
        ]);
        return response()->json([
            'product'=>$product,
            'msg'=>__('messages.done'),
         ],200); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first(); 
        $product->delete();
        return response()->json([
            'msg'=>__('messages.done'),
         ],200); 
    }
}
