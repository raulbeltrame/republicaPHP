<?php
    session_start();
		require('tipoContaBiblioteca.php');

		$idTipo = 0;
		$nome = "";

		if(isset($_GET["idTipo"])){
			$registro = buscarTipoConta($_GET["idTipo"]);
			$idTipo = $registro['idTipo'];
			$nome = $registro['nome'];
		}

	?>

		<html>
			<head>
				<meta charset="utf-8"/>
				<title> Cadastro de Tipo de Conta </title>
				<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
				<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
			</head>
			<body>

			<?php	
			$pagina = "tipoConta";				
			require_once('menu.php'); 
			?>
				<div class="container">				
					<h5 id="titulo"> Tipo de Conta </h5>
					<form id="formulario" action="tipoContaSalvar.php" method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<input class="form-control" id="idTipo" name="idTipo" 
								       value="<?php echo $idTipo?>" type="hidden">
							</div>					
							<div class="col-md-12">
								<label for="nome">Nome do tipo</label>  
								<input class="form-control" id="nome" name="nome" value="<?php echo $nome?>" 
								       type="text" placeholder="Informe o nome do tipo">
							</div>						
						</div>							
						<div class="row form-group">
							<div class="col-md-12">
								<a class="btn btn-info" href="tipoContaTabela.php">Voltar</a>
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
				<script type="text/javascript" src="js/tipoContaFormulario.js"></script>				
			</body>
		</html>

		
		
		