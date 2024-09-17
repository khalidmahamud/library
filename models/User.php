<?php
class User
{
  private $connection;

  public function __construct(Database $database)
  {
    $this->connection = $database->getConnection();
  }

  public function authenticate($username, $password)
  {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return false;
  }

  public function getUserIdByUsername($username)
  {
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user ? $user['id'] : null;
  }

  public function verifySecurityQuestion($username, $securityAnswer)
  {
    $query = "SELECT * FROM users WHERE username = ? AND security_answer = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("ss", $username, $securityAnswer);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }

  public function updatePassword($userId, $password)
  {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("si", $hashedPassword, $userId);

    if (!$stmt->execute()) {
      echo "Error updating password: " . $stmt->error;
    }
  }
}
