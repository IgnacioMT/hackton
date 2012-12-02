<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php 
	   header("Content-Type: text/html; charset=iso-8859-1");
	   
	   //$handle = fopen("https://ckannet-storage.commondatastorage.googleapis.com/2012-11-26T174649/InfoEmpresa-Directorio.csv", "r"); 
	   $handle = fopen("../InfoEmpresa-Directorio.csv", "r"); 
	   $data = array();
	   $primVal = 0;
	   echo "Busqueda: ".$_POST["buscar"]."<br />";
		
		while (($row = fgetcsv($handle, 1000, ";")) !== FALSE)
		{ 
			if($primVal==0){ $primVal = 666; continue; }
			$sql = "INSERT INTO info_empresa(nombre, rubro, direccion, departamento, contacto, correo, web)  
			        VALUES ('".$row["1"]."', '".$row["2"]."', '".$row["3"]."', '".$row["4"]."', '".$row["5"]."', '".$row["6"]."', '".$row["7"]."' )";
			
			echo $sql."<br /><br /><br />";		
					
			$consulta = mysql_query($sql);
			validar_consulta($consulta);
		}
   
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>