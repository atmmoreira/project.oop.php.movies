<?php

require_once('models/User.php');
require_once('models/Messages.php');

class UserDAO implements IUserDAO
{
  private $conn;
  private $url;
  private $message;

  public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
    $this->message = new Messages($url);
  }
  public function buildUser($data)
  {
    $user = new User();
    $user->id = $data["id"];
    $user->name = $data["name"];
    $user->email = $data["email"];
    $user->password = $data["password"];
    $user->avatar = $data["avatar"];
    $user->biography = $data["biography"];
    $user->token = $data["token"];
    return $user;
  }
  public function create(User $user, $authUser = false)
  {
    $stmt = $this->conn->prepare("INSERT INTO tbUsers(name, email, password, token) VALUES (:name, :email, :password, :token)");
    $stmt->bindParam(":name", $user->name);
    $stmt->bindParam(":email", $user->email);
    $stmt->bindParam(":password", $user->password);
    $stmt->bindParam(":token", $user->token);
    $stmt->execute();
    // Authentication User
    if ($authUser) {
      $this->setTokenToSession($user->token);
    }
  }
  public function destroyToken()
  {
    $_SESSION["token"] = "";
    $this->message->setMessage("Você foi desconectado com sucesso!", "success", "login.php");
  }
  public function update(User $user, $redirect = true)
  {
    $stmt = $this->conn->prepare("UPDATE tbUsers SET name = :name, email = :email, password = :password, avatar = :avatar, biography = :biography, token = :token WHERE id =:id");
    $stmt->bindParam(":id", $user->id);
    $stmt->bindParam(":name", $user->name);
    $stmt->bindParam(":email", $user->email);
    $stmt->bindParam(":password", $user->password);
    $stmt->bindParam(":avatar", $user->avatar);
    $stmt->bindParam(":biography", $user->biography);
    $stmt->bindParam(":token", $user->token);
    $stmt->execute();

    if ($redirect) {
      $this->message->setMessage("Dados atualizados com sucesso!", "success", "back");
    }
  }
  public function verifyToken($protected = false)
  {
    if (!empty($_SESSION["token"])) {
      $token = $_SESSION["token"];
      $user = $this->findByToken($token);
      if ($user) {
        return $user;
      } else if ($protected) {
        $this->message->setMessage("Você necessita estar logado!", "warning", "login.php");
      }
    } else if ($protected) {
      $this->message->setMessage("Você necessita estar logado!", "warning", "login.php");
    }
  }
  public function setTokenToSession($token, $redirect = true)
  {
    // Save token in session
    $_SESSION["token"] = $token;

    if ($redirect) {
      $this->message->setMessage("Seja bem vindo!", "success", "editProfile.php");
    }
  }
  public function authenticateUser($email, $password)
  {
    $user = $this->findByEmail($email);
    if ($user) {
      if (password_verify($password, $user->password)) {
        $token = $user->generateToken();
        $this->setTokenToSession($token, false);
        // Update token user
        $user->token = $token;
        $this->update($user, false);
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function findByEmail($email)
  {
    if ($email != "") {
      $stmt = $this->conn->prepare("SELECT * FROM tbUsers WHERE email = :email");
      $stmt->bindParam(":email", $email);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch();
        $user = $this->buildUser($data);
        return $user;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function findById($id)
  {
  }
  public function findByToken($token)
  {
    if ($token != "") {
      $stmt = $this->conn->prepare("SELECT * FROM tbUsers WHERE token = :token");
      $stmt->bindParam(":token", $token);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch();
        $user = $this->buildUser($data);
        return $user;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function changePassword(User $user)
  {
  }
}
