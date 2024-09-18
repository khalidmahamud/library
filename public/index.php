<?php
session_start(); // Start the session to access session variables

require_once '../config/config.php';
require_once '../lib/Database.php';
require_once '../models/User.php';
require_once '../models/Book.php';
require_once '../controllers/LoginController.php';
require_once '../controllers/BookController.php';
require_once '../controllers/BorrowController.php';

// Database connection
$db = new Database();
$userModel = new User($db);
$bookModel = new Book($db);

// Front controller logic
$action = $_GET['action'] ?? 'login';
$loginController = new LoginController($userModel);
$bookController = new BookController($bookModel);
$borrowController = new BorrowController($bookModel);

// Checks if the user is logged in
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
  // User is already logged in, redirect to book_list view
  if ($action === 'login') {
    header('Location: index.php?action=books');
    exit();
  }
}

switch ($action) {
  case 'login':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $loginController->login($_POST['username'], $_POST['password']);
    } else {
      $loginController->showLoginForm();
    }
    break;
  case 'books':
    if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
      header('Location: index.php?action=login');
      exit();
    }
    $bookController->showBookList();
    break;
  case 'book_detail':
    if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
      header('Location: index.php?action=login');
      exit();
    }
    $bookId = $_GET['id'] ?? null;
    if ($bookId) {
      $bookController->showBookDetail($bookId);
    } else {
      echo 'No book ID provided.';
    }
    break;
  case 'borrow_book':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentId = $_POST['student_id'];
        $bookId = $_POST['book_id'];
        $returnDate = $_POST['return_date'];

        // Call the borrowBook method
        $result = $borrowController->borrowBook($studentId, $bookId, $returnDate);

        if ($result === true) {
            // Successful borrowing, redirect to books list
            header('Location: index.php?action=books');
            exit();
        } else {
            // Failed, $result contains the error message
            $errorMessage = $result;
        }

        // Load the form again with error message
        $book = $bookModel->getBookById($bookId);
        include '../views/borrow_book_form.php';
    } else {
        $bookId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        if ($bookId) {
            $borrowController->showBorrowBookForm($bookId);
        } else {
            echo 'No valid book ID provided.';
        }
    }
    break;

  case 'logout':
    session_destroy();
    header('Location: index.php?action=login');
    exit();
  case 'forgot_password':
    require '../views/forgot_password.php';
    break;
  case 'verify_security_question':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $securityAnswer = $_POST['security_answer'];
      if ($userModel->verifySecurityQuestion($username, $securityAnswer)) {
        $_SESSION['user_id'] = $userModel->getUserIdByUsername($username);
        header('Location: index.php?action=reset_password');
        exit();
      } else {
        $_SESSION['error'] = 'Security question answer is incorrect.';
        header('Location: index.php?action=forgot_password');
        exit();
      }
    }
    break;
  case 'reset_password':
    require '../views/reset_password.php';
    break;
  case 'update_password':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];

      if ($password === $confirmPassword) {
        if (isset($_SESSION['user_id'])) {
          $userModel->updatePassword($_SESSION['user_id'], $password);
          unset($_SESSION['user_id']);
          header('Location: index.php?action=login');
          exit();
        } else {
          $_SESSION['error'] = 'User session expired. Please try again.';
          header('Location: index.php?action=login');
          exit();
        }
      } else {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: index.php?action=reset_password');
        exit();
      }
    }
    break;
  default:
    echo 'Page not found';
}
