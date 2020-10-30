<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Repertoire;
use App\Models\UserRepertoire;
use File;
use Auth;

class RepertoiresController extends Controller
{
    //
    public function index()
    {
      if(Auth::user()->role == "ad") :
        $data  = Repertoire::latest()->get();
      return view("app.ad.repertoires",compact('data'));
      else :
        return redirect('/');
      endif;
    }

    public function create(Request $request)
    {
      $rules = [
        "nom" => "required|min:2",
      ];
      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()) :
        return response()->json(["errors" => $validates->errors()->all()]);
      endif;

      $path = "ENTERPRISE/".$request->nom;
      File::makeDirectory($path, $mode = 0777, true, true);

      Repertoire::create([
        "nom" => $request->nom,
        "chemin" => $path
      ]);

      return response()->json(["success" => "Repertoire crée avec succès"]);
    }

    public function update(Request $request)
    {
      $rules = [
        "nom" => "required|min:2",
      ];
      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()) :
        return response()->json(["errors" => $validates->errors()->all()]);
      endif;

      Repertoire::create([
        "nom" => $request->nom,
        "chemin" => ""
      ]);

      return response()->json(["success" => "Information sur repertoire mis à jour avec succès"]);
    }

    public function edit($id)
    {
      $data = Repertoire::find($id);
      return response()->json(["data" => $data]);
    }

    public function delete($id)
    {
      $data = Repertoire::find($id);
      $data->delete();
      return response()->json(["success" => "Repertoire supprimé avec succès"]);
    }

    public function getFolder()
    {

      $myDir = Repertoire::find(UserRepertoire::whereUserId(Auth::user()->id)->first()->repertoire_id);


      $dir = $myDir->chemin;

      // Run the recursive function
      $response = $this->scan($dir);

      $data = array(
      	"name" => $dir,
      	"type" => "folder",
      	"path" => $dir,
      	"items" => $response
      );


      return response()->json($data);
    }

    protected function scan($dir){

    	$files = array();

    	// Is there actually such a folder/file?

    	if(file_exists($dir)){

    		foreach(scandir($dir) as $f) {

    			if(!$f || $f[0] == '.') {
    				continue; // Ignore hidden files
    			}

    			if(is_dir($dir . '/' . $f)) {

    				// The path is a folder

    				$files[] = array(
    					"name" => $f,
    					"type" => "folder",
    					"path" => $dir . '/' . $f,
    					"items" => $this->scan($dir . '/' . $f) // Recursively get the contents of the folder
    				);
    			}

    			else {

    				// It is a file

    				$files[] = array(
    					"name" => $f,
    					"type" => "file",
    					"path" => $dir . '/' . $f,
    					"size" => filesize($dir . '/' . $f) // Gets the size of this file
    				);
    			}
    		}

    	}

    	return $files;
    }


    public function attribution(Request $request)
    {
      $rules = [
        "repertoire_id" => "required",
      ];
      $validates = Validator::make($request->all(),$rules);

      if($validates->fails()) :
        return response()->json(["errors" => $validates->errors()->all()]);
      endif;

      UserRepertoire::create([
        "user_id" => $request->hidden_id,
        "repertoire_id" => $request->repertoire_id
      ]);

      return response()->json(["success" => "Repertoire attribué avec succès"]);
    }

}
