Simple-PHP-Mail-Class-
======================

Simple easy to use PHP mail class
==============================================
Example Usage

The below is an example of how to send an email using the built in method chaining. Hope someone finds the above class useful at least
===============================================
<?php
$email = new email();

$email->setTo("example@example.com")
    ->setFrom("Steve")
    ->setReplyTo("example@example.com")
    ->setSubject("My Subject")
    ->isHTML()
    ->send()
   ;
   ?>
   ===============================================================
 More Detailed Usage

<?php
/**
 * Set up 3 variables to hold our message data 
 */
$_name = (isset($_POST['name'])) ? $_POST['name'] : false;
$_email = (isset($_POST['email'])) ? $_POST['email'] : false;
$_message = (isset($_POST['message'])) ? $_POST['message'] : false;

/**
 * Create new instance of our email object/class
 */
$email = new email();

/**
 * Only send our email if the form is submitted
 */
if(isset($_POST['send'])):
 
    /**
     * EXAMPLE OF CHECKING IF AN EMAIL IS VALID USING OUR CLASS
     */
    if(email::isEmailValid($_email) === false){
        //Email is not valid show error
    }
    /**
     * END VALID EMAIL EXAMPLE
     */
    
   /**
    * Put together our body with our contact details
    * to be sent in the email
    */
   $body = "
      Name:$_name<br />
      E-Mail:$_email<br />
      Message:$_message<br />
    ";
  /**
   * SENDING THE ACTUAL EMAIL EXAMPLE USING OUR CLASS
   */
   $email->setTo("example@example.com")
          ->setFrom("My Website")
          ->setReplyTo($_email)
          ->setSubject("Contact Details Of User")
          ->setMessage($body)
          ->isHTML()
          ->send();
   /**
    * END THE SENDING OF OUR EMAIL
    */
    
endif;

?>
d
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form method="post" action="contact.php">
            <div>Name:<input type="text" name="name" /></div> 
            <div>E-Mail:<input type="text" name="email" /></div> 
            <div>Message:<textarea name="message" rows="7" cols="50"></textarea></div>
            <div><input type="submit" name="send" value="Send" /></div>
        </form>
    </body>
</html>

