<?php	

    function criarConexao(){

        $conexao = null;
        try{	
            $conexao = new PDO('mysql:host=localhost; dbname=ProjetoWeb', 'root', '');
            $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch (PDOException $erro){
            criarArquivo($erro);
            die();
        }	        
        return $conexao;
    }
	
    function fecharConexao($conexao){
        $conexao = null;
    }

    function criarArquivo($erro){
        echo "<script>alert('Foi gerada uma exceção.');</script>"; 
        date_default_timezone_set('America/Sao_Paulo');
        $dataErro = date('d/m/Y H:i:s');
        $arquivo = fopen('arquivoErro.txt','a+');
        $texto = "Data: {$dataErro} \n";
        $texto = $texto . "\t Arquivo: {$erro->getFile()} - Linha: {$erro->getLine()} \n"; 
        $texto = $texto . "\t Erro: {$erro->getMessage()} \n";
        fwrite($arquivo, $texto);
        fclose($arquivo);
    }    
?>	