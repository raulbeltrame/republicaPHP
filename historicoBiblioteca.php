<?php

    require_once('bancoDadosBiblioteca.php');

    function salvarHistorico($idMorador, $estado, $idConta){
        try{
            $data = date('Y-m-d H:i:s');
            $conexao = criarConexao();   
            $sql = "INSERT INTO tbHistorico(data, estado, idConta, idMorador) VALUES (:data, :estado, :idConta, :idMorador);";
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':data', $data); 
            $resultado->bindValue(':estado', $estado); 
            $resultado->bindValue(':idConta', $idConta); 
            $resultado->bindValue(':idMorador', $idMorador); 
            $resultado->execute(); 
            fecharConexao($conexao);     
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        
    }

    function buscarHistoricoPorID($idConta){
        try{          
            $sql = "SELECT * FROM tbHistorico WHERE idConta = :idConta;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idConta', $idConta); 		
            $resultado->execute(); 
            $registro = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;  	  
    }

    function excluirHistoricos($idConta){
        try{
            $sql = "DELETE FROM tbHistorico WHERE idConta = :idConta";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(":idConta", $idConta);
            $resultado->execute();
            fecharConexao($conexao);
        }catch(PDOException $erro){
            criarArquivo($erro);
        }
    }
?>