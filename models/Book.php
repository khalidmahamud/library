<?php
class Book
{
  private $connection;

  public function __construct(Database $database)
  {
    $this->connection = $database->getConnection();
  }

  public function getAllBooks()
  {
    $sql = "SELECT * FROM books";
    $result = $this->connection->query($sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function searchBooks($query)
  {
    $sql = "SELECT * FROM books WHERE title LIKE '%$query%'";
    $result = $this->connection->query($sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function getBookById($bookId)
  {
    $sql = "SELECT * FROM books WHERE id = '$bookId'";
    $result = $this->connection->query($sql);
    return mysqli_fetch_assoc($result);
  }

  public function isStudentBorrowingBook($studentId)
  {
    $sql = "SELECT COUNT(*) as count FROM borrowings WHERE student_id = '$studentId' AND is_borrowing = 1";
    $result = $this->connection->query($sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
  }

  public function isBookAvailable($bookId)
  {
    $sql = "SELECT is_available FROM books WHERE id = '$bookId'";
    $result = $this->connection->query($sql);
    $row = mysqli_fetch_assoc($result);
    return $row['is_available'] == 1;
  }

  public function borrowBook($studentId, $bookId, $returnDate)
  {
    $sql = "INSERT INTO borrowings (student_id, book_id, borrow_date, return_date, is_borrowing) 
              VALUES ('$studentId', '$bookId', NOW(), '$returnDate', 1)";
    $this->connection->query($sql);
  }

  public function updateBookAvailability($bookId, $isAvailable)
  {
    $sql = "UPDATE books SET is_available = '$isAvailable' WHERE id = '$bookId'";
    $result = $this->connection->query($sql);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
}
