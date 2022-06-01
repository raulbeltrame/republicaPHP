<?php	
    session_start();
		require('moradorBiblioteca.php');
		require('contaBiblioteca.php');
		

		$idMorador = $_GET["idMorador"];
		
		if($idMorador == 1){
		    echo "<script>alert('Não pode excluir a conta administrador.');location.href='moradorTabela.php';</script>";
		    exit;
		}

		$confirmation = "<script>
							if(confirm('Existem contas relacionadas a esse morador. Deseja excluí-las?')){
								location.href='./excluirCascata.php?idMorador={$idMorador}';
							}else{
								location.href='./moradorTabela.php';
							}
						</script>";

		$contasVinculadas = buscarContaByMorador($idMorador);

		if(sizeof($contasVinculadas)>0){
			echo $confirmation;
			exit;
		}

		if(excluirMorador($idMorador)){
			echo "<script>alert('Registro excluído com sucesso!');</script>"; 
			if($idMorador = $_SESSION['USUARIO']['idMorador']){
			    echo "<script>alert('Um morador foi apagado por você, para verificar que não foi está conta, relogue!'); location.href='loginEncerrar.php';</script>";
			}
		}else{
			echo "<script>alert('Erro ao excluir o registro');</script>"; 
		}

		echo "<script>location.href='moradorTabela.php';</script>"; 
	?>	

	
	
	
	