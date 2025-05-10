<?php
    include_once('access.php');
    include_once('consultas.php');
    session_start();

    $modelos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
    $codigo_transp = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);

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
            

            
            

            echo "<div class='row'>";
            echo "<div class='col-12 col-lg-1'>";
            echo "<label for='quantidade'>Qtde.:</label>";
            echo "<input class='form-control' id='quantidade' type='text' name='quantidade' value='1' maxlength='5'>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label>Código</label>";
            echo "<input class='form-control' name='cod' id='cod' value='".$row_model['codigo']." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-1'>";
            echo "<label>Referência</label>";
            echo "<input class='form-control' name='referencia' id='referencia' value='".$row_model['referencia']." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-3'>";
            echo "<label>Nome do Modelo</label>";
            echo "<input class='form-control' name='nome' id='nome' value='".utf8_encode($row_model['nome'])." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-1'>";
            echo "<label>Tamanho</label>";
            echo "<input type='hidden' name='tamanho_id' id='tamanho_id' value='".$row_model['tamanho_id']." '>";
            echo "<input class='form-control' name='tamanho' id='tamanho' value='".$tamanho_nome." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label>Cor</label>";
            echo "<input type='hidden' name='cor_id' id='cor_id' value='".$row_model['cor_id']." '>";
            echo "<input class='form-control' name='cor' id='cor' value='".$cor_nome." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label>Preço Unitário</label>";
            echo "<input type='hidden' name='preco' id='preco' value='".$row_model['preco']."' readonly>";
            echo "<input class='form-control' name='precoshow' id='precoshow' value='R$ " . number_format($row_model['preco'], 2, ',', '.')  ."' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label>Tecido</label>";
            echo "<input type='hidden' name='tecido_id' id='tecido_id' value='".$row_model['tecido_id']." '>";
            echo "<input class='form-control' name='tecido' id='tecido' value='".$tecido_nome." ' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<br>";
            echo "<a class='btn btn-block' href='modelo.php?codigo=".$row_model['codigo']." '>Ver</a>";
            echo "</div>";
            echo "<div class='col-12 col-lg-3'>";
            echo "<br>";
            echo "<input class='btn btn-block' type='submit' name='retirar' id='retirar' value='Retirar do transporte'>";
            echo "</div>";
            echo "</div>";
        } 
    } else {
        echo "Nenhum modelo encontrado ...";
    }
?>