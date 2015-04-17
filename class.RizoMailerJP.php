<?php

require_once('class.RizoMailer.php');

class RizoMailerJP extends RizoMailer
{
  public $charset = "iso-2022-jp";

  public $lineBreak = "\r\n";

  public $body = array();

  public $msgBodyJP;

  public $bodyOutput;

  private $_debug = false;

  public function __construct($args = array()){
    parent::__construct($args);
    if (isset($args['msgBodyJP'])){
      $this->msgBodyJP = $args['msgBodyJP'];
    }
  }
  /**
* Built in mailer error handler
* Handles mail errors
* @param type $message
* @return \email
*/
  private function errorHandle($message){
    if($this->_debug === true):
         print("<h1>メールエラー</h1>");
         print("エラー詳細:<br />");
         printf("<span style='color:#FF0000; font-size:13pt;'>%s</span>",$message);
         exit;
         endif;
  }
  private function setBoundary(){
    $this->boundary = uniqid( rand() , true );
    return $this;
  }
  public function setBody(){
    $this->body[] = $this->lineBreak;
    $this->body[] = "--mix-". $this->boundary . $this->lineBreak;
    $this->body[] = "Content-Type: multipart/alternative; boundary=alt-" . $this->boundary . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = "--alt-". $this->boundary . $this->lineBreak;
    $this->body[] = "Content-Type: text/plain; charset=\"". $this->charset . "\"" . $this->lineBreak;
    $this->body[] = "Content-Transfer-Encoding: 7bit" . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = strip_tags($this->msgBodyJP) . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = "--alt-". $this->boundary . $this->lineBreak;
    $this->body[] = "Content-Type: text/html; charset=\"". $this->charset . "\"" . $this->lineBreak;
    $this->body[] = "Content-Transfer-Encoding: 7bit" . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = $this->msgBodyJP . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = "--alt-". $this->boundary . "--" . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    $this->body[] = "--mix-". $this->boundary . "--" . $this->lineBreak;
    $this->body[] = $this->lineBreak;
    foreach($this->body as $this->bodys){
      $this->bodyOutput .= $this->bodys;
    }
    //Return header output
    return $this->bodyOutput;
  }
    /**
* Check to be sure required info is not blank
* such as a to address
* @param type $message
* @return \email
*/
 private function checkRequired(){
        if(!isset($this->to))
        $this->errorHandle("<strong>RizoMailerJP ERROR:</strong>送信先メールアドレスが設定されていません。");
 }

  /**
* Sets who the email is from
* @param type $from
* @return \email
*/
  public function setSubject($subject){
      $this->subject = mb_convert_encoding( $subject, $this->charset, "auto");
      return $this;
  }

  /**
* Create our headers for sending the email
* @return string
*/
  private function _CreateHeaders(){
      /**
* メールバウンダリを作成
*/
    $this->setBoundary();
      /**
* Populate our header array with our headers
*/
    $this->header[] = "X-Mailer: PHP5\r\n";
    $this->header[] = "From:".$this->from."\r\n";
    $this->header[] = "Return-Path:".$this->reply_to."\r\n";
    $this->header[] = "MIME-Version: 1.0\r\n";
    $this->header[] = "Content-Transfer-Encoding: 7bit\r\n";
    $this->header[] = "Content-Type: multipart/mixed; boundary=mix-" . $this->boundary ."\r\n";

    /**
* Loop through our headers and assign the final
* output to our headerOutput property
*/
    foreach($this->header as $this->headers){
        $this->headerOutput .= $this->headers;
    }
    $this->setBody();
    //Return header output
    return $this->headerOutput;

  }

  /**
* Send our message
*/
  public function send(){
      /**
* Create the headers for our email
*/
   $this->_CreateHeaders();
   //Check that required info is passed to our methods
   $this->checkRequired();
      /**
* Send the email
* if email will not send we display a error message
*/
   if(!@mail($this->to,mb_encode_mimeheader($this->subject,$this->charset),mb_convert_encoding( $this->bodyOutput, $this->charset ),$this->headerOutput))
   {
     $this->errorHandle("<strong>RizoMailer ERROR:</strong>The php mail() function has failed to send your message!");
   }
  }


}