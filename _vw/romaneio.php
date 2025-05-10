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

    $buscar_transporte = "SELECT * ";
    $buscar_transporte .= "FROM transportes ";
    $buscar_transporte .= "WHERE registro = {$resultado_funcionario['registro']} ";
    $buscar_transporte .= "ORDER BY transporte_id DESC LIMIT 1 ";
    $buscando_transporte = mysqli_query($conecta,$buscar_transporte);
    $resultado_transporte = mysqli_fetch_assoc($buscando_transporte);

    $local_id = $resultado_transporte['local_id'];

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
    $buscando_transporte = mysqli_query($conecta,$buscar_estado);
    $resultado_estado = mysqli_fetch_assoc($buscando_transporte);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nota de Transporte | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
        <script type="text/x-javascript" src="../_js/chama-modal.js"></script>
        <style>
            @media print { 
                #noprint { display:none; } 
                body { background: #fff; }
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_POST['fechar'])){
    $cod_trnsp = $_POST['cod_transp'];
    $qtde_fechada = $_POST['quantidade_total'];
    $valr_fechada = $_POST['valor_total'];
    $data = date('d/m/Y H:i:s');
    $saida = 1;

    $fechar_saida = "UPDATE transportes ";
    $fechar_saida .= "SET ";
    $fechar_saida .= "quantidade_total = {$qtde_fechada}, ";
    $fechar_saida .= "vl_total = {$valr_fechada}, ";
    $fechar_saida .= "entrada_saida = {$saida}, ";
    $fechar_saida .= "data_transporte = '{$data}' ";
    $fechar_saida .= "WHERE codigo_transporte = {$cod_trnsp} ";
    $fechando_saida = mysqli_query($conecta,$fechar_saida);
    if(!$fechando_saida){
?>
        <style type="text/css">
            div.modal-dialog {
                border-radius: 5px;
                border: solid 2px red;
            }
            div.modal-header {
                text-align: center;
                color: red;
                background: rgb(255,80,80);
                background: linear-gradient(90deg, rgba(255,80,80,1) 0%, rgba(249,245,245,1) 50%, rgba(255,80,80,1) 100%);
            }
        </style>
        
        

<?php
        $modal_titulo = "Transporte Não Fechado";
        $modal_mensagem = "Erro ao fechar saída. Confira as informações e tente novamente.";
        $btn = "Voltar";
        $link = "saida-transporte.php";
        include('modal.php');
        exit();
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
        $modal_titulo = "Transporte Fechado";
        $modal_mensagem = "O transporte foi fechado, veja todas as informações no romaneio.";
        $btn = "Ver Romaneio";
        $link = "romaneio.php";
        include('modal.php');
    }
}
            //fim fechar

        ?>
        <div class="container-fluid login">
            <div class="row">
                <div id="img">
                    <img src="../_img/logo.png">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="box">
                <div class="row col-12">
                    <h3 class="col-12 col-lg-6">Romaneio</h3>
                    <h6 class="col-12 col-lg-6 right">
                        Retirado por: <?php echo $nome_funcionario ?><br>
                        Local de saída: <?php echo $nome_local ?><br>
                        <?php echo $endereco_local.', '.$resultado_local['numero'].' '.$resultado_local['complemento'].', '.$cidade_local.' - '.$resultado_estado['estado'];  ?><br>
                        Total de itens: <?php echo $resultado_transporte['quantidade_total']; ?><br>
                        Valor total da mercadoria: <?php echo 'R$ ' . number_format($resultado_transporte['vl_total'], 2, ',', '.'); ?></h6>
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
                        if(isset($_GET['pesquisa'])){
                                    $est_local = $_GET['local'];
                                    $pesquisa = $_GET['pesquisa'];
                                    $buscando_estoque_local = "SELECT * ";
                                    $buscando_estoque_local .= "FROM transportando ";
                                    $buscando_estoque_local .=  "WHERE codigo_transporte = {$codigo_transporte} ";
                                    $buscando_estoque_local .= "AND codigo LIKE '%{$pesquisa}%' ";
                                    $buscando_estoque_local .= "ORDER BY codigo ASC ";
                                } else {
                                    $buscando_estoque_local = "SELECT * ";
                                    $buscando_estoque_local .= "FROM transportando ";
                                    $buscando_estoque_local .= "WHERE codigo_transporte = {$resultado_transporte['codigo_transporte']} ";
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
        <div id="noprint" class="container-fluid row col-12">
            <div class="col-12 col-lg-3">
                <input href="javascript:;" onclick="window.print();return false" type="button" class="btn btn-block" value="Imprimir">
            </div>
            <div class="col-12 col-lg-6"></div>
            <div class="col-12 col-lg-3">
                <a href="transporte.php" class="btn btn-block">Voltar</a>
            </div>
        </div>
    </body>
</html>