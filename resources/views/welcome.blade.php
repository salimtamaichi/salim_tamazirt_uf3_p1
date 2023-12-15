@include("films.header")

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Personalización del estilo para un diseño oscuro minimalista -->
    <style>
        body {
            background-color: #202020;
            color: #ffffff;
        }

        .container {
            margin-top: 50px;
        }

        .form-group label {
            color: #ffffff;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            background-color: #333333;
            border: 1px solid #555555;
            color: #ffffff;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            padding: 10px 20px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        ul li a:hover {
            text-decoration: underline;
        }

        img {
            width: 50%;
            height: 50%;
        }

        .error-message {
            color: #ff0000;
        }
    </style>
</head>

<body class="container">

    @if(!empty($error))
    <p class="error-message">{{ $error }}</p>
    @endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Lista de Películas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/filmout/oldFilms">Películas antiguas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/filmout/newFilms">Películas nuevas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/filmout/films">Películas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/filmout/countFilms">Contador de películas</a>
                </li>
            </ul>
        </div>
    </nav>

    <h2>Añadir Película</h2>

    <form action="{{ route('createFilm') }}" method="post" class="form">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div class="form-group">
            <label for="ano">Año:</label>
            <input type="number" name="ano" id="ano">
        </div>
        <div class="form-group">
            <label for="genero">Género:</label>
            <input type="text" name="genero" id="genero">
        </div>
        <div class="form-group">
            <label for="pais">País:</label>
            <input type="text" name="pais" id="pais">
        </div>
        <div class="form-group">
            <label for="duracion">Duración:</label>
            <input type="number" name="duracion" id="duracion">
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="text" name="imagen" id="imagen">
        </div>
        <div class="form-group">
            <input type="submit" value="Enviar" name="button">
        </div>
    </form>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
@include("films.footer")