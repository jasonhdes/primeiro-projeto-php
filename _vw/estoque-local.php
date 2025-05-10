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

    $estoque_local = $_GET['local'];

    include('../_ctrl/estoque-local.php');
    include('../_mdl/transformando.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ESTOQUE | ko.dok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="../_js/jquery-3.4.1.js"></script>
        <style type="text/css">
            .line {
                border-top: solid 1px gainsboro;
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
                <div class="btn col-12 col-md-3 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-3 col-md-3 col-lg-2">
                    <a href="estoque.php">
                        <p>Estoque Geral</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-4 col-md-3 col-lg-2">
                    <a href="transporte.php">
                        <p>Entrada/Saída Estoque</p>
                    </a>
                </div>
                <div class="col-12 col-md-2 col-md-3 col-lg-1">
                    <a href="#">
                        <p></p>
                    </a>
                </div>
                <div class="col-12 col-md-1 col-md-3 col-lg-1">
                    <a href="#">
                        <p></p>
                    </a>
                </div>                
                <div class="nome col-12 col-md-8 col-md-3 col-lg-3">
                    <p><?php echo utf8_encode($resultado_funcionario['nome']) ?></p>
                </div>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3>Consolidado</h3>
                </div>
                <div class="row box">
                    <div class="row col-12">
                        <h4>
                            <?php
                                $local_estoque = "SELECT * ";
                                $local_estoque .= "FROM locais ";
                                $local_estoque .= "WHERE local_id = {$estoque_local} ";
                                $lista_estoque_local = mysqli_query($conecta, $local_estoque);
                                $list_estoque_local = mysqli_fetch_assoc($lista_estoque_local);

                                if($local_estoque_id = $list_local['local_id']){
                                    $local_estoque_nome = utf8_encode($list_estoque_local['nome']);
                                }
                            
                                echo $local_estoque_nome
                                    
                            ?>
                        </h4>
                    </div>
                    <div class="col-12">
                        <ul>
                            <div class="row col-12 line"></div>
                            <div class="row col-12">
                                <?php
                                    $soma_quantidade = "SELECT sum(quantidade) ";
                                    $soma_quantidade .= "FROM estoque ";
                                    $soma_quantidade .= "WHERE local_id = {$estoque_local} ";

                                    $somando_quantidade = mysqli_query($conecta,$soma_quantidade);
                                    $resultado_quantidade = mysqli_num_rows($somando_quantidade);

                                    if($resultado_quantidade = mysqli_fetch_array($somando_quantidade)){
                                        $total_pecas_estoque = $resultado_quantidade['sum(quantidade)'];
                                    }

                                    $info_estoque = "SELECT * ";
                                    $info_estoque .= "FROM estoque ";
                                    $info_estoque .= "WHERE local_id = {$estoque_local} ";

                                    $buscando_info_estoque = mysqli_query($conecta,$info_estoque);
                                    $quantidade_modelos_estoque = mysqli_num_rows($buscando_info_estoque);
                                ?>
                                <li class="col-12 col-md-4 col-lg-4">Total de peças no estoque: <?php echo $resultado_quantidade['sum(quantidade)']; ?></li>
                                <li class="col-12 col-md-4 col-lg-4">Total de modelos: <?php echo $quantidade_modelos_estoque ?></li>
                                <?php
                                    $valor_total_local = "SELECT sum(total) ";
                                    $valor_total_local .= "FROM estoque ";
                                    $valor_total_local .= "WHERE local_id = {$estoque_local} ";
                                    
                                    $query_valores = mysqli_query($conecta,$valor_total_local);
                                        while($info_query = mysqli_fetch_assoc($query_valores)){
                                            $valor_total = $info_query['sum(total)'];
                                        }
                                ?>
                                <li class="float-right col-12 col-md-4 col-lg-4">Total em estoque: <?php echo 'R$ ' . number_format($valor_total, 2, ',', '.'); ?></li>
                            </div>
                            <div class="row col-12 line"></div>
                            <div class="row col-12">
                                <?php
                                    $buscando_estoque_tamanho = "SELECT * ";
                                    $buscando_estoque_tamanho .= "FROM tamanhos ";
                                    $buscando_estoque_tamanho .= "ORDER BY tamanho_id ASC ";
                                    $encontrando_estoque_tamanho = mysqli_query($conecta,$buscando_estoque_tamanho);

                                    while($row_tamanho = mysqli_fetch_assoc($encontrando_estoque_tamanho)){
                                        $soma_quantidade = "SELECT sum(quantidade) ";
                                        $soma_quantidade .= "FROM estoque ";
                                        $soma_quantidade .= "WHERE local_id = {$estoque_local} AND tamanho_id = {$row_tamanho['tamanho_id']} ";

                                        $somando_quantidade = mysqli_query($conecta,$soma_quantidade);
                                        $resultado_quantidade = mysqli_num_rows($somando_quantidade);

                                        if($resultado_quantidade = mysqli_fetch_array($somando_quantidade)){
                                            $total_tam = $resultado_quantidade['sum(quantidade)'];
                                        }
                                        if($total_tam == 0){} else {
                                ?>
                                <li class="col-12 col-md-6 col-lg-3">Quantidade de <?php echo $row_tamanho['tamanho'] ?> : <?php echo $total_tam ?></li>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                            <div class="row col-12 line"></div>
                            <div class="row col-12">
                                <?php
                                    $buscando_estoque_cores = "SELECT * ";
                                    $buscando_estoque_cores .= "FROM cores ";
                                    $buscando_estoque_cores .= "ORDER BY cor ASC ";
                                    $encontrando_estoque_cores = mysqli_query($conecta,$buscando_estoque_cores);

                                    while($row_cores = mysqli_fetch_assoc($encontrando_estoque_cores)){
                                        $soma_quantidad = "SELECT sum(quantidade) ";
                                        $soma_quantidad .= "FROM estoque ";
                                        $soma_quantidad .= "WHERE local_id = {$estoque_local} AND cor_id = {$row_cores['cor_id']} ";

                                        $somando_quantidad = mysqli_query($conecta,$soma_quantidad);
                                        $resultado_quantidad = mysqli_num_rows($somando_quantidad);

                                        if($resultado_quantidad = mysqli_fetch_array($somando_quantidad)){
                                            $total_cores = $resultado_quantidad['sum(quantidade)'];
                                        }
                                        if($total_cores == 0){} else {
                                ?>
                                <li class="col-12 col-md-4 col-lg-3">Quantidade de <?php echo $row_cores['cor'] ?> : <?php echo $total_cores ?></li>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="row col-12">
                        
                        <h3>Peças em estoque</h3>
                     <div class="col-12 col-lg-3"></div>
                        <div class="col-12 col-lg-6">
                            <form style="float: right" class="form-inline" method="GET" id="form-pesquisa" action="estoque-local.php?local=<?php echo $estoque_local ?>">
                                <input type="hidden" name="local" value="<?php echo $estoque_local ?>">
                                <div class="form-group mx-sm-3 mb-2">
                                <input class="form-control-plaintext" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código aqui">
                                </div>
                                <div class="form-group">
                                <input class="btn btn-block mb-2" type="submit" name="buscar" value="Pesquisar">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row box col-12 estoque">
                        <div class="row col-12" style="padding: 10px ">
                            <div class="row col-12 line" style="margin: 0 1%"></div>
                        </div>
                        <div class=" col-12">
                            <ul class="list-title">
                                <li>Qtde.</li>
                                <li>Código</li>
                                <li>Tecido</li>
                                <li>Modelo</li>
                                <li>Tam.</li>
                                <li>Cor</li>
                                <li>Preço</li>
                                <li></li>
                            </ul>
                            <?php
                                if(isset($_GET['pesquisa'])){
                                    $est_local = $_GET['local'];
                                    $pesquisa = $_GET['pesquisa'];
                                    $buscando_estoque_local = "SELECT * ";
                                    $buscando_estoque_local .= "FROM estoque ";
                                    $buscando_estoque_local .=  "WHERE local_id = {$est_local} ";
                                    $buscando_estoque_local .= "AND codigo LIKE '%{$pesquisa}%' ";
                                    $buscando_estoque_local .= "ORDER BY codigo ASC ";
                                } else {
                                    $buscando_estoque_local = "SELECT * ";
                                    $buscando_estoque_local .= "FROM estoque ";
                                    $buscando_estoque_local .= "WHERE local_id = {$estoque_local} ";
                                    $buscando_estoque_local .= "ORDER BY codigo ASC ";
                                }
                                           $encontrando_estoque_local = mysqli_query($conecta,$buscando_estoque_local);
                                           while($row_estoque = mysqli_fetch_assoc($encontrando_estoque_local)){
                                               $codigo_ref = $row_estoque['codigo'];
                                               $qtde_estoq = $row_estoque['quantidade'];
                                               $valores    = $row_estoque['preco'];
                                               $nome_model = utf8_encode($row_estoque['nome']);
                                               $tec_id     = $row_estoque['tecido_id'];
                                               $tam_id     = $row_estoque['tamanho_id'];
                                               $color_id   = $row_estoque['cor_id'];

                                               $tec_item = "SELECT * ";
                                               $tec_item .= "FROM tecidos ";
                                               $tec_item .= "WHERE tecido_id = '{$tec_id}' ";
                                               $resultado_tec_item = mysqli_query($conecta, $tec_item);
                                               if($resultado_tec_item){
                                                   $result_tec_item = mysqli_fetch_assoc($resultado_tec_item);
                                                   $mostrar_tec_item = utf8_encode($result_tec_item['tecido']);
                                               }
                                               $tam_item = "SELECT * ";
                                               $tam_item .= "FROM tamanhos ";
                                               $tam_item .= "WHERE tamanho_id = '{$tam_id}' ";
                                               $resultado_tam_item = mysqli_query($conecta, $tam_item);
                                               if($resultado_tam_item){
                                                   $result_tam_item = mysqli_fetch_assoc($resultado_tam_item);
                                                   $mostrar_tam_item = utf8_encode($result_tam_item['tamanho']);
                                               }
                                               $cor_item = "SELECT * ";
                                               $cor_item .= "FROM cores ";
                                               $cor_item .= "WHERE cor_id = '{$color_id}' ";
                                               $resultado_cor_item = mysqli_query($conecta, $cor_item);
                                               if($resultado_cor_item){
                                                   $result_cor_item = mysqli_fetch_assoc($resultado_cor_item);
                                                   $mostrar_cor_item = utf8_encode($result_cor_item['cor']);
                                               }
                            ?>
                            <ul>
                                <li><?php echo $qtde_estoq ?></li>
                                <li><?php echo $codigo_ref ?></li>
                                <li><?php echo $mostrar_tec_item ?></li>
                                <li><?php echo $nome_model ?></li>
                                <li><?php echo $mostrar_tam_item ?></li>
                                <li><?php echo $mostrar_cor_item ?></li>
                                <li><?php echo 'R$ ' . number_format($valores, 2, ',', '.'); ?></li>
                                <a href='modelo.php?codigo=<?php echo $codigo_ref ?>'><li class='btn'>Ver</li></a>
                            </ul>
                            <?php
                                           }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php mysqli_close($conecta); ?>