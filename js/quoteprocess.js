$(document).ready(function(){
     $('#submit_quote').click(function(){
          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var company = $('#company').val();
          var email = $('#email').val();
          var phone = $('#phone').val();
          var website = $('#website').val();
          var details = $('#details').val();
          if(firstname == '' || lastname == '' || email == '' || details == '' || details.length < 50)
          {
               $('#error_message').html("Fields with &ast; are required!");
          }
          else
          {
               $('#error_message').html('');
               $.ajax({
                    url:"includes/quoteprocess.php",
                    method:"POST",
                    data:{firstname:firstname, lastname:lastname, company:company, email:email, phone:phone, website:website, details:details},
                    success:function(data){
                         $("form").trigger("reset");
                         $('#success_message').fadeIn().html(data);
                         setTimeout(function(){
                              $('#success_message').fadeOut("Slow");
                         }, 9000);
                    }
               });
          }
     });
});
