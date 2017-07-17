 <?php
 //quoteprocess.php
 $hasError = false;
 $sent = false;

 $connect = mysqli_connect("localhost", "root", "root", "dbname");
 if(isset($_POST["firstname"]) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['details']))
 {
      $firstname = mysqli_real_escape_string($connect, $_POST["firstname"]);
      $lastname = mysqli_real_escape_string($connect, $_POST["lastname"]);
      $company = mysqli_real_escape_string($connect, $_POST["company"]);
      $email = mysqli_real_escape_string($connect, $_POST["email"]);
      $phone = mysqli_real_escape_string($connect, $_POST["phone"]);
      $website = mysqli_real_escape_string($connect, $_POST["website"]);
      $details = nl2br(mysqli_real_escape_string($connect, $_POST["details"]));

      $fieldsArray = array(
          'firstname' => $firstname,
          'lastname' => $lastname,
          'email' => $email,
          'details' => $details
      );

      $errorArray = array();

      foreach ($fieldsArray as $key => $val) {
        switch ($key) {
          case 'firstname':
          case 'lastname':
          case 'details':
            if(empty($val)) {
              $hasError = true;
              $errorArray[$key] = ucfirst($key) . " field is empty!";
            }
            break;
            case 'email':
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $hasError = true;
                $errorArray[$key] = "Invalid Email Address!";
              } else {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
              }
              break;
          }
      }

      if($hasError !== true)
      {
      $sql = "INSERT INTO quote_request(firstname, lastname, company, email, phone, website, details, created_at) VALUES
              ('".$firstname."', '".$lastname."', '".$company."', '".$email."', '".$phone."', '".$website."', '".$details."', now())";
      $run = mysqli_query($connect, $sql);

          $to = "your-email@example.com";
          $subject = "Message from: $firstname $lastname";
          $msgcontents = "<b>First Name:</b> $firstname<br><b>Last Name:</b> $lastname<br><b>Company Name:</b> $company<br>
          <b>Email:</b> $email<br><b>Phone Number:</b> $phone<br><b>Website:</b> $website<br><p><b>Project Details:</b> $details</p>";
          $headers = "MIME-Version: 1.0 \r\n";
          $headers .= "Content-type: text/html; charset-iso-8859-1 \r\n";
          $headers .= "From: $firstname $lastname <$email> \r\n";
          $mailsent = mail($to, $subject, $msgcontents, $headers);
          if($mailsent) {
            $sent = true;
            unset($firstname);
            unset($lastname);
            unset($company);
            unset($email);
            unset($phone);
            unset($website);
            unset($details);
          }
           echo "Thanks, Your request is sent successfuly!";
      }
 }
 ?>

