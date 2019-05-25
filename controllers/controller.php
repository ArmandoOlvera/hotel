<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	
	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		 

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}
		//echo $enlaces;

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}


	#REGISTRO DE RESERVAS
	#------------------------------------
	public function registroReservaController( ){
 
		if(isset($_POST["nombreRegistro"])){

 
			$respuesta = Datos::vistaNumHabitacionModel1("habitaciones",$_POST["numRegistro"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
	 
		$valor=0;	 
		foreach($respuesta as $row => $item){
		$valor=$item["precio"];
		}
		 $dias=$_POST["tipoRegistro"];
		 $ganancia=$dias*$valor;
		 //echo "ganancia ".$ganancia;fecha
		 
		 $fecha= $_POST["fecha"];

		 echo $fecha;
			/////////////////////////////////////////////////////////////// tipoRegistro

			$datosController = array( "nombreCliente"=>$_POST["nombreRegistro"],
								      "idHabitacion"=>$_POST["numRegistro"],
								      "fecha"=>$fecha,
								      "dias"=> $dias,
								      "ganancia"=>$ganancia);

			$respuesta = Datos::registroReservaModel($datosController, "reserva");

			if($respuesta == "success"){
				echo "guardado";
				//header("location:index.php?action=ok");

			}

			else{
				echo "FALLO";
				//header("location:index.php");
			}

		}

	}




	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			$datosController = array( "usuario"=>$_POST["usuarioRegistro"], 
								      "password"=>$_POST["passwordRegistro"],
								      "email"=>$_POST["emailRegistro"]);

			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

		#REGISTRO DE Habitaciones
	#------------------------------------
	public function traerHabitaciones(){

		 

			$datosController = array( "precio"=>"1");

			$respuesta = Datos::registroHabitacionModel($datosController, "habitaciones");

			if($respuesta == "success"){

				//header("location:index.php?action=ok");
				echo "Guardado!!!";

			}

			else{

				//header("location:index.php");
				echo "Fallo";
			}

		 

	}




	#REGISTRO DE Habitaciones
	#------------------------------------
	public function registroHabitaciones(){
		$respuesta = Datos::vistaNumHabitacionModel("habitaciones");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo "<select name=\"numRegistro\" id=\"numRegistro\">";
								 
		foreach($respuesta as $row => $item){
		echo' <option value='.$item["id"].'>No.'.$item["id"]." - "."$".$item["precio"].'</option> ';
		}
		echo "</select>";
	}


	#REGISTRO DE Habitaciones
	#------------------------------------ tipoRegistro
	public function registroClientes(){

		if(isset($_POST["nombreRegistro"])){
			$datosController = array( "nombre"=>$_POST["nombreRegistro"], 
								      "tipo"=>$_POST["tipoRegistro"] );

			$respuesta = Datos::registroClienteModel($datosController, "clientesh");

			if($respuesta == "success"){

				//header("location:index.php?action=ok");
				echo "Guardado!!!";

			}

			else{

				//header("location:index.php");
				echo "Fallo";
			}

		}

	}


	#REGISTRO DE Habitaciones
	#------------------------------------ tipoRegistro
	public function guardarHabitacion(){

		if(isset($_POST["habitacionRegistro"])){
			$ruta="images/";//ruta carpeta donde queremos copiar las imágenes
        $uploadfile_temporal=$_FILES['imagen']['tmp_name'];
        $uploadfile_nombre=$ruta.$_FILES['imagen']['name'];

 		if (is_uploaded_file($uploadfile_temporal))
        {
            
        }
        else
        {
          $errores = 'error <br/>';
        }

 if(empty($errores)){
			$datosController = array( "precio"=>$_POST["habitacionRegistro"], 
								      "tipo"=>$_POST["tipoRegistro"],
								      "imagen"=>$uploadfile_nombre );


		
			$respuesta = Datos::registroHabitacionModel($datosController, "habitaciones");

			if($respuesta == "success"){
 				move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
				//header("location:index.php?action=ok");
				echo "Guardado!!!";

			}

			else{

				//header("location:index.php");
				echo "Fallo";
			}
}
		}

	}

public function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}


	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);

			 
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if($respuesta["user"] == $_POST["usuarioIngreso"] && $respuesta["pass"] == $_POST["passwordIngreso"]){

				//session_start();
 
				$_SESSION["validar"] = $respuesta["tipo"];
 

 				 echo '<script type="text/javascript">
                    window.location.replace("index.php?action=dashboard");
                  </script>';


 					//header('Location: ' . "index.php?action=habitaciones", true, $permanent ? 301 : 302);
 					//exit();
				//header("location:index.php?action=habitaciones");

			}

			else{
				$_SESSION["validar"] = "na";
				header("location:index.php?action=fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["user"].'</td>
				<td>'.$item["pass"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}


#VISTA DE CLIENTES
	#------------------------------------

	public function vistaClientessController(){

		$respuesta = Datos::vistaClientesModel("clientesh");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["nombre"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}



	#VISTA DE Habitaciones
	#------------------------------------ if(isset($_POST["usuarioIngreso"])){

	public function vistaHabitacionesController(){

		$respuesta = Datos::vistaHabitacionesModel("habitaciones");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["precio"].'</td>
				<td>'.$item["tipo"].'</td> 
				<td><img src="'.$item["imagen"].'"  style="width:128px;height:128px"/></td>
				<td><a href="index.php?action=editarhab&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=habitaciones&idBorrar='.$item["id"].'" onclick="salir('.$item["id"].');"><button>Borrar</button></a></td>
			</tr>';

		}

	}

#VISTA DE Habitaciones
	#------------------------------------ if(isset($_POST["usuarioIngreso"])){

	public function vistaHabitacionesControllerb(){

		$respuesta = Datos::vistaHabitacionesModel("habitaciones");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["precio"].'</td>
				<td>'.$item["tipo"].'</td> 
				<td><img src="'.$item["imagen"].'"  style="width:128px;height:128px"/></td>
			 
			</tr>';

		}

	}
	#VISTA DE Habitaciones
	#------------------------------------ 

	public function vistaHabitacionesController2(){


	if(isset($_POST["tipoRegistro"])){
		$respuesta = Datos::vistaHabitacionesModel2("habitaciones",$_POST["tipoRegistro"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["precio"].'</td>
				<td>'.$item["tipo"].'</td> 
				<td><img src="'.$item["imagen"].'"  style="width:128px;height:128px"/></td>
				 
			</tr>';

		}

	}elseif (isset($_POST["precio"])) {
		$respuesta = Datos::vistaHabitacionesModel3("habitaciones",$_POST["precio"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["precio"].'</td>
				<td>'.$item["tipo"].'</td> 
				<td><img src="'.$item["imagen"].'"  style="width:128px;height:128px"/></td>
				 
			</tr>';

		}
	}
}


public function vistaReservasController2(){


	if(isset($_POST["tipoRegistro"])){
		$respuesta = Datos::vistaReservasModel2("reserva",$_POST["tipoRegistro"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){ 
		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["nombreCliente"].'</td>
				<td>'.$item["idHabitacion"].'</td>
				<td>'.$item["fecha"].'</td> 
				<td>'.$item["dias"].'</td>
				  
			</tr>';

		}

	}elseif (isset($_POST["numero"])) {
		$respuesta = Datos::vistaReservasModel3("reserva",$_POST["numero"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["nombreCliente"].'</td>
				<td>'.$item["idHabitacion"].'</td>
				<td>'.$item["fecha"].'</td> 
				<td>'.$item["dias"].'</td>
			</tr>';

		}
	}elseif (isset($_POST["dias"])) {
		$respuesta = Datos::vistaReservasModel4("reserva",$_POST["dias"]);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){

		echo'<tr>
				<td>'.$item["id"].'</td> 
				<td>'.$item["nombreCliente"].'</td>
				<td>'.$item["idHabitacion"].'</td>
				<td>'.$item["fecha"].'</td> 
				<td>'.$item["dias"].'</td>
			</tr>';

		}
	}
}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["user"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["pass"].'" name="passwordEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

#EDITAR habitacion
	#------------------------------------

	public function editarHabitacionController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarHabitacionModel($datosController, "habitaciones");


		echo "<div class=\"col-lg-6 col-xs-12\">
				<div class=\"box-content card white\">
					<h4 class=\"box-title\">Basic example</h4>
					<!-- /.box-title -->
					<div class=\"card-content\">
						<form   method=\"post\"  enctype=\"multipart/form-data\">

						<div class=\"form-group\">
								<label for=\"exampleInputEmail1\">Precio</label>
								<input  type=\"text\"  class=\"form-control\" value=\"".$respuesta["id"]."\" placeholder=\"Usuario\" name=\"id\" readonly>
							</div>
							<div class=\"form-group\">
								<label for=\"exampleInputEmail1\">Precio</label>
								<input  type=\"text\"  class=\"form-control\" value=\"".$respuesta["precio"]."\" placeholder=\"Usuario\" name=\"precioRegistro\" required>
							</div>
							<div class=\"form-group\">
								<label for=\"exampleInputEmail1\">Tipo de habitacion </label>
								<select name=\"tipoRegistro\" id=\"tipoRegistro\">
								  <option value=\"Simple\">Simple</option>
								  <option value=\"Doble\">Doble</option>
								  <option value=\"Matrimonial\">Matrimonial</option>
								</select>
							</div>
							<div class=\"form-group\">
								<label for=\"imagenRegistro\">Ingrese la imagen</label>
								<input type=\"file\"    name=\"imagen\" id=\"imagen\" required>
							</div>
							<button type=\"submit\" class=\"btn btn-primary btn-sm waves-effect waves-light\">Submit</button>
						</form>
					</div>
					<!-- /.card-content -->
				</div>
				<!-- /.box-content -->
			</div>";
		 
	}

 

#ACTUALIZAR HABITACION
	#------------------------------------
	public function actualizarHabitacionController(){

		if(isset($_POST["id"])){


		 
		$ruta="images/";//ruta carpeta donde queremos copiar las imágenes
        $uploadfile_temporal=$_FILES['imagen']['tmp_name'];
        $uploadfile_nombre=$ruta.$_FILES['imagen']['name'];

 		if (is_uploaded_file($uploadfile_temporal))
        {
            
        }
        else
        {
          $errores = 'error <br/>';
        }

 
 if(empty($errores)){

			$datosController = array( "id"=>$_POST["id"],
							          "precio"=>$_POST["precioRegistro"],
				                      "tipo"=>$_POST["tipoRegistro"],
				                      "imagen"=>$uploadfile_nombre);
			
			$respuesta = Datos::actualizarHabitacionModel($datosController, "habitaciones");

			if($respuesta == "success"){
	move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
				echo "Guardado Correctamente!";
				//header("location:index.php?action=cambio");

			}

			else{
  
				echo "Error, no se hizø la ACTUALIZÆCION favor de contactar al administrador";

			}
}
		}
	
	}



#ACTUALIZAR RESERVA
	#------------------------------------
	public function VerGanancias(){

		if(isset($_POST["mes"])){

		$mes = $_POST['mes'];
		 $anio=date('Y');

		 $fecha1=$anio."-".$mes."-01";
		 $fecha2= date("Y-m-t",strtotime($fecha1));

		  
			
			$respuesta = Datos::vistaGananciasModel4("reserva",$fecha1,$fecha2);

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
			$total=0;
		foreach($respuesta as $row => $item){
			$total=$item['ganancia']+$total; 
		}
 	echo "Las ganancias son: ".$total;
		}
	
	}




#ACTUALIZAR RESERVA
	#------------------------------------
	public function actualizarReservasController(){

		if(isset($_POST["numero"])){

		$fecha = new DateTime($_POST['fecha']);
		//echo $fecha->format('d-m-Y');
		 $respuesta = Datos::vistaNumHabitacionModel1("habitaciones",$_POST["habitacion"]);
		$dias=$_POST["dias"];
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		 
		$valor=0;	 
		foreach($respuesta as $row => $item){
		$valor=$item["precio"];
		}
		 $valor=$dias*$valor;
			$datosController = array( "id"=>$_POST["numero"],
							          "nombreCliente"=>$_POST["nombre"],
				                      "idHabitacion"=>$_POST["habitacion"],
				                      "fecha"=>$fecha->format("Y-m-d"),
				                      "dias"=>$dias,
				                      "ganancia"=>$valor
				                  );
			
			$respuesta = Datos::actualizarReservacionnModel($datosController, "reserva");

			if($respuesta == "success"){ 
				echo "Guardado Correctamente!";
				//header("location:index.php?action=cambio");

			}

			else{ 

				echo "Error, no se hizø la actualizacion favor de contactar al administrador";

			}
 
		}
	
	}


	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "usuario"=>$_POST["usuarioEditar"],
				                      "password"=>$_POST["passwordEditar"],
				                      "email"=>$_POST["emailEditar"]);
			
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				echo "Guardado Correctamente!";
				//header("location:index.php?action=cambio");

			}

			else{
  
				echo "Error, no se hizø la ACTUALIZÆCION favor de contactar al administrador";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarReservaController2(){

		if( isset($_POST["borrar"])){

			$datosController = $_POST["borrar"];
			
			$respuesta = Datos::borrarReservaModel($datosController, "reserva");

			if($respuesta == "success"){
				echo "Echo";
				//header("location:index.php?action=registroreserva");
			
			}else{
				echo "Error al borrar, no se ha borrado nada.";
			}

		}


		if( isset($_POST["borrar"])){

			$datosController = $_POST["borrar"];
			
			$respuesta = Datos::borrarReservaModel($datosController, "reserva");

			if($respuesta == "success"){
				echo "Echo";
				//header("location:index.php?action=registroreserva");
			
			}else{
				echo "Error al borrar, no se ha borrado nada.";
			}

		}

	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=usuarios");
			
			}

		}

	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarHabitacionController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarHabitaacionModel($datosController, "habitaciones");

			if($respuesta == "success"){

				//header("location:index.php?action=usuarios");
			
			}

		}

	}

	#######

}

?>