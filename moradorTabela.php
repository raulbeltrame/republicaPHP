<?php
    session_start();	
	$varDoIndex = "1";
	require('moradorBiblioteca.php');
	$moradores = listarMorador();
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
			$pagina = "conta";				
			require_once('menu.php'); 
		?>
		<div class="container">
			<h5 id="titulo"> Moradores </h5>
			<a class="btn btn-info float-right" href="moradorFormulario.php">Novo</a>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">E-mail</th>
						<th scope="col">Telefone</th>
						<th scope="col">Data de Nascimento</th>
					</tr>
				</thead>
				<tbody>
					<?php	
						foreach($moradores as $morador){
							$data = date_create($morador['dataNascimento']);
							$dataFormatada = date_format($data, 'd/m/Y');
								echo "<tr>";
								echo "<td>{$morador['nome']}</td>";
								echo "<td>{$morador['email']}</td>";
								echo "<td>{$morador['celular']}</td>";
								echo "<td id='dataNascimento'>{$dataFormatada}</td>";	
								echo "<td><a class='btn btn-secondary float-right' 
							             	href='moradorFormulario.php?idMorador={$morador['idMorador']}'>
										 	Editar</a>";							
								echo "<a class='btn btn-info float-right mx-1' 
							             	href='moradorExcluir.php?idMorador={$morador['idMorador']}'>
											Excluir</a></td>";
								echo "</tr>";							

						}	
					?>							
				</tbody>
			</table>		
		</div> 	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>			
	</body>
</html>



