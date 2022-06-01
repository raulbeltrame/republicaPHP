<?php
	ob_start();
	require_once "mpdf/mpdf.php";
    require_once('tipoContaBiblioteca.php'); 
    require_once('contaBiblioteca.php'); 
    require_once('contaRateioBiblioteca.php'); 
    require_once('moradorBiblioteca.php'); 

	$mpdf = new mPDF();
    $mpdf->SetDisplayMode("fullpage");
    
    $html = "<div id='area01'>
                <img src='logo.png'>
            </div>  
            <div id='area02'>   
                <h1 class='titulo'>Extrato de Contas</h1>
            </div>";
    $html = $html . "<hr>";

    $dataInicialFiltro  = $_POST['dataInicial'];
    $dataFinalFiltro    = $_POST['dataFinal'];

    $dataInicialFiltro = date_create($dataInicialFiltro);
    $dataFinalFiltro = date_create($dataFinalFiltro);
    $dataInicialFiltro = date_format($dataInicialFiltro, 'd/m/Y');
    $dataFinalFiltro = date_format($dataFinalFiltro, 'd/m/Y');  
    $html = $html . "<h2 class='subTitulo'>Período de: {$dataInicialFiltro} - {$dataFinalFiltro}</h2>";
    $html = $html . "<hr>";

    $contas = listarConta();
    $idTipoModal = $_POST['idTipo'];

    foreach($contas as $conta){
        if($conta['idTipo'] == $idTipoModal){
            $html = $html . "<div id='area03'>
                                <table class='tabela'>
                                    <thead>
                                        <tr>
                                            <th width='40%'>Descricao</th>
                                            <th width='20%'>Tipo</th>
                                            <th width='20%'>Vencimento</th>
                                            <th width='20%'>Valor Rateio</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
            
            $rateios = listarRateio();
            $total = 0;

            foreach($rateios as $rateio){    
                $morador = buscarMorador($conta['idMoradorResponsavel']);
                $tipo = buscarTipoConta($conta['idTipo']);
                $dataVencimento = date_create($conta['dataVencimento']);
                $dataVencimento = date_format($dataVencimento, 'd/m/Y');                    
                $html = $html . "<tr>";                         
                $html = $html . "<td>{$conta['descricao']}</td>";
                $html = $html . "<td>{$tipo['nome']}</td>";
                $html = $html . "<td>{$dataVencimento}</td>";
                $html = $html . "<td>{$rateio['valor']}</td>";
                $html = $html . "</tr>";    
                $total += $rateio['valor'];
            }       
        }
    }
    $html = $html . "<tr>";                             
    $html = $html . "<td></td>";
    $html = $html . "<td></td>";
    $html = $html . "<th>Total: </th>";
    $html = $html . "<th>{$total}</th>";
    $html = $html . "</tr>";        
    $html = $html . "</tbody> </table>";    
    $html = $html . "</div>";

    $morador = listarMorador();

    foreach ($morador as $morada) {
        $conta = buscarConta($idConta);
        $dataVencimento = date_create($conta['dataVencimento']);
        $dataVencimento = date_format($dataVencimento, 'd/m/Y');
        $html = $html . "<div id='area03'>
                            <table class='tabela'>
                                <thead>
                                    <tr>
                                        <th width='40%'>Morador</th>
                                        <th width='20%'>CPF</th>
                                        <th width='20%'>Pago</th>
                                        <th width='20%'>Em Débito</th>
                                    </tr>
                                </thead>
                                <tbody>";
        $contaRateios = listarRateio();
        $pago = 0;
        $debito = 0;

        foreach($contaRateios as $contaRateio){
            if ($contaRateio['situacao'] == 0) {
                $pago += $contaRateio['valor'];
            }else{
                $debito += $contaRateio['valor'];
            }
        }                   
        $html = $html . "<tr>";                         
        $html = $html . "<td>{$morada['nome']}</td>";
        $html = $html . "<td>{$morada['CPF']}</td>";
        $html = $html . "<td>{$pago}</td>";
        $html = $html . "<td>{$debito}</td>";
        $html = $html . "</tr>";
        $html = $html . "</tbody> </table>";    
        $html = $html . "</div>";
    }

    $dataEmissao = date("d/m/Y H:i:s"); 
    $css = file_get_contents('css/PDF.css');  
    $mpdf->WriteHTML($css, 1);      
    $mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
    $mpdf->setFooter("{PAGENO} de {nb}"); 
    $mpdf->WriteHTML($html, 2); 
    $mpdf->Output('ExtratoConta.pdf',D);

    exit();

?>

