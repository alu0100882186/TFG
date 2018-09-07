<?php
	function CrearConexion(){
		$Servidor = "localhost";
		$Usuario = "daniel";
		$Clave = "daniel";
		$BaseDatos = "tfg";
		// Creamos la conexión y almacenamos el handle
		$Conexion = new mysqli($Servidor, $Usuario, $Clave,  $BaseDatos);
		// Comprobamos que la conexión es válida (la función die termina el programa mostrando un mensaje, es como un "echo" más "exit")
		/*if ($Conexion->connect_error) die("Fallo!! " . $Conexion->connect_error);
		echo "La conexión se ha efectuado correctamente :-D <br />";*/
		return $Conexion;
	}

	function Ejecutar($Conexion, $SQL){
		$Resultado = mysqli_query($Conexion, $SQL);
		if (!$Resultado) {
			echo ($SQL);
			die("Error en la ejecución" );
		}
		else{
		//	echo"Conexión correcta";
		}

		return $Resultado;
	}

	function Ejecutar2($Conexion, $SQL){
		$Resultado = mysqli_query($Conexion, $SQL);
		/*if (!$Resultado) {
			echo ($SQL);
			die("Error en la ejecución" );
		}
		else{
			echo"Conexión correcta";
		}
*/
		return $Resultado;
	}

?>
