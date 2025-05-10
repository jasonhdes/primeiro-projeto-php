<?php
include('../_mdl/access.php');
session_start();
$registro = $_SESSION['portal'];
$buscar_funcionario = "SELECT * ";
$buscar_funcionario .= "FROM funcionarios ";
$buscar_funcionario .= "WHERE registro = '{$registro}' ";
$buscando_funcionario = mysqli_query($conecta,$buscar_funcionario);
$resultado_funcionario = mysqli_fetch_assoc($buscando_funcionario);

$buscar_transporte = "SELECT * ";
$buscar_transporte .= "FROM transportes ";
$buscar_transporte .= "WHERE registro = {$registro} ";
$buscar_transporte .= "ORDER BY transporte_id DESC LIMIT 1 ";
$buscando_transporte = mysqli_query($conecta,$buscar_transporte);
$resultado_transporte = mysqli_fetch_assoc($buscando_transporte);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SAÍDA TRANSPORTE | ko.dok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="../_js/personalizado2.js"></script>
        <script type="text/javascript" src="../_js/esconder.js"></script>
        <style type="text/css">
            div.saida {
                width: 100%;
                margin: auto 0;
                border:  1px solid;
                border-color: rgba(255,255,255,0.5);
                border-radius: 5px;
                color: rgb(0,0,0);
                background-color: rgb(250,250,250);
            }
            @media all and (max-width: 760px) {
                div.saida {
                    overflow: auto;
                }
            }
            div.saida ul {
                width: 100%;
                margin: 0;
                padding: 0;
                border-bottom: none;
            }
            div.saida ul:last-child {
                border-bottom: none;
            }
            div.saida ul:nth-child(odd) {
                background-color: rgba(255,194,25,0.4);
                color: (0,0,0);
            }
            div.saida li {
                list-style: none;
                display: inline-block;
                padding-bottom: 3px;
                padding-top: 3px;
                margin: 0 auto;
            }
            div.saida li:nth-child(1){
                width: 5%;
            }
            div.saida li:nth-child(2){
                width: 10%;
            }
            div.saida li:nth-child(3){
                width: 15%;
            }
            div.saida li:nth-child(4){
                width: 20%;
            }
            div.saida li:nth-child(5){
                width: 5%;
            }
            div.saida li:nth-child(6){
                width: 15%;
            }
            div.saida li:nth-child(7){
                width: 10%;
            }
            div.saida li:nth-child(8){
                width: 10%;
            }
            div.saida li:nth-child(9){
                width: 10%;
            }
            div.saida ul.list-title {
                background: rgb(255,194,25);
                background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(255,194,25,1) 100%);
                font-weight: 600;
                border-radius: 5px;
            }
            div.line {
                border-bottom: solid 1px rgb(200,200,200);
            }
            button[type=submit] {
                border: none;
            }
            div.info {
                width: 100%;
                text-align: center;
                border-radius: 5px;
            }
            div#erro {
                color: red;
                background: rgb(255,163,163);
                background: linear-gradient(90deg, rgba(255,163,163,1) 0%, rgba(249,245,245,1) 50%, rgba(255,163,163,1) 100%);
                border: solid 2px red;
            }
            div#sucesso {
                color: green;
                background: rgb(148,255,108);
                background: linear-gradient(90deg, rgba(148,255,108,1) 0%, rgba(249,245,245,1) 50%, rgba(148,255,108,1) 100%);
                border: solid 2px green;
            }
            div.modal-dialog {
                border-radius: 5px;
                border: solid 2px green;
            }
            div.modal-header {
                text-align: center;
                color: green;
                background: rgb(168,255,132);
                background: linear-gradient(90deg, rgba(168,255,132,1) 0%, rgba(249,245,245,1) 50%, rgba(168,255,132,1) 100%);
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
            <?php
            if(isset($_POST['retirar'])){
                $transportando_id = $_POST['id'];
                
                $buscar_transportando = "SELECT * ";
                $buscar_transportando .= "FROM transportando ";
                $buscar_transportando .= "WHERE transportando_id = {$transportando_id} ";
                $buscando_transportando = mysqli_query($conecta,$buscar_transportando);
                $resultado_transportando = mysqli_fetch_assoc($buscando_transportando);
                
                $cod_x = $resultado_transportando['codigo'];
                $qtde_x = $resultado_transportando['quantidade'];
                $local_id = $resultado_transportando['local_id'];
                
                $buscar_qtde_estoque = "SELECT * ";
                $buscar_qtde_estoque .= "FROM estoque ";
                $buscar_qtde_estoque .= "WHERE codigo = {$cod_x} AND local_id = {$local_id} ";
                $buscando_qtde_estoque = mysqli_query($conecta,$buscar_qtde_estoque);
                $resultado_qtde_estoque = mysqli_fetch_assoc($buscando_qtde_estoque);
                
                if(!$resultado_qtde_estoque){
                    ?>
            <div class="info" id="erro">Erro ao buscar estoque para devolução. Confira as informações e tente novamente.</div>
            <?php
                    exit();
                } else {
                    $quantidade_estoque = $resultado_qtde_estoque['quantidade'];
                    $estoque_id = $resultado_qtde_estoque['estoque_id'];
                    $preco = $resultado_qtde_estoque['preco'];
                    
                    $nova_quantidade_estoque = ($quantidade_estoque + $qtde_x);
                    $novo_valor_total = ($nova_quantidade_estoque * $preco);
                    
                    $alterar_estoque = "UPDATE estoque ";
                    $alterar_estoque .= "SET ";
                    $alterar_estoque .= "quantidade = '{$nova_quantidade_estoque}', ";
                    $alterar_estoque .= "total = '{$novo_valor_total}' ";
                    $alterar_estoque .= "WHERE estoque_id = {$estoque_id} ";
                    $alterando_estoque = mysqli_query($conecta,$alterar_estoque);
                    
                     if(!$alterando_estoque){
                         ?>
            <div class="info" id="erro">Não foi possível devolver as peças ao estoque. Confira as informações e tente novamente.</div>
            <?php
                     } else {
                         $deletar = "DELETE FROM transportando ";
                         $deletar .= "WHERE transportando_id = {$transportando_id} ";
                         $deletando = mysqli_query($conecta,$deletar);
                         
                         if(!$deletando) {
                             ?>
            <div class="info" id="erro">Erro ao excluir peças do transporte. Confira as informações e tente novamente.</div>
            <?php
                         } else {
                             ?>
            <div class="info" id="sucesso">Peças retiradas do transporte com sucesso.</div>
            <?php
                         }
                     }
                }
            }
            //fim retirar
            if(isset($_POST['adicionar'])){
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
            }
        ?>
        <div class="container-fluid noprint">
            <div class="row">
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="estoque-local.php?local=<?php echo $resultado_transporte['local_id'] ?>" target="_blank">
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
                <div class="col-12 col-md-8 col-lg-3">
                        <p><?php echo utf8_encode($resultado_funcionario['nome']) ?></p>
                </div>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3 class="col-6">Saída | Transporte Estoque</h3>
                    <h4 class="col-6" style="text-align: right">Nº.: <?php echo $resultado_transporte['codigo_transporte'] ?></h4>
                </div>
                <div class="row">
                    <div class="row col-12">
                        <h6 class="col-12 col-lg-3">
                            <?php
    $buscar_local = "SELECT * ";
                       $buscar_local .= "FROM locais ";
                       $buscar_local .= "WHERE local_id = {$resultado_transporte['local_id']} ";
                       $buscando_local = mysqli_query($conecta,$buscar_local);
                       $resultado_local = mysqli_fetch_assoc($buscando_local);
                            ?>
                            Local de saída: <?php echo utf8_encode($resultado_local['nome']) ?>
                        </h6>
                        <h6 class="col-12 col-lg-6 right"></h6>
                    </div>
                </div>
                <div class="row box col-12 formulario form-group" id="formulario">
                    <div class="row col-12">
                        <div class="col-12 col-lg-2">
                            <form method="post" id="form-pesquisa" action="">
                                <label>Pesquisar código: </label>
                                <input class="form-control" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código">
                            </form>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="resultado col-12"></div>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="row col-12">
                            <form action="romaneio.php" class="form-inline col-12 col-lg-9" method="post">
                            <div class="col-12 col-lg-5">
                                <?php
    $buscar_valor = "SELECT sum(quantidade), sum(total) ";
                            $buscar_valor .= "FROM transportando ";
                            $buscar_valor .= "WHERE codigo_transporte = {$resultado_transporte['codigo_transporte']} ";
                            $buscando_valor = mysqli_query($conecta,$buscar_valor);
                            if(!$buscando_valor){
                                $valor_final = 0;
                            } else {
                                $resultado_valor = mysqli_fetch_assoc($buscando_valor);
                                $valor_final = $resultado_valor['sum(total)'];
                                $quantidade_fechada = $resultado_valor['sum(quantidade)'];
                            }
                                ?>
                                Valor total da mercadoria: <?php echo "R$ ".number_format($valor_final, 2, ',','.'); ?>
                            </div>
                            <div class="col-12 col-lg-1"></div>
                            <div class="col-12 col-lg-3">
                                <input type="hidden" name="cod_transp" value="<?php echo $resultado_transporte['codigo_transporte'] ?>">
                                <input type="hidden" name="valor_total" value="<?php echo $valor_final ?>">
                                <input type="hidden" name="quantidade_total" value="<?php echo $quantidade_fechada ?>">
                                <input class="btn btn-block" id="fechar" type="submit" name="fechar" value="Fechar Saída">
                            </div>
                                </form>
                            <form action="transporte.php" class="form-inline col-12 col-lg-3" method="post" style="float: left">
                            <div class="col-12">
                                <input type="hidden" name="cod_transp" value="<?php echo $resultado_transporte['codigo_transporte'] ?>">
                                    <input style="color: red" class="btn btn-block" id="cancelar" type="submit" name="cancelar" value="Cancelar Saída">
                                
                            </div>
                                </form>
                        </div>
                    </div>
                
                <div class="box">
                    <div class="row col-12">
                        <h3>Peças neste transporte</h3>
                        <div class="col-12 col-lg-3"></div>
                        <div class="col-12 col-lg-6">
                            <form style="float: right" class="form-inline" method="post" id="form-pesquisa" action="saida-transporte.php">
                                <input type="hidden" name="local" value="<?php echo $estoque_local ?>">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input class="form-control plaintext" type="text" name="pesquisa" placeholder="Digite o código aqui">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-block mb-2" type="submit" name="buscar" value="Pesquisar">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row col-12" style="padding: 10px">
                        <div class="row col-12 line" style="margin: 0 1%"></div>
                    </div>
                    <div class="row box col-12 saida">
                        <ul class="list-title">
                            <li>Qtde.</li>
                            <li>Código</li>
                            <li>Tecido</li>
                            <li>Modelo</li>
                            <li>Tam.</li>
                            <li>Cor</li>
                            <li>Preço</li>
                            <li></li>
                            <li></li>
                        </ul>
                        <?php
    if(isset($_GET['pesquisar'])){
        $est_local = $_GET['local'];
        $pesquisa = $_GET['pesquisa'];
        $pesquisar = "SELECT * ";
        $pesquisar .= "FROM transportando ";
        $pesquisar .= "WHERE codigo_transporte = {$codigo_transporte} ";
        $pesquisar .= "AND codigo LIKE '%{$pesquisa}%' ";
        $pesquisar .= "ORDER BY codigo ASC ";
    } else {
        $pesquisar = "SELECT * ";
        $pesquisar .= "FROM transportando ";
        $pesquisar .= "WHERE codigo_transporte = {$resultado_transporte['codigo_transporte']} ";
        $pesquisar .= "ORDER BY codigo ASC ";
    }
                                       $pesquisando = mysqli_query($conecta,$pesquisar);
                                       while($encontrado = mysqli_fetch_assoc($pesquisando)){
                                           $codigo_ref = $encontrado['codigo'];
                                           $qtde_estoq = $encontrado['quantidade'];
                                           $valores = $encontrado['preco'];
                                           $nome_model = utf8_encode($encontrado['nome']);
                                           $tec_id = $encontrado['tecido_id'];
                                           $tam_id = $encontrado['tamanho_id'];
                                           $color_id = $encontrado['cor_id'];
                                           $id = $encontrado['transportando_id'];
                                           
                                           $tam_item = "SELECT * ";
                                           $tam_item .= "FROM tamanhos ";
                                           $tam_item .= "WHERE tamanho_id = '{$tam_id}' ";
                                           $resultado_tam = mysqli_query($conecta,$tam_item);
                                           if($resultado_tam){
                                               $tamanho = mysqli_fetch_assoc($resultado_tam);
                                               $mostrar_tam_item = utf8_encode($tamanho['tamanho']);
                                           }
                                           $cor_item = "SELECT * ";
                                           $cor_item .= "FROM cores ";
                                           $cor_item .= "WHERE cor_id = '{$color_id}' ";
                                           $resultado_cor = mysqli_query($conecta,$cor_item);
                                           if($resultado_cor){
                                               $cor = mysqli_fetch_assoc($resultado_cor);
                                               $mostrar_cor_item = utf8_encode($cor['cor']);
                                           }
                                           $tec_item = "SELECT * ";
                                           $tec_item .= "FROM tecidos ";
                                           $tec_item .= "WHERE tecido_id = '{$tec_id}' ";
                                           $resultado_tec = mysqli_query($conecta,$tec_item);
                                           if($resultado_tec){
                                               $tecido = mysqli_fetch_assoc($resultado_tec);
                                               $mostrar_tec_item = utf8_encode($tecido['tecido']);
                                           }
                        ?>
                        <ul>
                            <form class="x form-group" action="saida-transporte.php" method="post">
                                <li><?php echo $qtde_estoq ?></li>
                                <li><?php echo $codigo_ref ?></li>
                                <li><?php echo $mostrar_tec_item ?></li>
                                <li><?php echo $nome_model ?></li>
                                <li><?php echo $mostrar_tam_item ?></li>
                                <li><?php echo $mostrar_cor_item ?></li>
                                <li><?php echo "R$ ".number_format($valores, 2, ',', '.'); ?></li>
                                <a href="modelo.php?codigo=<?php echo $codigo_ref ?>">
                                    <li>
                                        <button class="btn-block">
                                            Ver
                                        </button>
                                    </li>
                                </a>
                                <a>
                                    <li>
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <input type="hidden" name="codigo" value="<?php echo $codigo_ref ?>">
                                        <input type="hidden" name="quantidade" value="<?php echo $qtde_estoq ?>">
                                        <button class="btn-block" style="color: red; font-weight: 900;" id="retirar" type="submit" name="retirar" title="Retirar do transporte">X</button>
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
        </div>
    </body>
</html>