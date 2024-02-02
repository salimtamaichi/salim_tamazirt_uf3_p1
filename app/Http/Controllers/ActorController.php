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

        // Fetch actors with birthdates between start and end years
        $actorsByDecade = DB::table('actors')
            ->whereBetween('birthdate', ["{$startYear}-01-01", "{$endYear}-12-31"])
            ->get();

        return view('actors.list_by_decade', compact('actorsByDecade'));
    }
}
