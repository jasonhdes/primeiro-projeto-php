<?php
    session_start();
    include('_mdl/access.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ENTRAR | ko.dok</title>
        <link rel="shortcut icon" href="_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="_css/estilo.css" rel="stylesheet">
        <script type="text/x-javascript" src="_js/chama-modal.js"></script>
        <style type="text/css">
            div.modal-dialog {
                border-radius: 5px;
                border: solid 2px red;
            }
            div.modal-header {
                text-align: center;
                color: red;
                background: rgb(255,163,163);
                background: linear-gradient(90deg, rgba(255,163,163,1) 0%, rgba(249,245,245,1) 50%, rgba(255,163,163,1) 100%);
            }
        </style>
    </head>
    <body class="index">
        <?php
            if(isset($_POST['entrar'])) {
                $registro  = mysqli_real_escape_string($conecta, $_POST['registro']);
                $senha  = mysqli_real_escape_string($conecta, $_POST['senha']);
                $query  = "SELECT * FROM funcionarios WHERE registro = '{$registro}' and senha = md5('{$senha}')";
                $result = mysqli_query($conecta, $query);
                $row    = mysqli_num_rows($result);
                $info   = mysqli_fetch_assoc($result);
                if($row == 1) {
                    $_SESSION['portal'] = $info['registro'] ;
                    header('Location: _vw/home.php');
                } else {
                    $modal_titulo = "Acesso Negado";
                    $modal_mensagem = "Registro e/ou senha inválidos.";
                    $btn = "Tentar Novamente";
                    $link = "index.php";
                    include('_vw/modal.php');
                }
            }
        ?>
        <div class="container-fluid login">
            <div class="row">
                <div id="img">
                    <img src="_img/logo.png">
                </div>
            </div>
            <div class="card center">
                <form action="index.php" method="post" class="form-group">
                    <label>Insira o seu número de registro</label>
                    <input type="text" class="form-control" name="registro" placeholder="registro">
                    <label>Insira sua senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="senha">
                    <input type="submit" name="entrar" value="Entrar" class="btn botao">
                </form>
            </div>
        </div>
    </body>
</html>
<?php mysqli_close($conecta); ?>