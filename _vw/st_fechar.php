<?php
    $cod_trnsp = $_POST['cod_transp'];
    $qtde_fechada = $_POST['quantidade_total'];
    $valr_fechada = $_POST['valor_total'];
    $data = date('d/m/Y H:i:s');
    $saida = 1;

    $fechar_saida = "UPDATE transportes ";
    $fechar_saida .= "SET ";
    $fechar_saida .= "quantidade_total = {$qtde_fechada}, ";
    $fechar_saida .= "vl_total = {$valr_fechada}, ";
    $fechar_saida .= "entrada_saida = {$saida}, ";
    $fechar_saida .= "data_transporte = '{$data}' ";
    $fechar_saida .= "WHERE codigo_transporte = {$cod_trnsp} ";
    $fechando_saida = mysqli_query($conecta,$fechar_saida);
    if(!$fechando_saida){
?>
<div class="info" id="erro">Erro ao fechar saída. Confira as informações e tente novamente.</div>
<?php
        exit();
    } else {
        header('Location: romaneio.php');
        exit();
    }
?>