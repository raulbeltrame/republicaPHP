

	<?php			
		require('contaRateioBiblioteca.php');

		$idRateio = 0;
		$idConta = $_POST["idConta"];
		$idMorador = $_POST["idMorador"];
		$valor = $_POST["valorRat"];
		$situacao = $_POST["situacao"];

		if(salvarRateio($idRateio, $valor, $situacao, $idConta, $idMorador)){
			echo "<script>alert('Registro salvo com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao salvar o registro.');</script>"; 
		}

		echo "<script>location.href='contaFormulario.php?acao=editar&idConta={$idConta}';</script>"; 
	?>	

	
	
	
	