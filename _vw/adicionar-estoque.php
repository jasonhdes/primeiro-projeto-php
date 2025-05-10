<?php
    require('../_mdl/access.php');
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
    require('../_mdl/consultas.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ADICIONAR AO ESTOQUE | ko.dok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../_js/jquery-3.4.1.js"></script>
        <script src="../_js/esconder.js"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
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
                <div class="col-12">
            <?php
            if(isset($_POST['quantidade'])){

                $quantidade   = $_POST['quantidade'];
                $codigo       = $_POST['cod'];
                $local_id     = $_POST['local'];
                $query        = "SELECT estoque_id FROM estoque WHERE codigo = '{$codigo}' AND local_id = '{$local_id}' ";
                $result       = mysqli_query($conecta, $query);
                $row          = mysqli_num_rows($result);
                $estoque_info = mysqli_fetch_assoc($result);
                if($row == 1) {
                    $estoque = $estoque_info['estoque_id'];

                    $consulta   = "SELECT * ";
                    $consulta   .= "FROM estoque ";
                    $consulta   .= "WHERE estoque_id = '{$estoque}' ";
                    $mais_estoque    = mysqli_query($conecta,$consulta);

                    $dados_estoque  = mysqli_fetch_assoc($mais_estoque);
                    $quantidade_atual = $dados_estoque["quantidade"];
                    $vl_unit = $dados_estoque['preco'];

                    $nova_quantidade = ($quantidade_atual + $quantidade);
                    $novo_valor_total = ($nova_quantidade * $vl_unit);

                    $inserir_quantidade = "UPDATE estoque ";
                    $inserir_quantidade .= "SET ";
                    $inserir_quantidade .= "quantidade = '{$nova_quantidade}', ";
                    $inserir_quantidade .= "total = '{$novo_valor_total}' ";
                    $inserir_quantidade .= "WHERE estoque_id = {$estoque} ";

                    $operacao_inserir = mysqli_query($conecta,$inserir_quantidade);
                    if(!$operacao_inserir){
            ?>
            <div class='info' id='erro'>Erro ao adicionar ao estoque. Confira as informações e tente novamente.</div>
            <?php
                    } else {
                        ?>
            <div class='info' id='sucesso'>Adicionado ao estoque com sucesso!</div>
            <?php
                    }
                } else {
                    $codigo_id = "SELECT * ";
                    $codigo_id .= "FROM modelos ";
                    $codigo_id .= "WHERE codigo = '{$codigo}' ";

                    $lista_codigo = mysqli_query($conecta, $codigo_id);
                    $list_codigo = mysqli_fetch_assoc($lista_codigo);
    
                    $cor     = $list_codigo['cor_id'];
                    $tamanho = $list_codigo['tamanho_id'];
                    $tecido  = $list_codigo['tecido_id'];
                    $preco   = $list_codigo['preco'];
                    $modelo  = $list_codigo['nome'];
                    $total   = ($quantidade * $preco);

                    $inserir_estoque = "INSERT INTO estoque ";
                    $inserir_estoque .= "(local_id, codigo, quantidade, cor_id, tamanho_id, tecido_id, preco, nome, total) ";
                    $inserir_estoque .= "VALUES ";
                    $inserir_estoque .= "($local_id, $codigo, $quantidade, $cor, $tamanho, $tecido, $preco, '$modelo', $total) ";

                    $operacao_estoque = mysqli_query($conecta,$inserir_estoque);
                    if(!$operacao_estoque){
            ?>
            <div class='info' id='erro'>Erro ao adicionar ao estoque. Confira as informações e tente novamente.</div>
            <?php
                    } else {
                        ?>
            <div class='info' id='sucesso'>Adicionado ao estoque com sucesso!</div>
            <?php
                    }
                }
            };
            ?>
                </div>
            </div>
            <div class="row">
                <div class="btn col-12 col-md-3 col-lg-2">
                    <a href="home.php">
                        <p>Painel Inicial</p>
                    </a>
                </div>
                <div class="btn col-12 col-md-4 col-lg-2">
                    <a href="transporte.php">
                        <p>Entrada/Saída Estoque</p>
                    </a>
                </div>
                <div class=" col-12 col-md-4 col-lg-2">
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
                    <h3>Adicionar Estoque</h3>
                </div>
                <div class="row col-12">
                    <div class="col-12 col-lg-2">
                        <form method="POST" id="form-pesquisa" action="">
                            <label>Pesquisar código: </label>
                            <input class="form-control" type="text" name="pesquisa" id="pesquisa" placeholder="Digite o código">
                        </form>
                    </div>
                </div>
                <div class="row col-12">
                    <form action="adicionar-estoque.php" id="form-adicionar" method="POST" class="form-group col-12">
                        <div class="row col-12">
                            <div class="col-12 col-lg-3">
                                <label for="local">Local:</label>
                                <select class="form-control" id="local" name="local">
                                    <option selected>Selecione...</option>
                                    <?php
                                        while($list_local = mysqli_fetch_assoc($lista_local)){
                                    ?>
                                    <option value="<?php echo $list_local["local_id"] ?>"><?php echo utf8_encode($list_local["nome"]) ?>   </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-1">
                                <label for="quantidade">Qtde.</label>
                                <input name="quantidade" id="quantidade" type="text" class="form-control" maxlength="5">
                            </div>
                            <div class="col-12 col-lg-8"></div>
                        </div>
                        <div class="resultado row col-12">
                            <script type="text/javascript" src="../_js/personalizado.js"></script>
                        </div>
                        <div class="row col-12">
                            <div class="col-12 col-lg-9"></div>
                            <div class="col-12 col-lg-3">
                                <input class="btn btn-block" id="adicionar" type="submit" name="adicionar" value="Adicionar">
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </body>
</html>
<?php mysqli_close($conecta); ?>