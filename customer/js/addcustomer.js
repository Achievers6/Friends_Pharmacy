$(document).ready(function(){
    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 
       
  
 jQuery.validator.addMethod('NICNumber', function (value,element) { 
    return this.optional(element) || /^[0-9]{9}[vV]$/.test(value); 
}, "Please enter a valid National Identity Card Number");
        

    $("#form").validate({ 
     rules:{
          
          dob:"required",
          fname:{
              required:true,
              lettersonly:true,
          },
         lname:{
             required:true,
             lettrsonly:true,
         },
          email:{
                required:true,
                mail:true,
                
                },
        
           mobile:{
			    required:true,
                number:true, 
                maxlength:10,
                minlength:10,
                },
           nic:{
                required:true,
                NICNumber:true,
           },
                    
            
      },
            
    messages:{
             fname:"Please enter first name",
             lname:"Please enter last name",
                       
            dob:"Enter birth date",
               
            mobile:{
				    required:"Please enter contact number",
                    number:"Enterd number is wrong",
                    maxlength:" Enterd number is incorrect",
                    minlength:" Enterd number is incorrect"
                        },
            email:{
                    required:"Please enter email",
                    number:"Enterd number is wrong",
                        
                    },
            nic:{
                required:"Please enter NIC",
                maxlength:"Enterd NIC is invalid",
                 minlength:"Enterd NIC is invalid",
                        }
                       
                       
            },
                        submitHandler: function(form) {
      form.submit();
    }
       
   }); 

    
    
    
    
    
});