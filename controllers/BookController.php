<?php

class BookController
{
    private $bookModel;

    public function __construct($bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function showBookList()
    {
        $books = $this->bookModel->getAllBooks();
        include '../views/book_list.php'; 
    }

    public function showBookDetail($bookId)
    {
        $book = $this->bookModel->getBookById($bookId);
        if ($book) {
            include '../views/book_detail.php'; 
        } else {
            echo 'Book not found.';
        }
    }
}
