<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use DB;

class CategoriesController extends Controller
{
    public function addCategory(Request $request){
        $libelle = $request->categoryName;
        $result = DB::table('categories')
        ->where('libelle',$libelle)
        ->first();
        if(isset($result)){
            return(['message'=>'already','category'=>null]);
        }
        else{
            try {
                $cat = new Categories();
                $cat->libelle = $libelle;

                $cat->save();
                return(['message'=>'successfully','category'=>$cat]);
                //code...
            } catch (\Exception $th) {
                //throw $th;
                return(['message'=>'unsuccessfully','category'=>null]);
            }
        }

    }

    public function allCategory(){
        $cat = DB::table('categories')
        ->get();
        $categories_array = array('categories'=> $cat);
        return $categories_array;
    }

    public function getOneCategory($id){

        // return $request->libelle;
        $cat = Categories::where(array('idCat'=>$id))->get();

        if($cat){

            $categories_array = array('categories'=> $cat);
            return $categories_array;
        }
        else{

            return 'unsuccessfully';
        }

    }

    public function updateCategory(Request $request, $id){

        // return $request->libelle;
        $catUp = Categories::where(array('idCat'=>$id))->update([

            "libelle" => $request->libelle
        ]);

        if($catUp){

            return 'successfully';
        }
        else{

            return 'unsuccessfully';
        }

        return $categories_array;
    }

    public function deleteCategory($id){

        try {

            $del =  Categories::where('idCat',$id)->delete();

            if($del){
                return 'successfully';
            }
            else{
                return 'unsuccessfully';
            }

        } catch (\Exception $th) {
            return 'unsuccessfully';
        }
    }
}
