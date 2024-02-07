<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function listActors()
    {
        $actors = DB::table('actors')->select('id', 'name', 'surname', 'birthdate', 'country')->get(); // Obtener todos los registros de la tabla 'actors'
        $actorsArray = json_decode(json_encode($actors), true); // Convertir objetos stdClass a arrays asociativos
        $title = 'Listado de Actores'; // Agrega el título que deseas mostrar

        return view('actors.list', compact('actorsArray', 'title'));
    }

    public function listActorsByDecade(Request $request)
    {
        // Calculate the start and end years for the decade based on the selected year
        $startYear = $request -> input('year');
        $endYear = $startYear + 9;

        $title = 'Listado de Actores'; // Agrega el título que deseas mostrar

        // Fetch actors with birthdates between start and end years
        $actors = DB::table('actors')
            ->select('id', 'name', 'surname', 'birthdate', 'country')
            ->whereBetween('birthdate', ["{$startYear}-01-01", "{$endYear}-12-31"])
            ->get();
        $actorsArray = json_decode(json_encode($actors), true);

        return view('actors.list', compact('actorsArray', 'title'));
    }

    public function countActors()
    {
        $title = "Total Number of Actors";
        $actors = DB::table('actors')->count();

        return view('actors.countActors', ["actors" => $actors, "title" => $title]);
    }

    public function deleteActors($id)
    {
        $affected = DB::table('actors')->where('id', $id)->delete();
    
        if ($affected) {
            return response()->json(['action' => 'delete', 'status' => true]);
        } else {
            return response()->json(['action' => 'delete', 'status' => false]);
        }
    }
}
