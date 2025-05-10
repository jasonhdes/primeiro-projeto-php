<?php
    include_once('access.php');
    include_once('consultas.php');
    
    $modelos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    $result_model = "SELECT * FROM modelos WHERE codigo LIKE '%$modelos%' ";
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
            <ul>
                <li>".$row_model['codigo']."</li>
                <li>".utf8_encode($row_model['nome'])."</li>
                <li>".$tamanho_nome."</li>
                <li>".$cor_nome."</li>
                <li>".$tecido_nome."</li>
                <li>R$ ".number_format($row_model['preco'], 2, ',', '.')."</li>
                <a href='modelo.php?codigo=<".$row_model['codigo']."'><li class='btn'>Ver</li></a>
            </ul>
            "; 
        }
    }else{
        echo "Nenhum modelo encontrado ...";
    }
?>