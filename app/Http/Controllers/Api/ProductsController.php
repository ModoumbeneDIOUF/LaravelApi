<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;


class ProductsController extends Controller
    {

           // *************************************************************************   Debut partie Admin   *****************************************************************************************


           public function allproduct(){

        $products = DB::table('product_models')
        ->get();
        $product_array = array('products'=> $products);
        return $product_array;

    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function addProduct(Request $request){

        $product = new ProductModel();
        $productName = $request->productName;
        $productDesc = $request->productDesc;
        $productQty = $request->productQty;
        $productPrice = $request->productPrice;
        $idCat = $request->idCat;

        if($request->file('fileName')){

            // $file = base64_decode($request['fileName']);

            $file= $request->file('fileName');
            $extension=$file->getClientOriginalExtension();

            $filename= date('YmdHi').'.'.$extension;
            $file-> move(public_path('/images/products/'), $filename);


            $product->fileName= $filename;
        }

              $product->productName = $productName;
              $product->productDesc = $productDesc;
              $product->productQty = $productQty;
              $product->productPrice = $productPrice;
              $product->idCat = $idCat;
              $product->status = "En stock";


              $product->save();
              return response()->json(["message" => "Product Uploaded Succesfully"]);

      }

      public function getOneProduct($id){

        // return $request->libelle;
        $pro = ProductModel::where(array('id'=>$id))->get();

        if($pro){

            $products_array = array('product'=> $pro);
            return $products_array;
        }
        else{

            return 'unsuccessfully';
        }

    }

    public function updateProduct(Request $request, $id){

        // return $request->libelle;
        $prodUp = ProductModel::where(array('id'=>$id))->update([

            "productQty" => $request->productQty,
            "productPrice" => $request->productPrice,
            "status" => $request->status

        ]);

        if($prodUp){

            return 'successfully';
        }
        else{

            return 'unsuccessfully';
        }

        return $products_array;
    }

    public function deleteProduct($id){

        try {

            $del =  ProductModel::where('id',$id)->delete();

            if($del){
                return(['message'=>'successfully','product'=>null]);

            }
            else{

                return(['message'=>'unsuccessfully','product'=>null]);

            }

        } catch (\Exception $th) {
            return 'unsuccessfully';
        }
    }


        // *************************************************************************   Fin partie Admin   *****************************************************************************************



        // *************************************************************************   Debut partie Client   *****************************************************************************************



        public function featuredProducts(){

            $products = DB::table('product_models')
            ->inRandomOrder()
            ->limit(6)
            ->get();
            $product_array = array('products'=> $products);
            return $product_array;

        }

        public function trendingProducts(){

            $products = DB::table('product_models')
            ->inRandomOrder()
            ->limit(8)
            ->get();
            $product_array = array('products'=> $products);
            return $product_array;

        }

        public function specialOffreProducts(){

            $products = DB::table('product_models')
            ->inRandomOrder()
            ->limit(3)
            ->get();
            $product_array = array('products'=> $products);
            return $product_array;

        }

        public function flashProducts(){

            $products = DB::table('product_models')
            ->inRandomOrder()
            ->limit(1)
            ->get();
            $product_array = array('products'=> $products);
            return $product_array;

        }

        public function productByCategory($idCat){

            $products = ProductModel::where(array('idCat'=>$idCat))->get();
            if($products){

                $product_array = array('products'=> $products);
                return $product_array;
            }

        }

        public function productById($idProd){

            $products = ProductModel::where(array('id'=>$idProd))->get();
            if($products){

                $product_array = array('products'=> $products);
                return $product_array;
            }

        }


        // *************************************************************************   Fin partie Client   *****************************************************************************************

    }

