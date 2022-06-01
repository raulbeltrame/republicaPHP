<?php

    ob_start(); 
	require_once "mpdf/mpdf.php";
    require('tipoContaBiblioteca.php'); 
    require('contaBiblioteca.php'); 
    require('contaRateioBiblioteca.php'); 
    require('moradorBiblioteca.php'); 

    $mpdf = new mPDF();
    $mpdf->SetDisplayMode("fullpage");
    
    $html = "<div id='area01'>
                <img src='logo.png'>
            </div>  
            <div id='area02'>   
                <h1 class='titulo'>Saldo da Conta</h1>
            </div>";
    
    $conta = buscarConta($_GET['idConta']);
    $morador = buscarMorador($conta['idMoradorResponsavel']);
    
    $html = $html . "<div id='area03'>
                        <table class='tabela'>
                            <tr>
                                <th width='40%'>Morador: {$morador['nome']}</th>
                                <th width='30%'>CPF: {$morador['CPF']}</th>
                            </tr>
                        </table>                    
                        <div id='area05'>
                            <table class='tabela'>
                                <thead>
                                    <tr>
                                        <th width='20%'>Descricao</th>
                                        <th width='20%'>Tipo</th>
                                        <th width='20%'>Valor da Conta</th>
                                        <th width='20%'>Vencimento</th>
                                        <th width='20%'>Valor do Rateio</th>
                                    </tr>
                                </thead>
                                <tbody>";       

    $rateios = listarRateio();
    $total = 0;

    foreach($rateios as $rateio){
        $tipo = buscarTipoConta($conta['idTipo']);
        $dataVencimento = date_create($conta['dataVencimento']);
        $dataVencimento = date_format($dataVencimento, 'd/m/Y');

        $html = $html . "<tr>";                             
        $html = $html . "<td>{$conta['descricao']}</td>";
        $html = $html . "<td>{$tipo['nome']}</td>";
        $html = $html . "<td>{$conta['valor']}</td>";
        $html = $html . "<td>{$dataVencimento}</td>";
        $html = $html . "<td>{$rateio['valor']}</td>";
        $html = $html . "</tr>";    
        $total += $rateio['valor'];
    }   
    $html = $html . "<tr>";                             
    $html = $html . "<td></td>";
    $html = $html . "<td></td>";
    $html = $html . "<td></td>";
    $html = $html . "<th>Total: </th>";
    $html = $html . "<th>{$total}</th>";
    $html = $html . "</tr>";        
    $html = $html . "</tbody> </table>";    
    $html = $html . "</div>";
    

    $dataEmissao = date("d/m/Y H:i:s"); 
    $css = file_get_contents('css/PDF.css');  
    $mpdf->WriteHTML($css, 1);      
    $mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
    $mpdf->setFooter("{PAGENO} de {nb}"); 
    $mpdf->WriteHTML($html, 2); 
    $mpdf->Output('SaldoConta.pdf',D);

    exit();

?>