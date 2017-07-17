jQuery(document).ready(function($){
  $("#quote_form").validate({
    rules: {
      firstname: {
        required: true,
        minlength: 3
      },
      lastname: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      details: {
        required: true,
        minlength: 50
      }
    },
    messages: {
      firstname: {
        required: "Please enter your first name!",
        minlength: "Your name is too short!"
      },
      lastname: {
        required: "Please enter your last name!",
        minlength: "Your name is too short!"
      },
      email: {
        required: "Please enter your email!",
        email: "Please enter a valid email address!"
      },
      details: {
        required: "Please enter your project details!",
        minlength: "Your details is too short!"
      }
    }
  });
});
