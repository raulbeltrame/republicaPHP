<?php

    require_once('bancoDadosBiblioteca.php');
    require('historicoBiblioteca.php');

    function salvarConta($idConta, $descricao, $idTipo, $idMoradorResponsavel, $valor, $observacao, $dataVencimento, $estado){
        $isSave = false;
        try{	
            $valor = arrumarValor($valor);
            $situacao = FALSE;    
            $conexao = criarConexao();
            if($idConta == 0){
                $sql = "INSERT INTO tbConta(descricao, dataVencimento, valor, observacao, idTipo, idMoradorResponsavel, estado) VALUES(:descricao, :dataVencimento, :valor, :observacao, :idTipo, :idMoradorResponsavel, :estado);";
                $resultado = $conexao->prepare($sql);
                $resultado->bindValue(':descricao', $descricao); 
                $resultado->bindValue(':dataVencimento', $dataVencimento); 
                $resultado->bindValue(':valor', $valor); 
                $resultado->bindValue(':observacao', $observacao); 
                $resultado->bindValue(':idTipo', $idTipo); 
                $resultado->bindValue(':idMoradorResponsavel', $idMoradorResponsavel); 
                $resultado->bindValue(':estado', $estado); 
                $isSave = true;
            }else{
                $sql = "UPDATE tbConta SET descricao = :descricao, valor = :valor, observacao = :observacao, dataVencimento = :dataVencimento, idTipo = :idTipo, idMoradorResponsavel = :idMoradorResponsavel, estado = :estado WHERE idConta = :idConta;";
                $resultado = $conexao->prepare($sql);
                $resultado->bindValue(':descricao', $descricao); 
                $resultado->bindValue(':valor', $valor); 
                $resultado->bindValue(':observacao', $observacao); 
                $resultado->bindValue(':dataVencimento', $dataVencimento); 
                $resultado->bindValue(':idTipo', $idTipo); 
                $resultado->bindValue(':idMoradorResponsavel', $idMoradorResponsavel); 
                $resultado->bindValue(':estado', $estado); 
                $resultado->bindValue(':idConta', $idConta); 
                $historicos = buscarHistoricoPorID($idConta);
                $contaAntiga = buscarConta($idConta);
                $estadoAntigo = $contaAntiga['estado'];
            }
            $resultado->execute(); 
            fecharConexao($conexao);
            $situacao = TRUE;
            if(isset($historicos)){
                if(sizeof($historicos) == 0){
                    $isSave = true;
                }
            }

            if($isSave){
                $aux = getLastId();
                $ultimoCadastro = $aux['idConta'];
        
                if($estado == 0){
                    salvarHistorico($idMoradorResponsavel, 0, $ultimoCadastro);
                }else{
                    salvarHistorico($idMoradorResponsavel, 1, $ultimoCadastro);
                }
            }else{
                $aux = buscarConta($idConta);
                $ultimoCadastro = $aux['idConta'];
                if($estado != $estadoAntigo){
                    if($estado == 1){
                        salvarHistorico($idMoradorResponsavel, 1, $ultimoCadastro);
                    }else{
                        salvarHistorico($idMoradorResponsavel, 2, $ultimoCadastro);
                    }
                }
            }    
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        
        return $situacao;
    }


    function listarConta(){
        try{	        
            $sql = "SELECT * FROM tbConta;";
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

    function excluirConta($idConta){
        try{	
            $situacao = FALSE;  
            $sql = "DELETE FROM tbConta WHERE idConta = :idConta;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idConta', $idConta); 		
            $resultado->execute(); 
            fecharConexao($conexao);
            if($resultado->rowCount() > 0){
                $situacao = TRUE;
            } 	
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        	
        return $situacao;
    }
    function buscarConta($idConta){
        try{          
            $sql = "SELECT * FROM tbConta WHERE idConta = :idConta;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idConta', $idConta); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;        
    } 
    function getLastId(){
        $sql = "SELECT * FROM tbconta WHERE idConta = (SELECT MAX(idConta) FROM tbconta);";
        $conexao = criarConexao();
        $resultado = $conexao->prepare($sql);
        $resultado->execute();
        fecharConexao($conexao);
        $conta = $resultado->fetch();
        return $conta;
    }

    function excluirContaByTipo($idTipo){
        try{	 
            $sql = "DELETE FROM tbConta WHERE idTipo = :idTipo;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idTipo', $idTipo); 		
            $resultado->execute(); 
            echo '<pre>'; print_r($sql); echo '</pre>';
            echo '<pre>'; print_r($idTipo); echo '</pre>'; exit;
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        	
    }

    function excluirContaByMorador($idMorador){
        try{	 
            $sql = "DELETE FROM tbConta WHERE idMoradorResponsavel = :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	        	
    }

    

    function buscarContaByTipo($idTipo){
        try{          
            $sql = "SELECT * FROM tbConta WHERE idTipo = :idTipo;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idTipo', $idTipo); 		
            $resultado->execute(); 
            $registro = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro; 
    }

    function buscarContaByMorador($idMorador){
        try{          
            $sql = "SELECT * FROM tbConta WHERE idMoradorResponsavel = :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            $registro = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro; 
    }
    
    function arrumarValor($valor){
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    function listarContaPorData($valor1, $valor2){
        try{	        
            $sql = "SELECT * FROM tbConta WHERE dataVencimento BETWEEN :dataInicial AND :dataFinal;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':dataInicial', $valor1);	
            $resultado->bindValue(':dataFinal', $valor2);			
            $resultado->execute();         
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registros;
    } 

    function listarContaPorDataPorTipo($idTipo, $valor1, $valor2){
        try{	        
            $sql = "SELECT * FROM tbConta WHERE idTipo = :idTipo AND dataVencimento BETWEEN :dataInicial AND :dataFinal;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idTipo', $idTipo);	
            $resultado->bindValue(':dataInicial', $valor1);	
            $resultado->bindValue(':dataFinal', $valor2);			
            $resultado->execute();         
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registros;
    }
	
	
?>