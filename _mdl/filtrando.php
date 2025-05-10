<?php
    //$filtrando = mysqli->prepare('SELECT * FROM modelos ');

    $filtrando = "SELECT * ";
    $filtrando .= "FROM modelos ";
    $filtrando .= "ORDER BY codigo ASC ";
    $lista_filtro_model = mysqli_query($conecta, $filtrando); 

?>