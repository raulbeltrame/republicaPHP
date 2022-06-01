<?php

    require_once('bancoDadosBiblioteca.php');

    function salvarRateio($idRateio, $valor, $situacao, $idConta, $idMorador){
        try{
        $situacao1 = FALSE; 
        $conexao = criarConexao();   
		if($idRateio == 0){
			$sql = "INSERT INTO tbRateio(valor, situacao, idConta, idMorador) VALUES(:valor, :situacao, :idConta, :idMorador);";
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':valor', $valor); 
            $resultado->bindValue(':situacao', $situacao); 
            $resultado->bindValue(':idConta', $idConta); 
            $resultado->bindValue(':idMorador', $idMorador); 
        }else{
			$sql = "UPDATE tbRateio SET valor = :valor, situacao = :situacao, idConta = :idConta, idMorador = :idMorador WHERE idRateio= :idRateio";
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':valor', $valor); 
            $resultado->bindValue(':situacao', $situacao); 
            $resultado->bindValue(':idConta', $idConta); 
            $resultado->bindValue(':idMorador', $idMorador); 
            $resultado->bindValue(':idRateio', $idRateio); 
        }
        $resultado->execute(); 
            fecharConexao($conexao);
            if($resultado->rowCount() > 0){
                $situacao1 = TRUE;
            }        
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        
        return $situacao1;
    }


    function listarRateio(){
        try{	        
            $sql = "SELECT * FROM tbRateio;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);			
            $resultado->execute();         
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registros;
    }  

    function excluirRateio($idRateio){
		try{	
            $situacao1 = FALSE;  
            $sql = "DELETE FROM tbRateio WHERE idRateio = :idRateio;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idRateio', $idRateio); 		
            $resultado->execute(); 
            fecharConexao($conexao);
            if($resultado->rowCount() > 0){
                $situacao1 = TRUE;
            } 	
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        	
        return $situacao1;
    }

  	function buscarRateio($idRateio){
        try{          
            $sql = "SELECT * FROM tbRateio WHERE idRateio = :idRateio;";        
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idRateio', $idRateio); 				
            $resultado->execute();         
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;
    } 

    function listarRateioPorConta($idConta){
        try{          
            $sql = "SELECT * FROM tbRateio WHERE idConta = :idConta;";      
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
    
    function listarRateioPorMorador($idMorador){
        try{	        
            $sql = "SELECT * FROM tbRateio WHERE idMorador = :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idMorador', $idMorador);		
            $resultado->execute();         
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registros;
    }
	
?>