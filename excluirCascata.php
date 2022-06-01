<?php

    require('contaBiblioteca.php');

    if(isset($_GET['idTipo'])){
        $idTipo = $_GET['idTipo'];

        $contasVinculadas = buscarContaByTipo($idTipo);

        foreach($contasVinculadas as $conta){
            excluirHistoricos($conta['idConta']);
            excluirConta($conta['idConta']);
        }

        header('Location: ./tipoContaExcluir.php?idTipo='.$idTipo);
    }

    if(isset($_GET['idMorador'])){
        $idMorador = $_GET['idMorador'];

        $contasVinculadas = buscarContaByMorador($idMorador);

        foreach($contasVinculadas as $conta){
            excluirHistoricos($conta['idConta']);
            excluirConta($conta['idConta']);
        }

        header('Location: ./moradorExcluir.php?idMorador='.$idMorador);
    }

?>