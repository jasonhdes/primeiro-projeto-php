<?php
    require('../_mdl/access.php');

    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);

    require('../_mdl/consultas.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Novo Modelo | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <style type="text/css">
            div.modelos {
                width:100%;
                margin: auto 0;
                border: 1px solid;
                border-color: rgba(255,255,255,0.5);
                border-radius: 5px;
                color: rgb(0,0,0);
                background-color: rgb(250,250,250);
            }

            @media all and (min-width: 768px) {
                div.modelos
                {
                    overflow:auto; 
                }
            }

            div.modelos ul {
                width: 100%;
                margin:0;
                padding:0; 
                border-bottom: none;
            }

            div.modelos ul:last-child {
                border-bottom:none;
            }

            div.modelos ul:nth-child(odd) {
                background-color: rgba(255,194,25,0.4);
                color: rgb(0,0,0);
            }

            div.modelos li {
                list-style:none;
                display:inline-block;
                padding-bottom: 3px;
                padding-top: 3px;
                margin: 0 auto;
            }

            div.modelos ul.list-title {
                background: rgb(139,107,3);
                background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(255,194,25,0.5) 100%);
                border-radius: 5px;
                font-weight: 600;
            }
            
            div.modelos li:nth-child(1) {
                width: 7%;
            }
            div.modelos li:nth-child(2) {
                width: 30%;
            }    
            div.modelos li:nth-child(3) {
                width: 5%;
            }    
            div.modelos li:nth-child(4) {
                width: 15%;
            }    
            div.modelos li:nth-child(5) {
                width: 10%;
            }    
            div.modelos li:nth-child(6) {
                width: 15%;
            }
            div.modelos li:nth-child(7) {
                width: 18%;
            }
            div.modelos ul:nth-child(odd) {
                font-style: italic;
            }
            .lista-modelos li {
                padding-top: 20%;
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
                        <p>Lista de Modelos</p>
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
                    <h3>Lista de Modelos</h3>
                </div>
                <div class="row col-12">
                    <div class="col-12 col-lg-2">
                        <form method="POST" id="form-pesquisa" action="">
                            <label>Pesquisar código: </label>
                            <input class="form-control" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código">
                        </form>
                    </div>
                </div>
                <div class="row box col-12 modelos">
                    <ul class="list-title lista-modelos">
                        <li>Código</li>
                        <li>Modelo</li>
                        <li>Tam.</li>
                        <li>Cor</li>
                        <li>Tecido</li>
                        <li>Preço</li>
                        <li></li>
                    </ul>
                </div>
                <div class="row box col-12 modelos resultado">                
                            <script type="text/javascript" src="../_js/pesquisa-modelo-lista.js"></script>
                    <?php
                    $buscando_estoque_local = "SELECT * ";
                    $buscando_estoque_local .= "FROM modelos ";
                    $buscando_estoque_local .= "ORDER BY nome ASC ";
                    $encontrando_estoque_local = mysqli_query($conecta,$buscando_estoque_local);
                    while($row_estoque = mysqli_fetch_assoc($encontrando_estoque_local)){
                        $codigo_ref = $row_estoque['codigo'];
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
                        <li><?php echo $codigo_ref ?></li>
                        <li><?php echo $nome_model ?></li>
                        <li><?php echo $mostrar_tam_item ?></li>
                        <li><?php echo $mostrar_cor_item ?></li>
                        <li><?php echo $mostrar_tec_item ?></li>
                        <li><?php echo 'R$ ' . number_format($valores, 2, ',', '.'); ?></li>
                        <a href='modelo.php?codigo=<?php echo $codigo_ref ?>'><li class='btn btn-block'>Ver</li></a>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>