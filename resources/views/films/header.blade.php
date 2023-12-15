<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>           body {
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
            width: 45%;
            height: 45%;
        }

        .error-message {
            color: #ff0000;
        }
        </style>

</head>

<body>
    <center><img src=" {{ asset('img/pie.png') }} " alt=""></center>
    <br><br>
</body>

</html>