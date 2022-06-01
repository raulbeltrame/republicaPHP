$(document).ready(function(){
    $('#CPF').mask('999.999.999-99');
  });


$("#formLogin").validate({
       rules:{
           email:{
               required:true,
               email:true,
           }, 
           CPF:{
               required:true
           }	   
       }, 
       messages:{
            email:{
               required:"Campo obrigatório",
               required:"E-mail inválido",
           },
           CPF:{
               required:"Campo obrigatório"
           }	   
       }
});


$(document).ready(function(){
    $('#CPF').mask('999.999.999-99');
  });


$("#formLogin").validate({
       rules:{
           email:{
               required:true,
               email:true,
           }, 
           CPF:{
               required:true
           }	   
       }, 
       messages:{
            email:{
               required:"Campo obrigatório",
               required:"E-mail inválido",
           },
           CPF:{
               required:"Campo obrigatório"
           }	   
       }
});


