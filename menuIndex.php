<?php
	require_once('loginCheck.php');
	require_once('moradorBiblioteca.php'); 
	$idMoradorMenu = $_SESSION['USUARIO']['idMorador'];
	$resultado = buscarMorador($idMoradorMenu);
	$nomeMorador = $resultado['nome'];
?>

<div class="cabecalhoMenu">
	<nav class="navbar navbar-expand-md navbar-green bg-yellow float-right">
		<div class="collapse navbar-collapse" id="navbarsExampleDefault ">
			<div class="sessao text-center">
				<p style="font-size: 1.1rem; margin-top: 1rem; float: left;" class=' text-center'>Tempo de sessão:</p>
				<p id="tempoSessao" class="mx-2" style="font-size: 1.1rem; margin-top: 1rem; float: left;">60</p>
			</div>
			<div class="form-inline">
                <a href="" class="float-left"></a>
				<label class="form-control mr-sm-2 float-right" readonly><?=$nomeMorador?></label>
				<a class="btn btn-outline-danger my-2 my-sm-0" href="javascript: location.href='loginEncerrar.php';">Sair</a>
			</div>
		</div>
	</nav>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/contadorPlugin.js"></script>