<?php
    session_start();

	require('moradorBiblioteca.php');
	require('historicoBiblioteca.php');
    $idConta = $_POST['idConta'];
    $registros = buscarHistoricoPorID($idConta);

    $linhasTabela = "";
    foreach($registros as $registro){
        $morador = buscarMorador($registro['idMorador']);
        $nomeMorador = $morador['nome'];
        $acao = "";
        if($registro['estado'] == 0){
            $acao = "Abriu";
        }elseif($registro['estado'] == 1){
            $acao = "Fechou";
        }else{
            $acao = "Reabriu";
        }

        $data = date_create($registro['data']);
        $dataFormatada = date_format($data, 'd/m/Y H:i:s');

        $linhasTabela = $linhasTabela . "<tr> <td>{$acao}</td> <td>{$dataFormatada}</td> <td>{$nomeMorador}</td> </tr>";
    }
    echo $linhasTabela;
?>