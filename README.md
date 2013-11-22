RizoMailer
======================

RizoMailer is a simple easy to use PHP class that allows you to send email using the PHP programming language.


Example Usage
======================

      <?php
      require_once('class.RizoMailer.php');
      
      $mail = new RizoMailer();
      
      $mail->to = "example@mydomain.com";
      $mail->from = "from@example.com";
      $mail->reply_to = "email@example.com";
      $mail->subject = "New Email From Your Site";
      $mail->content_type = "text/html";
      $mail->message = "This is the message that will get sent";
      //Send the message
      $mail->send();



