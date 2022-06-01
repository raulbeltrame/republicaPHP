$(document).ready(function(){
	$('#valor').mask('#.##0,00', {reverse: true});
  });
  
$("#formulario").validate(
	{
		rules:{
			descricao:{
				required:true				
			},
			dataVencimento:{
				required:true				
			},
			valor:{
				required:true				
			},
			idMorador:{
				required:true				
			},
			observacao:{
				required:true				
			},
			idTipo:{
				required:true				
			}						
		}, 
		messages:{
			descricao:{
				required:"Campo obrigatório"
			},
			dataVencimento:{
				required:"Campo obrigatório"
			},
			valor:{
				required:"Campo obrigatório"
			},
			observacao:{
				required:"Campo obrigatório"
			},
			idMorador:{
				required:"Campo obrigatório"
			},
			idTipo:{
				required:"Campo obrigatório"
			}				   							   
		}
	}
);

$("#formularioRateio").validate(
	{
		rules:{
			idMorador:{
				required:true				
			},
			valorRat:{
				required:true				
			},
			situacao:{
				required:true				
			}						
		}, 
		messages:{
			idMorador:{
				required:"Campo obrigatório"
			},
			valorRat:{
				required:"Campo obrigatório"
			},
			situacao:{
				required:"Campo obrigatório"
			}			   							   
		}
	}
);