$(document).ready(function(){
    $("#form").validate({ 
     rules:{
          fname:"required",
          lname:"required",
          dob:"required",
                
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
                maxlength:10,
                minlength:10,
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