<?php
	require_once('loginCheck.php');
	require_once('moradorBiblioteca.php'); 
	$idMoradorMenu = $_SESSION['USUARIO']['idMorador'];
	$resultado = buscarMorador($idMoradorMenu);
	$nomeMorador = $resultado['nome'];
?>

<div class="cabecalhoMenu">
	<nav class="navbar navbar-expand-md navbar-blue bg-secondary">
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">

			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if($pagina=='tipoConta'){echo 'active';}?>">
					<a class="nav-link" href="tipoContaTabela.php">Tipo Conta</a>
				</li>
				<li class="nav-item <?php if($pagina=='morador'){echo 'active';}?>">
					<a class="nav-link" href="moradorTabela.php">Morador</a>
				</li>
				<li class="nav-item <?php if($pagina=='conta'){echo 'active';}?>">
					<a class="nav-link" href="contaTabela.php">Conta</a>
				</li>																		
			</ul>
			
			<div class="sessao text-center">
				<p style="font-size: 1.1rem; margin-top: 1rem; float: left;" class=' text-center'>Expira em (min):</p>
				<p id="tempoSessao" class="mx-2" style="font-size: 1.1rem; margin-top: 1rem; float: left;">60</p>
			</div>
			<div class="form-inline my-2 my-lg-0">
				<label class="form-control mr-sm-2" readonly><?=$nomeMorador?></label>
				<a class="btn btn-outline-info my-2 my-sm-0" href="javascript: location.href='loginEncerrar.php';">Sair</a>
			</div>
		</div>
	</nav>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/contadorPlugin.js"></script>