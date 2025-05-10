<?php
    require('../_mdl/access.php');

    $local = "SELECT local_id, nome ";
    $local .= "FROM locais ";
    $local .= "ORDER BY nome ASC ";
    $lista_local = mysqli_query($conecta, $local);
?>
<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Novo Funcionário | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../_css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                    <h3>Adicionar Novos Funcionários</h3>
                </div>
        <span id="msg"></span>
        <form id="add-info" method="POST">
            <div id="formulario">
                <div class="row box col-12 formulario form-group">
                            <div class="row col-12">
                                <div class="col-12 col-lg-4">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control" id="nome" type="text" name="nome[]" placeholder="Primeiro Nome" max-lenght="15" required>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <label for="sobrenome">Sobrenome:</label>
                                    <input class="form-control" id="sobrenome" type="text" name="sobrenome[]" placeholder="Sobrenome" max-lenght="20" required>
                                </div>
                                <div class="col-12 col-lg-1">
                                    <label for="registro">Registro.:</label>
                                    <input class="form-control" id="registro" type="text" name="registro" placeholder="1020304050" maxlength="10" required>
                                </div>
                                <div class="col-12 col-lg-1">
                                    <label for="loja">Alocação:</label>
                                    <select class="form-control" id="local" name="local[]">
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
                                <div class="col-12 col-lg-2">
                                    <label for="telefone">Telefone:</label>
                                    <input class="form-control" id="telefone" type="text" name="telefone[]" placeholder="(XX)XXXXX-XXXX" max-lenght="14">
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="senha">Senha:</label>
                                    <input class="form-control" id="senha" type="password" name="senha[]" value="000000" max-lenght="6">
                                </div>
                            </div>
                        </div>
            </div>
                <div class="row">
                        <div class="row col-12">
                            <div class="col-12 col-lg-1">
                                <div class="btn button btn-block"><button type="button" id="add-campo"> + </button></div>
                            </div>
                            <div class="col-12 col-lg-8"></div>
                            <div class="col-12 col-lg-3">
                                <input class="btn btn-block" type="button" name="CadInfos" id="CadInfos" value="Cadastrar">
                            </div>
                        </div>
                    </div>
        </form>
        <script>
                        $(document).ready(function () {
                var cont = 1;
                //https://api.jquery.com/click/
                $('#add-campo').click(function () {
                    cont++;
                    //https://api.jquery.com/append/
                    $('#formulario').append('<div class="form-group" id="campo' + cont + '"> <label>Aula: </label><input type="text" name="titulo[]" placeholder="Nome da Aula"> <button type="button" id="' + cont + '" class="btn-apagar"> - </button></div>');
                });

                $('form').on('click', '.btn-apagar', function () {
                    var button_id = $(this).attr("id");
                    $('#campo' + button_id + '').remove();
                });

                $("#CadInfos").click(function () {
                    //Receber os dados do formulário
                    var dados = $("#add-info").serialize();
                    $.post("insert.php", dados, function (retorna) {
                        $("#msg").slideDown('slow').html(retorna);

                        //Limpar os campos
                        //$('#add-info')[0].reset();

                        //Apresentar a mensagem leve
                        retirarMsg();
                    });
                });

                //Retirar a mensagem após 1700 milissegundos
                function retirarMsg() {
                    setTimeout(function () {
                        $("#msg").slideUp('slow', function () {});
                    }, 2700);
                }
            });

        </script>
            </div>
        </div>
    </body>
</html>