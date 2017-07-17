jQuery(document).ready(function($){
  $("#contact_form").validate({
    rules: {
      fullname: {
        required: true,
        minlength: 3
      },
      emailaddress: {
        required: true,
        email: true
      },
      messagebody: {
        required: true,
        minlength: 50
      }
    },
    messages: {
      fullname: {
        required: "Please enter your name!",
        minlength: "Your name is too short!"
      },
      emailaddress: {
        required: "Please enter your email!",
        email: "Please enter a valid email address!"
      },
      messagebody: {
        required: "Please enter your message!",
        minlength: "Your message is too short!"
      }
    }
  });
});

