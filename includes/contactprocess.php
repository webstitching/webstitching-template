<?php


if(isset($_POST['fullname']) && isset($_POST['emailaddress']) && isset($_POST['messagebody']))
{
	 $connect = mysqli_connect("localhost", "root", "root", "dbname");

	 $name = mysqli_real_escape_string($connect, $_POST["fullname"]);
	 $email = mysqli_real_escape_string($connect, $_POST["emailaddress"]);
	 $message = nl2br(mysqli_real_escape_string($connect, $_POST["messagebody"]));
	 $created_at = date("F j, Y, g:i a");
	 
         $secret = 'your secret key';
         $response = $_POST['g-recaptcha-response'];
         $remoteip = $_SERVER['REMOTE_ADDR'];

     $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
     $result = json_decode($url, TRUE);

     if($result['success'] == 1){
       $sql = "INSERT INTO messages(name, email, message, created_at, ipaddress)
               VALUES
               ('".$name."', '".$email."', '".$message."', now(), '".$remoteip."')";
  		 $run = mysqli_query($connect, $sql);
       if($run)
          {
            $to = "your-email@example.com";
            $subject = "Message from: $name";
            $msgcontents = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Sent:</b> $created_at<br><b>IP:</b> $remoteip
            <p><b>Message:</b> $message</p>";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers .= "Content-type: text/html; charset-iso-8859-1 \r\n";
            $headers .= "From: $name <$email> \r\n";
            $mailsent = mail($to, $subject, $msgcontents, $headers);
            if($mailsent) {
              unset($name);
              unset($email);
              unset($message);
            }
             echo " Thanks, Message Sent Successfuly!";
          } else {
            echo " Message not sent, please try again!";
          }

     } else {
       echo " recaptcha not verified, please try again!";
     }
}

?>
