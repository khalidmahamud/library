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

    return mysqli_fetch_all($result, MYSQLI_ASSOC); // Return an associative array of all books
  }

  public function searchBooks($query)
  {
    $sql = "SELECT * FROM books WHERE title LIKE '%$query%'";
    $result = $this->connection->query($sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC); // Return search results as an associative array
  }

  public function getBookById($bookId)
  {
    $query = "SELECT * FROM books WHERE id = '$bookId'";

    $result = mysqli_query($this->connection, $query);

    return mysqli_fetch_assoc($result);
  }
}
