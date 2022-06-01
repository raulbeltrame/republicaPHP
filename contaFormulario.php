<?php
	    session_start();
        require('moradorBiblioteca.php');
		require('tipoContaBiblioteca.php');
		require('contaRateioBiblioteca.php');
		require('contaBiblioteca.php');
        $moradores = listarMorador();
		$tipos = listarTipoConta();
		$estadoContas = [];


		$idConta = 0;
        $descricao = "";
        $valor = "";
		$dataVencimento= "";
		$observacao= "";
        $idMorador = 0;
		$idTipo = 0;
		
		if(isset($_GET["acao"])){
			$acao = $_GET["acao"];
		}else{
			echo "<script>location.href='contaTabela.php';</script>"; 
		}

		if(isset($_GET["idConta"])){
			$registro = buscarConta($_GET["idConta"]);
			$idConta = $registro['idConta'];
            $descricao = $registro['descricao'];
            $valor = $registro['valor'];
			$dataVencimento = $registro['dataVencimento'];
			$observacao = $registro['observacao'];
            $idMorador = $registro['idMoradorResponsavel'];
			$idTipo = $registro['idTipo'];
			$estado = $registro['estado'];
			$estadoContas =  listarRateioPorConta($idConta);
		}

	?>

		<html>
			<head>
				<meta charset="utf-8"/>
				<title> Formulário </title>
				<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
				<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
			</head>
			<body>


			
			<?php	
				$pagina = "conta";				
				require_once('menu.php'); 
			?>

			
				<div class="container">				
					<h5 id="titulo"> Contas </h5>
					
					<a class="btn btn-info" href="contaTabela.php">Voltar</a>
					<?php	
						if($acao != "cadastrar"){
							echo "<a class='btn btn-primary  float-right' href='saldoConta.php?idConta={$idConta}'>Saldo</a>";
						}
					?>	

					<form id="formularioConta" action="contaSalvar.php" method="post">

						<?php 
							if($acao == "visualizar"){
								echo "<fieldset disabled='disabled'>";
							}else{
								echo "<fieldset>";
							}
						?>	
						<div class="row form-group">
							<div class="col-md-12">
								<input class="form-control" id="idConta" name="idConta" 
								       value="<?php echo $idConta?>" type="hidden">
							</div>					
							<div class="col-md-4">
								<label for="descricao">Descrição</label>  
								<input class="form-control" id="descricao" name="descricao" value="<?php echo $descricao?>" 
								       type="text" placeholder="Informe a descrição da conta">
							</div>	
							<div class="col-md-4">
								<label for="estado">Estado</label>  
								<select class="form-control" name="estado" id="estado">	
								<?php
									if(isset($estado)){
										if($estado == 0){
											echo '<option value="0" selected>Aberta</option>
													<option value="1">Fechada</option> ';
										}else{
											echo '<option value="0">Aberta</option>
													<option value="1" selected>Fechada</option> ';
										}
									}else{
										echo '<option value="0" selected>Aberta</option>
												<option value="1">Fechada</option> ';
									}
								?>
									                   
								</select>								
							</div>
							<div class="col-md-4">
								<label for="idMorador">Morador</label>  
								<select class="form-control" name="idMorador" id="idMorador">
									<?php	
										if($idConta == 0){
											echo "<option value='' selected disabled>Morador</option>";
											foreach($moradores as $morador){												
												echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
											}											
										}else{
											foreach($moradores as $morador){	
												if($morador['idMorador'] != $idMorador){
													echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
												}else{
													echo "<option selected value='{$morador['idMorador']}'>{$morador['nome']}</option>";
												}											
											}												
										}
									?>
								</select>								
							</div>													
						</div>
                        <div class="row form-group">
                        <div class="col-md-4">
							<label for="dataVencimento">Data de Vencimento</label>  
							<input class="form-control" id="dataVencimento" name="dataVencimento" value="<?php echo $dataVencimento?>" type="date" type="text" placeholder="Informe a data de nascimento">
						</div>
                        <div class="col-md-4">
							<label for="valor">Valor</label>  
							<input class="form-control" id="valor" name="valor" value="<?php echo $valor?>" type="text"  placeholder="Informe o valor">
						</div>
                        <div class="col-md-4">
								<label for="idTipo">Tipo</label>  
								<select class="form-control" name="idTipo" id="idTipo">
									<?php	
										if($idConta == 0){
											echo "<option value='' selected disabled>Selecione um tipo</option>";
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
							<div class="row form-group">	
							<div class="col-md-12">
								<label for="observacao">Observaçoes</label>
								<textarea class="form-control" id="observacao" name="observacao" type="text" placeholder="Informe as observações" rows="3"><?=$observacao?></textarea>	
							</div>		
    					</div>
						<div class="row form-group">
							<div class="col-md-12">
								<button type="submit" class="btn btn-info float-right mx-1">Cadastrar</button>	
								
							</div>											
						</div>					
						<?php 
						if($acao == "cadastrar"){
							echo "<div hidden>";
						}else{
							echo "<div>";
						}
					?>
					</form>				

						<h5 id="subTitulo"> Rateio </h5>

						<form id="formularioRateio" action="contaRateioSalvar.php" method="post">

							<?php 
								if($acao == "visualizar"){
									echo "<fieldset disabled='disabled'>";
								}else{
									echo "<fieldset>";
								}
							?>

								<div class="row form-group">
									<div class="col-md-12">
											<input class="form-control" id="idConta" name="idConta" 
												value="<?php echo $idConta?>" type="hidden">
									</div>
								</div>

								<div class="row form-group">
									<div class="col-md-4">
										<label for="idMorador">Morador</label>  
										<select class="form-control" name="idMorador" id="idMorador">
											<option value='' selected disabled>Selecione um morador</option>
											<?php	
												foreach($moradores as $morador){	
													echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";	
												}										
											?>
										</select>								
									</div>
									<div class="col-md-3">
										<label for="valorRat">Valor</label>  
										<input class="form-control" id="valorRat" name="valorRat" value="" type="text"  placeholder="Informe o valor">
									</div>
									
									<div class="col-md-4">
										<label for="situacao">Situação</label>  
										<select class="form-control" id="situacao" name="situacao" value="" type="number" placeholder="Informe a situacao">
											<option selected disabled>Selecione uma situação</option>
											<option value="0">Pago</option>
      										<option value="1">Não pago</option>
										</select>
									</div>	
									<div class="col-md-1">
										<button type="submit" class="btn btn-secondary btn-lg my-4">+</button>	
									</div>												

								</div>
							</fieldset>					
						</form>	
						
						<table class="table" id="tabela" name="tabela">
							<thead>
								<tr>
									<th scope="col">Morador</th>
									<th scope="col">Valor</th>
									<th scope="col">Situação</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php	
									foreach($estadoContas as $estadoConta){		
										$estado = buscarRateio($estadoConta['idRateio']);
										$morador = buscarMorador($estado['idMorador']);
										if($estado['situacao']==0){
											$situacao = "Pago";
										}else{
											$situacao = "Não Pago";
										}
										echo "<tr>";
										echo "<td>{$morador['nome']}</td>";
										echo "<td>{$estadoConta['valor']}</td>";
										echo "<td>{$situacao}</td>";
										if($acao == "editar"){
											echo "<td> <a class='btn btn-danger float-right mx-1' 
											href='contaRateioExcluir.php?idRateio={$estado['idRateio']}&idConta={$idConta}'>
											Excluir</a></td>";										
										}else{
											echo "<td> </td>";
										}
										echo "</tr>";
									}	
								?>							
							</tbody>
						</table>	
					<div>			
					
				</div> 	
				<script type="text/javascript" src="js/jquery.js"></script>
				<script type="text/javascript" src="js/bootstrap.js"></script>
				<script type="text/javascript" src="js/jquery.validate.js"></script>		
				<script type="text/javascript" src="js/jquery.mask.js"></script>			
				<script type="text/javascript" src="js/contaFormulario.js"></script>				
			</body>
		</html>

		
		
		