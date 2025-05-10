<?php
    include('../_mdl/access.php');
    session_start();
    $_SESSION['portal'];
    $busca_funcionario = "SELECT * ";
    $busca_funcionario .= "FROM funcionarios ";
    $busca_funcionario .= "WHERE registro = {$_SESSION['portal']} ";
    $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);



    if(isset($_POST['atualizar'])){

        $cod        = $_POST['cod'];
        $referencia = $_POST['referencia'];
        $modelo     = $_POST['modelo'];
        $tamanho    = $_POST['tamanho'];
        $cor        = $_POST['cor'];
        $tecido     = $_POST['tecido'];
        $preco      = $_POST['preco'];
        $modelo_id  = $_POST['modelo_id'];
        $codigo     = $referencia.$tamanho.$cor;
        
        $atualizar_modelo = "UPDATE modelos ";
        $atualizar_modelo .= "SET ";
        $atualizar_modelo .= "referencia = {$referencia}, ";
        $atualizar_modelo .= "codigo = {$codigo}, ";
        $atualizar_modelo .= "nome  = '{$modelo}', ";
        $atualizar_modelo .= "tamanho_id = {$tamanho}, ";
        $atualizar_modelo .= "cor_id = {$cor}, ";
        $atualizar_modelo .= "tecido_id = {$tecido}, ";
        $atualizar_modelo .= "preco = {$preco} ";
        $atualizar_modelo .= "WHERE modelo_id = {$modelo_id} ";
        $atualizando_modelo = mysqli_query($conecta,$atualizar_modelo);
        
        if(!$atualizando_modelo){
            echo "Houve algum erro na atualização.";
            print_r($_POST);
        } else {
            
            $buscar_modelo_estoque = "SELECT * ";
            $buscar_modelo_estoque .= "FROM estoque ";
            $buscar_modelo_estoque .= "WHERE codigo = {$cod} ";
            $buscando_modelo_estoque = mysqli_query($conecta,$buscar_modelo_estoque);
            
            while($resultado_modelo_estoque = mysqli_fetch_assoc($buscando_modelo_estoque)){
                
                $quantidade = $resultado_modelo_estoque['quantidade'];
                $novo_total = ($quantidade * $preco);
                
                $atualizar_modelo_estoque = "UPDATE estoque ";
                $atualizar_modelo_estoque .= "SET ";
                $atualizar_modelo_estoque .= "nome  = '{$modelo}', ";
                $atualizar_modelo_estoque .= "tamanho_id = {$tamanho}, ";
                $atualizar_modelo_estoque .= "cor_id = {$cor}, ";
                $atualizar_modelo_estoque .= "tecido_id = {$tecido}, ";
                $atualizar_modelo_estoque .= "codigo = {$codigo}, ";
                $atualizar_modelo_estoque .= "total = {$novo_total}, ";
                $atualizar_modelo_estoque .= "preco = {$preco} ";
                $atualizar_modelo_estoque .= "WHERE codigo = {$cod} ";
                $atualizando_modelo_estoque = mysqli_query($conecta,$atualizar_modelo_estoque);
                
                if(!$atualizando_modelo_estoque){
                    
                }
            } 
            ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

            <!-- Botão para acionar modal -->


<!-- Modal -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('ExemploModalCentralizado').modal('show');
    });
</script>
<?php
        }
        
    }





    $codigo_modelo = $_GET['codigo'];

    $buscar_modelo = "SELECT * ";
    $buscar_modelo .= "FROM modelos ";
    $buscar_modelo .= "WHERE codigo = {$codigo_modelo} ";
    $buscando_modelo = mysqli_query($conecta,$buscar_modelo);
    $resultado_modelo = mysqli_fetch_assoc($buscando_modelo);

    $tamanho_id = $resultado_modelo['tamanho_id'];
    $cor_id = $resultado_modelo['cor_id'];
    $tecido_id = $resultado_modelo['tecido_id'];

    $buscar_tamanho = "SELECT * ";
    $buscar_tamanho .= "FROM tamanhos ";
    $buscar_tamanho .= "WHERE tamanho_id = {$tamanho_id} ";
    $buscando_tamanho = mysqli_query($conecta,$buscar_tamanho);
    $resultado_tamanho = mysqli_fetch_assoc($buscando_tamanho);

    $nome_tamanho = utf8_encode($resultado_tamanho['tamanho']);

    $buscar_cor = "SELECT * ";
    $buscar_cor .= "FROM cores ";
    $buscar_cor .= "WHERE cor_id = {$cor_id} ";
    $buscando_cor = mysqli_query($conecta,$buscar_cor);
    $resultado_cor = mysqli_fetch_assoc($buscando_cor);

    $nome_cor = utf8_encode($resultado_cor['cor']);

    $buscar_tecido = "SELECT * ";
    $buscar_tecido .= "FROM tecidos ";
    $buscar_tecido .= "WHERE tecido_id = {$tecido_id} ";
    $buscando_tecido = mysqli_query($conecta,$buscar_tecido);
    $resultado_tecido = mysqli_fetch_assoc($buscando_tecido);

    $nome_tecido = utf8_encode($resultado_tecido['tecido']);
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
        <script type="text/javascript">

        </script>
            
        <style type="text/css">
            div.foto a img {
                max-width: 100%;
            }
            
            .modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: rgba(0,0,0,0.8);
  z-index: 99999;
  opacity:0;
  -webkit-transition: opacity 400ms ease-in;
  -moz-transition: opacity 400ms ease-in;
  transition: opacity 400ms ease-in;
  pointer-events: none;
}
            
            
.modal:target {
  opacity: 1;
  pointer-events: auto;
}
            .modal > div {
  width: 400px;
  position: relative;
  margin: 10% auto;
  padding: 15px 20px;
  background: #fff;
}
            
            .fechar {
  position: absolute;
  width: 30px;
  right: -15px;
  top: -20px;
  text-align: center;
  line-height: 30px;
  margin-top: 5px;
  background: #ff4545;
  border-radius: 50%;
  font-size: 16px;
  color: #8d0000;
}
        </style>
    </head>
    <body>
        <div id="abrirModal" class="modal">
  <?php echo $msg ?>
</div>
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
            <div class="box col-12">    
                <div class="row col-12">
                    <h3><?php echo utf8_encode($resultado_modelo['nome']) ?></h3>
                </div>
                <div class="row col-12">
                    <div class="box col-12 col-lg-6 foto">
                        <a href="<?php echo $resultado_modelo['foto'] ?>" target="_blank">
                            <img src="<?php echo $resultado_modelo['foto'] ?>">
                        </a>
                    </div>
                    <div class="box col-12 col-lg-5 mostragem form-group">
                        <form action="../_ctrl/atualizando.php" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <label for="referencia">Ref.:</label>
                                    <input class="form-control" id="referencia" type="text" name="referencia" value="<?php echo $resultado_modelo['referencia'] ?>" >
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="modelo">Modelo</label>
                                    <input class="form-control" id="modelo" type="text" name="modelo" value="<?php echo $resultado_modelo['nome'] ?>" >
                                </div>
                                <div class="col-12 col-lg-3">
                                    <label for="tamanho">Tamanho:</label>
                                    <select name="tamanho" id="tamanho" class="form-control">
                                        <option value="<?php echo $tamanho_id ?>" selected><?php echo $nome_tamanho ?></option>
                                        <?php
                                            $selecionar_tamanho = "SELECT * ";
                                            $selecionar_tamanho .= "FROM tamanhos ";
                                            $selecionando_tamanho = mysqli_query($conecta,$selecionar_tamanho);
                                            while($lista_tamanhos = mysqli_fetch_assoc($selecionando_tamanho)){
                                        ?>
                                        <option value="<?php echo $lista_tamanhos['tamanho_id'] ?>"><?php echo $lista_tamanhos['tamanho'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <label for="cor">Cor:</label>
                                    <select name="cor" id="cor" class="form-control">
                                        <option value="<?php echo $cor_id ?>" selected><?php echo $nome_cor ?></option>
                                        <?php
                                            $selecionar_cor = "SELECT * ";
                                            $selecionar_cor .= "FROM cores ";
                                            $selecionando_cor = mysqli_query($conecta,$selecionar_cor);
                                                while($lista_cores = mysqli_fetch_assoc($selecionando_cor)){
                                        ?>
                                        <option value="<?php echo $lista_cores['cor_id'] ?>"><?php echo utf8_encode($lista_cores['cor']) ?></option>
                                        <?php
                                                }
                                                ?>
                                    </select>
                                    
                                </div>
                                <div class="col-12 col-lg-4">
                                    <label for="tecido">Tecido:</label>
                                    <select name="tecido" id="tecido" class="form-control">
                                        <option value="<?php echo $tecido_id ?>" selected><?php echo $nome_tecido ?></option>
                                        <?php
                                            $selecionar_tecido = "SELECT * ";
                                            $selecionar_tecido .= "FROM tecidos ";
                                            $selecionando_tecido = mysqli_query($conecta,$selecionar_tecido);
                                                while($lista_tecidos = mysqli_fetch_assoc($selecionando_tecido)){
                                        ?>
                                        <option value="<?php echo $lista_tecidos['tecido_id'] ?>"><?php echo utf8_encode($lista_tecidos['tecido']) ?></option>
                                        <?php
                                                }
                                                ?>
                                    </select>
                                    
                                </div>
                                <div class="col-12">
                                    <label for="preco">Valor Unitário: <small><?php echo 'R$ ' . number_format($resultado_modelo['preco'], 2, ',', '.'); ?></small><br><small>Ao alterar o valor, coloque ponto(".") no lugar da vírgula(",").</small></label>
                                    <input class="form-control" id="preco" type="text" name="preco" value="<?php echo $resultado_modelo['preco'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <input type="hidden" name="modelo_id" id="modelo_id" value="<?php echo $resultado_modelo['modelo_id'] ?>">
                                    <input type="hidden" name="cod" id="cod" value="<?php echo $resultado_modelo['codigo'] ?>">
                                </div>
                                <div class="col-12 col-lg-5">
                                    <a href="#abrirModal">
                                        <input type="submit" name="atualizar" id="atualizar" value="Salvar Alterações" class="btn btn-block">
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                                <div class="col-12 col-lg-3">
                                    <a href="lista-modelos.php" class="btn btn-block">Voltar</a>
                                </div>
                                <div class="col-12 col-lg-3">
                                    
                                </div>
                                <div class="col-12 col-lg-6">
                                    <a href="upload.php" class="btn btn-block">Adicionar/Trocar Foto</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        
        
    </body>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>