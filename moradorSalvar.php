<?php			
		require('moradorBiblioteca.php');

		$idMorador = $_POST["idMorador"];
		$nome = $_POST["nome"];
		$CPF = $_POST["CPF"];
		$contato = $_POST["contato"];
		$dataNascimento = $_POST["dataNascimento"];
		$celular = $_POST["celular"];
		$email = $_POST["email"];
		$senha = geraSenha();
		$foto = $_POST["foto"];
		$arquivo = $_FILES["arquivo"];

		if(!empty( $arquivo["name"])){
			$foto =  armazenarFotoMorador($arquivo);
		}

		
		
    		if(salvarMorador($idMorador, $nome, $CPF, $email, $foto, $senha, $contato, $dataNascimento, $celular)){
    			echo "<script>alert('Registro salvo com sucesso!');</script>"; 
    		}else{
    			echo "<script>alert('Erro ao salvar o registro.');</script>"; 
    		} 
		echo "<script>location.href='moradorTabela.php';</script>"; 
	?>	

	
	
	
	