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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TRANSPORTE | ko.dok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
        <style type="text/css">
            @media print { 
                .noprint { display:none; } 
                body { background: #fff; }
            }
            div.lista-t {
                width:100%;
                margin: auto 0;
                border: 1px solid;
                border-color: rgba(255,255,255,0.5);
                border-radius: 5px;
                color: rgb(0,0,0);
                background-color: rgb(250,250,250);
            }
            @media all and (min-width: 768px) {
                div.lista-t
                {
                    overflow:auto; 
                }
            }
            div.lista-t ul {
                width: 100%;
                margin:0;
                padding:0; 
                border-bottom: none;
            }
            div.lista-t ul:last-child {
                border-bottom:none;
            }
            div.lista-t ul:nth-child(odd) {
                background-color: rgba(255,194,25,0.4);
                color: rgb(0,0,0);
            }
            div.lista-t li {
                list-style:none;
                display:inline-block;
                padding-bottom: 3px;
                padding-top: 3px;
                margin: 0 auto;
            }
            div.lista-t ul.list-title {
                background: rgb(139,107,3);
                background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(255,194,25,0.5) 100%);
                border-radius: 5px;
                font-weight: 600;
            }
            div.lista-t li:nth-child(1) {
                width: 10%;
            }   
            div.lista-t li:nth-child(2) {
                width: 15%;
            }
            div.lista-t li:nth-child(3) {
                width: 20%;
            }    
            div.lista-t li:nth-child(4) {
                width: 20%;
            }    
            div.lista-t li:nth-child(5) {
                width: 10%;
            }    
            div.lista-t li:nth-child(6) {
                width: 10%;
            }
            div.lista-t li:nth-child(7) {
                width: 10%;
            }
            div.lista-t ul:nth-child(odd) {
                font-style: italic;
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
            <div class="row noprint">
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
        <div class="container-fluid">
            <div class="box">
                <div class="row col-12">
                    <h3 class="col-12 col-lg-6">Lista de Transportes</h3>
                    <?php
    $entrada = 2;
                        $saida   = 1;

                        $buscar_saida = "SELECT sum(quantidade_total) ";
                        $buscar_saida .= "FROM transportes ";
                        $buscar_saida .= "WHERE entrada_saida = {$saida} ";
                        $buscando_saida = mysqli_query($conecta,$buscar_saida);
                        $resultado_saida = mysqli_fetch_assoc($buscando_saida);

                        $buscar_entrada = "SELECT sum(quantidade_total) ";
                        $buscar_entrada .= "FROM transportes ";
                        $buscar_entrada .= "WHERE entrada_saida = {$entrada} ";
                        $buscando_entrada = mysqli_query($conecta,$buscar_entrada);
                        $resultado_entrada = mysqli_fetch_assoc($buscando_entrada);                    

                        $saidas = $resultado_saida['sum(quantidade_total)'];
                        $entradas = $resultado_entrada['sum(quantidade_total)'];
                        $transito = ($saidas - $entradas);
                    ?>
                    <h6 class="col-12 col-lg-6 right">
                        Total de peças em trânsito: <?php echo $transito ?>
                    </h6>
                    <form style="float: right" class="form-inline noprint" method="GET" id="form-pesquisa" action="lista-transportes.php">
                        <div class="form-group mx-sm-3 mb-2">
                            <input class="form-control-plaintext" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código aqui">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-block mb-2" type="submit" name="buscar" value="Pesquisar">
                        </div>
                    </form>
                </div>
                <?php
    if(isset($_GET['pesquisa'])){
        $pesquisa = $_GET['pesquisa'];
        $buscar_transportes = "SELECT * ";
        $buscar_transportes .= "FROM transportes ";
        $buscar_transportes .= "WHERE codigo_transporte LIKE '%{$pesquisa}%' GROUP BY codigo_transporte ";
        $buscar_transportes .= "ORDER BY data_transporte DESC ";
    } else {
        $buscar_transportes = "SELECT * ";
        $buscar_transportes .= "FROM transportes ";
        $buscar_transportes .= "WHERE codigo_transporte GROUP BY codigo_transporte ";
        $buscar_transportes .= "ORDER BY data_transporte DESC ";
    }
                        $buscando_transportes = mysqli_query($conecta,$buscar_transportes);
                        while($resultado_transportes = mysqli_fetch_assoc($buscando_transportes)){
                            $cod_t = $resultado_transportes['codigo_transporte'];
                            
                            $buscar_1 = "SELECT sum(quantidade_total) ";
                            $buscar_1 .= "FROM transportes ";
                            $buscar_1 .= "WHERE codigo_transporte = '{$resultado_transportes['codigo_transporte']}' ";
                            $buscar_1 .= "AND entrada_saida = '{$saida}' ";
                            $buscando_1 = mysqli_query($conecta,$buscar_1);
                            $resultado_1 = mysqli_fetch_assoc($buscando_1);
                            $soma_1 = $resultado_1['sum(quantidade_total)'];

                            $buscar_2 = "SELECT sum(quantidade_total) ";
                            $buscar_2 .= "FROM transportes ";
                            $buscar_2 .= "WHERE codigo_transporte = '{$resultado_transportes['codigo_transporte']}' ";
                            $buscar_2 .= "AND entrada_saida = '{$entrada}' ";
                            $buscando_2 = mysqli_query($conecta,$buscar_2);
                            $resultado_2 = mysqli_fetch_assoc($buscando_2);
                            $soma_2 = $resultado_2['sum(quantidade_total)'];

                            $em_transito = ($soma_1 - $soma_2);
                ?>
                <div class="box">
                    <div class="row">
                        <h3 class="col-12 col-lg-5">Transporte Nº.: <?php echo $cod_t ?></h3>
                        <a href="detalhes-transporte.php?codigo=<?php echo $cod_t ?>" class="col-12 col-lg-1 noprint"><input class="btn-block" type="button" value="Ver"></a>
                    </div>
                    <div class="row col-12">
                        <div class="row col-12" style="padding: 10px ">
                            <?php
                    if($em_transito >= 1){
                            ?>
                            Peças em trânsito deste transporte: <?php echo $em_transito ?>
                            <?php
                    } else {}
                            ?>
                            <div class="row col-12 line" style="margin: 0 1%"></div>
                        </div>
                        <div class="lista-t">
                            <ul class="list-title">
                                <li></li>
                                <li>Data e Hora</li>
                                <li>Funcionário</li>
                                <li>Nome Estoque</li>
                                <li>Qtde.</li>
                                <li>Valor Total</li>
                                <li></li>
                            </ul>
                            <?php
                            $buscar_dados_transporte = "SELECT * ";
                            $buscar_dados_transporte .= "FROM transportes ";
                            $buscar_dados_transporte .= "WHERE codigo_transporte = {$cod_t} ";
                            $buscar_dados_transporte .= "ORDER BY data_transporte ASC ";
                            $buscando_dados_transporte = mysqli_query($conecta,$buscar_dados_transporte);
                            while($resultado_dados_transportes = mysqli_fetch_assoc($buscando_dados_transporte)){
                                $t_registro          = $resultado_dados_transportes['registro'];
                                $t_local_id          = $resultado_dados_transportes['local_id'];
                                $t_quantidade_total  = $resultado_dados_transportes['quantidade_total'];
                                $t_vl_total          = $resultado_dados_transportes['vl_total'];
                                $t_data_transporte   = $resultado_dados_transportes['data_transporte'];
                                $t_entrada_saida     = $resultado_dados_transportes['entrada_saida'];

                                $buscar_registro = "SELECT * ";
                                $buscar_registro .= "FROM funcionarios ";
                                $buscar_registro .= "WHERE registro = '{$t_registro}' ";
                                $buscando_registro = mysqli_query($conecta, $buscar_registro);
                                if($buscando_registro){
                                    $resultado_registro = mysqli_fetch_assoc($buscando_registro);
                                    $nome_registro = utf8_encode($resultado_registro['nome']);
                                }
                                $buscar_local = "SELECT * ";
                                $buscar_local .= "FROM locais ";
                                $buscar_local .= "WHERE local_id = '{$t_local_id}' ";
                                $buscando_local = mysqli_query($conecta, $buscar_local);
                                if($buscando_local){
                                        $resultado_local = mysqli_fetch_assoc($buscando_local);
                                    $nome_local = utf8_encode($resultado_local['nome']);
                                }
                                if($t_entrada_saida == 1){
                                    $es = "Saída";
                                } elseif($t_entrada_saida == 2) {
                                    $es = "Entrada";
                                } else {
                                    $es = "Erro";
                                }
                            ?>
                            <ul>
                                <li><?php echo $es ?></li>
                                <li><?php echo $t_data_transporte ?></li>
                                <li><?php echo $nome_registro ?></li>
                                <li><?php echo $nome_local ?></li>
                                <li><?php echo $t_quantidade_total ?></li>
                                <li><?php echo 'R$ ' . number_format($t_vl_total, 2, ',', '.'); ?></li>
                            </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                        }
                ?>
            </div>
        </div>
        <div class="container-fluid row col-12 noprint">
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
<?php mysqli_close($conecta) ?>