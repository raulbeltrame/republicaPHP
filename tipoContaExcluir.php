

	<?php			
		require('tipoContaBiblioteca.php');
		require('contaBiblioteca.php');

		$idTipo = $_GET["idTipo"];

		$confirmation = "<script>
							if(confirm('Existem contas relacionadas a esse tipo de conta. Deseja excluí-las?')){
								location.href='./excluirCascata.php?idTipo={$idTipo}';
							}else{
								location.href='./tipoContaTabela.php';
							}
						</script>";

		$contasVinculadas = buscarContaByTipo($idTipo);

		if(sizeof($contasVinculadas)>0){
			echo $confirmation;
			exit;
		}

		if(excluirTipoConta($idTipo)){
			echo "<script>alert('Registro excluído com sucesso!');</script>"; 
		}else{
			echo "<script>alert('Erro ao excluir o registro');</script>"; 
		}

		echo "<script>location.href='tipoContaTabela.php';</script>"; 
	?>	

	
	
	
	