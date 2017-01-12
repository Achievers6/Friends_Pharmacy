$(document).ready(function(){
    $("#submit").click(function(){
        jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 
       
    });
 
    
    $('#main').validate({ 
        rules:{
          
          lname:{
                required:true,
                lettersonly:true,
                
          },
         fname:{
                required:true,
                lettersonly:true,
                
                
          },
          nic:{
                required:true,
                maxlength:10,
                minlength:10
                },
         
         password:{
                required:true,
                minlength:8,
                
          },
         
         email:{
                required:true,
                email:true    
                },
         bday:{
             required:true,
         },
         contact:{
              required:true,
              number:true,
              maxlength:10,
              minlength:10,
               },               
            
      },
            
    messages:{
             
            lname:{
                required:"Enter your last name",
             
               
                   },
            fnam:{
                required:"Enter your first name",
                number:"Entered name might be wrong",
             }, 
            email:{
                   email:"Please enter a valid email",
                   required:"Please enter email address",
                   },
            contact:{
                    number:"Please enter a valid contact number",  
                    maxlength:"Enterd number is  wrong",
                    minlength:"Enterd number is wrong",
                    },           
            nic:{
                required:"Please enter your NIC",
                maxlength:"Please enter a valid NIC",
                minlegth:"Please enter a vaid NIC",
                
                },
            bday:{
                   required:"Please enter your birthday"     
                },
           
            password:{
                required:"Please give a password",
                minlength:"Password is not strong enough"
            },
                       
            },
                        submitHandler: function(form) {
      form.submit();
    }
       
   }); 

    
    
    
    
    
});