<?php

class BorrowController
{
  private $bookModel;

  public function __construct($bookModel)
  {
    $this->bookModel = $bookModel;
  }

  public function showBorrowBookForm($bookId)
  {
    $book = $this->bookModel->getBookById($bookId);
    require '../views/borrow_book_form.php';
  }

  public function borrowBook($studentId, $bookId, $returnDate)
  {
    // Initialize an array to hold error messages
    $errors = [];

    // Check if the book is available
    if (!$this->bookModel->isBookAvailable($bookId)) {
      $errors[] = 'This book is not available.';
    }

    // Validate student ID format
    if (!$this->validateStudentId($studentId)) {
      $errors[] = 'Invalid student ID format.';
    }

    // Check if the student is already borrowing a book
    if ($this->bookModel->isStudentBorrowingBook($studentId)) {
      $errors[] = 'This student is already borrowing a book.';
    }

    // Validate the return date
    if (!$this->validateReturnDate($returnDate)) {
      $errors[] = 'Return date must be within 7 days from today.';
    }

    // If there are any errors, return them as a string (each error in a new line)
    if (!empty($errors)) {
      return implode("\n", $errors);
    }

    // If no validation errors, try to borrow the book
    if ($this->bookModel->updateBookAvailability($bookId, 0)) {
      $this->bookModel->borrowBook($studentId, $bookId, $returnDate);
      return true; // Success, borrowing successful
    } else {
      // Return the failure message if borrowing fails
      return 'Failed to borrow the book. Please try again.';
    }
  }

  private function validateStudentId($studentId)
  {
    // Validate student ID format (e.g., xx-xxxxx-1/2/3)
    return preg_match('/^\d{2}-\d{5}-[1-3]$/', $studentId);
  }

  private function validateReturnDate($returnDate)
  {
    // Validate the return date to ensure it is within 7 days from today
    $today = new DateTime();
    $returnDateTime = new DateTime($returnDate);
    $interval = $today->diff($returnDateTime);
    return $interval->days <= 7 && $returnDateTime >= $today;
  }
}
