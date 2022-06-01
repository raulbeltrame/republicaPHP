<?php		
    session_start();
	require('tipoContaBiblioteca.php');
	require('moradorBiblioteca.php');
	require('contaBiblioteca.php');
	$contas = listarConta();
	$tipos = listarTipoConta();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Cadastro de conta </title> 
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>		
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>


		<!-- Modal -->
		<div class="modal fade" id="modalHist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Histórico</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table" id="tabelaModal" name="tabelaModal">
							<thead class="thead-dark">
								<tr>
									<th>Ação</th> <th>Data</th>	<th>Modificador</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalExtrato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Gerar extrato</h2>
					</div>
					<div class="modal-body">
						<form id="formulario" action="extratoConta.php" method="post">
							<div class="row">
								<div id="extrato" class="col-md-12">
									
								</div>
							</div>
							<div class="row form-group">	
									<div class="col-md-6">
										<label for="idTipo">Tipo</label>  
										<select class="form-control" name="idTipo" id="idTipo">
											<?php	
												if($idTipo == 0){
													echo "<option value='' selected disabled>Selecione um Tipo</option>";
													foreach($tipos as $tipo){												
														echo "<option value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
													}											
												}else{
													foreach($tipos as $tipo){	
														if($tipo['idTipo'] != $idTipo){
															echo "<option value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
														}else{
															echo "<option selected value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
														}											
													}												
												}
											?>
										</select>								
									</div>	
								</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label for="dataInicial">Data inicial</label>  
									<input class="form-control" id="dataInicial" name="dataInicial" type="date">
								</div>
								<div class="col-md-6">
									<label for="dataFinal">Data final</label>  
									<input class="form-control" id="dataFinal" name="dataFinal" type="date">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12">
									<button type="submit" class="btn btn-info float-right mx-1">Gerar PDF</button>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>

		<?php	
			$pagina = "conta";		 		
			require_once('menu.php'); 
		?>
		<div class="container">
			<h5 id="titulo"> Contas </h5>
			<a class="btn btn-secondary float-right my-1" href="contaFormulario.php?acao=cadastrar">Novo</a>
			<a class="btn btn-secondary float-right my-1 mr-1" data-toggle='modal' data-target='#modalExtrato' style="color: white;">Extrato</a>
			<table class="table" id="tabela" name="tabela">
				<thead>
					<tr>
						<th scope="col">Morador resp.</th>
						<th scope="col">Valor</th>
						<th scope="col">Data de Vencimento</th>						
					</tr>
				</thead>
				<tbody>
					<?php	
						foreach($contas as $conta){

							$data = date_create($conta['dataVencimento']);
							$dataFormatada = date_format($data, 'd/m/Y');
							$tipoConta = buscarTipoConta($conta['idTipo']);
							$morador = buscarMorador($conta['idMoradorResponsavel']);
							
							echo "<tr>";
							echo "<td>{$morador['nome']}</td>";
							echo "<td>{$conta['valor']}</td>";
							echo "<td id='dataVencimento'>{$dataFormatada}</td>";					 
							echo "<td><a class='btn btn-info' 
							             href='contaFormulario.php?acao=visualizar&idConta={$conta['idConta']}'>
										 +</a>";
							echo "<button class='btn btn-secondary mx-1' data-toggle='modal'
										data-target='#modalHist' data-codigo='{$conta['idConta']}' data-descricao='{$conta['descricao']}'> Hist.</button>";
							echo "<a class='btn btn-info mx-1' 
							             href='contaDuplicar.php?idConta={$conta['idConta']}'>
										 Duplicar</a>";	
							echo "<a class='btn btn-info' 
							             href='contaFormulario.php?acao=editar&idConta={$conta['idConta']}'>
										 Editar</a>";							
							echo "<a class='btn btn-secondary mx-1' 
							             href='contaExcluir.php?idConta={$conta['idConta']}'>
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
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/contaTabela.js"></script>					
	</body>
</html>



