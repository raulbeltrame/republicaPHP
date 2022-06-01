$(document).ready( function () {

$("#tabela").dataTable({
    "bJQueryUI": true,
    "oLanguage": {
        "sProcessing":   "Processando...",
        "sLengthMenu":   "_MENU_ registros por página",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
        "sInfoFiltered": "",
        "sInfoPostFix":  "",
        "sSearch":       "Pesquisar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Próximo",
            "sLast":     "Último"
        }
    }
})     

/*
$('#tabela').DataTable( {
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
    }
} );
*/


} );

$("#formularioRelatorio").validate(
    {
        rules:{
            idTipo:{
                required:true
            },
            dataInicial:{
                required:true               
            },  
            dataFinal:{
                required:true               
            }                                   
        }, 
        messages:{
            idTipo:{
                required:"Campo obrigatório"
            },
            dataInicial:{
                required:"Campo obrigatório"
            },
            dataFinal:{
                required:"Campo obrigatório"
            }                                                  
        }
    }
);

$('#modalHist').on('show.bs.modal', function (event) {
	//Recupera o botão que acionou o modal
	var button = $(event.relatedTarget) 

	//Extrai informação dos atributos data-* do botão
	var codigo = button.data('codigo')
    var descricao = button.data('descricao') 

	//Recupera a estrutura do modal
	var modal = $(this)
	
	//Atualiza do título do modal
	modal.find('.modal-title').text('Histórico da conta ' + descricao)

	//realiza uma requisição AJAX 
	$.ajax({
		url  : 'getHistoricos.php',
		type : 'post',
		data : {
             idConta : codigo
		}
   })
   .done(function(resultado){
		//Atualização das linhas do corpo da tabela
		modal.find('#tabelaModal tbody').html(resultado)
   });   
})