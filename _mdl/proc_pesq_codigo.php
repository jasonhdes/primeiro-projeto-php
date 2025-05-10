<?php

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$result_user = "SELECT * FROM estoque WHERE codigo LIKE '%$usuarios%' AND local_id = {$estoque_local} ";
$resultado_user = mysqli_query($conecta, $result_user);

if(($resultado_user) AND ($resultado_user->num_rows != 0 )){
	while($row_user = mysqli_fetch_assoc($resultado_user)){
		echo "
        
        <li>".$qtde_estoq."</li>
                        <li>".$row_user['codigo']."</li>
                        <li>".$mostrar_tec_item."</li>
                        <li>".$nome_model."</li>
                        <li>".$mostrar_tam_item."</li>
                        <li>".$mostrar_cor_item."</li>
                        <li>R$  ". number_format($valores, 2, ',', '.')."</li>
                        <a href='modelo.php?codigo=".$codigo_ref."<li class='btn'>Ver</li></a>
    ";
	}
}else{
	echo "Nenhum usuário encontrado ...";
}
?>