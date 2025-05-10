<?php
    require ('../_mdl/access.php');
    include ('../_mdl/filtrando-modelos.php');

    //$filtrando->execute();
    //$filtrando->bind_result($id,$codigo,$referencia,$nome,$tamanho,$cor,$foto,$preco,$tecido);
    

    //$resultado->bind_param($id,$codigo,$referencia,$nome,$tamanho,$cor,$foto,$preco,$tecido);
    //$resultado->execute();


    mysqli_stmt_bind_param($filtrar, "sssssssss", $id,$codigo,$referencia,$nome,$tamanho,$cor,$foto,$preco,$tecido);

    mysqli_stmt_execute($filtrar);
?>