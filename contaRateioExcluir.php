

	<?php			
		require('contaRateioBiblioteca.php');

		$idRateio = $_GET["idRateio"];
		$idConta = $_GET['idConta'];

		if(excluirRateio($idRateio)){
			echo "<script>alert('Registro excluido com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao excluir o registro.');</script>"; 
		}

		echo "<script>location.href='contaFormulario.php?acao=editar&idConta={$idConta}';</script>"; 
	?>	

	
	
	
	