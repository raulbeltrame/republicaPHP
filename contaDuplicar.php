<?php

    require('moradorBiblioteca.php');
    require('tipoContaBiblioteca.php');
    require('contaRateioBiblioteca.php');
    require('contaBiblioteca.php');

    if(!isset($_GET['idConta'])){
        header('Location: ./contaTabela.php');
        exit;
    }

    $idConta = $_GET['idConta'];

    $conta = buscarConta($idConta);

    if(salvarConta(0, $conta['descricao'], $conta['idTipo'], $conta['idMoradorResponsavel'], str_replace(".", ",", $conta['valor']), $conta['observacao'], $conta['dataVencimento'], $conta['estado'])){
        echo "<script>alert('Conta duplicada com sucesso! Caso queira, modifique algo.')</script>";
        $contaCriada = getLastId();
        header("Location: ./contaFormulario.php?acao=editar&idConta={$contaCriada['idConta']}");
    }else{
        echo "<script>alert('Não foi possível duplicar conta.'); location.href='./contaTabela.php'</script>";
    }

?>