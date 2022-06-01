<?php

    require('bancoDadosBiblioteca.php');
    $CPF = $_POST['CPF'];
    $idMorador = $_POST['idMorador'];

    $sql = "SELECT * FROM tbMorador WHERE CPF = :CPF AND idMorador <> :idMorador;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);	
    $resultado->bindValue(':CPF', $CPF); 		
    $resultado->bindValue(':idMorador', $idMorador); 		
    $resultado->execute(); 
    $registro = $resultado->fetch();
    fecharConexao($conexao);

    if(!isset($registro[0])){
        echo "true";
    } else{
        echo "false";
    }  

?>