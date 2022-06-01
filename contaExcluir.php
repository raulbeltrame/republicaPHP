

	<?php			
		require('contaBiblioteca.php');

		$idConta = $_GET["idConta"];
		
		excluirHistoricos($idConta);
		if(excluirConta($idConta)){
			echo "<script>alert('Registro excluído com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao excluir o registro');</script>"; 
		}

		echo "<script>location.href='contaTabela.php';</script>"; 
	?>	

	
	
	
	