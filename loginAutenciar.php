 <?php
	session_start();
	require_once('moradorBiblioteca.php');	

	$email = $_POST["email"];
	$senha = MD5($_POST["senha"]);		
	
	$registro = autenticarUsuario($email, $senha);

	if($registro != NULL){
		$_SESSION['USUARIO'] = $registro;
		echo "<script>location.href='contaTabela.php';</script>"; 
	}else{
		echo "<script>alert('E-mail ou senha inválido!'); location.href='moradorTabela.php';</script>"; 			
	}

			
?>