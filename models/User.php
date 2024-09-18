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
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->connection->query($query);
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getUserIdByUsername($username)
    {
        $query = "SELECT id FROM users WHERE username = '$username'";
        $result = $this->connection->query($query);
        $user = $result->fetch_assoc();

        return $user ? $user['id'] : null;
    }

    public function verifySecurityQuestion($username, $securityAnswer)
    {
        $query = "SELECT * FROM users WHERE username = '$username' AND security_answer = '$securityAnswer'";
        $result = $this->connection->query($query);

        return $result->fetch_assoc();
    }

    public function updatePassword($userId, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = '$hashedPassword' WHERE id = $userId";
        
        if (!$this->connection->query($query)) {
            echo "Error updating password: " . $this->connection->error;
        }
    }
}
