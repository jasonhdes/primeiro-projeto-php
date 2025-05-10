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
        <script type="text/x-javascript" src="../_js/chama-modal.js"></script>
        <style type="text/css">
            div.info {
                text-align: center;
                border-radius: 5px;
            }
            div#erro {
                color: red;
                background: rgb(255,163,163);
                background: linear-gradient(90deg, rgba(255,163,163,1) 0%, rgba(249,245,245,1) 50%, rgba(255,163,163,1) 100%);
                border: solid 1px red;
            }
            div#sucesso{
                color: green;
                background: rgb(148,255,108);
                background: linear-gradient(90deg, rgba(148,255,108,1) 0%, rgba(249,245,245,1) 50%, rgba(148,255,108,1) 100%);
                border: solid 1px green;
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
        
            <?php
            if(isset($_POST['cancelar'])){
                $codigo_t = $_POST['cod_transp'];
                        
                $buscar_estoque_local = "SELECT * ";
                $buscar_estoque_local .= "FROM transportando ";
                $buscar_estoque_local .= "WHERE codigo_transporte = {$codigo_t} ";
                $buscando_estoque_local = mysqli_query($conecta,$buscar_estoque_local);
                while($resultado_estoque_local = mysqli_fetch_assoc($buscando_estoque_local)){
                    $id = $resultado_estoque_local['transportando_id'];
                    $codigo_retorno = $resultado_estoque_local['codigo'];
                    $quantidade_retorno = $resultado_estoque_local['quantidade'];
                    $transportando_id = $resultado_estoque_local['transportando_id'];
                    $preco_estoque = $resultado_estoque_local['preco'];
                    
                    $buscar_estoque = "SELECT * ";
                    $buscar_estoque .= "FROM estoque ";
                    $buscar_estoque .= "WHERE codigo = {$codigo_retorno} ";
                    $buscar_estoque .= "AND local_id = {$resultado_estoque_local['local_id']} ";
                    $buscando_estoque = mysqli_query($conecta,$buscar_estoque);
                    $resultado_estoque = mysqli_fetch_assoc($buscando_estoque);
                    
                    $quantidade_estoque = $resultado_estoque['quantidade'];
                    $quantidade_nova = ($quantidade_estoque + $quantidade_retorno);
                    $novo_total = ($preco_estoque * $quantidade_nova);
                    
                    $devolver_estoque = "UPDATE estoque ";
                    $devolver_estoque .= "SET ";
                    $devolver_estoque .= "quantidade = {$quantidade_nova}, ";
                    $devolver_estoque .= "total = {$novo_total} ";
                    $devolver_estoque .= "WHERE local_id = {$resultado_estoque_local['local_id']} ";
                    $devolver_estoque .= "AND codigo = {$codigo_retorno} ";
                    $devolvendo_estoque = mysqli_query($conecta,$devolver_estoque);
                    
                    $excluir_transportando = "DELETE ";
                    $excluir_transportando .= "FROM transportando ";
                    $excluir_transportando .= "WHERE transportando_id = {$transportando_id} ";
                    $excluindo_transportando = mysqli_query($conecta,$excluir_transportando);
                    if(!$excluindo_transportando){
                        $modal_titulo = "Transporte Não Cancelado";
                        $modal_mensagem = "Erro ao cancelar transporte. Confira as informações e tente novamente.";
                        $btn = "Voltar";
                        $link = "saida-transporte.php";
                        include('modal.php');
                    } 
                }
                $excluir_transporte = "DELETE ";
                $excluir_transporte .= "FROM transportes ";
                $excluir_transporte .= "WHERE codigo_transporte = {$codigo_t} ";
                $excluindo_transporte = mysqli_query($conecta,$excluir_transporte);
                
                if(!$excluindo_transporte){
                    $modal_titulo = "Transporte Não Cancelado";
                        $modal_mensagem = "Erro ao excluir peças transporte e devolver ao estoque. Confira as informações e tente novamente.";
                        $btn = "Voltar";
                        $link = "saida-transporte.php";
                        include('modal.php');
                } else {
                        $modal_titulo = "Transporte Cancelado";
                        $modal_mensagem = "O transporte foi cancelado com sucesso.";
                        $btn = "Ok";
                        $link = "transporte.php";
                        include('modal.php');
                    }
            }
                            if(isset($_POST['saida'])){
                $codigo_transporte = $_POST['codigo_transporte'];
                $funcionario_id    = $_POST['funcionario_id'];
                $local_id          = $_POST['local_saida'];
                $quantidade_total  = 0;
                $vl_total          = 0;
                $data_transporte   = 0;
                $entrada_saida     = $_POST['entrada_saida'];

                $inserir_transporte = "INSERT INTO transportes ";
                $inserir_transporte .= "(codigo_transporte, registro, local_id, quantidade_total, vl_total, data_transporte, entrada_saida) ";
                $inserir_transporte .= "VALUES ";
                $inserir_transporte .= "('$codigo_transporte','$funcionario_id','$local_id','$quantidade_total','$vl_total','$data_transporte','$entrada_saida') ";
                $operacao_inserir = mysqli_query($conecta,$inserir_transporte);
 
                if(!$operacao_inserir){
            ?>
            <div class='info' id='erro'>Erro ao iniciar transporte. Confira as informações e tente novamente.</div>
            <?php
                } else {
                    $codigo_transporte = $_POST['codigo_transporte'];
                    $funcionario_id    = $_POST['funcionario_id'];
                    $local_id          = $_POST['local_saida'];
                    $entrada_saida     = $_POST['entrada_saida'];
                    header('Location: ../_vw/saida-transporte.php');
                }
            }

            if(isset($_POST['entrada'])){
                $codigo_transporte = $_POST['transporte'];
                $funcionario_id    = $_POST['funcionario_id'];
                $local_id          = $_POST['local'];
                $quantidade_total  = 0;
                $vl_total          = 0;
                $data_transporte   = 0;
                $entrada_saida     = 2;

                $buscar_transporte = "SELECT * ";
                $buscar_transporte .= "FROM transportes ";
                $buscar_transporte .= "WHERE codigo_transporte = {$codigo_transporte} ";
                $buscando_transporte = mysqli_query($conecta,$buscar_transporte);
                $resultado_transportes = mysqli_fetch_assoc($buscando_transporte);

                if(empty($resultado_transportes)){
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
                    $modal_titulo = "Transporte Não Encontrado";
                    $modal_mensagem = "Erro ao iniciar recebimento de mercadoria. Confira as informações e tente novamente.";
                    $btn = "Ok";
                    $link = "transporte.php";
                    include('modal.php');
                } else {
                    $inserir_entrega = "INSERT INTO transportes ";
                    $inserir_entrega .= "(codigo_transporte, registro, local_id, quantidade_total, vl_total, data_transporte, entrada_saida) ";
                    $inserir_entrega .= "VALUES ";
                    $inserir_entrega .= "('$codigo_transporte','$funcionario_id','$local_id','$quantidade_total','$vl_total','$data_transporte','$entrada_saida') ";
                    $operacao_inserir = mysqli_query($conecta,$inserir_entrega);
                    if(!$operacao_inserir){
                        $modal_titulo = "Entrada Não Iniciada";
                        $modal_mensagem = "Erro ao iniciar recebimento de mercadoria. Confira as informações e tente novamente.";
                        $btn = "Ok";
                        $link = "transporte.php";
                        include('modal.php');
                    } else {
                        header('Location: entrada-transporte.php?codigo='.$codigo_transporte );
                    }
                }
            }
?>
        <div class="container-fluid login">
            <div class="row">
                <div id="img">
                    <img src="../_img/logo.png">
                </div>
            </div>
        </div>
        <?php

            ?>
        <div class="container-fluid">
            <div class="row">
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="estoque.php">
                        <p>Estoque</p>
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
                    <h3>Transporte Estoque | Kodok</h3>
                </div>
                <div class="row col-12">
                    <div class="col-12 col-lg-6" style="margin: 0 auto">
                        <form action="transporte.php" method="post">
                            <label>Local de saída:</label>
                            <select class="form-control" id="local_saida" name="local_saida">
                                <option selected>Selecione...</option>
                                <?php
                                    $selecao_local = "SELECT * ";
                                    $selecao_local .= "FROM locais ";
                                    $selecao_local .= "ORDER BY local_id ASC ";
                                    $selecao_local_query = mysqli_query($conecta,$selecao_local);
                                    while($selecionando_local = mysqli_fetch_assoc($selecao_local_query)){
                                ?>
                                <option value="<?php echo $selecionando_local['local_id']?>"><?php echo utf8_encode($selecionando_local['nome']) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="entrada_saida" value="1" id="entrada_saida">
                            <input type="hidden" name="codigo_transporte" value="<?php echo date('YmdHis'); ?>" id="codigo_transporte">
                            <input type="hidden" name="funcionario_id" value="1234567890" id="funcionario_id">
                            <input class="btn btn-block" type="submit" name="saida" value="Saída">
                        </form>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form action="transporte.php" method="POST">
                            <label for="transporte">Digite aqui o código:</label>
                            <input class="form-control" type="text" name="transporte" placeholder="Total de 15 dígitos" id="codigo" maxlength="15">
                            <label for="local">Escolha o Local de entrada das peças:</label>
                            <select name='local' id='local' class='form-control'>
                                <?php
                                    $selecionar_local = 'SELECT * ';
                                    $selecionar_local .= 'FROM locais ';
                                    $selecionando_local = mysqli_query($conecta,$selecionar_local);
                                    while($lista_locais = mysqli_fetch_assoc($selecionando_local)){
                                ?>
                                <option value='<?php echo $lista_locais['local_id'] ?>'><?php echo utf8_encode($lista_locais['nome']) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="funcionario_id" value="<?php echo $resultado_funcionario['registro'] ?>" id="funcionario_id">
                            <input class="btn btn-block" type="submit" name="entrada" value="Entrada">
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>
<?php mysqli_close($conecta); ?>