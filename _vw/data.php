<?php
    date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['inserir']))  {

    print_r($_GET);
    
}

?>
<form action="data.php" method="get">
<input type="hidden" name="data" value="<?php echo date('dmYHis'); ?>">
    <input type="submit" name="inserir" value="Inserir">
</form>