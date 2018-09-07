<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reporte Equipos - Laravel Framework</title>
	<style>
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		td, th{
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even){
			background-color: #dddddd;
		} 
	</style>
</head>
<body>
	<h2>Reporte de Publicaciones por Equipo</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Equipos</th>
			<th>Deporte</th>
			<th>Publicaciones</th>
			<th>Contenido</th>
		</tr>
		@foreach($publicaciones as $publicacion)
			
			<tr>
				<td>{{$publicacion->idequipo}} </td>
				<td>{{$publicacion->equipo}} </td>
				<td>{{$publicacion->deporte}}</td>
				<td>{{$publicacion->titulo}} </td>
				<td>{{$publicacion->texto}}</td>
			</tr>
		@endforeach
	</table>
</body>
</html>