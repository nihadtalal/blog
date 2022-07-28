<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();


        
       

        //start decrement product_quantity in product
      
        if ($product->product_quantity == 0) {
            return;
          }
        //End decrement product_quantity in product
       

        //start decrement product_quantity in product
        $quantity = DB::table('products')->where('id', $id)->decrement('product_quantity');

        //End decrement product_quantity in product



        $check = DB::table('pos')->where('pro_id', $id)->first();
        if ($check) {
            DB::table('pos')->where('pro_id', $id)->increment('pro_quantity');

            $product = DB::table('pos')->where('pro_id', $id)->first();
            $subtotal = $product->pro_quantity * $product->product_price;
            DB::table('pos')->where('pro_id', $id)->update(['sub_total' => $subtotal]);
        } else {

            $data = array();
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;


            DB::table('pos')->insert($data);
        }
    }
    public function CartProduct()
    {
        $cart = DB::table('pos')->get();
        return response()->json($cart);
    }

    public function RemoveCart($id)
    {



        //restore product_quantity in product


        $quantityPos = DB::table('pos')->where('id', $id)->first();
        $quantityPro = DB::table('products')->where('id', $quantityPos->pro_id)->first();

        $quantityall = $quantityPos->pro_quantity + $quantityPro->product_quantity;

        $quantityupdate = DB::table('products')->where('id', $quantityPos->pro_id)->update(['product_quantity' => $quantityall]);

        //restore product_quantity in product

        DB::table('pos')->where('id', $id)->delete();
        return response('Done');
        // return response()->json( $quantityall);

    }

    public function Increment($id)
    {
       
        


        $product = DB::table('pos')->where('id', $id)->first();

        //start decrement product_quantity in product
      
        $quantityPro = DB::table('products')->where('id', $product->pro_id)->first();
        //End decrement product_quantity in product
        if ($quantityPro->product_quantity == 0) {
          return;
        }
        $quantity = DB::table('pos')->where('id', $id)->increment('pro_quantity');
        DB::table('products')->where('id', $product->pro_id)->decrement('product_quantity');
        $subtotal = $product->pro_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);
        return response('Done');
    }
    public function Decrement($id)
    {
        $quantity = DB::table('pos')->where('id', $id)->decrement('pro_quantity');
         
        $product = DB::table('pos')->where('id', $id)->first();

       

        if ($product->pro_quantity < 1) {
            DB::table('pos')->where('id', $id)->update(['pro_quantity' => 1]);
            return;
        }
        // $product = DB::table('pos')->where('id', $id)->first();

         //start decrement product_quantity in product
         DB::table('products')->where('id', $product->pro_id)->increment('product_quantity');
        
         //End decrement product_quantity in product

        $subtotal = $product->pro_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);

        return response('Done');
    }

    //Get Vat 

    public function Vats()
    {
        $vat = DB::table('extras')->first();
        return response()->json($vat);
    }
}
