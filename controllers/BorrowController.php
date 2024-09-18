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
    $errors = [];

    if (!$this->bookModel->isBookAvailable($bookId)) {
      $errors[] = 'This book is not available.';
    }

    if (!$this->validateStudentId($studentId)) {
      $errors[] = 'Invalid student ID format.';
    }

    if ($this->bookModel->isStudentBorrowingBook($studentId)) {
      $errors[] = 'This student is already borrowing a book.';
    }

    if (!$this->validateReturnDate($returnDate)) {
      $errors[] = 'Return date must be within 7 days from today.';
    }

    if (!empty($errors)) {
      return implode("\n", $errors);
    }

    if ($this->bookModel->updateBookAvailability($bookId, 0)) {
      $this->bookModel->borrowBook($studentId, $bookId, $returnDate);

      return true;
    } 
    else {
      return 'Failed to borrow the book. Please try again.';
    }
  }

  private function validateStudentId($studentId)
  {
    return preg_match('/^\d{2}-\d{5}-[1-3]$/', $studentId);
  }

  private function validateReturnDate($returnDate)
  {
    $today = new DateTime();
    $returnDateTime = new DateTime($returnDate);
    $interval = $today->diff($returnDateTime);
    return $interval->days <= 7 && $returnDateTime >= $today;
  }
}
