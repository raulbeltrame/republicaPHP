<?php
        session_start();	
    	$varDoIndex = "1";
		require_once('moradorBiblioteca.php');

		$idMorador = 0;
		$nome = "";
		$CPF = "";
		$contato = "";
		$dataNascimento = "";
		$celular = "";
		$email = "";
		$senha = "";
		$foto = "imagens/padrao.png";

		if(isset($_GET["idMorador"])){
			$registro = buscarMorador($_GET["idMorador"]);
			$idMorador = $registro['idMorador'];
			$nome = $registro['nome'];
			$CPF = $registro['CPF'];
			$contato = $registro['contato'];
			$dataNascimento = $registro['dataNascimento'];
			$celular = $registro['celular'];
			$email = $registro['email'];
			$senha = $registro['senha'];
			$foto = $registro['foto'];
		}
?>



<html>
	<head>
		<meta charset="utf-8"/>
		<title> Cadastro de Morador </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>
		<?php	
			$pagina = "morador";				
			require_once('menu.php'); 
		?>
		<div class="container">			
			<h5 id="titulo"> Morador </h5>
			<form id="formulario" action="moradorSalvar.php" method="post" enctype="multipart/form-data">
				<div class="row form-group">
					<div class="col-md-6">
							<input class="form-control" id="idMorador" name="idMorador" 
									value="<?php echo $idMorador?>" type="hidden">
					</div>	
					<div class="col-md-6">
							<input class="form-control" id="foto" name="foto" 
									value="<?php echo $foto?>" type="hidden">
					</div>							
				</div>		
				<div class="row form-group">			
					<div class="col-md-6">
						<label for="arquivo">Foto</label>  
						<input class="form-control" id="arquivo" name="arquivo" value="" type="file" >
					</div>
					<div class="col-md-6">
						<label for="nome">Nome</label>  
						<input class="form-control" id="nome" name="nome" value="<?php echo $nome?>" type="text" placeholder="Informe o nome">
					</div>													
				</div>

				<div class="row form-group">			
					<div class="col-md-6">
						<label for="email">E-mail</label>  
						<input class="form-control" id="email" name="email" value="<?php echo $email?>" type="email" placeholder="Informe o E-mail">
					</div>
					<div class="col-md-6">
						<label for="senha">Senha</label>  
						<input class="form-control" id="senha" name="senha" value="<?php echo $senha?>" type="password" placeholder="Crie uma senha de 8 dígitos">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-4">
						<label for="CPF">CPF</label>  
						<input class="form-control" id="CPF" name="CPF" value="<?php echo $CPF?>" type="text" placeholder="Informe o CPF">
					</div>
					<div class="col-md-4">
						<label for="dataNascimento">Data de Nascimento</label>  
						<input class="form-control" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento?>" type="date" type="text" placeholder="Informe a data de nascimento">
					</div>
					<div class="col-md-4">
						<label for="">Celular</label>  
						<input class="form-control" id="celular" name="celular" value="<?php echo $celular?>" type="text" placeholder="Informe o celular">
					</div>											
				</div>
				<div class="row form-group">			
					<label for="contato">Contatos</label>
					<textarea class="form-control" id="contato" name="contato" type="text" placeholder="Informe os contatos" rows="3"><?php echo $contato?></textarea>	
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<a class="btn btn-primary" href="moradorTabela.php">Voltar</a>
						<button type="reset"  class="btn btn-secondary float-right">Cancelar</button>	
						<button type="submit" class="btn btn-info float-right mx-1">Cadastrar</button>	
						
					</div>											
				</div>					
			</form>	
		</div> 	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>		
		<script type="text/javascript" src="js/jquery.mask.js"></script>			
		<script type="text/javascript" src="js/moradorFormulario.js"></script>				
	</body>
</html>