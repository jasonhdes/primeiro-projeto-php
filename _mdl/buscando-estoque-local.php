<?php
    $buscando_estoque = "SELECT * ";
    $buscando_estoque .= "FROM estoque ";
    $buscando_estoque .= "WHERE local_id = {$estoque_local} ";
    $buscando_estoque .= "ORDER BY codigo ASC ";
    
    $encontrando_estoque = mysqli_query($conecta,$buscando_estoque);
    //$estoque_encontrado  = mysqli_fetch_assoc($encontrando_estoque);
?>