<?php
    include_once('access.php');
    include_once('consultas.php');
    session_start();

    $vendas = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    $result_model = "SELECT * FROM vendas WHERE codigo_venda LIKE '%$vendas%' LIMIT 10 ";
    $resultado_model = mysqli_query($conecta, $result_model);

    if(($resultado_model) AND ($resultado_model->num_rows != 0 )){
        while($row_model = mysqli_fetch_assoc($resultado_model)){
            
            $tamanho_id = $row_model['tamanho_id'];
            $cor_id = $row_model['cor_id'];
            $tecido_id = $row_model['tecido_id'];
            
            $list_tamanho = mysqli_fetch_assoc($lista_tamanho);
            if($tamanho_id = $list_tamanho['tamanho_id']){
                $tamanho_nome = $list_tamanho['tamanho'];
            }

            $list_cor = mysqli_fetch_assoc($lista_cor);
            if($cor_id = $list_cor['cor_id']){
                $cor_nome = utf8_encode($list_cor['cor']);
            }
            
            $list_tecido = mysqli_fetch_assoc($lista_tecido);
            if($tecido_id_id = $list_tecido['tecido_id']){
                $tecido_nome = utf8_encode($list_tecido['tecido']);
            }
            
            $pagamento_id = $row_model['pagamento_id'];
            
            $listar_pagamento = "SELECT * ";
            $listar_pagamento .= "FROM pagamentos ";
            $listando_pagamento = mysqli_query($conecta,$listar_pagamento);
            $lista_pagamento = mysqli_fetch_assoc($listando_pagamento);
            if($pagamento_id = $lista_pagamento['pagamento_id']){
                $pagamento_nome = utf8_encode($lista_pagamento['pagamento']);
            }
            
            $entrega_id = $row_model['entrega_id'];
            
            $listar_entrega = "SELECT * ";
            $listar_entrega .= "FROM entregas ";
            $listando_entrega = mysqli_query($conecta,$listar_entrega);
            $lista_entrega = mysqli_fetch_assoc($listando_entrega);
            if($entrega_id = $lista_entrega['entrega_id']){
                $entrega_nome = utf8_encode($lista_entrega['entrega']);
            }
            
            $busca_funcionario = "SELECT * ";
            $busca_funcionario .= "FROM funcionarios ";
            $busca_funcionario .= "WHERE registro = {$row_model['registro']} ";
            $buscar_funcionario = mysqli_query($conecta,$busca_funcionario);
            $resultado_funcionario = mysqli_fetch_assoc($buscar_funcionario);

            echo "<ul>";
            echo "<li>".$row_model['codigo_venda']."</li>";
            echo "<li>".$row_model['registro']."</li>";
            echo "<li>".$row_model['local_id']." - ".utf8_encode($resultado_funcionario['nome'])."</li>";
            echo "<li>".$pagamento_nome."</li>";
            echo "<li>".$row_model['cpf']."</li>";
            echo "<li>".$row_model['quantidade']."</li>";
            echo "<li>R$ " . number_format($row_model['total'], 2, ',', '.')."</li>";
            echo "<li>".$row_model['data_venda']."</li>";
            echo "<li>".$entrega_nome."</li>";
            echo "</ul>";

        } 
    } else {
        echo "Nenhum modelo encontrado ...";
    }
?>