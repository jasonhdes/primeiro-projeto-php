<?php
//Incluir a conexão com banco de dados
//abre conexão
	$server    = "localhost";
	$user      = "jasonh_jason";
	$pass      = "xcVd~T.HFJZ}";
	$db        = "jasonh_erp";
	$conecta   = mysqli_connect($server,$user,$pass,$db);
	//testar conexão
	if ( mysqli_connect_errno() ) {
		die("Conexão falhou: " . mysqli_connect_errno());
	}

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

//Pesquisar no banco de dados nome do usuario referente a palavra digitada
$result_user = "SELECT * FROM modelos WHERE codigo LIKE '%$usuarios%' LIMIT 1";
$resultado_user = mysqli_query($conecta, $result_user);

if(($resultado_user) AND ($resultado_user->num_rows != 0 )){
	while($row_user = mysqli_fetch_assoc($resultado_user)){
		echo "
        <li>".$row_user['codigo']."</li>
        <li>".$row_user['referencia']."</li>
        <li>".$row_user['nome']."</li>
        <li>".$row_user['tamanho_id']."</li>
        <li>".$row_user['cor_id']."</li>
        <li>".$row_user['foto']."</li>
        <li>".$row_user['preco']."</li>
        <li>".$row_user['tecido_id']."</li>
        <li>".$row_user['modelo_id']."</li>
        ";
	}
}else{
	echo "Nenhum usuário encontrado ...";
}