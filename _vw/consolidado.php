<?php
    include('../_mdl/access.php');
    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);

    $local_id = $_GET['loja'];

    $buscar_loja = "SELECT * ";
    $buscar_loja .= "FROM locais ";
    $buscar_loja .= "WHERE local_id = {$local_id} ";
    $buscando_loja = mysqli_query($conecta,$buscar_loja);
    $resultado_lojas = mysqli_fetch_assoc($buscando_loja);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Vendas | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
                <script src="../_js/personalizado5.js"></script>
        <style type="text/css">
            div.listagem-venda li:nth-child(1) {
                width: 12%;
            }
            div.listagem-venda li:nth-child(2) {
                width: 12%;
            }    
            div.listagem-venda li:nth-child(3) {
                width: 20%;
            }    
            div.listagem-venda li:nth-child(4) {
                width: 16%;
            }    
            div.listagem-venda li:nth-child(5) {
                width: 5%;
            }    
            div.listagem-venda li:nth-child(6) {
                width: 10%;
            }
            div.listagem-venda li:nth-child(7) {
                width: 13%;
            }
            div.listagem-venda li:nth-child(8) {
                width: 7%;
            }
            div.listagem-venda ul:nth-child(odd) {
                font-style: italic;
            }
            div#e {
                text-align: center;
                padding: 0 auto;
            }
            form.um {
                border-right: solid 1px rgba(0,0,0,0.5);
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
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="adicionar-estoque.php">
                        <p>Adicionar Estoque</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-4 col-lg-2">
                    <a href="transporte.php">
                        <p>Entrada/Saída Estoque</p>
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
        </div>
        <div class="row box">
            <div class="row col-12">
                <form class="col-12 col-lg-2 um" method="POST" id="form-pesquisa" action="consolidado.php?loja=<?php echo $local_id ?>">
                    <div class="col-12">
                        <label>Por código venda</label>
                        <input class="form-control" type="text" name="codigo_venda" id="codigo_venda" placeholder="Digite aqui">
                    </div>
                    <div class="col-12">
                        <input class="btn-block" type="submit" name="buscar" id="buscar" value="Pesquisar">
                    </div>
                </form>
                <form class="col-12 col-lg-10 form-group-inline" method="POST" id="form-pesquisa" action="consolidado.php?loja=<?php echo $local_id ?>">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="row">
                                <div class="col-12">
                                    <label>Pesquisar período</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" type="date" name="data_inicial" id="data_inicial">
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="date" name="data_final" id="data_final">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <input type="submit" class="btn-block" name="pesquisar" value="Pesquisar">
                        </div>
                    </div>
                </form>
            </div>
        </div> 
        <?php
    if(isset($_POST['buscar'])){
        $cod = $_POST['codigo_venda'];
        
        $listar_vendas = "SELECT * ";
        $listar_vendas .= "FROM vendas ";
        $listar_vendas .= "WHERE codigo_venda LIKE '%$cod%' ";
        $listar_vendas .= "AND local_id = {$local_id} ";
        $listar_vendas .= "ORDER BY data_venda DESC ";
        $listando_vendas = mysqli_query($conecta,$listar_vendas);
        
        $pesquisa = "resultados da pesquisa pelo código de venda: ".$cod;
    } elseif(isset($_POST['pesquisar'])){
        
        
        $data_inicial = $_POST['data_inicial'];
        $data_final = $_POST['data_final'];
        
        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
        $data_inicio = $data1." 00:00:00";
        
        $date2 = date_parse_from_format("Y-m-d", $data_final);
        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
        $data_fim =  $data2." 23:59:59";
        
        $listar_vendas = "SELECT * ";
        $listar_vendas .= "FROM vendas ";
        $listar_vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
        $listar_vendas .= "AND local_id = {$local_id} ";
        $listar_vendas .= "ORDER BY data_venda DESC ";
        $listando_vendas = mysqli_query($conecta,$listar_vendas);
        $pesquisa = "vendas do período de ".$data1." a ".$data2;
    } else {
        $listar_vendas = "SELECT * ";
        $listar_vendas .= "FROM vendas ";
        $listar_vendas .= "WHERE local_id = {$local_id} ";
        $listar_vendas .= "ORDER BY data_venda DESC ";
        $listando_vendas = mysqli_query($conecta,$listar_vendas);
        $pesquisa = "";
    }
        ?>
        <div class="row box">
            <div class="row col-12">
                <?php
                if(!$pesquisa){
                ?>
                <div class='col-12 col-lg-3'></div>
                <div class='col-12 col-lg-6'>
                    <h5>Mostrando todas as vendas...</h5>
                </div>
                <div class='col-12 col-lg-3'></div>
                <?php
                } else {
                ?>
                <div class='col-12 col-lg-1'></div>
                <div class='col-12 col-lg-8'>
                    <h5>Mostrando <?php echo $pesquisa ?></h5>
                </div>
                <div class='col-12 col-lg-3'>
                    <form action='consolidado.php?loja=<?php echo $local_id ?>' method='post'>
                        <input type='submit' value='Limpar Pesquisa' class='btn-block'>
                    </form>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row box">
            <div class="row col-12">
                <h4><?php echo utf8_encode($resultado_lojas['nome']) ?> </h4>
            </div>
            <div class="col-12">
                <a href="consolidado.php?local<?php echo $resultado_lojas['local_id'] ?>" class="col-3 float-right"><input type="button" class="btn-block" value="Acessar Lista de Vendas"></a>
                <?php
    $consolidar_vendas = "SELECT * ";
                    $consolidar_vendas .= "FROM vendas ";
                    $consolidar_vendas .= "WHERE local_id = {$resultado_lojas['local_id']} ";
                    if(isset($_POST['pesquisar'])){
                        $data_inicial = $_POST['data_inicial'];
                        $data_final = $_POST['data_final'];
                        
                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                        $data_inicio = $data1." 00:00:00";
                        
                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                        $data_fim =  $data2." 23:59:59";
                        
                        $consolidar_vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                    }
                    $consolidando_vendas = mysqli_query($conecta,$consolidar_vendas);
                    if(!$consolidando_vendas){} else {
                        $resultado_vendas = mysqli_fetch_assoc($consolidando_vendas);
                    }
                    $somar_vendas = "SELECT sum(quantidade), sum(valor) ";
                    $somar_vendas .= "FROM vendas ";
                    $somar_vendas .= "WHERE local_id = {$resultado_lojas['local_id']} ";
                    if(isset($_POST['pesquisar'])){
                        $data_inicial = $_POST['data_inicial'];
                        $data_final = $_POST['data_final'];
                        
                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                        $data_inicio = $data1." 00:00:00";
                        
                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                        $data_fim =  $data2." 23:59:59";
                        
                        $somar_vendas .= "AND data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                    }
                    $somando_vendas = mysqli_query($conecta,$somar_vendas);
                    $resultando_vendas = mysqli_fetch_assoc($somando_vendas);
                    
                    $qtde_vendas = "SELECT COUNT(codigo_venda) ";
                    $qtde_vendas .= "AS TOTAL ";
                    $qtde_vendas .= "FROM vendas ";
                    $qtde_vendas .= "WHERE local_id = {$resultado_lojas['local_id']} ";
                    if(isset($_POST['pesquisar'])){
                        $data_inicial = $_POST['data_inicial'];
                        $data_final = $_POST['data_final'];
                        
                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                        $data_inicio = $data1." 00:00:00";
                        
                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                        $data_fim =  $data2." 23:59:59";
                        
                        $qtde_vendas .= "AND data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                    }
                    $contando_vendas = mysqli_query($conecta,$qtde_vendas);
                    $quantidade_vendas = mysqli_fetch_assoc($contando_vendas);
                ?>
                <div class="row col-12 line"></div>
                <ul>
                    <div class="row col-12">
                        <li class="col-12 col-lg-4">Total de peças vendidas: <?php if(!$resultando_vendas['sum(quantidade)']){ echo "0"; } else { echo $resultando_vendas['sum(quantidade)'];} ?></li>
                        <li class="col-12 col-lg-4">Total de vendas: <?php echo $quantidade_vendas['TOTAL'] ?></li>
                        <li class="col-12 col-lg-4">Valor Total em vendas: <?php echo "R$ ".number_format($resultando_vendas['sum(valor)'], 2, ',', '.'); ?></li>
                    </div>
                    <div class="row col-12 line"></div>
                    <div class="row col-12">
                        <?php
                        $buscar_v_tamanho = "SELECT * ";
                        $buscar_v_tamanho .= "FROM tamanhos ";
                        $buscar_v_tamanho .= "ORDER BY tamanho_id ASC ";
                        $buscando_v_tamanho = mysqli_query($conecta,$buscar_v_tamanho);
                        
                        while($resultado_v_tamanho = mysqli_fetch_assoc($buscando_v_tamanho)){
                            $soma_quantidade_v = "SELECT sum(quantidade) ";
                            $soma_quantidade_v .= "FROM vendidas ";
                            $soma_quantidade_v .= "WHERE tamanho_id = {$resultado_v_tamanho['tamanho_id']} ";
                            $soma_quantidade_v .= "AND local_id = {$resultado_lojas['local_id']} ";
                            
                            if(isset($_POST['pesquisar'])){
                                $data_inicial = $_POST['data_inicial'];
                                $data_final = $_POST['data_final'];
                                
                                $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                                $data1 = sprintf("%04d%02d%02d", $date1["year"], $date1["month"], $date1["day"] );
                                $data_inicio = $data1."000000";
                                
                                $date2 = date_parse_from_format("Y-m-d", $data_final);
                                $data2 = sprintf("%04d%02d%02d", $date2["year"], $date2["month"], $date2["day"]);
                                $data_fim =  $data2."999999";
                                
                                $soma_quantidade_v .= "AND codigo_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                            } 
                            $somando_quantidade_v = mysqli_query($conecta,$soma_quantidade_v);
                            $resultado_quantidade_v = mysqli_num_rows($somando_quantidade_v);
                            
                            if($resultado_quantidade_v = mysqli_fetch_array($somando_quantidade_v)){
                                $total_v_tam = $resultado_quantidade_v['sum(quantidade)'];
                            }
                            if(!$total_v_tam){} else {
                        ?>
                        <li class="col-12 col-md-6 col-lg-3">Quantidade de <?php echo $resultado_v_tamanho['tamanho'] ?> : <?php echo $total_v_tam ?></li>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="row col-12 line"></div>
                    <div class="row col-12">
                        <?php
                        $buscar_estoque_cores = "SELECT * ";
                        $buscar_estoque_cores .= "FROM cores ";
                        $buscar_estoque_cores .= "ORDER BY cor ASC ";
                        $buscando_estoque_cores = mysqli_query($conecta,$buscar_estoque_cores);
                        
                        while($resultado_cores = mysqli_fetch_assoc($buscando_estoque_cores)){
                            $soma_quantidad = "SELECT sum(quantidade) ";
                            $soma_quantidad .= "FROM vendidas ";
                            $soma_quantidad .= "WHERE cor_id = {$resultado_cores['cor_id']} ";
                            $soma_quantidad .= "AND local_id = {$resultado_lojas['local_id']} ";
                            
                            if(isset($_POST['pesquisar'])){
                                $data_inicial = $_POST['data_inicial'];
                                $data_final = $_POST['data_final'];
                                
                                $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                                $data1 = sprintf("%04d%02d%02d", $date1["year"], $date1["month"], $date1["day"] );
                                $data_inicio = $data1."000000";
                                
                                $date2 = date_parse_from_format("Y-m-d", $data_final);
                                $data2 = sprintf("%04d%02d%02d", $date2["year"], $date2["month"], $date2["day"]);
                                $data_fim =  $data2."999999";
                                
                                $soma_quantidad .= "AND codigo_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                            }
                            $somando_quantidad = mysqli_query($conecta,$soma_quantidad);
                            $resultado_quantidad = mysqli_num_rows($somando_quantidad);
                            
                            if($resultado_quantidad = mysqli_fetch_array($somando_quantidad)){
                                $total_cores = $resultado_quantidad['sum(quantidade)'];
                            }
                            if(!$total_cores){
                            } else {
                        ?>
                        <li class="col-12 col-md-4 col-lg-3">Quantidade de <?php echo $resultado_cores['cor'] ?> : <?php echo $total_cores ?></li>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
        <div class="row box">
            <div class="col-12 results">
                <div class="row col-12">
                    <h4 class="col-12 col-lg-4">Lista das Vendas</h4>
                </div>
                <div class="row box col-12 listagem-venda">
                    <ul class="list-title">
                        <li>Código da Venda</li>
                        <li>Data</li>
                        <li>Código e Nome Vendedor(a)</li>
                        <li>Loja </li>
                        <li>Qtde. Itens</li>
                        <li>Forma de Pagamento</li>
                        <li>Valor da Venda</li>
                        <li></li>
                    </ul>
                    <?php
                    while($lista_vendas = mysqli_fetch_assoc($listando_vendas)){
                        $codigo_venda = $lista_vendas['codigo_venda'];
                        $registro     = $lista_vendas['registro'];
                        $local_id     = $lista_vendas['local_id'];
                        $pagamento_id = $lista_vendas['pagamento_id'];
                        $cpf          = $lista_vendas['cpf'];
                        $quantidade   = $lista_vendas['quantidade'];
                        if(!$lista_vendas['valor']){
                            $valor = 0;
                        } else {
                            $valor        = $lista_vendas['valor'];
                        }
                        $data_venda   = $lista_vendas['data_venda'];
                        $entrega_id   = $lista_vendas['entrega_id'];
                        $registrado   = $lista_vendas['registrado'];
                        $observacao   = utf8_encode($lista_vendas['observacao']);
                        
                        $listar_pagamento = "SELECT * ";
                        $listar_pagamento .= "FROM pagamentos ";
                        $listar_pagamento .= "WHERE pagamento_id = {$pagamento_id} ";
                        $listando_pagamento = mysqli_query($conecta,$listar_pagamento);
                        $lista_pagamento = mysqli_fetch_assoc($listando_pagamento);
                        if($pagamento_id = $lista_pagamento['pagamento_id']){
                            $pagamento_nome = utf8_encode($lista_pagamento['pagamento']);
                        }
                        
                        $listar_entrega = "SELECT * ";
                        $listar_entrega .= "FROM entrega ";
                        $listar_entrega .= "WHERE entrega_id = $entrega_id ";
                        $listando_entrega = mysqli_query($conecta,$listar_entrega);
                        $lista_entrega = mysqli_fetch_assoc($listando_entrega);
                        if($entrega_id = $lista_entrega['entrega_id']){
                            $entrega_nome = utf8_encode($lista_entrega['entrega']);
                        }
                        
                        $listar_local = "SELECT * ";
                        $listar_local .= "FROM locais ";
                        $listar_local .= "WHERE local_id = {$local_id} ";
                        $listando_local = mysqli_query($conecta,$listar_local);
                        $lista_local = mysqli_fetch_assoc($listando_local);
                        if($local_id = $lista_local['local_id']){
                            $local_nome = utf8_encode($lista_local['nome']);
                        }
                        
                        $busca_funcionario = "SELECT * ";
                        $busca_funcionario .= "FROM funcionarios ";
                        $busca_funcionario .= "WHERE registro = {$registro} ";
                        $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
                        $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);
                        if($registro = $resultado_funcionario['registro']){
                            $nome_vendedor = utf8_encode($resultado_funcionario['nome']);
                        }
                        
                        $busca_funcionario = "SELECT * ";
                        $busca_funcionario .= "FROM funcionarios ";
                        $busca_funcionario .= "WHERE registro = {$registrado} ";
                        $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
                        $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);
                        if($registrado = $resultado_funcionario['registro']){
                            $nome_registrou = utf8_encode($resultado_funcionario['nome']);
                        }
                    ?>
                    <ul>
                        <li><a href="visualizar-romaneio.php?codigo=<?php echo $codigo_venda ?>"><?php echo $codigo_venda ?></a></li>
                        <li><?php echo $data_venda ?></li>
                        <li><?php echo $registro." - ".$nome_vendedor ?></li>
                        <li><?php echo $local_nome ?></li>
                        <li><?php echo $quantidade ?></li>
                        <li><?php echo $pagamento_nome ?></li>
                        <li><?php echo "R$ " . number_format($valor, 2, ',', '.') ?></li>
                        <li><?php echo $entrega_nome ?></li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>