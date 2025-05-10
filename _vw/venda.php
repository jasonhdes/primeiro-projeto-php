<?php
include('../_mdl/access.php');
    session_start();
    if(isset($_SESSION['portal'])){
        $_SESSION['portal'];
        $busca_funcionario = "SELECT * ";
        $busca_funcionario .= "FROM funcionarios ";
        $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
        $buscando_funcionario = mysqli_query($conecta,$busca_funcionario);
        $resultado_funcionario = mysqli_fetch_assoc($buscando_funcionario);
    } else {
        header('../index.php');
    }


    $vendedor = 4;

    $buscar_venda = "SELECT * ";
    $buscar_venda .= "FROM vendas ";
    $buscar_venda .= "WHERE registrado = {$resultado_funcionario['registro']} ";
    $buscar_venda .= "ORDER BY venda_id DESC LIMIT 1 ";
    $buscando_venda = mysqli_query($conecta,$buscar_venda);
    $resultado_venda = mysqli_fetch_assoc($buscando_venda);

    $registro = $resultado_venda['registro'];
    $local_id = $resultado_venda['local_id'];
    $cod_vend = $resultado_venda['codigo_venda'];

    $buscar_vendedor = "SELECT * ";
    $buscar_vendedor .= "FROM funcionarios ";
    $buscar_vendedor .= "WHERE registro = {$registro} ";
    $buscando_vendedor = mysqli_query($conecta,$buscar_vendedor);
    $resultado_vendedor = mysqli_fetch_assoc($buscando_vendedor);
    $nome_vendedor = utf8_encode($resultado_vendedor['nome']);

    $buscar_local = "SELECT * ";
    $buscar_local .= "FROM locais ";
    $buscar_local .= "WHERE local_id = {$local_id} ";
    $buscando_local = mysqli_query($conecta,$buscar_local);
    $resultado_local = mysqli_fetch_assoc($buscando_local);
    $nome_loja_venda = utf8_encode($resultado_local['nome']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Venda | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="../_js/personalizado4.js"></script>
        <script src="../_js/escondendo.js"></script>
        <style type="text/css">
            div.listagem li:nth-child(1) {
                width: 5%;
            }
            div.listagem li:nth-child(2) {
                width: 10%;
            }    
            div.listagem li:nth-child(3) {
                width: 10%;
            }    
            div.listagem li:nth-child(4) {
                width: 20%;
            }    
            div.listagem li:nth-child(5) {
                width: 5%;
            }    
            div.listagem li:nth-child(6) {
                width: 15%;
            }
            div.listagem li:nth-child(7) {
                width: 10%;
            }
            div.listagem li:nth-child(8) {
                width: 10%;
            }
            div.listagem li:nth-child(9) {
                width: 10%;
            }
            div.listagem li:nth-child(10) {
                width: 5%;
            }
            div.listagem ul:nth-child(odd) {
                font-style: italic;
            }
            button[type=submit] {
                border: none;
            }
            div.info {
                text-align: center;
                border-radius: 5px;
            }
            div#erro {
                color: red;
                background: rgb(255,163,163);
                background: linear-gradient(90deg, rgba(255,163,163,1) 0%, rgba(249,245,245,1) 50%, rgba(255,163,163,1) 100%);
                border: solid 1px red;
            }
            div#sucesso{
                color: green;
                background: rgb(148,255,108);
                background: linear-gradient(90deg, rgba(148,255,108,1) 0%, rgba(249,245,245,1) 50%, rgba(148,255,108,1) 100%);
                border: solid 1px green;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid login">
            <div class="row">
                <div id="img">
                    <img src="../_img/logo.png">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    if(isset($_POST['fechar'])){
                        $codigo_venda = $_POST['codigo_venda'];
                        $total        = $_POST['total'];
                        $cpf          = $_POST['cpf'];
                        $pagamento    = $_POST['pagamento'];
                        $quantidade   = $_POST['quantidade'];
                        $data         = date('d/m/Y H:i:s');
                        $observacao   = utf8_decode($_POST['observacao']);
                        $entrega      = 1;

                        $fechar_venda = "UPDATE vendas ";
                        $fechar_venda .= "SET ";
                        $fechar_venda .= "pagamento_id = '{$pagamento}', ";
                        $fechar_venda .= "cpf = '{$cpf}', ";
                        $fechar_venda .= "quantidade = '{$quantidade}', ";
                        $fechar_venda .= "valor = '{$total}', ";
                        $fechar_venda .= "data_venda = '{$data}', ";
                        $fechar_venda .= "entrega_id = '{$entrega}', ";
                        $fechar_venda .= "observacao = '{$observacao}' ";
                        $fechar_venda .= "WHERE codigo_venda = {$codigo_venda} ";
                        $fechando_venda = mysqli_query($conecta,$fechar_venda);

                        if(!$fechando_venda){
                    ?>
                    <div class='info' id='erro'>Erro ao fechar venda. Confira as informações e tente novamente.</div>
                    <?php
                        } else {
                            header('location: cupom.php');
                        }
                    }

                    if(isset($_POST['online'])){
                        $codigo_venda = $_POST['codigo_venda'];
                        $total        = $_POST['total'];
                        $cpf          = $_POST['cpf'];
                        $pagamento    = $_POST['pagamento'];
                        $quantidade   = $_POST['quantidade'];
                        $data         = date('d/m/Y H:i:s');
                        $observacao   = utf8_decode($_POST['observacao']);
                        $entrega      = 2;

                        $fechar_venda = "UPDATE vendas ";
                        $fechar_venda .= "SET ";
                        $fechar_venda .= "pagamento_id = '{$pagamento}', ";
                        $fechar_venda .= "cpf = '{$cpf}', ";
                        $fechar_venda .= "quantidade = '{$quantidade}', ";
                        $fechar_venda .= "valor = '{$total}', ";
                        $fechar_venda .= "data_venda = '{$data}', ";
                        $fechar_venda .= "entrega_id = '{$entrega}', ";
                        $fechar_venda .= "observacao = '{$observacao}' ";
                        $fechar_venda .= "WHERE codigo_venda = {$codigo_venda} ";
                        $fechando_venda = mysqli_query($conecta,$fechar_venda);

                        if(!$fechando_venda){
                    ?>
                    <div class='info' id='erro'>Erro ao fechar venda. Confira as informações e tente novamente.</div>
                    <?php
                        } else {
                            header('location: preencher.php');
                        }
                    }

                    if(isset($_POST['retirar'])){
                        $codigo_venda = $_POST['codigo_venda'];
                        $codigo_modelo = $_POST['codigo'];

                        $buscar_produto = "SELECT * ";
                        $buscar_produto .= "FROM vendidas ";
                        $buscar_produto .= "WHERE codigo_venda = {$codigo_venda} AND codigo = {$codigo_modelo} ";
                        $buscando_produto = mysqli_query($conecta,$buscar_produto);
                        $resultado_produto = mysqli_fetch_assoc($buscando_produto);

                        $produto_id = $resultado_produto['vendida_id'];
                        $produto_quantidade = $resultado_produto['quantidade'];

                        $buscar_qtde_estoque = "SELECT * ";
                        $buscar_qtde_estoque .= "FROM estoque ";
                        $buscar_qtde_estoque .= "WHERE codigo = {$codigo_modelo} AND local_id = {$local_id} ";
                        $buscando_qtde_estoque = mysqli_query($conecta,$buscar_qtde_estoque);
                        $resultado_qtde_estoque = mysqli_fetch_assoc($buscando_qtde_estoque);

                        if(!$resultado_qtde_estoque){
                            echo "<div class='info' id='erro'>Erro ao buscar estoque existente. Confira as informações e tente novamente.</div>";
                        } else {
                            $quantidade_estoque = $resultado_qtde_estoque['quantidade'];
                            $estoque_id         = $resultado_qtde_estoque['estoque_id'];
                            $preco              = $resultado_qtde_estoque['preco'];

                            $nova_quantidade_estoque = ($quantidade_estoque + $produto_quantidade);
                            $novo_valor_total        = ($nova_quantidade_estoque * $preco);

                            $alterar_estoque = "UPDATE estoque ";
                            $alterar_estoque .= "SET ";
                            $alterar_estoque .= "quantidade = '{$nova_quantidade_estoque}', ";
                            $alterar_estoque .= "total = '{$novo_valor_total}' ";
                            $alterar_estoque .= "WHERE estoque_id = {$estoque_id} ";
                            $alterando_estoque = mysqli_query($conecta,$alterar_estoque);

                            if(!$alterando_estoque){
                                echo "<div class='info' id='erro'>Não foi possível devolver as peças ao estoque. Confira as informações e tente novamente.</div>";
                            } else {
                                $deletar = "DELETE FROM vendidas ";
                                $deletar .= "WHERE vendida_id = {$produto_id} ";
                                $deletando = mysqli_query($conecta,$deletar);

                                if(!$deletando){
                                    echo "<div class='info' id='erro'>Erro ao excluir peças da venda. Confira as informações e tente novamente.</div>";
                                } else {
                                    echo "<div class='info' id='sucesso'>Peças retiradas da venda com sucesso.</div>";
                                }
                            }
                        }
                    }

                    if(isset($_POST['cancelar'])){
                        $codigo_venda = $_POST['codigo_venda'];
                        $local_id = $_POST['local'];

                        $cancelar_vendas = "SELECT * ";
                        $cancelar_vendas .= "FROM vendidas ";
                        $cancelar_vendas .= "WHERE codigo_venda = {$codigo_venda} ";
                        $cancelando_vendas = mysqli_query($conecta,$cancelar_vendas);
                        while($cancelamento = mysqli_fetch_assoc($cancelando_vendas)){
                            $codigo = $cancelamento['codigo'];
                            $quantidade = $cancelamento['quantidade'];
                            $id = $cancelamento['vendida_id'];

                            $buscar_qtde_estoque = "SELECT * ";
                            $buscar_qtde_estoque .= "FROM estoque ";
                            $buscar_qtde_estoque .= "WHERE codigo = {$codigo} AND local_id = {$local_id} ";
                            $buscando_qtde_estoque = mysqli_query($conecta,$buscar_qtde_estoque);
                            $resultado_qtde_estoque = mysqli_fetch_assoc($buscando_qtde_estoque);

                            $quantidade_estoque = $resultado_qtde_estoque['quantidade'];
                            $estoque_id         = $resultado_qtde_estoque['estoque_id'];
                            $preco = $resultado_qtde_estoque['preco'];

                            $nova_quantidade_estoque = ($quantidade_estoque + $quantidade);
                            $novo_valor_total        = ($nova_quantidade_estoque * $preco);

                            $alterar_estoque = "UPDATE estoque ";
                            $alterar_estoque .= "SET ";
                            $alterar_estoque .= "quantidade = '{$nova_quantidade_estoque}', ";
                            $alterar_estoque .= "total = '{$novo_valor_total}' ";
                            $alterar_estoque .= "WHERE estoque_id = {$estoque_id} ";
                            $alterando_estoque = mysqli_query($conecta,$alterar_estoque);

                            if(!$alterando_estoque){
                                echo "<div class='info' id='erro'>Não foi possível devolver peças ao estoque. Confira as informações e tente novamente.</div>";
                            } else {
                                $deletar = "DELETE FROM vendidas ";
                                $deletar .= "WHERE vendida_id = {$id} ";
                                $deletando = mysqli_query($conecta,$deletar);

                                if(!$deletando){
                                    echo "<div class='info' id='erro'>Erro ao devolver venda ao estoque. Confira as informações e tente novamente.</div>";
                                }
                            }
                        }

                        $excluir = "DELETE FROM vendas ";
                        $excluir .= "WHERE codigo_venda = {$codigo_venda} ";
                        $excluindo = mysqli_query($conecta,$excluir);

                        if($excluindo){
                            echo "<div class='info' id='sucesso'>Venda cancelada com sucesso.</div>";
                        } else {
                            echo "<div class='info' id='erro'>Erro ao cancelar venda. Confira as informações e tente novamente.</div>";
                        }
                    }

                    if(isset($_POST['adicionar'])){
                        $modelo_codigo = $_POST['codigo'];
                        $quantidade    = $_POST['quantidade'];
                        $codigo_venda  = $_POST['codigo_venda'];

                        $buscar_modelo = "SELECT * ";
                        $buscar_modelo .= "FROM modelos ";
                        $buscar_modelo .= "WHERE codigo = {$modelo_codigo} ";
                        $buscando_modelo = mysqli_query($conecta,$buscar_modelo);
                        $resultado_modelo = mysqli_fetch_assoc($buscando_modelo);

                        $modelo_nome    = utf8_decode($resultado_modelo['nome']);
                        $modelo_tamanho = $resultado_modelo['tamanho_id'];
                        $modelo_cor     = $resultado_modelo['cor_id'];
                        $modelo_tecido  = $resultado_modelo['tecido_id'];
                        $modelo_preco   = $resultado_modelo['preco'];

                        $modelo_total   = ($quantidade * $modelo_preco);

                        $buscar_qtde_estoque = "SELECT * ";
                        $buscar_qtde_estoque .= "FROM estoque ";
                        $buscar_qtde_estoque .= "WHERE codigo = {$modelo_codigo} AND local_id = {$local_id} ";
                        $buscando_qtde_estoque = mysqli_query($conecta,$buscar_qtde_estoque);
                        $resultado_qtde_estoque = mysqli_fetch_assoc($buscando_qtde_estoque);

                        $quantidade_estoque = $resultado_qtde_estoque['quantidade'];
                        $estoque_id         = $resultado_qtde_estoque['estoque_id'];

                        $nova_quantidade_estoque = ($quantidade_estoque - $quantidade);
                        $novo_valor_total        = ($nova_quantidade_estoque * $modelo_preco);
                        if($nova_quantidade_estoque < 0){
                            echo "<div class='info' id='erro'>Não há peças suficientes no estoque.</div>";
                        } else {
                            $alterar_estoque = "UPDATE estoque ";
                            $alterar_estoque .= "SET ";
                            $alterar_estoque .= "quantidade = '{$nova_quantidade_estoque}', ";
                            $alterar_estoque .= "total = '{$novo_valor_total}' ";
                            $alterar_estoque .= "WHERE estoque_id = {$estoque_id} ";
                            $alterando_estoque = mysqli_query($conecta,$alterar_estoque);

                            if(!$alterando_estoque){
                                echo "<div class='info' id='erro'>Erro ao alterar estoque. Confira as informações e tente novamente.</div>";
                            } else {
                                $inserir_vendidas = "INSERT INTO vendidas ";
                                $inserir_vendidas .= "(codigo_venda, codigo, quantidade, nome, tamanho_id, tecido_id, cor_id, preco, total) ";
                                $inserir_vendidas .= "VALUES ";
                                $inserir_vendidas .= "($codigo_venda, $modelo_codigo, $quantidade, '$modelo_nome', $modelo_tamanho, $modelo_tecido, $modelo_cor, $modelo_preco, $modelo_total) ";

                                $inserindo_vendidas = mysqli_query($conecta,$inserir_vendidas);

                                if(!$inserindo_vendidas){
                                    echo "<div class='info' id='erro'>Não foi possível inserir peças na venda. Confira as informações e tente novamente.</div>";
                                } else {
                                    echo "<div class='info' id='sucesso'>Peças inseridas na venda com sucesso.</div>";
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="estoque-local.php?local=<?php echo $local_id ?>" target="_blank">
                        <p>Ver Estoque</p>
                    </a>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <a href="#">
                        <p></p>
                    </a>
                </div>
                <div class="col-12 col-md-2 col-lg-1">
                    <a href="#">
                        <p></p>
                    </a>
                </div>
                <div class="col-12 col-md-1 col-lg-1">
                    <a href="#">
                        <p></p>
                    </a>
                </div>                
                <div class="nome col-12 col-md-8 col-lg-3">
                    <p><?php echo utf8_encode($resultado_funcionario['nome']) ?></p>
                </div>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3>Registrando Venda<br>Nº.: <?php echo $cod_vend ?></h3>
                </div>
                <div class="row form-group">
                    <div class="row col-12">
                        <h6 class="col-12 col-lg-6">Loja: <?php echo $nome_loja_venda ?></h6>
                        <h6 class="col-12 col-lg-6 right">
                            Vendedora: <?php echo $nome_vendedor ?>
                        </h6>
                    </div>
                </div>
                <div id="formulario">
                    <div class='row box col-12 formulario form-group'>
                        <div class='row col-12'>
                            <div class="col-12">
                                <form method="POST" id="form-pesquisa" action="">
                                    <div class="col-12 col-lg-2">
                                        <label>Pesquisar código: </label>
                                        <input class="form-control" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código">
                                    </div>
                                </form>
                                <form class="row col-12 form-group" action="venda.php" method="post">
                                    <input type="hidden" name="codigo_venda" value="<?php echo $resultado_venda['codigo_venda']; ?>">
                                    <div class="resultado col-12 row"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $buscar_vendas = "SELECT sum(total), sum(quantidade) ";
                    $buscar_vendas .= "FROM vendidas ";
                    $buscar_vendas .= "WHERE codigo_venda = {$resultado_venda['codigo_venda']} ";
                    $buscando_vendas = mysqli_query($conecta,$buscar_vendas);    
                    $resultado_vendas = mysqli_fetch_assoc($buscando_vendas);

                    $valor_total_venda = $resultado_vendas['sum(total)'];
                    $quantidade_total_venda = $resultado_vendas['sum(quantidade)'];
                ?>
                <div class="row box">
                    <form class="row col-12" action="venda.php" method="post">
                        <input type="hidden" name="codigo_venda" id="codigo_venda" value="<?php echo $resultado_venda['codigo_venda']; ?>">

                        <div class="col-12 col-lg-4">
                            <label for="total">Valor Total: <small>(<?php echo 'R$ ' . number_format($valor_total_venda, 2, ',', '.'); ?>)</small></label>
                            <input class="form-control" id="total" name="total" value="<?php echo $valor_total_venda ?>" required>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="CPF:">CPF:</label>
                            <input class="form-control" id="cpf" name="cpf" placeholder="(opcional)" maxlength="11">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="pagamento:">Forma de Pagamento:</label>
                            <select name="pagamento" class="form-control">
                                <option value="0" selected>Selecione...</option>
                                <?php
                                    $buscar_pagamento = "SELECT * ";
                                    $buscar_pagamento .= "FROM pagamentos ";
                                    $buscando_pagamento = mysqli_query($conecta,$buscar_pagamento);
                                    while($lista_pagamentos = mysqli_fetch_assoc($buscando_pagamento)){
                                        ?>
                                <option value="<?php echo $lista_pagamentos['pagamento_id'] ?>"><?php echo utf8_encode($lista_pagamentos['pagamento']) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="observacao">Observações:</label>
                            <textarea class="form-control" name="observacao" id="observacao" placeholder="(Opcional)" maxlength="300"></textarea>
                        </div>
                        <div class="col-12 col-lg-3">
                            <input type="hidden" name="quantidade" value="<?php echo $quantidade_total_venda ?>">
                            <input type="hidden" name="vendedor" value="<?php echo $registro ?>">
                            <input type="hidden" name="local" value="<?php echo $local_id ?>">
                            <input class="btn btn-block" id="fechar" type="submit" name="fechar" value="Retirado na Loja">
                        </div>
                        <div class="col-12 col-lg-3">
                            <input class="btn btn-block" id="online" type="submit" name="online" value="Enviar Pedido">
                        </div>
                        <div class="col-12 col-lg-3">
                            <input class="btn btn-block" style="color: red" id="cancelar" type="submit" name="cancelar" value="Cancelar Venda">
                        </div>
                    </form>
                </div>
                <div class="row listagem">
                    <div class="row col-12" style="padding: 10px ">
                        <div class="row col-12 line" style="margin: 0 1%"></div>
                    </div>
                    <ul class="list-title">
                        <li>Qtde.</li>
                        <li>Código</li>
                        <li>Tecido</li>
                        <li>Modelo</li>
                        <li>Tam.</li>
                        <li>Cor</li>
                        <li>Valor Unitário</li>
                        <li>Total por peça</li>
                        <li></li>
                        <li></li>
                    </ul>
                    <?php
                        $listar_vendas = "SELECT * ";
                        $listar_vendas .= "FROM vendidas ";
                        $listar_vendas .= "WHERE codigo_venda = {$resultado_venda['codigo_venda']} ";
                        $listando_vendas = mysqli_query($conecta,$listar_vendas);    
                        while($lista_vendas = mysqli_fetch_assoc($listando_vendas)){
                            $venda_codigo     = $lista_vendas['codigo'];
                            $venda_quantidade = $lista_vendas['quantidade'];
                            $venda_nome       = utf8_encode($lista_vendas['nome']);
                            $tamanho_id       = $lista_vendas['tamanho_id'];
                            $tecido_id        = $lista_vendas['tecido_id'];
                            $cor_id           = $lista_vendas['cor_id'];
                            $venda_preco      = $lista_vendas['preco'];
                            $venda_total      = $lista_vendas['total'];

                            $tec_item = "SELECT * ";
                        $tec_item .= "FROM tecidos ";
                        $tec_item .= "WHERE tecido_id = '{$tecido_id}' ";
                        $resultado_tec_item = mysqli_query($conecta, $tec_item);
                        if($resultado_tec_item){
                            $result_tec_item = mysqli_fetch_assoc($resultado_tec_item);
                            $mostrar_tec_item = utf8_encode($result_tec_item['tecido']);
                        }
                        $tam_item = "SELECT * ";
                        $tam_item .= "FROM tamanhos ";
                        $tam_item .= "WHERE tamanho_id = '{$tamanho_id}' ";
                        $resultado_tam_item = mysqli_query($conecta, $tam_item);
                        if($resultado_tam_item){
                            $result_tam_item = mysqli_fetch_assoc($resultado_tam_item);
                            $mostrar_tam_item = utf8_encode($result_tam_item['tamanho']);
                        }
                        $cor_item = "SELECT * ";
                        $cor_item .= "FROM cores ";
                        $cor_item .= "WHERE cor_id = '{$cor_id}' ";
                        $resultado_cor_item = mysqli_query($conecta, $cor_item);
                        if($resultado_cor_item){
                            $result_cor_item = mysqli_fetch_assoc($resultado_cor_item);
                            $mostrar_cor_item = utf8_encode($result_cor_item['cor']);
                        }
                    ?>
                    
                    <ul>
                        <form class="x form-group" action="venda.php" method="post">
                            <li><?php echo $venda_quantidade ?></li>
                            <li><?php echo $venda_codigo ?></li>
                            <li><?php echo $mostrar_tec_item ?></li>
                            <li><?php echo $venda_nome ?></li>
                            <li><?php echo $mostrar_tam_item ?></li>
                            <li><?php echo $mostrar_cor_item ?></li>
                            <li><?php echo 'R$ ' . number_format($venda_preco, 2, ',', '.'); ?></li>
                            <?php $preco_total = ($venda_quantidade * $venda_preco); ?>
                            <li><?php echo 'R$ ' . number_format($preco_total, 2, ',', '.'); ?></li>
                            <a href='modelo.php?codigo=<?php echo $venda_codigo ?>'><li class='btn btn-block'>Ver</li></a>
                            <input type="hidden" name="codigo" value="<?php echo $venda_codigo ?>">
                            <input type="hidden" name="codigo_venda" value="<?php echo $resultado_venda['codigo_venda'] ?>">
                            <a>
                                <li>
                                    <button class="form-control" style="color: red; font-weight: 900;" id="retirar" type="submit" name="retirar" title="Retirar da venda">X</button>
                                </li>
                            </a>
                        </form>
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>