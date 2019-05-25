<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){

//editarhab verhabitaciones
		if($enlaces == "ganancias" ||$enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar"|| $enlaces == "registrohab"|| $enlaces == "habitaciones"|| $enlaces == "editarhab"  || $enlaces == "clientes"|| $enlaces == "verhabitaciones"|| $enlaces == "registrocli"||  $enlaces == "registroreserva"||  $enlaces == "verreservas"||  $enlaces == "habitaciones2" ||  $enlaces == "reservas2" ||  $enlaces == "editarreserva"){

			$module =  "views/modules/".$enlaces.".php";
		
		}
		else if($enlaces == "salir"){

			$module =  "views/modules/salir.php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "ok"){

			$module =  "views/modules/registro.php";
		
		}

		else if($enlaces == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "cambio"){

			$module =  "views/modules/usuarios.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}
		
		return $module;

	}

}

?>