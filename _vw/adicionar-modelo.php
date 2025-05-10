<?php
    require('../_mdl/access.php');

    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);


    if(isset($_POST["modelo"])){
        $nome       = utf8_decode($_POST["modelo"]);
        $referencia = utf8_decode($_POST["referencia"]);
        $tamanho    = $_POST["tamanho"];
        $cor        = $_POST["cor"];
        $preco      = utf8_decode($_POST["preco"]);
        $tecido     = $_POST["tecido"];
    
        if(isset($_FILES['upload_file'])) {
            $arquivo_temporario = $_FILES['upload_file']['tmp_name'];
            $arquivo = basename($_FILES['upload_file']['name']);
            $extensao  = strtolower(strrchr($_FILES['upload_file']['name'],"."));
            $nome_novo = $referencia.$tamanho.$cor.$extensao;
            $diretorio = "../_img/modelos/";
            
            move_uploaded_file($arquivo_temporario,$diretorio.$nome_novo);
        
            $file_new = $diretorio.$nome_novo;
        }
        
 
    $inserir_modelo = "INSERT INTO modelos ";
    $inserir_modelo .= "(nome, referencia, tamanho_id, cor_id, preco, foto, tecido_id, codigo) ";
    $inserir_modelo .= "VALUES ";
    $inserir_modelo .= "('$nome', '$referencia', $tamanho, $cor, '$preco', '$file_new', '$tecido', $nome_novo) ";

    $operacao_inserir = mysqli_query($conecta,$inserir_modelo);


    }

    if(!$operacao_inserir){
        echo "houve erro";
    } else {
        
        echo "Novo Modelo salvo.";
    }


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
                    <a href="lista-modelos.php">
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
                    <h3>Adicionar Novo Modelo</h3>
                </div>
                <form action="adicionar-modelo.php" method="post" enctype="multipart/form-data">
                    <div id="formulario">
                        <div class="row box col-12 formulario form-group">
                            <div class="row col-12">
                                <div class="col-12 col-lg-2">
                                    <label for="referencia">Ref.:</label>
                                    <input class="form-control" id="referencia" type="text" name="referencia" placeholder="XXX" maxlength="3" required>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <label for="modelo">Modelo</label>
                                    <input class="form-control" id="modelo" type="text" name="modelo" placeholder="Nome do Modelo" maxlenght="20" required>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="tamanho">Tam.:</label>
                                    <select name="tamanho" id="tamanho" class="form-control" required>
                                        <option selected>Selecione...</option>
                                        <?php
                                            while($list_tamanho = mysqli_fetch_assoc($lista_tamanho)){
                                        ?>
                                        <option value="<?php echo $list_tamanho["tamanho_id"] ?>"><?php echo utf8_encode($list_tamanho["tamanho"]) ?>   </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="cor">Cor:</label>
                                    <select name="cor" id="cor" class="form-control" required>
                                        <option selected>Selecione...</option>
                                        <?php
                                            while($list_cor = mysqli_fetch_assoc($lista_cor)){
                                        ?>
                                        <option value="<?php echo $list_cor["cor_id"] ?>"><?php echo utf8_encode($list_cor["cor"]) ?>   </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="tecido">Tecido:</label>
                                    <select name="tecido" id="tecido" class="form-control" required>
                                        <option selected>Selecione...</option>
                                        <?php
                                            while($list_tecido = mysqli_fetch_assoc($lista_tecido)){
                                        ?>
                                        <option value="<?php echo $list_tecido["tecido_id"] ?>"><?php echo utf8_encode($list_tecido["tecido"]) ?>   </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <label for="preco">Preço:<br><small><small>(Utilize ponto e não vírgula)</small></small></label>
                                    <input class="form-control" id="preco" type="text" name="preco" placeholder="10.00" maxlenght="6" required>
                                </div>
                            </div>
                            <div class="row col-12">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                                <input class="btn btn-primary" type="file" id="file" name="upload_file" accept="image/jpeg, image/jpg, image/png">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row col-12">
                            <div class="col-12 col-lg-1"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>