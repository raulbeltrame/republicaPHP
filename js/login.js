
$("#formLogin").validate({
       rules:{
           email:{
               required:true,
               email:true,
           }, 
           senha:{
               required:true
           }	   
       }, 
       messages:{
            email:{
               required:"Campo obrigatório",
               required:"E-mail inválido",
           },
           senha:{
               required:"Campo obrigatório"
           }	   
       }
});


