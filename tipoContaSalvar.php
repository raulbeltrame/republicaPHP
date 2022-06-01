	<?php			
		require('tipoContaBiblioteca.php');


		$idTipo = $_POST["idTipo"];
		$nome = $_POST["nome"];

		if(salvarTipoConta($idTipo, $nome)){
			echo "<script>alert('Registro salvo com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao salvar o registro.');</script>"; 
		}

		echo "<script>location.href='tipoContaTabela.php';</script>"; 
	?>	

	
	
	
	