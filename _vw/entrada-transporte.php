<?php
    require('../_mdl/access.php');
    session_start();
    $registro = $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);

    if(isset($_GET['codigo'])){
        $codigo_transporte = $_GET['codigo'];
        $entrada = 2;
        
        $buscar_transporte = "SELECT * ";
        $buscar_transporte .= "FROM transportes ";
        $buscar_transporte .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = '{$entrada}' ";
        $buscar_transporte .= "ORDER BY transporte_id DESC LIMIT 1 ";
        $buscando_transporte = mysqli_query($conecta,$buscar_transporte);
        $resultado_transporte = mysqli_fetch_assoc($buscando_transporte);

        $buscar_local_entrega = "SELECT * ";
        $buscar_local_entrega .= "FROM locais ";
        $buscar_local_entrega .= "WHERE local_id = {$resultado_transporte['local_id']} ";
        $buscando_local_entrega = mysqli_query($conecta,$buscar_local_entrega);
        $resultado_local_entrega = mysqli_fetch_assoc($buscando_local_entrega);
        $local_entrada = $resultado_local_entrega['local_id'];
    } else {
        header('location: transporte.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Transporte | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="../_js/personalizado3.js"></script>
        <script src="../_js/esconder.js"></script>
        <script src="../_js/chama-modal.js"></script>
        <style type="text/css">
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
        if(isset($_POST['finalizar'])){
    $cod_trsnp    = $_POST['transporte'];
    $qtde_fechada = $_POST['quantidade_total'];
    $valr_fechada = $_POST['valor_total'];
    $data         = date('d/m/Y H:i:s');
    $entrada      = 2;
    $local_id     = $resultado_transporte['local_id'];
    
    $buscar_itens_retirados = "SELECT * ";
    $buscar_itens_retirados .= "FROM transportando ";
    $buscar_itens_retirados .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = {$entrada} AND local_id = {$local_entrada} ";
    $buscando_itens_retirados = mysqli_query($conecta,$buscar_itens_retirados);
    while($resultado_itens_retirados = mysqli_fetch_assoc($buscando_itens_retirados)){
        $r_item_qtde = $resultado_itens_retirados['quantidade'];
        $r_item_codi = $resultado_itens_retirados['codigo'];
        $r_item_mode = utf8_decode($resultado_itens_retirados['nome']);
        $r_item_teci = $resultado_itens_retirados['tecido_id'];
        $r_item_tama = $resultado_itens_retirados['tamanho_id'];
        $r_item_cor  = $resultado_itens_retirados['cor_id'];
        $r_item_prec = $resultado_itens_retirados['preco'];
        
        $buscar_estoque = "SELECT * ";
        $buscar_estoque .= "FROM estoque ";
        $buscar_estoque .= "WHERE codigo = {$r_item_codi} AND local_id = {$local_entrada} ";
        $buscando_estoque = mysqli_query($conecta,$buscar_estoque);
        $resultado_estoque = mysqli_fetch_assoc($buscando_estoque);
        
        if($resultado_estoque){
            $quantidade_estoque = $resultado_estoque['quantidade'];
            $preco_estoque      = $resultado_estoque['preco'];
            
            $inserir_nova_quantidade = ($quantidade_estoque + $r_item_qtde);
            $inserir_novo_total      = ($inserir_nova_quantidade * $preco_estoque);
            
            $alterar_estoque = "UPDATE estoque ";
            $alterar_estoque .= "SET ";
            $alterar_estoque .= "quantidade = {$inserir_nova_quantidade}, ";
            $alterar_estoque .= "total = {$inserir_novo_total} ";
            $alterar_estoque .= "WHERE codigo = {$r_item_codi} AND local_id = {$local_entrada} ";
            $alterando_estoque = mysqli_query($conecta,$alterar_estoque);
            
            if(!$alterando_estoque){
                echo "Erro ao atualizar estoque.";
                die();
            }
        } else {
            $total = ($r_item_qtde * $r_item_prec);
            
            $inserir_estoque = "INSERT INTO estoque ";
            $inserir_estoque .= "(local_id, codigo, quantidade, cor_id, tamanho_id, tecido_id, preco, nome, total) ";
            $inserir_estoque .= "VALUES ";
            $inserir_estoque .= "($local_entrada, $r_item_codi, $r_item_qtde, $r_item_cor, $r_item_tama, $r_item_teci, $r_item_prec, '$r_item_mode', $total) ";

            $operacao_estoque = mysqli_query($conecta,$inserir_estoque);
            if(!$operacao_estoque){
                echo "Houve erro. Adicione a nova peça ao estoque manualmente.";
                die();
            }
        }
    }
    $atualizar_entrada = "UPDATE transportes ";
    $atualizar_entrada .= "SET ";
    $atualizar_entrada .= "quantidade_total = {$qtde_fechada}, ";
    $atualizar_entrada .= "vl_total = {$valr_fechada}, ";
    $atualizar_entrada .= "entrada_saida = {$entrada}, ";
    $atualizar_entrada .= "data_transporte = '{$data}', ";
    $atualizar_entrada .= "registro = {$registro}, ";
    $atualizar_entrada .= "local_id = {$local_id} ";
    $atualizar_entrada .= "WHERE transporte_id = {$resultado_transporte['transporte_id']} ";
    $atualizando_entrada = mysqli_query($conecta,$atualizar_entrada);
    
    if(!$atualizando_entrada){
        ?>
        <style type="text/css">
            div.modal-dialog {
                    border-radius: 5px;
                    border: solid 2px red;
                }
                div.modal-header {
                    text-align: center;
                    color: red;
                    background: rgb(255,100,100);
                    background: linear-gradient(90deg, rgba(255,100,100,1) 0%, rgba(249,245,245,1) 50%, rgba(255,100,100,1) 100%);
                }
        </style>
        <?php
                    $modal_titulo = "Transporte Não Cancelado";
                        $modal_mensagem = "Erro ao excluir peças transporte e devolver ao estoque. Confira as informações e tente novamente.";
                        $btn = "Voltar";
                        $link = "saida-transporte.php";
                        include('modal.php');
                } else {
        ?>
        <style type="text/css">
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
        <?php
                        $modal_titulo = "Transporte Cancelado";
                        $modal_mensagem = "O transporte foi cancelado com sucesso.";
                        $btn = "Ok";
                        $link = "transporte.php";
                        include('modal.php');
                    }
}
        if(isset($_POST['retirar'])){
            $local_id   = $resultado_transporte['local_id'];
            $quantidade = $_POST['quantidade'];
            $cod        = $_POST['cod'];
            $referencia = $_POST['referencia'];
            $nome       = utf8_decode($_POST['nome']);
            $tamanho_id = $_POST['tamanho_id'];
            $cor_id     = $_POST['cor_id'];
            $preco      = $_POST['preco'];
            $tecido_id  = $_POST['tecido_id'];
            $total      = ($quantidade * $preco);
            $entrada    = 2;
            $saida      = 1;
            
            $buscar_transportando = "SELECT * ";
            $buscar_transportando .= "FROM transportando ";
            $buscar_transportando .= "WHERE codigo_transporte = {$_GET['codigo']} ";
            $buscar_transportando .= "AND codigo = {$cod} ";
            $buscar_transportando .= "AND entrada_saida = {$saida} ";
            $buscando_transportando = mysqli_query($conecta,$buscar_transportando);
            $resultado_transportando = mysqli_fetch_assoc($buscando_transportando);
            
            $qtde_transportando = $resultado_transportando['quantidade'];
            
            $buscar_entradas = "SELECT sum(quantidade) ";
            $buscar_entradas .= "FROM transportando ";
            $buscar_entradas .= "WHERE codigo_transporte = {$_GET['codigo']} ";
            $buscar_entradas .= "AND codigo = {$cod} ";
            $buscar_entradas .= "AND entrada_saida = {$entrada} ";
            $buscando_entradas = mysqli_query($conecta,$buscar_entradas);
            
            if(!$buscando_entradas){
                $qtde_entradas = 0;
            } else {
                $resultado_entradas = mysqli_fetch_assoc($buscando_entradas);
                $qtde_entradas = $resultado_entradas['sum(quantidade)'];
            }
            
            $qtde_nova = (($qtde_transportando - $qtde_entradas) - $quantidade);
            if($qtde_nova < 0){
        ?>
        <div class="info" id="erro">Não há peças suficientes neste trasnporte. Confira as informações e tente novamente.</div>
        <?php
            } else {
                $inserir_transporte = "INSERT INTO transportando ";
                $inserir_transporte .= "(codigo_transporte, codigo, quantidade, nome, tamanho_id, cor_id, tecido_id, preco, total, local_id, entrada_saida) ";
                $inserir_transporte .= "VALUES ";
                $inserir_transporte .= "('$codigo_transporte', '$cod', '$quantidade', '$nome', '$tamanho_id', '$cor_id', '$tecido_id', '$preco',   '$total', '$local_id', '$entrada') ";
                $inserindo_transporte = mysqli_query($conecta,$inserir_transporte);
                if(!$inserindo_transporte){
        ?>
        <div class="info" id="erro">Não foi possível retirar a peça do transporte. Confira as informações e tente novamente.</div>
        <?php
                } else {
        ?>
        <div class="info" id="sucesso">Sucesso! Peças retiradas do transporte.</div>
        <?php
                }
            }
        }
        if(isset($_POST['devolver'])){
            $id = $_POST['id'];
            
            $devolver = "DELETE FROM transportando ";
            $devolver .= "WHERE transportando_id = {$id} ";
            $devolvendo = mysqli_query($conecta,$devolver);
            if(!$devolvendo){
                ?>
        <div class="info" id="erro">Houve erro ao devolver peça ao transporte.</div>
        <?php
                } else {
        ?>
        <div class="info" id="sucesso">Sucesso! Peças devolvidas ao transporte.</div>
        <?php
                }
            }
        
        ?>
        <div class="container-fluid">
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
                <div class="nome col-12 col-md-8 col-lg-3">
                    <p><?php echo utf8_encode($resultado_funcionario['nome']) ?></p>
                </div>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3>Entrada | Transporte Estoque</h3>
                </div>
                <div class="row">
                    <div class="row col-12">
                        <?php
                            $buscar_local = "SELECT * ";
                            $buscar_local .= "FROM locais ";
                            $buscar_local .= "WHERE local_id = {$resultado_transporte['local_id']} ";
                            $buscando_local = mysqli_query($conecta,$buscar_local);
                            $resultado_local = mysqli_fetch_assoc($buscando_local);

                            $buscar_valor_em_transporte = "SELECT vl_total ";
                            $buscar_valor_em_transporte .= "FROM transportes ";
                            $buscar_valor_em_transporte .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = '1' ";
                            $buscando_valor_em_transporte = mysqli_query($conecta,$buscar_valor_em_transporte);
                            $resultado_valor_em_transporte = mysqli_fetch_assoc($buscando_valor_em_transporte);
                       
                            $valor_romaneio = $resultado_valor_em_transporte['vl_total'];
                       
                            $buscar_valor_restante = "SELECT sum(quantidade), sum(total) ";
                            $buscar_valor_restante .= "FROM transportando ";
                            $buscar_valor_restante .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = '2' ";
                            $buscando_valor = mysqli_query($conecta,$buscar_valor_restante);
                            
                            if(!$buscando_valor){
                                $valor_final = 0;
                            } else {
                                $resultado_valor = mysqli_fetch_assoc($buscando_valor);
                                $valor_final = $resultado_valor['sum(total)'];
                                $quantidade_fechada = $resultado_valor['sum(quantidade)'];
                            }
                       
                            $buscar_valor_retirado = "SELECT sum(quantidade), sum(total) ";
                            $buscar_valor_retirado .= "FROM transportando ";
                            $buscar_valor_retirado .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = '2' AND local_id = {$local_entrada} ";
                            $buscando_valor_retirado = mysqli_query($conecta,$buscar_valor_retirado);
                            
                            if(!$buscar_valor_retirado){
                                $valor_retirado = 0;
                            } else {
                                $resultado_retirado = mysqli_fetch_assoc($buscando_valor_retirado);
                                $valor_retirado = $resultado_retirado['sum(total)'];
                                $quantidade_retirada = $resultado_retirado['sum(quantidade)'];
                            }
                                
                            $valor_transito = ($valor_romaneio - $valor_final );
                       
                       $buscar_saida = "SELECT local_id ";
                       $buscar_saida .= "FROM transportes ";
                       $buscar_saida .= "WHERE codigo_transporte = {$_GET['codigo']} ";
                       $buscar_saida .= "AND entrada_saida = '1' ";
                       $buscando_saida = mysqli_query($conecta,$buscar_saida);
                       if(!$buscando_saida){
                           $local_saida = "ERRO!!! ";
                       } else {
                           $resultado_saida = mysqli_fetch_assoc($buscando_saida);
                           $local_saida = "SELECT nome ";
                           $local_saida .= "FROM locais ";
                           $local_saida .= "WHERE local_id = '{$resultado_saida['local_id']}' ";
                           $localizando_saida = mysqli_query($conecta,$local_saida);
                           $resultando_local = mysqli_fetch_assoc($localizando_saida);
                           $local_saida = utf8_encode($resultando_local['nome']);
                       }
                        ?>
                        <h6 class="col-12 col-lg-6">Local de saída: <?php echo $local_saida ?><br>Local de entrada: <?php echo utf8_encode($resultado_local_entrega['nome']) ?></h6>
                        <h6 class="col-12 col-lg-6 right">Valor total da mercadoria no transporte: <?php echo 'R$ ' . number_format($valor_transito, 2, ',', '.'); ?>
                        </h6>
                    </div>
                </div>
                <div class="row box col-12 formulario form-group" id="formulario">
                    <div class="row col-12">
                        <div class="col-12 col-lg-2">
                            <form method="POST" id="form-pesquisa" action="">
                                <label>Pesquisar código: </label>
                                <input class="form-control" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código">
                            </form>
                        </div>
                    </div>
                    <form class='col-12' action='entrada-transporte.php?codigo=<?php echo $codigo_transporte ?>' method='post'>
                        <input type='hidden' id='transporte' type='text' name='transporte' value='<?php echo $codigo_transporte ?>'>
                        <input type='hidden' id='local' type='text' name='local' value='<?php echo $local_id ?>'>
                        <div class="row col-12">
                            <div class="resultado col-12"></div>
                        </div>
                    </form>
                </div>
                <div class="box">
                    <div class="row col-12">
                        <div class="col-12 col-lg-6">
                            <h6>Valor total da mercadoria que já retirou deste transporte: <?php echo 'R$ ' . number_format($valor_retirado, 2, ',', '.'); ?></h6>
                        </div>
                        <div class="col-12 col-lg-6">
                            <form class="form-group form-group-inline" action="entrada-transporte.php?codigo=<?php echo $codigo_transporte ?>" method="post">
                                <input type="hidden" name="transporte" value="<?php echo $codigo_transporte; ?>">
                                <input type="hidden" name="quantidade_total" value="<?php echo $quantidade_retirada ?>">
                                <input type="hidden" name="local" value="<?php echo $local_id ?>">
                                <input type="hidden" name="valor_total" value="<?php echo $valor_retirado ?>">
                                <input class="btn btn-block" id="fechar" type="submit" name="finalizar" value="Fechar Entrada">
                            </form>
                        </div>
                        <div class="row col-12">
                        <p>Peças que você já retirou deste romaneio para <?php echo utf8_encode($resultado_local_entrega['nome']) ?></p>
                        <div class="col-12 col-lg-3"></div>
                        <div class="col-12 col-lg-6"></div>
                    </div>
                    <div class="row box col-12 estoque">
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
                            <li>Preço</li>
                            <li></li>
                        </ul>
                        <?php
                            $entrada = 2;
                            $saida = 1;
                        
                            $buscar_itens_retirados = "SELECT * ";
                            $buscar_itens_retirados .= "FROM transportando ";
                            $buscar_itens_retirados .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = {$entrada} AND local_id = {$local_entrada} ";
                            $buscando_itens_retirados = mysqli_query($conecta,$buscar_itens_retirados);
                            while($resultado_itens_retirados = mysqli_fetch_assoc($buscando_itens_retirados)){
                                $r_item_qtde = $resultado_itens_retirados['quantidade'];
                                $r_item_codi = $resultado_itens_retirados['codigo'];
                                $r_item_mode = utf8_encode($resultado_itens_retirados['nome']);
                                $r_item_teci = $resultado_itens_retirados['tecido_id'];
                                $r_item_tama = $resultado_itens_retirados['tamanho_id'];
                                $r_item_cor  = $resultado_itens_retirados['cor_id'];
                                $r_item_prec = $resultado_itens_retirados['preco'];
                                
                                $buscar_tecido = "SELECT * ";
                                $buscar_tecido .= "FROM tecidos ";
                                $buscar_tecido .= "WHERE tecido_id = {$r_item_teci} ";
                                $buscando_tecido = mysqli_query($conecta,$buscar_tecido);
                                $resultado_tecido = mysqli_fetch_assoc($buscando_tecido);
                                
                                $r_nome_teci = utf8_encode($resultado_tecido['tecido']);
                                
                                $buscar_tamanho = "SELECT * ";
                                $buscar_tamanho .= "FROM tamanhos ";
                                $buscar_tamanho .= "WHERE tamanho_id = {$r_item_tama} ";
                                $buscando_tamanho = mysqli_query($conecta,$buscar_tamanho);
                                $resultado_tamanho = mysqli_fetch_assoc($buscando_tamanho);
                                
                                $r_nome_tama = utf8_encode($resultado_tamanho['tamanho']);
                                
                                $buscar_cor = "SELECT * ";
                                $buscar_cor .= "FROM cores ";
                                $buscar_cor .= "WHERE cor_id = {$r_item_cor} ";
                                $buscando_cor = mysqli_query($conecta,$buscar_cor);
                                $resultado_cor = mysqli_fetch_assoc($buscando_cor);
                                
                                $r_nome_cor = utf8_encode($resultado_cor['cor']);
                        ?>
                    <ul>
                        <form action="entrada-transporte.php?codigo=<?php echo $codigo_transporte ?>" method="post">
                            <li><?php echo $r_item_qtde ?></li>
                            <li><?php echo $r_item_codi ?></li>
                            <li><?php echo $r_nome_teci ?></li>
                            <li><?php echo $r_item_mode ?></li>
                            <li><?php echo $r_nome_tama ?></li>
                            <li><?php echo $r_nome_cor ?></li>
                            <li><?php echo 'R$ ' . number_format($r_item_prec, 2, ',', '.'); ?></li>
                            <li>
                                <input type="hidden" name="id" value="<?php echo $resultado_itens_retirados['transportando_id'] ?>">
                                <input type="submit" class="btn-block" name="devolver" value="X" style="color: red; font-weight: 900;">
                            </li>
                        </form>
                        </ul>
                    <?php
                           }
                    ?>
                    </div>
                    </div>
                </div>
                <div class="box">
                    <div class="row col-12">
                        <h3>Peças neste transporte</h3>
                        <div class="col-12 col-lg-3"></div>
                        <div class="col-12 col-lg-6"></div>
                    </div>
                    <div class="row box col-12 estoque">
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
                            <li>Preço</li>
                            <li></li>
                        </ul>
                        <?php
                            $entrada = 2;
                            $saida = 1;
                        
                            $buscar_itens = "SELECT * ";
                            $buscar_itens .= "FROM transportando ";
                            $buscar_itens .= "WHERE codigo_transporte = {$codigo_transporte} AND entrada_saida = {$saida} ";
                            $buscando_itens = mysqli_query($conecta,$buscar_itens);
                            while($resultado_itens = mysqli_fetch_assoc($buscando_itens)){
                                $item_qtde = $resultado_itens['quantidade'];
                                $item_codi = $resultado_itens['codigo'];
                                $item_mode = utf8_encode($resultado_itens['nome']);
                                $item_teci = $resultado_itens['tecido_id'];
                                $item_tama = $resultado_itens['tamanho_id'];
                                $item_cor  = $resultado_itens['cor_id'];
                                $item_prec = $resultado_itens['preco'];
                                
                                $buscar_entregues = "SELECT sum(quantidade) ";
                                $buscar_entregues .= "FROM transportando ";
                                $buscar_entregues .= "WHERE codigo = {$item_codi} AND codigo_transporte = {$codigo_transporte} AND entrada_saida = {$entrada} ";
                                $buscando_entregues = mysqli_query($conecta,$buscar_entregues);
                                $resultado_entregues = mysqli_fetch_assoc($buscando_entregues);
                                
                                if($resultado_entregues['sum(quantidade)'] <= 0){
                                    $qtde_item = $resultado_itens['quantidade'];
                                } else {
                                    $qtde = $resultado_entregues['sum(quantidade)'];
                                    $qtde_item = ($item_qtde - $qtde);
                                }
                                
                                $buscar_tecido = "SELECT * ";
                                $buscar_tecido .= "FROM tecidos ";
                                $buscar_tecido .= "WHERE tecido_id = {$item_teci} ";
                                $buscando_tecido = mysqli_query($conecta,$buscar_tecido);
                                $resultado_tecido = mysqli_fetch_assoc($buscando_tecido);
                                
                                $nome_teci = utf8_encode($resultado_tecido['tecido']);
                                
                                
                                $buscar_tamanho = "SELECT * ";
                                $buscar_tamanho .= "FROM tamanhos ";
                                $buscar_tamanho .= "WHERE tamanho_id = {$item_tama} ";
                                $buscando_tamanho = mysqli_query($conecta,$buscar_tamanho);
                                $resultado_tamanho = mysqli_fetch_assoc($buscando_tamanho);
                                
                                    $nome_tama = utf8_encode($resultado_tamanho['tamanho']);
                                
                                
                                $buscar_cor = "SELECT * ";
                                $buscar_cor .= "FROM cores ";
                                $buscar_cor .= "WHERE cor_id = {$item_cor} ";
                                $buscando_cor = mysqli_query($conecta,$buscar_cor);
                                $resultado_cor = mysqli_fetch_assoc($buscando_cor);
                                
                                    $nome_cor = utf8_encode($resultado_cor['cor']);
                                
                        ?>
                    <ul>
                        <li><?php echo $qtde_item ?></li>
                        <li><?php echo $item_codi ?></li>
                        <li><?php echo $nome_teci ?></li>
                        <li><?php echo $item_mode ?></li>
                        <li><?php echo $nome_tama ?></li>
                        <li><?php echo $nome_cor ?></li>
                        <li><?php echo 'R$ ' . number_format($item_prec, 2, ',', '.'); ?></li>
                        <a href='modelo.php?codigo=<?php echo $item_codi ?>'><li class='btn'>Ver</li></a>
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