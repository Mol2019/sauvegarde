<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Auth;

class ServicesController extends Controller
{
    //
    public function index()
    {
      if(Auth::user()->role == "ad") :
        $data = Service::latest()->get();
        return view("app.ad.services",compact('data'));
      else :
        return redirect("/");
      endif;
    }

    public function create(Request $request)
    {
      $rules = [
        "name" => "required|min:2|unique:services"
      ];

      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()):
        return response()->json(["errors" => $validates->errors()->all()]);
      endif;

      Service::create($request->all());
      //self::buildServiceDir($request->name);

      return response()->json(["success" => "Service ajouté avec succès"]);
    }

    public function update(Request $request)
    {
      $rules = [
        "name" => "required|min:2"
      ];

      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()):
        return response()->json(["errors" => $validates->errors()->all()]);
      endif;

      $data = Service::find($request->hidden_id);

      $data->update($request->all());

      return response()->json(["success" => "Service modifié avec succès"]);
    }

    public function edit($id)
    {
        $data = Service::find($id);
        return response()->json(["data" => $data]);
    }

    public function delete($id)
    {
      $data = Service::find($id);
      $data->delete();
      return response()->json(["success" => "Service supprimé avec succès"]);
    }

    protected  function buildServiceDir(string $serviceName)
    {
      $path = public_path("serv/".$serviceName);
      Storage::makeDirectory($path);
    }
}
