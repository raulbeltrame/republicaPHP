<?php
	require_once('moradorBiblioteca.php');	

	$email = $_POST["email"];
	$CPF = $_POST["CPF"];	
	
	$registro = verificarUsuario($email, $CPF);

	if($registro != NULL){		
		$novaSenha = geraSenha();

		$emailDestinatario = $email;
		$assunto = "Recuperação de senha";
		$mensagem = "Sua nova senha é: {$novaSenha}"; 
		$headers = "From: mateusrezendexd@gmail.com"; 
		
		$envio = mail($emailDestinatario, $assunto, $mensagem, $headers); 

		if($envio){
			$idMorador = $registro['idMorador'];
			atualizarSenha($idMorador, $novaSenha);

			echo "<script>alert('E-mail com sua senha foi enviado.'); location.href='login.php';</script>"; 

		}else{
			echo "<script>alert('Erro ao enviar e-mail.');</script>";
		}
		
	}else{
		echo "<script>alert('E-mail ou CPF inválido!'); location.href='loginEsqueceuSenha.php';</script>"; 		
	}		
?>