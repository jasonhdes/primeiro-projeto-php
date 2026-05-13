<?php
	//abre conexão
	$server    = "127.0.0.1";
	$user      = "jasonh_jason";
	$pass      = "xcVd~T.HFJZ}";
	$db        = "jasonh_erp";
	$conecta   = mysqli_connect($server,$user,$pass,$db);
	//testar conexão
	if ( mysqli_connect_errno() ) {
		die("Conexão falhou: " . mysqli_connect_errno());
	}
?>