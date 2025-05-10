<?php
    include('../_mdl/access.php');
    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);
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
            div.listvenda li:nth-child(1) {
                width: 12%;
            }
            div.listvenda li:nth-child(2) {
                width: 12%;
            }    
            div.listvenda li:nth-child(3) {
                width: 20%;
            }    
            div.listvenda li:nth-child(4) {
                width: 16%;
            }    
            div.listvenda li:nth-child(5) {
                width: 5%;
            }    
            div.listvenda li:nth-child(6) {
                width: 10%;
            }
            div.listvenda li:nth-child(7) {
                width: 13%;
            }
            div.listvenda li:nth-child(8) {
                width: 7%;
            }
            div.listvenda ul:nth-child(odd) {
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
                <div class="row box col-12">
                    <form class="col-12 col-lg-2 um" method="POST" id="form-pesquisa" action="todas-vendas.php">
                        <div class="col-12">
                            <label>Por código venda</label>
                            <input class="form-control" type="text" name="codigo_venda" id="codigo_venda" placeholder="Digite aqui">
                        </div>
                        <div class="col-12">
                            <input class="btn-block" type="submit" name="buscar" id="buscar" value="Pesquisar">
                        </div>
                    </form>
                    <form class="col-12 col-lg-10 form-group-inline" method="POST" id="form-pesquisa" action="todas-vendas.php">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Pesquisar entre datas</label>
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
            <?php
                                if(isset($_POST['buscar'])){
                                
                                $cod = $_POST['codigo_venda'];
                                
                                $listar_vendas = "SELECT * ";
                            $listar_vendas .= "FROM vendas ";
                                $listar_vendas .= "WHERE codigo_venda LIKE '%$cod%' ";
                                $listar_vendas .= "ORDER BY data_venda DESC ";
                                    $listando_vendas = mysqli_query($conecta,$listar_vendas);
                                    
                                    $pesquisa = "da pesquisa pelo código de venda: ".$cod;
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
                                    $listar_vendas .= "ORDER BY data_venda DESC ";
                                    $listando_vendas = mysqli_query($conecta,$listar_vendas);
                                    $pesquisa = "da pesquisa entre as data ".$data1." e ".$data2;
                            } else {
                                $listar_vendas = "SELECT * ";
                        $listar_vendas .= "FROM vendas ";
                                
                            $listar_vendas .= "ORDER BY data_venda DESC ";
                                    $listando_vendas = mysqli_query($conecta,$listar_vendas);
                                    $pesquisa = "";
                            }
            ?>
            <div class="row box col-12 results">
                    <div class="row col-12">
                        <h4 class="col-12 col-lg-4">Lista das Vendas</h4>
                        <h5 class="col-12 col-lg-8" style="text-align: right">
                            <?php
                            if(!$pesquisa){
                                echo "Mostrando todas as vendas...";
                            } else {
                            
                                echo "Mostrando resultados ".$pesquisa ;
                                echo "<form action='todas-vendas.php' method='post'>";
                                echo "<input type='submit' value='Limpar Pesquisa' class='btn'>";
                                echo "</form>";
                            
                            }?>
                            
                        </h5>
                    </div>
                
                    <div class="row box col-12 estoque listvenda">
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
                                if($pagamento_id == 0){
                                    $pagamento_nome = "Cancelado.";
                                } elseif($pagamento_id = $lista_pagamento['pagamento_id']){
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
                        <li><a href="visualizar-venda.php?codigo=<?php echo $codigo_venda ?>"><?php echo $codigo_venda ?></a></li>
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