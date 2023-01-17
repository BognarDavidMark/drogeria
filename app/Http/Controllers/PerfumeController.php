<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public function getPerfumes() {
        $perfumes = Perfume::all();
        return view( "perfumes", ["perfumes" => $perfumes]);
    }


    public function newPerfume(request $request) {
        return view( "new_perfume" );
    }


    public function storePerfume( Request $request ) {
        if(request->isMethod("post")) {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "price" => "required"
            ],
            [
                "name.required"=>"Kötelező megadni a nevet",
                "type.required" =>"Kötelező megadni a típust",
                "price.required"=>"Kötelező megadni az árat"
            ]);
        }

        $perfume = new Perfume;
        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;
        $perfume->save();

        return redirect( "/" );
    }


    public function editPerfume( $id ) {
        $perfume = Perfume::find( $id );

        return view( "edit_perfume", [
            "perfume" => $perfume
        ]);
    }


    public function updatePerfume( Request $request ) {
        if($request->isMethod("post")) {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "price" => "required"
            ],
            [
                "name.required"=>"Kötelező megadni a nevet",
                "type.required" =>"Kötelező megadni a típust",
                "price.required"=>"Kötelező megadni az árat"
            ]);
        }
        $perfume = Perfume::find($request["id"]);
        $perfume->name = $request["name"];
        $perfume->type = $request["type"];
        $perfume->price = $request["price"];

        $perfume->save();
        return redirect("/");
    }

    public function deletePerfume( $id ) {
        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "/" );
    }
}
