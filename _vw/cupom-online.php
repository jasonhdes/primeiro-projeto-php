<?php
    include('../_mdl/access.php');
    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);

    $nome_funcionario = $resultado_funcionario['nome'];

    $buscar_venda = "SELECT * ";
    $buscar_venda .= "FROM vendas ";
    $buscar_venda .= "WHERE registrado = {$resultado_funcionario['registro']} ";
    $buscar_venda .= "ORDER BY venda_id DESC LIMIT 1 ";
    $buscando_venda = mysqli_query($conecta,$buscar_venda);
    $resultado_venda = mysqli_fetch_assoc($buscando_venda);


    if(isset($_POST['gerar'])){
        $comprador   = $_POST['comprador'];
        $endereco    = $_POST['endereco'];
        $numero      = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $cidade      = $_POST['cidade'];
        $estado      = $_POST['estado'];
        $telefone    = $_POST['telefone'];
        $observacao  = $_POST['observacao'];
        $cep         = $_POST['cep'];
        
        $destinatario1 = "Nome: ".$comprador." | Endereço: ".utf8_decode($endereco).", ".$numero." ".$complemento.", ".$cidade." - ".$estado." - ".$cep." | Telefone: ".$telefone." ! Observações: ".$observacao;
        $destinatario = utf8_decode($destinatario1);
        

        $fechar_venda = "UPDATE vendas ";
        $fechar_venda .= "SET ";
        $fechar_venda .= "observacao = '{$destinatario}' ";
        $fechar_venda .= "WHERE codigo_venda = {$resultado_venda['codigo_venda']} ";
        $fechando_venda = mysqli_query($conecta,$fechar_venda);
        
        if(!$fechando_venda){
            echo "Erro ao fechar venda.";
            die();
        }


    $buscar_vendedor = "SELECT * ";
    $buscar_vendedor .= "FROM funcionarios ";
    $buscar_vendedor .= "WHERE registro = {$resultado_venda['registro']} ";
    $buscando_vendedor = mysqli_query($conecta,$buscar_vendedor);
    $resultado_vendedor = mysqli_fetch_assoc($buscando_vendedor);

    $nome_vendedor = utf8_encode($resultado_vendedor['nome']);
    $local_id = $resultado_venda['local_id'];

    $buscar_local = "SELECT * ";
    $buscar_local .= "FROM locais ";
    $buscar_local .= "WHERE local_id = {$local_id} ";
    $buscando_locais = mysqli_query($conecta,$buscar_local);
    $resultado_local = mysqli_fetch_assoc($buscando_locais);

    $nome_local = utf8_encode($resultado_local['nome']);
    $endereco_local = utf8_encode($resultado_local['endereco']);
    $cidade_local = utf8_encode($resultado_local['cidade']);
    $estado_id = $resultado_local['estado_id'];

    $buscar_estado = "SELECT * ";
    $buscar_estado .= "FROM estados ";
    $buscar_estado .= "WHERE estado_id = {$estado_id} ";
    $buscando_estado = mysqli_query($conecta,$buscar_estado);
    $resultado_estado = mysqli_fetch_assoc($buscando_estado);

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nota de Transporte | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <style type="text/css">
            @media print { 
                #noprint { display:none; } 
                body { background: #fff; }
            }
            div.estoque li:nth-child(1) {
                width: 5%;
            }
            div.estoque li:nth-child(2) {
                width: 10%;
            }    
            div.estoque li:nth-child(3) {
                width: 10%;
            }    
            div.estoque li:nth-child(4) {
                width: 25%;
            }    
            div.estoque li:nth-child(5) {
                width: 5%;
            }    
            div.estoque li:nth-child(6) {
                width: 15%;
            }
            div.estoque li:nth-child(7) {
                width: 10%;
            }
            div.estoque li:nth-child(8) {
                width: 10%;
            }
            div.estoque ul:nth-child(odd) {
                font-style: italic;
            }
            button[type=submit] {
                border: none;
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
            <div class="box">
                <div class="row">
                    <div class="col-6">
                        <h3>Cupom</h3>
                        <h6>Destinatário: <?php echo $comprador ?></h6>
                        <h6>Celular: <?php echo $telefone ?></h6>
                        <h6>Endereço: <?php echo $endereco.', '.$numero.' '.$complemento.', '.$cidade.' - '.$estado." - ".$cep  ?></h6>
                        <h6>Observações: <?php echo $observacao ?></h6>
                    </div>
                    <div class="col-6 right" style="float: right">
                        <h6>Vendido por: <?php echo $nome_vendedor ?></h6>
                        <h6>Local de saída: <?php echo $nome_local ?></h6>
                        <h6><?php echo $endereco_local.', '.$resultado_local['numero'].' '.$resultado_local['complemento'].', '.$cidade_local.' - '.$resultado_estado['estado'];  ?></h6>
                        <h6>Total de itens: <?php echo $resultado_venda['quantidade']; ?></h6>
                        <h6>Valor total da mercadoria: <?php echo 'R$ ' . number_format($resultado_venda['valor'], 2, ',', '.'); ?></h6>
                    </div>
                </div>
                <div class="row estoque">
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
                            <li><?php echo $venda_quantidade ?></li>
                            <li><?php echo $venda_codigo ?></li>
                            <li><?php echo $mostrar_tec_item ?></li>
                            <li><?php echo $venda_nome ?></li>
                            <li><?php echo $mostrar_tam_item ?></li>
                            <li><?php echo $mostrar_cor_item ?></li>
                            <li><?php echo 'R$ ' . number_format($venda_preco, 2, ',', '.'); ?></li>
                            <?php $preco_total = ($venda_quantidade * $venda_preco); ?>
                            <li><?php echo 'R$ ' . number_format($preco_total, 2, ',', '.'); ?></li>
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="noprint" class="container-fluid row col-12">
            <div class="col-12 col-lg-3">
                <input href="javascript:;" onclick="window.print();return false" type="button" class="btn btn-block" value="Imprimir">
            </div>
            <div class="col-12 col-lg-6"></div>
            <div class="col-12 col-lg-3">
                <a href="abrir-venda.php" class="btn btn-block">Fechar</a>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>