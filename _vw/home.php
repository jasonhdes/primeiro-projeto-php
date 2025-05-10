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
    $adm = 1;
    $ger = 2;
    $alm = 3;
    $ven = 4;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PAINEL INICIAL | ko.dok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
        <div class="row">
                <div class="col-6 col-lg-2">
                </div>
                <div class="col-6 col-lg-2">
                </div>
                <div class="col-6 col-lg-2">
                </div>
                <div class="col-6 col-lg-2">
                </div>
                <div class="nome col-6 col-lg-2">
                    <p>Bem vindo, <?php echo utf8_encode($resultado_funcionario['nome']) ?> !</p>
                </div>
            </div>
        <?php
            if($resultado_funcionario['setor_id'] = $adm){
        ?>
        <div class="container-fluid">
            <div class="row box">
                <div class="row col-12">
                    <h3>Estoque</h3>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="estoque.php">
                        <img src="../_img/favicon.png">
                        <p>Estoque Geral</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="adicionar-estoque.php">
                        <img src="../_img/favicon.png">
                        <p>Adicionar Estoque</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="transporte.php">
                        <img src="../_img/favicon.png">
                        <p>Transferir Estoque</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="lista-transportes.php">
                        <img src="../_img/favicon.png">
                        <p>Lista dos Transportes</p>
                    </a>
                </div>
                <?php
                    $busca_locais = "SELECT * ";
                    $busca_locais .= "FROM locais ";
                    $busca_locais .= "ORDER BY local_id ASC ";
                    $buscando_locais = mysqli_query($conecta,$busca_locais);
                        while($resultado_locais =  mysqli_fetch_assoc($buscando_locais)){
                            $id_local = $resultado_locais['local_id'];
                        
                ?>
                <div class="icon col-3 col-lg-1">
                    <a href="estoque-local.php?local=<?php echo $id_local ?>">
                        <img src="../_img/favicon.png">
                        <p><?php echo utf8_encode($resultado_locais['nome']) ?></p>
                    </a>
                </div>
                <?php
                        }
                ?>
            </div>
            <div class="row box">
                <div class="row col-12">
                    <h3>Vendas</h3>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="abrir-venda.php">
                        <img src="../_img/favicon.png">
                        <p>Abrir Venda</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="total-vendas.php">
                        <img src="../_img/favicon.png">
                        <p>Consolidado de Vendas</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="todas-vendas.php">
                        <img src="../_img/favicon.png">
                        <p>Todas as Vendas</p>
                    </a>
                </div>
                <?php
                    $busca_locais = "SELECT * ";
                    $busca_locais .= "FROM locais ";
                    $busca_locais .= "ORDER BY local_id ASC ";
                    $buscando_locais = mysqli_query($conecta,$busca_locais);
                        while($resultado_locais =  mysqli_fetch_assoc($buscando_locais)){
                            $id_local = $resultado_locais['local_id'];
                        
                ?>
                <div class="icon col-3 col-lg-1">
                    <a href="consolidado-vendas.php?local=<?php echo $id_local ?>">
                        <img src="../_img/favicon.png">
                        <p><?php echo utf8_encode($resultado_locais['nome']) ?></p>
                    </a>
                </div>
                <?php
                        }
                ?>
            </div>
            <div class="row box">
                <div class="row col-12">
                    <h3>Lojas</h3>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="adicionar-loja.php">
                        <img src="../_img/favicon.png">
                        <p>Adicionar Loja</p>
                    </a>
                </div>
                <?php
                    $busca_locais = "SELECT * ";
                    $busca_locais .= "FROM locais ";
                    $busca_locais .= "ORDER BY local_id ASC ";
                    $buscando_locais = mysqli_query($conecta,$busca_locais);
                        while($resultado_locais =  mysqli_fetch_assoc($buscando_locais)){
                            $id_local = $resultado_locais['local_id'];
                        
                ?>
                <div class="icon col-3 col-lg-1">
                    <a href="loja.php?local=<?php echo $id_local ?>">
                        <img src="../_img/favicon.png">
                        <p><?php echo utf8_encode($resultado_locais['nome']) ?></p>
                    </a>
                </div>
                <?php
                        }
                ?>
            </div>
            <div class="row box">
                <div class="row col-12">
                    <h3>Colaboradores</h3>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="#">
                        <img src="../_img/favicon.png">
                        <p>Todos</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="#">
                        <img src="../_img/favicon.png">
                        <p>Adicionar</p>
                    </a>
                </div>
                <div class="icon col-3 col-lg-1">
                    <a href="#">
                        <img src="../_img/favicon.png">
                        <p>João</p>
                    </a>
                </div>
            </div>
        </div>
        <?php
            } else {}
        ?>
    </body>
</html>