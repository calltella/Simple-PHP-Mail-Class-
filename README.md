RizoMailer
======================

RizoMailer is a simple easy to use PHP class that allows you to send email using the PHP programming language.
日本語版を追加(テキストとHTMLの混在メールを送信します。)


Example Usage
======================

      <?php
      require_once('class.RizoMailerJP.php');
      
      $mail = new RizoMailer();
      
      $mail->to = "example@mydomain.com";
      $mail->from = "from@example.com";
      $mail->reply_to = "email@example.com";
      $mail->subject = "email テスト送信";
      $mail->msgBodyJP = "本文を送信します。<p>HTMLでも送信可能</p>";
      //メッセージ送信
      $mail->send();



