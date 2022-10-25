<?php

class Messages
{
  private $url;

  public function __construct($url)
  {
    $this->url = $url;
  }

  public function setMessage($textMessage, $typeMessage, $redirect = "index.php")
  {
    $_SESSION["textMessage"] = $textMessage;
    $_SESSION["typeMessage"] = $typeMessage;

    if ($redirect != "back") {
      header("Location: $this->url" . $redirect);
    } else {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
  public function getMessage()
  {
    if (!empty($_SESSION["textMessage"])) {
      return [
        "textMessage" => $_SESSION["textMessage"],
        "typeMessage" => $_SESSION["typeMessage"]
      ];
    } else {
      return false;
    }
  }
  public function clearMessage()
  {
  }
}
