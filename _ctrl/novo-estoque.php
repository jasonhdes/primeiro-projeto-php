<?php
    require('../_mdl/access.php');

    if(isset($_POST['quantidade'])){
        
        $quantidade   = $_POST['quantidade'];
        $codigo       = $_POST['cod'];
        $local_id     = $_POST['local'];
        $query        = "SELECT estoque_id FROM estoque WHERE codigo = '{$codigo}' AND local_id = '{$local_id}' ";
        $result       = mysqli_query($conecta, $query);
        $row          = mysqli_num_rows($result);
        $estoque_info = mysqli_fetch_assoc($result);
        if($row == 1) {
            $estoque = $estoque_info['estoque_id'];
            
            include ('../_mdl/adicionar-estoque.php');
            exit();
        } else {
            include ('../_mdl/novo-estoque.php');
            exit();
        }
    };
?>