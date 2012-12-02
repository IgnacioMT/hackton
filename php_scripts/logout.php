<?php ob_start(); ?>
<?php require_once("funciones.php"); ?>
<?php
    session_start();
	//$pag = $_SESSION["url"];
	$pag = "../";
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
		echo "session deleted!";
	}
	session_destroy();
    redireccionar_a($pag);
?>
<?php ob_end_flush(); ?>