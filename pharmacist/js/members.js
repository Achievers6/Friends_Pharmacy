$(document).ready(function(){

        jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please");

    jQuery.validator.addMethod("NICNumber", function (value,element) { 
    return this.optional(element) || /^[0-9]{9}[vV]$/.test(value); 
}, "Please enter a valid National Identity Card Number");
        

   
        
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {

    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) > Number($(params).val())); 
},'Must be less than {0}.');
       
         

    
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
         address:{
                required:true,
         },
         nic:{
                required:true,
                NICNumber:true,
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
             greaterThan:"today",
             
         },
        date:{
             required:true,
             greaterThan:"today",
             
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
            fname:{
                required:"Enter your first name",
                number:"Entered name might be wrong",
             }, 
            email:{
                   email:"Please enter a valid email",
                   required:"Please enter email address",
                   },
            contact:{
                    required:"Please enter your contact number",
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
                   required:"Please enter your birthday",
                   
                },
            address:{
                required:"Please enter your home address",
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