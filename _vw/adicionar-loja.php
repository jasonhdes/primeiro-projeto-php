<?php
    require('../_mdl/access.php');
    require('../_mdl/consultas.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nova Loja | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                <div class="btn col-6 col-lg-2">
                    <a href="#">
                        <p></p>
                    </a>
                </div>
                <div class="btn col-6 col-lg-2">
                    <a href="estoque.html">
                        <p>Estoques</p>
                    </a>
                </div>
                <div class="btn col-6 col-lg-2">
                    <a href="home.html">
                        <p>Página Inicial</p>
                    </a>
                </div>
                <div class="btn col-6 col-lg-2">
                    <a href="home.html">
                        <p>Página Inicial</p>
                    </a>
                </div>
                <div class="nome col-6 col-lg-2">
                    <p>Fulano de tal</p>
                </div>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3>Adicionar Nova Loja</h3>
                </div>
                <form action="../_ctrl/nova-loja.php" method="post">
                    <div id="formulario">
                        <div class="row box col-12 formulario form-group">
                            <div class="row col-12">
                                <div class="col-12 col-lg-4">
                                    <label for="nome">Nome da Loja:</label>
                                    <input class="form-control" id="nome" type="text" name="nome" value="Presidente Prudente" max-lenght="30" required>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <label for="endereco">Endereço:</label>
                                    <input class="form-control" id="endereco" type="text" name="endereco" value="Avenida Principal" max-lenght="50" required>
                                </div>
                                <div class="col-12 col-lg-1">
                                    <label for="numero">Nº.:</label>
                                    <input class="form-control" id="numero" type="text" name="numero" placeholder="12345" maxlength="5" required>
                                </div>
                                                                <div class="col-12 col-lg-2">
                                    <label for="complemento">Complemento.:</label>
                                    <input class="form-control" id="complemento" type="text" name="complemento" placeholder="Piso 3 Loja 4" maxlength="20">
                                </div>
                                                                <div class="col-12 col-lg-4">
                                    <label for="cidade">Cidade:</label>
                                    <input class="form-control" id="cidade" type="text" name="cidade" placeholder="Presidente Prudente" maxlength="30" required>
                                </div>
                                <div class="col-12 col-lg-1">
                                    <label for="estado">UF:</label>
                                    <select id="estado" name="estado" class="form-control">
                                        <option selected>Selecione...</option>
                                        <?php
                                            while($list_estado = mysqli_fetch_assoc($lista_estado)){
                                        ?>
                                        <option value="<?php echo $list_estado["estado_id"] ?>"><?php echo utf8_encode($list_estado["estado"]) ?>   </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="telefone">Telefone:</label>
                                    <input class="form-control" id="telefone" type="text" name="telefone" placeholder="(XX)XXXX-XXXX" max-lenght="13">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="row col-12">
                            <div class="col-12 col-lg-1">
                                
                            </div>
                            <div class="col-12 col-lg-8"></div>
                            <div class="col-12 col-lg-3">
                                <input class="btn btn-block" id="adicionar" type="submit" name="adicionar" value="Adicionar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>