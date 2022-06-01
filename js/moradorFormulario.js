$(document).ready(function(){
    $('#CPF').mask('999.999.999-90');
    $('#celular').mask('(00)00000-0000');			
});

$("#formulario").validate(
	{
		rules:{
			email:{
				required:true,
				remote: {
					url: "moradorVerificarEmail.php",
					type: "post",
					data: {
						idMorador: function() {
							return $( "#idMorador" ).val();
					  	}
					}
				}				
			},	
			 
            CPF:{
				required:true,
				remote: {
					url: "moradorVerificarCPF.php",
					type: "post",
					data: {
						idMorador: function() {
							return $( "#idMorador" ).val();
					  	}
					}
				}				
			},
            celular:{
                required:true
            
				},
			nome:{
				required:true
				
				},
			contato:{
				required:true
					
			},
			dataNascimento:{
				required:true	
			}
		},
				 
		messages:{
			email:{
				required:"Campo obrigatório",
				remote:"Esse já foi cadastrado"
			},
			nome:{
				required:"Campo obrigatório"
			},
			CPF:{
				required:"Campo obrigatório",
				remote:"Esse já foi cadastrado"
            },
            celular:{
				required:"Campo obrigatório"				   
			},
			dataNascimento:{
				required:"Campo obrigatório"				   
			},
			contato:{
				required:"Campo obrigatório"				   
			}
	    }
	}
);