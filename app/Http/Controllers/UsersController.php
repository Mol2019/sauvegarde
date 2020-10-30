<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Service;
use App\Models\Repertoire;

class UsersController extends Controller
{
    //
    public function index()
    {
      if(Auth::user()->role == "ad"):

      $data = new Collection;

      $data->users = User::latest()->get();
      $data->services = Service::all();
      $data->repertoires = Repertoire::all();
      return view("app.ad.users",compact('data'));
      else :
        return redirect("/");
      endif;
    }

    public function create(Request $request)
    {
      $rules = [
        "name" => "required|min:2|unique:users",
        "email" => "required|unique:users",
        "password" => "required|min:4",
        "role" => "required",
        "service_id" => "required"
      ];

      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()):
        return response()->json(['errors' => $validates->errors()->all()]);
      endif;

      $data = $request->all();

      $data['password'] = \Hash::make($request->password);


      User::create($data);

      return response()->json(["success" => "Utilisateur ajouté avec succès"]);
    }

    public function update(Request $request)
    {
      $rules = [
        "name" => "required|min:2",
        "email" => "required",
        "role" => "required",
        "service_id" => "required"
      ];

      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()):
        return response()->json(['errors' => $validates->errors()->all()]);
      endif;

      $user = User::find($request->hidden_id);

      $data = $request->all();

      $data['password'] = $user->password;

      if($request->password) :
         $data['password'] = \Hash::make($request->password);
      endif;

      $user->update($data);

      return response()->json(["success" => "Informations sur utilisateur modifiées avec succès"]);
    }

    public function edit($id)
    {
      $data = User::find($id);
      return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
      $data = User::find($id);
      $data->delete();
      return response()->json(["success" => "Utilisateur supprimé avec succès"]);
    }
}
