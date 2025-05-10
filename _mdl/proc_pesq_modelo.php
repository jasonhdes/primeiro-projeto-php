<?php
    include_once('access.php');
    include_once('consultas.php');
    

    $modelos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    $result_model = "SELECT * FROM modelos WHERE codigo LIKE '%$modelos%' LIMIT 1";
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
            <div class='col-12 col-lg-2'>
                <label>Código</label>
                <input class='form-control' name='cod' id='cod' value='".$row_model['codigo']."' readonly>
            </div>
            <div class='col-12 col-lg-1'>
                <label>Referência</label>
                <input class='form-control' name='referencia' id='referencia' value='".$row_model['referencia']."' readonly>
            </div>
            <div class='col-12 col-lg-2'>
                <label>Nome do Modelo</label>
                <input class='form-control' name='nome' id='nome' value='".utf8_encode($row_model['nome'])."' readonly>
            </div>
            <div class='col-12 col-lg-1'>
                <label>Tamanho</label>
                <input class='form-control' name='tamanho_id' id='tamanho_id' value='".$tamanho_nome."' readonly>
            </div>
            <div class='col-12 col-lg-2'>
                <label>Cor</label>
                <input class='form-control' name='cor_id' id='cor_id' value='".$cor_nome."' readonly>
            </div>
            <div class='col-12 col-lg-2'>
                <label>Valor Unitário</label>
                <input class='form-control' name='preco' id='preco' value='R$ ". number_format($row_model['preco'], 2, ',', '.')."' readonly>
            </div>
            <div class='col-12 col-lg-2'>
                <label>Tecido</label>
                <input class='form-control' name='tecido_id' id='tecido_id' value='".$tecido_nome."' readonly>
            </div>
            <div class='col-12 col-lg-1'>
                <a class='btn btn-block' href='modelo.php?id=".$row_model['modelo_id']."'>Ver</a>
            </div>
            "; 
        }
    }else{
        echo "Nenhum modelo encontrado ...";
    }
?>