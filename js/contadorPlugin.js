function atualizarContador(){

	var contador = parseInt($("#tempoSessao").text());
	contador = contador - 1;
	if(contador >= 0){
		// Define que a função será executada novamente em 6000ms = 1 segundo
		setTimeout('atualizarContador()', 60000);
		$("#tempoSessao").text(contador);
	}else{
		alert('Sua sessão expirou.');
		location.href='./loginEncerrar.php';
	}
}

atualizarContador();