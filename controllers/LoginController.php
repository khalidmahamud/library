<?php
class LoginController
{
  private $userModel;

  public function __construct(User $userModel)
  {
    $this->userModel = $userModel;
  }

  public function showLoginForm()
  {
    include '../views/login_form.php';
  }

  public function login($username, $password): never
  {
    $user = $this->userModel->authenticate($username, $password);
    if ($user) {
      $_SESSION['user_logged_in'] = true;
      $_SESSION['username'] = $username;

      header('Location: index.php?action=books');
      exit();
    } else {
      $_SESSION['login_error'] = 'Invalid username or password';

      header('Location: index.php?action=login');
      exit();
    }
  }
}
