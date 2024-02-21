<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\Film;


class FilmController extends Controller
{

    /**
     * Read films from storage.
     *
     * @return array
     */
    public static function readFilms(): array
    {

        $filmsDB = Film::select('name', 'year', 'genre', 'country', 'duration', 'img_url')->get()->toArray();

        return $filmsDB;
    }

    /**
     * List films older than the provided year.
     * If no year is provided, it defaults to 2000.
     *
     * @param int|null $year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listOldFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "List of Old Films (Before $year)";

        // Utilizamos Eloquent para obtener las películas más antiguas que el año dado
        $old_films = Film::where('year', '<', $year)->get();

        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    /**
     * List films newer than the provided year.
     * If no year is provided, it defaults to 2000.
     *
     * @param int|null $year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listNewFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "List of New Films (After $year)";

        // Utilizamos Eloquent para obtener las películas más recientes que el año dado
        $new_films = Film::where('year', '>=', $year)->get();

        return view('films.list', ["films" => $new_films, "title" => $title]);
    }


    /**
     * List all films or filter by year or genre.
     *
     * @param int|null $year
     * @param string|null $genre
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listFilms($year = null, $genre = null)
    {
        $title = "List of All Films";
        $query = Film::query();

        if (!is_null($year)) {
            $title = "List of All Films Filtered by Year";
            $query->where('year', $year);
        }

        if (!is_null($genre)) {
            $title = "List of All Films Filtered by Genre";
            $query->where('genre', 'LIKE', '%' . $genre . '%');
        }

        $films = $query->get();
        return view("films.list", ["films" => $films, "title" => $title]);
    }


    /**
     * Display films for a specific year.
     *
     * @param int|null $year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filmsByYear($year = null)
    {
        $title = "List of All Films";
        $query = Film::query();

        if (!is_null($year)) {
            $title = "List of All Films Filtered by Year";
            $films = $query->where('year', $year)->get();
        } else {
            $films = $query->get();
        }

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    /**
     * Display films for a specific genre.
     *
     * @param string|null $genre
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filmsByGenre($genre = null)
    {
        $title = "List of All Films";
        $query = Film::query();

        if (!is_null($genre)) {
            $title = "List of All Films Filtered by Genre";
            $films = $query->where('genre', 'LIKE', '%' . $genre . '%')->get();
        } else {
            $films = $query->get();
        }

        return view("films.list", ["films" => $films, "title" => $title]);
    }


    /**
     * Sort films by year.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sortByYear()
{
    $title = "List of Films Sorted by Year";
    
    // Obtenemos todas las películas ordenadas por año utilizando Eloquent ORM
    $films = Film::orderBy('year')->get();

    return view('films.list', ["films" => $films, "title" => $title]);
}

    /**
     * Count the total number of films.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function countFilms()
{
    $title = "Total Number of Films";

    // Obtenemos el total de películas utilizando Eloquent ORM
    $totalFilms = Film::count();

    return view('films.countFilms', ["films" => $totalFilms, "title" => $title]);
}

    /**
     * Check if a film already exists.
     *
     * @param mixed $filmUser
     * @return bool
     */
    public function isFilm($filmUser)
    {
        // Buscamos si existe una película con el mismo nombre en la base de datos utilizando Eloquent ORM
        $existingFilm = Film::where('name', $filmUser['name'])->exists();
    
        return $existingFilm;
    }
    

    /**
     * Create a new film.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createFilm(Request $request)
    {
        $filmUser = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'genre' => $request->input('genre'),
            'country' => $request->input('country'),
            'duration' => $request->input('duration'),
            'img_url' => $request->input('img_url'),
        ];
    
        if ($this->isFilm($filmUser)) {
            return view('welcome', ["error" => "Movie already exists"]);
        } else {
            // Creamos la película en la base de datos utilizando Eloquent ORM
            Film::create($filmUser);
            
            // Obtenemos todas las películas después de agregar la nueva película
            $films = Film::all();
            $title = "All Films";
            
            return view('films.list', ["films" => $films, "title" => $title]);
        }
    }
    
    public function updateFilm(Request $request, $id)
{
    $film = Film::find($id);

    if (!$film) {
        return response()->json(['error' => 'Film not found'], Response::HTTP_NOT_FOUND);
    }

    // Actualizamos los atributos de la película
    $film->name = $request->input('name');
    $film->year = $request->input('year');
    $film->genre = $request->input('genre');
    $film->country = $request->input('country');
    $film->duration = $request->input('duration');
    $film->img_url = $request->input('img_url');

    // Guardamos los cambios en la base de datos
    $film->save();

    return response()->json(['message' => 'Film updated successfully'], Response::HTTP_OK);
}

}
