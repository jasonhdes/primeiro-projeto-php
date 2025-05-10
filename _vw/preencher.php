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

    $buscar_vendedor = "SELECT * ";
    $buscar_vendedor .= "FROM funcionarios ";
    $buscar_vendedor .= "WHERE registro = {$resultado_venda['registro']} ";
    $buscando_vendedor = mysqli_query($conecta,$buscar_vendedor);
    $resultado_vendedor = mysqli_fetch_assoc($buscando_vendedor);

    $nome_vendedor = utf8_encode($resultado_vendedor['nome']);
    $local_id = $resultado_venda['local_id'];
    $observacao = $resultado_venda['observacao'];

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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Preencher para entrega | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../_js/personalizado2.js"></script>
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
                <div class="col-12 col-md-4 col-lg-2">
                    <a href="#">
                        <p></p>
                    </a>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <a href="#">
                        <p></p>
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
                    <h3>Preencher Para Entrega | Kodok</h3>
                </div>
                <div class="row col-12">
                    <form class="col-12 form-group" action="cupom-online.php" method="POST">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <label for="vendedor">Vendido por:</label>
                                <input class="form-control" type="text" name="vendedor" id="vendedor" value="<?php echo $nome_vendedor ?>" disabled>
                            </div>
                            <div class="col-12 col-lg-3">
                                <label for="local">Loja:</label>
                                <input class="form-control" type="text" name="local" id="local" value="<?php echo $nome_local ?>" disabled>
                            </div>
                            <div class="col-12 col-lg-3">
                                <label for="quantidade">Quantidade total de peças:</label>
                                <input class="form-control" type="text" name="quantidade" id="quantidade" value="<?php echo $resultado_venda['quantidade']; ?>" disabled>
                            </div>
                            <div class="col-12 col-lg-3">
                                <label for="total">Valor total da compra:</label>
                                <input class="form-control" type="text" name="total" id="total" value="<?php echo 'R$ ' . number_format($resultado_venda['valor'], 2, ',', '.'); ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="comprador">Nome do Comprador/Destinatário:</label>
                                <input class="form-control" id="comprador" name="comprador" placeholder="Nome Completo" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <label for="endereco">Endereço:</label>
                                <input class="form-control" id="endereco" type="text" name="endereco" placeholder="Avenida Principal" maxlenght="50" required>
                            </div>
                            <div class="col-12 col-lg-1">
                                <label for="numero">Nº.:</label>
                                <input class="form-control" id="numero" type="text" name="numero" placeholder="12345" maxlength="5" required>
                            </div>
                            <div class="col-12 col-lg-1">
                                <label for="complemento">Compl.:</label>
                                <input class="form-control" id="complemento" type="text" name="complemento" placeholder="Piso 3 Loja 4" maxlength="20">
                            </div>
                            <div class="col-12 col-lg-2">
                                <label for="cidade">Cidade:</label>
                                <input class="form-control" id="cidade" type="text" name="cidade" placeholder="Presidente Prudente" maxlength="30" required>
                            </div>
                            <div class="col-12 col-lg-1">
                                <label for="estado">UF:</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option selected>Selecione...</option>
                                    <?php
                                    $listar_estados = "SELECT * ";
                                    $listar_estados .= "FROM estados ";
                                    $listando_estados = mysqli_query($conecta,$listar_estados);
                                        while($lista_estados = mysqli_fetch_assoc($listando_estados)){
                                    ?>
                                    <option value="<?php echo $lista_estados["estado"] ?>"><?php echo utf8_encode($lista_estados["estado"]) ?>       </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-2">
                                <label for="cep">CEP:</label>
                                <input class="form-control" id="cep" type="text" name="cep" placeholder="12345678" maxlength="8" required>
                            </div>
                            <div class="col-12 col-lg-2">
                                <label for="telefone">Telefone:</label>
                                <input class="form-control" id="telefone" type="text" name="telefone" placeholder="(XX)XXXX-XXXX" maxlength="13">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="observacao">Observações:</label>
                                <textarea class="form-control" name="observacao"><?php echo $observacao ?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="codigo_venda" value="<?php echo date('YmdHis') ?>" id="codigo_venda">
                        <input class="btn btn-block" type="submit" name="gerar" value="Gerar Romaneio">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>