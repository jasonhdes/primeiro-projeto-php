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
<?php
    $buscar_lojas = "SELECT * ";
    $buscar_lojas .= "FROM locais ";
    $buscando_lojas = mysqli_query($conecta,$buscar_lojas);
?>
<?php

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
            <?php
                $buscar_vendas = "SELECT * ";
                $buscar_vendas .= "FROM vendas ";

                if(isset($_POST['pesquisar'])){
                    $data_inicial = $_POST['data_inicial'];
                    $data_final = $_POST['data_final'];

                    $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                    $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                    $data_inicio = $data1." 00:00:00";

                    $date2 = date_parse_from_format("Y-m-d", $data_final);
                    $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                    $data_fim =  $data2." 23:59:59";

                    $pesquisa = "Mostrando período de ".$data1." a ".$data2;

                    $buscar_vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                }
                $buscar_vendas .= "ORDER BY data_venda DESC ";
                $buscando_vendas = mysqli_query($conecta,$buscar_vendas);
                        
                $somar_vendas = "SELECT sum(quantidade), sum(valor) ";
                $somar_vendas .= "FROM vendas ";
                        if(isset($_POST['pesquisar'])){
                                        $data_inicial = $_POST['data_inicial'];
                                        $data_final = $_POST['data_final'];

                                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                                        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                                        $data_inicio = $data1." 00:00:00";

                                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                                        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                                        $data_fim =  $data2." 23:59:59";

                                        $somar_vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                }
                $somando_vendas = mysqli_query($conecta,$somar_vendas);
                $resultando_soma = mysqli_fetch_assoc($somando_vendas);
                        
                    
                    
            ?>
            <div class="box">
                <div class="row col-12">
                    <h3 class="col-12 col-lg-4">Consolidado</h3>
                    <h6 class="col-12 col-lg-8">
                        <?php
                            if(isset($_POST['pesquisar'])){
                                echo $pesquisa;
                                echo "<form action='total-vendas.php' method='post'>";
                                echo "<input type='submit' value='Limpar Pesquisa' class='btn'>";
                                echo "</form>";
                            
                            }?>
                    </h6>
                </div>
                
                <div class="row col-12">
                    <div class="col-12">
                    <div class="row col-12 line"></div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <h4>Total das vendas</h4>
                    </div>
                    <div class="col-12 col-lg-4"></div>
                    <form class="col-12 col-lg-4 form-group-inline" method="POST" id="form-pesquisa" action="total-vendas.php">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Selecionar período:</label>
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
                
                <div class="col-12">
                    <div class="row col-12 line"></div>
                        <a href="todas-vendas.php" class="col-3"><input type="button" value="Lista de Vendas"></a>
                        <ul>
                            <div class="row col-12">
                                <li class="col-12 col-lg-4">Total de peças vendidas: <?php echo $resultando_soma['sum(quantidade)'] ?></li>
                                <?php
                                    $vendas = "SELECT COUNT(codigo_venda) ";
                                    $vendas .= "AS TOTAL ";
                                    $vendas .= "FROM vendas ";
                                    if(isset($_POST['pesquisar'])){
                                        $data_inicial = $_POST['data_inicial'];
                                        $data_final = $_POST['data_final'];

                                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                                        $data1 = sprintf("%02d/%02d/%04d", $date1["day"], $date1["month"], $date1["year"]);
                                        $data_inicio = $data1." 00:00:00";

                                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                                        $data2 = sprintf("%02d/%02d/%04d", $date2["day"], $date2["month"], $date2["year"]);
                                        $data_fim =  $data2." 23:59:59";

                                        $vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                                    }
                                    $contando = mysqli_query($conecta,$vendas);
                                    $resultado = mysqli_fetch_assoc($contando);
                                    
                                ?>
                                <li class="col-12 col-lg-4">Total de vendas: <?php echo $resultado['TOTAL'] ?></li>
                                <li class="col-12 col-lg-4">Valor Total em vendas: <?php echo "R$ ".number_format($resultando_soma['sum(valor)'], 2, ',', '.'); ?></li>
                            </div>
                            <div class="row col-12 line"></div>
                            <div class="row col-12">
                                <?php
                                    $buscar_estoque_tamanho = "SELECT * ";
                                    $buscar_estoque_tamanho .= "FROM tamanhos ";
                                    $buscar_estoque_tamanho .= "ORDER BY tamanho_id ASC ";
                                    $buscando_estoque_tamanho = mysqli_query($conecta,$buscar_estoque_tamanho);

                                    while($resultado_tamanho = mysqli_fetch_assoc($buscando_estoque_tamanho)){
                                        $soma_quantidade = "SELECT sum(quantidade) ";
                                        $soma_quantidade .= "FROM vendidas ";
                                        $soma_quantidade .= "WHERE tamanho_id = {$resultado_tamanho['tamanho_id']} ";
                                        
                                        
                                        if(isset($_POST['pesquisar'])){
                                        $data_inicial = $_POST['data_inicial'];
                                        $data_final = $_POST['data_final'];

                                        $date1 = date_parse_from_format("Y-m-d", $data_inicial);
                                        $data1 = sprintf("%04d%02d%02d", $date1["year"], $date1["month"], $date1["day"] );
                                        $data_inicio = $data1."000000";

                                        $date2 = date_parse_from_format("Y-m-d", $data_final);
                                        $data2 = sprintf("%04d%02d%02d", $date2["year"], $date2["month"], $date2["day"]);
                                        $data_fim =  $data2."999999";
                                            
                                        $soma_quantidade .= "AND codigo_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                                    }
                                        
                                        
                                        
                                        
                                        
                                        

                                        $somando_quantidade = mysqli_query($conecta,$soma_quantidade);
                                        $resultado_quantidade = mysqli_num_rows($somando_quantidade);

                                        if($resultado_quantidade = mysqli_fetch_array($somando_quantidade)){
                                            $total_tam = $resultado_quantidade['sum(quantidade)'];
                                        }
                                        if(!$total_tam){} else {
                                ?>
                                <li class="col-12 col-md-6 col-lg-3">Quantidade de <?php echo $resultado_tamanho['tamanho'] ?> : <?php echo $total_tam ?></li>
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
                
                <?php
                    while($resultado_lojas = mysqli_fetch_assoc($buscando_lojas)){
                ?>
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

                                        $vendas .= "WHERE data_venda BETWEEN '{$data_inicio}' AND '{$data_fim}' ";
                                    }
                            $consolidando_vendas = mysqli_query($conecta,$consolidar_vendas);
                            $resultado_vendas = mysqli_fetch_assoc($consolidando_vendas);
                        
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
                                <li class="col-12 col-lg-4">Total de peças vendidas: <?php echo $resultando_vendas['sum(quantidade)'] ?></li>
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
                <?php
                    }
                ?>
            </div>
        </div>
    </body>

</html>