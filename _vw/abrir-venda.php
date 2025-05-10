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


    $vendedor = 4;

    if(isset($_POST['abrir'])){
        $registro_vendedor = $_POST['vendedor'];
        $local_venda       = $_POST['local'];
        $registrado_por    = $_POST['funcionario_id'];
        $codigo_venda      = $_POST['codigo_venda'];
        
        $inserir_venda = "INSERT INTO vendas ";
        $inserir_venda .= "(codigo_venda,registro,local_id,registrado) ";
        $inserir_venda .= "VALUES ";
        $inserir_venda .= "($codigo_venda,$registro_vendedor,$local_venda,$registrado_por ) ";
        $inserindo_venda = mysqli_query($conecta,$inserir_venda);

        if(!$inserindo_venda){
            echo "houve erro. linha 26";
        } else {
            header('location: venda.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Abrir Venda | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../_js/personalizado2.js"></script>
        <link href="../_css/estilo.css" rel="stylesheet">
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
                    <h3>Abrir Venda | Kodok</h3>
                </div>
                <div class="row col-12">
                    <div class="col-12 col-lg-3" style="margin: 0 auto"></div>
                    <div class="col-12 col-lg-6">
                        <form action="abrir-venda.php" method="POST">
                            <label for="vendedor">Vendedora:</label>
                            <select name='vendedor' id='vendedor' class='form-control'>
                                <option selected>Selecione...</option>
                                <?php
                                    $selecionar_vendedor = "SELECT * ";
                                    $selecionar_vendedor .= "FROM funcionarios ";
                                    $selecionar_vendedor .= "WHERE setor_id = {$vendedor} ";
                                    $selecionando_vendedor = mysqli_query($conecta,$selecionar_vendedor);
                                    while($lista_vendedor = mysqli_fetch_assoc($selecionando_vendedor)){
                                ?>
                                <option value='<?php echo $lista_vendedor['registro'] ?>'><?php echo utf8_encode($lista_vendedor['nome'])." ".utf8_encode($lista_vendedor['sobrenome']) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <label for="local">Loja:</label>
                            <select name='local' id='local' class='form-control'>
                                <option selected>Selecione...</option>
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
                            <input type="hidden" name="codigo_venda" value="<?php echo date('YmdHis') ?>" id="codigo_venda">
                            <input class="btn btn-block" type="submit" name="abrir" value="Abrir Venda">
                        </form>
                    </div>
                    <div class="col-12 col-lg-3" style="margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </body>
</html>