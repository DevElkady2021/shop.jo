<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Excel;
use App\Imports\ProductImport;
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

    public function store(ProductRequest $request)
    {
        if($request->hasfile('image')){
            $file = $request->image;
            $newfile = time().'.'. $file->getClientOriginalName();
            $file->move('product/',$newfile);
        }
     $product = Product::create([
        'catagory_id'=>$request->catagory_id,
        'image'=>'http://localhost/shop.jo/public/product'.$newfile,
     // 'image'=>'http://shop.shop-jo.com/shop/public/product'.$newfile', // serve
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
    public function show($id)
    {
        $product = Product::where('id',$id)->first(); 
        return response()->json([
            'product'=>$product??'No Data',
            'msg'=>__('messages.done'),
         ],200); 
        
    }

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




    public function import(Request $request)
    {
        Excel::import(new ProductImport, $request->file);

        return response()->json([
            'msg'=>__('done')
        ],200);
    }


    public function downloadExcel()
    {
        return response()->json([
            'data'=>'http://localhost/shop.jo/public/products.csv',
            'msg'=>__('messages.done'),
        ],200);
    }


}
