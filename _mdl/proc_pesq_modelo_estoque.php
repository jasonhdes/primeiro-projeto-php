<?php
    include_once('access.php');
    include_once('consultas.php');
    
    $estoque_local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);
    $modelos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    $result_model = "SELECT * FROM estoque WHERE codigo LIKE '%$modelos%' AND local_id = {$estoque_local} LIMIT 1";
    $resultado_model = mysqli_query($conecta, $result_model);

    if(($resultado_model) AND ($resultado_model->num_rows != 0 )){
        while($row_model = mysqli_fetch_assoc($resultado_model)){
            
            $tamanho_id = $row_model['tamanho_id'];
            $cor_id = $row_model['cor_id'];
            $tecido_id = $row_model['tecido_id'];
            
            $list_tamanho = mysqli_fetch_assoc($lista_tamanho);
            if($tamanho_id = $list_tamanho['tamanho_id']){
                $tamanho_nome = $list_tamanho['tamanho'];
            }

            $list_cor = mysqli_fetch_assoc($lista_cor);
            if($cor_id = $list_cor['cor_id']){
                $cor_nome = utf8_encode($list_cor['cor']);
            }
            
            $list_tecido = mysqli_fetch_assoc($lista_tecido);
            if($tecido_id_id = $list_tecido['tecido_id']){
                $tecido_nome = utf8_encode($list_tecido['tecido']);
            }
            
            echo "
            <ul class='list-title'>
                <li>Qtde.</li>
                <li>Código</li>
                <li>Tecido</li>
                <li>Modelo</li>
                <li>Tam.</li>
                <li>Cor</li>
                <li>Preço</li>
                <li></li>
            </ul>
            <ul>
                <li>".$row_model['codigo']."</li>
                <li>".utf8_encode($row_model['nome'])."</li>
                <li>".$tamanho_nome."</li>
                <li>".$cor_nome."</li>
                <li>".$row_model['preco']."</li>
                <li>".$tecido_nome."</li>
            </ul>
            "; 
        }
    }else{
        echo "Nenhum modelo encontrado ...";
    }
?>