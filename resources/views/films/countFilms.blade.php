@include("films.header")
<h1>{{$title}}</h1>
 
@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else (!empty($films) && is_int($films))
    <FONT COLOR="black"><b>Hay un total de <FONT COLOR="red">{{$films}}</FONT> películas</b></FONT>
@endif
@include("films.footer")