

	<?php			
		require('contaBiblioteca.php');

		$idConta = $_POST["idConta"];
		$descricao = $_POST["descricao"];
		$idMoradorResponsavel = $_POST["idMorador"];
		$idTipo = $_POST["idTipo"];
		$valor = $_POST["valor"];
		$observacao = $_POST["observacao"];
		$dataVencimento = $_POST["dataVencimento"];
		$estado = $_POST['estado'];

		if(salvarConta($idConta, $descricao, $idTipo, $idMoradorResponsavel, $valor, $observacao, $dataVencimento, $estado)){
			echo "<script>alert('Registro salvo com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao salvar o registro.');</script>"; 
		}

		echo "<script>location.href='contaTabela.php';</script>"; 
	?>	

	
	
	
	