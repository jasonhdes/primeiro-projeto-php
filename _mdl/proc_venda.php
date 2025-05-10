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

            echo "<div class='row col-12'>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label for='quantidade'>Qtde.:</label>";
            echo "<input class='form-control' id='quantidade' type='text' name='quantidade' placeholder='0' maxlength='5' required>";
            echo "</div>";
            echo "<div class='col-12 col-lg-3'>";
            echo "<label for='codigo'>Modelo</label>";
            echo "<input class='form-control' id='codigo' type='text' name='codigo' value='".$row_model['codigo']."' maxlength='20' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-3'>";
            echo "<label for='modelo'>Modelo</label>";
            echo "<input class='form-control' id='modelo' type='text' name='modelo' value='".$row_model['nome']."' maxlength='20' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-1'>";
            echo "<label for='tamanho'>Tam.:</label>";
            echo "<input class='form-control' id='tamanho' type='text' name='tamanho' value='".$tamanho_nome."' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label for='cor'>Cor:</label>";
            echo "<input class='form-control' id='cor' type='text' name='cor' value='".$cor_nome."' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label for='cor'>Tecido:</label>";
            echo "<input class='form-control' id='tecido' type='text' name='tecido' value='".$tecido_nome."' readonly>";
            echo "</div>";
            echo "<div class='col-12 col-lg-2'>";
            echo "<label for='preco'>Preço:</label>";
            echo "<input class='form-control' id='rpeco' type='text' name='preco' value='".$row_model['preco']."' readonly>";
            echo "</div>";
            echo "</div>";
            echo "<div class='row col-12'>";
            echo "<div class='col-12 col-lg-2 btn btn-block'><a href='modelo.html'>Ver peça</a> </div>";
            echo "<div class='col-12 col-lg-5'></div>";
            echo "<div class='col-12 col-lg-4'>";
            echo "<input type='submit' class='btn btn-block' id='adicionar' name='adicionar' value='Adicionar'>";
            echo "</div>";
            echo "</div>";

        } 
    } else {
        echo "Nenhum modelo encontrado ...";
    }
?>