<?php
echo "Sucesso";

/*
include_once 'conexao.php';

$titulos = $_POST["titulo"];

$cont_insert = false;

foreach ($titulos as $titulo) {
    $result_aula = "INSERT INTO aulas (titulo) VALUES (:titulo)";

    $insert_aula = $conn->prepare($result_aula);
    $insert_aula->bindParam(':titulo', $titulo);
    if ($insert_aula->execute()) {
        $cont_insert = true;
    } else {
        $cont_insert = false;
    }
}
if ($cont_insert) {
    echo "<p style='color:green;'>Cadastrado com Sucesso</p>";
} else {
    echo "<p style='color:red;'>Erro ao cadastrar</p>";
}