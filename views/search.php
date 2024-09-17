<?php
require_once '../config/config.php';
require_once '../lib/Database.php';
require_once '../models/Book.php';

$db = new Database();
$bookModel = new Book($db);

// Get the search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');

// Fetch books based on the query
if ($query === '') {
  $books = $bookModel->getAllBooks();
} else {
  $books = $bookModel->searchBooks($query);
}


if (!empty($books)): ?>
  <h1 id="results-heading" class="mb-12 text-3xl text-center text-gray-700">All Books</h1>
  <div class="p-6 bg-gray-100 rounded-xl grid grid-cols-3 gap-8">

    <?php foreach ($books as $book): ?>
      <div class="bg-white rounded-xl overflow-hidden shadow-md">
        <a href="index.php?action=book_detail&id=<?php echo urlencode($book['id']); ?>" class="">
          <div class="w-full bg-gray-200 flex items-center justify-center">
            <img src="<?php echo htmlspecialchars($book['img_url']); ?>" class="object-fill w-full h-full" alt="Book Image" />
          </div>
          <div class="p-6">
            <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($book['title']); ?></h2>
            <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($book['author']); ?></p>
            <p class="text-green-400"><?php echo $book['is_available'] ? 'Available' : 'Not Available'; ?></p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

  </div>
<?php else: ?>
  <h2 class="mb-12 text-3xl text-gray-400 text-center">No result found!</h2>
<?php endif; ?>