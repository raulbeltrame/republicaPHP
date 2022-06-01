<?php
    session_start();
	require('tipoContaBiblioteca.php');
	$tipos = listarTipoConta();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Tipo De Conta </title> 
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>		
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>
		<?php	
			$pagina = "conta";				
			require_once('menu.php'); 
		?>
		<div class="container">
			<h5 id="titulo"> Tipos de Conta </h5>
			<a class="btn btn-info float-right my-1" href="tipoContaFormulario.php">Novo</a>
			<table class="table" id="tabela">
				<thead>
					<tr>
						<th scope="col">Tipo de Conta</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php	
						foreach($tipos as $tipo){
							
							echo "<tr>";
							echo "<td>{$tipo['nome']}</td>";
							echo "<td><a class='btn btn-info float-right' 
							             href='tipoContaFormulario.php?idTipo={$tipo['idTipo']}'>
										 Editar</a>";							
							echo "<a class='btn btn-secondary float-right mx-1' 
							             href='tipoContaExcluir.php?idTipo={$tipo['idTipo']}'>
										 Excluir</a></td>";
							echo "</tr>";
							
						}	
					?>							
				</tbody>
			</table>		
		</div> 	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>			
		<script type="text/javascript" src="js/datatables.js"></script>	
		<script type="text/javascript" src="js/tipoContaTabela.js"></script>	
	</body>
</html>



