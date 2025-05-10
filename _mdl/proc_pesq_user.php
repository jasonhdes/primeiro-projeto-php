<?php
//Incluir a conexão com banco de dados
include_once 'access.php';

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

//Pesquisar no banco de dados nome do usuario referente a palavra digitada
$result_user = "SELECT * FROM modelos WHERE codigo LIKE '%$usuarios%' LIMIT 20";
$resultado_user = mysqli_query($conecta, $result_user);

if(($resultado_user) AND ($resultado_user->num_rows != 0 )){
	while($row_user = mysqli_fetch_assoc($resultado_user)){
		echo "<li>".$row_user['nome']."</li>";
	}
}else{
	echo "Nenhum usuário encontrado ...";
}