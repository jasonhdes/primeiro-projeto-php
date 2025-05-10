<?php
    $cod_transporte = $resultado_transporte['codigo_transporte'];
    $saida = 1;
    $local = $resultado_transporte['local_id'];
    $quantidade = $_POST['quantidade'];
    $cod = $_POST['cod'];
    $referencia = $_POST['referencia'];
    $nome = utf8_decode($_POST['nome']);
    $tamanho_id = $_POST['tamanho_id'];
    $cor_id = $_POST['cor_id'];
    $preco = $_POST['preco'];
    $tecido_id = $_POST['tecido_id'];
    $total = ($quantidade * $preco);

    $buscar_estoque = "SELECT * ";
    $buscar_estoque .= "FROM estoque ";
    $buscar_estoque .= "WHERE codigo = {$cod} AND local_id = {$resultado_transporte['local_id']} ";
    $buscando_estoque = mysqli_query($conecta,$buscar_estoque);
    $resultado_estoque = mysqli_fetch_assoc($buscando_estoque);

    $preco = $resultado_estoque['preco'];
    $nova_quantidade = ($resultado_estoque['quantidade'] - $quantidade);
    $novo_total = ($nova_quantidade * $preco);

    if($nova_quantidade < 0){
        ?>
<div class="info" id="erro">Não há peças suficientes no estoque. Verifique a quantidade no estoque e/ou se o codigo da peça está correto.</div>
<?php
    } else {
        $alterar_estoque = "UPDATE estoque ";
        $alterar_estoque .= "SET ";
        $alterar_estoque .= "quantidade = '{$nova_quantidade}', ";
        $alterar_estoque .= "total = '{$novo_total}' ";
        $alterar_estoque .= "WHERE codigo = {$cod} AND local_id = {$resultado_transporte['local_id']} ";
        $alterando_estoque = mysqli_query($conecta,$alterar_estoque);
        if(!$alterando_estoque){
            ?>
<div class="info" id="erro">Não foi possível atualizar o estoque. Confira as informações e tente novamente.</div>
<?php
        } else {
            $inserir_transporte = "INSERT INTO transportando ";
            $inserir_transporte .= "(codigo_transporte, codigo, quantidade, nome, tamanho_id, cor_id, tecido_id, preco, total, local_id, entrada_saida) ";
            $inserir_transporte .= "VALUES ";
            $inserir_transporte .= "('$cod_transporte', '$cod', '$quantidade', '$nome', '$tamanho_id', '$cor_id', '$tecido_id', '$preco', '$total', '$local', '$saida') ";
            $inserindo_transporte = mysqli_query($conecta,$inserir_transporte);
            if(!$inserindo_transporte){
                ?>
<div class="info" id="erro">Não foi possível inserir a peça no transporte. Confira as informações e tente novamente.</div>
<?php
            } else {
                ?>
<div class="info" id="sucesso">Sucesso! Peças inseridas no transporte.</div>
<?php
            }
        }
    }
?>