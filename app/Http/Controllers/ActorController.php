<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor; // Importar el modelo Actor

class ActorController extends Controller
{
    public function listActors()
    {
        // Obtener todos los actores utilizando Eloquent ORM
        $actors = Actor::select('id', 'name', 'surname', 'birthdate', 'country')->get();
    
        // Convertir la colección de actores a un array asociativo
        $actorsArray = $actors->toArray();
    
        // Agregar el título deseado
        $title = 'Listado de Actores';
    
        return view('actors.list', compact('actorsArray', 'title'));
    }
    

    public function listActorsByDecade(Request $request)
    {
        // Calcular el inicio y fin de la década basado en el año seleccionado
        $startYear = $request->input('year');
        $endYear = $startYear + 9;

        $title = 'Listado de Actores'; // Agregar el título que deseas mostrar

        // Obtener los actores con fechas de nacimiento entre los años de inicio y fin
        $actors = Actor::select('id', 'name', 'surname', 'birthdate', 'country')
            ->whereBetween('birthdate', ["{$startYear}-01-01", "{$endYear}-12-31"])
            ->get();
        $actorsArray = $actors->toArray();

        return view('actors.list', compact('actorsArray', 'title'));
    }

    public function countActors()
    {
        $title = "Total Number of Actors";
        $actorsCount = Actor::count(); // Contar los actores utilizando Eloquent ORM

        return view('actors.countActors', ["actors" => $actorsCount, "title" => $title]);
    }

    public function deleteActor($actorId)
    {
        $affected = Actor::where('id', $actorId)->delete(); // Eliminar el actor por su ID
    
        if ($affected) {
            return response()->json(['action' => 'delete', 'status' => true]);
        } else {
            return response()->json(['action' => 'delete', 'status' => false]);
        }
    }
}
