<?php

    require_once('bancoDadosBiblioteca.php');

    function salvarMorador($idMorador, $nome, $CPF, $email, $foto, $senha, $contato, $dataNascimento, $celular){
        try{
            $situacao = FALSE; 
            $conexao = criarConexao();   
		    if($idMorador == 0){
			$sql = "INSERT INTO tbMorador(nome, CPF, email, foto, senha, contato, dataNascimento, celular) VALUES(:nome, :CPF, :email, :foto, :senha, :contato, :dataNascimento, :celular);";
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':nome', $nome); 
            $resultado->bindValue(':CPF', $CPF); 
            $resultado->bindValue(':email', $email); 
            $resultado->bindValue(':foto', $foto); 
            $resultado->bindValue(':senha', MD5($senha)); 
            $resultado->bindValue(':contato', $contato); 
            $resultado->bindValue(':dataNascimento', $dataNascimento); 
            $resultado->bindValue(':celular', $celular);
            }else{
			    $sql = "UPDATE tbMorador SET nome = :nome, CPF = :CPF, email = :email, foto = :foto, senha = :senha, contato = :contato, dataNascimento = :dataNascimento, celular = :celular WHERE idMorador = :idMorador";
                $resultado = $conexao->prepare($sql);
                $resultado->bindValue(':nome', $nome); 
                $resultado->bindValue(':CPF', $CPF); 
                $resultado->bindValue(':email', $email); 
                $resultado->bindValue(':foto', $foto); 
                $resultado->bindValue(':senha', $senha); 
                $resultado->bindValue(':contato', $contato); 
                $resultado->bindValue(':dataNascimento', $dataNascimento); 
                $resultado->bindValue(':celular', $celular);
                $resultado->bindValue(':idMorador', $idMorador);

            }
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

    function buscarMorador($idMorador){
        try{ 
            $sql = "SELECT * FROM tbMorador WHERE idMorador = :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;  
    } 

    function listarMorador(){
        try{	        
            $sql = "SELECT * FROM tbMorador;";
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

    function excluirMorador($idMorador){
		try{	
            $situacao = FALSE;  
            $sql = "DELETE FROM tbMorador WHERE idMorador = {$idMorador};";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':idMorador', $idMorador); 		
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

    function autenticarUsuario($email, $senha){
        try{          
            $sql = "SELECT * FROM tbMorador WHERE email = :email AND senha = :senha;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':email', $email); 		
            $resultado->bindValue(':senha', $senha); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;
    }

    function armazenarFotoMorador($arquivo){
        $nomeArquivo = $arquivo["name"];
        $extensaoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        $novoNome = md5(uniqid($nomeArquivo)) .".". $extensaoArquivo;
        $caminhoArquivo = "imagens/" . $novoNome ;
        move_uploaded_file($arquivo["tmp_name"], $caminhoArquivo );
        return $caminhoArquivo;
    }    
    
   
    
    function verificarUsuario($email, $CPF){
        try{          
            $sql = "SELECT * FROM tbMorador WHERE email = :email AND CPF = :CPF;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':email', $email); 		
            $resultado->bindValue(':CPF', $CPF); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;
    }   
    
    function geraSenha()
    {
        $tamanho = 8;
        $maiusculas = true; 
        $numeros = true; 
        $simbolos = true;


        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        

        $retorno = '';
        $caracteres = '';
        

        $caracteres .= $lmin;
        if ($maiusculas){
            $caracteres .= $lmai;
        } 
        if ($numeros){
            $caracteres .= $num;
        } 
        if ($simbolos){
            $caracteres .= $simb;
        }
        

        $len = strlen($caracteres);
        
        for ($n = 1; $n <= $tamanho; $n++) {

            $rand = mt_rand(1, $len);

            $retorno .= $caracteres[$rand-1];
        }
        
        return $retorno;
    }    

    function atualizarSenha($idMorador, $senha){
        try{          
            $sql = "UPDATE tbMorador SET senha = :senha WHERE idMorador = :idMorador";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':senha', $senha); 		
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;  
    }
    
    function verificarCPF($CPF, $idMorador){
        try{          
            $sql = "SELECT * FROM tbMorador WHERE CPF = :CPF AND idMorador <> :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':CPF', $CPF); 		
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;        
    } 

    
    function verificarEmail($email, $idMorador){
        try{          
            $sql = "SELECT * FROM tbMorador WHERE email = :email AND idMorador <> :idMorador;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);	
            $resultado->bindValue(':email', $email); 		
            $resultado->bindValue(':idMorador', $idMorador); 		
            $resultado->execute(); 
            $registro = $resultado->fetch();
            fecharConexao($conexao);
        }catch (PDOException $erro){
            criarArquivo($erro);
        }	         
        return $registro;        
    }
	
?>