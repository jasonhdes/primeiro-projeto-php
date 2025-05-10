<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pesquisar Estoque | Kodok</title>
        <link rel="shortcut icon" href="../_img/favicon.png" type="image/x-png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                <div class="btn col-6 col-lg-2">
                    <a href="#">
                        <p>Adicionar Estoque</p>
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
            <div class="row col-12">
                <form action="pesquisar.php" method="get">
                    <div id="divBusca">
                        <input type="text" id="txtBusca" placeholder="Pesquisar por referência"/>
                        <input type="submit" id="btnBusca" name="pesquisar" value="Pesquisar">
                    </div>
                </form>
            </div>
            <div class="box">
                <div class="row col-12">
                    <h3>Resultados da Pesquisa</h3>
                </div>
                <div class="row box col-12 listagem">
                    <ul class="list-title">
                        <li>Código</li>
                        <li>Ref.</li>
                        <li>Modelo</li>
                        <li>Tam.</li>
                        <li>Cor</li>
                        <li>Qtde.</li>
                        <li>Vl. Unit.</li>
                        <li></li>
                    </ul>
                    <ul>
                        <li>0000000</li>
                        <li>0000</li>
                        <li>Nome Modelo</li>
                        <li>GG</li>
                        <li>Azul Marinho</li>
                        <li>10000</li>
                        <li>R$1.000,00</li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </div>
                <div class="row box col-12 results">
                    <div class="row col-12">
                        <h4><a href="#">Fábrica</a></h4>
                    </div>
                    <div class="row box col-12 listagem">
                    <ul class="list-title">
                        <li>Código</li>
                        <li>Ref.</li>
                        <li>Modelo</li>
                        <li>Tam.</li>
                        <li>Cor</li>
                        <li>Qtde.</li>
                        <li>Vl. Unit.</li>
                        <li></li>
                    </ul>
                    <ul>
                        <li>0000000</li>
                        <li>0000</li>
                        <li>Nome Modelo</li>
                        <li>GG</li>
                        <li>Azul Marinho</li>
                        <li>500</li>
                        <li>R$1.000,00</li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </div>
                </div>
                <div class="row box col-12 results">
                    <div class="row col-12">
                        <h4>Loja 1</h4>
                    </div>
                    <div class="row box col-12 listagem">
                    <ul class="list-title">
                        <li>Código</li>
                        <li>Ref.</li>
                        <li>Modelo</li>
                        <li>Tam.</li>
                        <li>Cor</li>
                        <li>Qtde.</li>
                        <li>Vl. Unit.</li>
                        <li></li>
                    </ul>
                    <ul>
                        <li>0000000</li>
                        <li>0000</li>
                        <li>Nome Modelo</li>
                        <li>GG</li>
                        <li>Azul Marinho</li>
                        <li>500</li>
                        <li>R$1.000,00</li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>