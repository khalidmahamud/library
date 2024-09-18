<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrow Book</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <header class="border-b border-gray-200">
    <nav class="max-w-7xl mx-auto p-6 flex justify-between items-center">
      <a href="index.php?action=books" class="text-3xl font-semibold">AIUB</a>
      <ul class="flex items-center space-x-6">
        <li>
          <a href="index.php?action=logout" class="px-6 py-3 text-lg font-semibold bg-gray-500 text-white rounded-xl hover:bg-gray-700">Log Out</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="max-w-7xl mx-auto">
    <div class="py-12 px-6 w-2/5 mx-auto">
      <div class="flex flex-col gap-6 content-center">
        <div class="p-6 bg-gray-100 rounded-xl">
          <!-- Show error message if any -->
          <?php if (isset($errorMessage) && !empty($errorMessage)): ?>
            <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-600 rounded-lg">
              <?php echo nl2br(htmlspecialchars($errorMessage)); // Display each error on a new line 
              ?>
            </div>
          <?php endif; ?>

          <form action="index.php?action=borrow_book&id=<?php echo htmlspecialchars($book['id']); ?>" method="post" class="mb-6">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
            <div class="mb-6">
              <label for="book_title" class="block text-lg font-semibold">Book Title</label>
              <input type="text" id="book_title" name="book_title" class="mt-1 w-full py-4 px-6 rounded-md" readonly required value="<?php echo htmlspecialchars($book['title']); ?>">
            </div>
            <div class="mb-6">
              <label for="student_id" class="block text-lg font-semibold">Student ID</label>
              <input type="text" id="student_id" name="student_id" class="mt-1 w-full py-4 px-6 rounded-md" required>
            </div>
            <div class="mb-6">
              <label for="return_date" class="block text-lg font-semibold">Return Date</label>
              <input type="date" id="return_date" name="return_date" class="mt-1 w-full py-4 px-6 rounded-md" required>
            </div>
            <button type="submit" class="px-6 py-3 w-full text-lg font-semibold bg-teal-500 text-white rounded-xl hover:bg-teal-700">Borrow</button>

          </form>
          <a href="index.php?action=book_detail&id=<?php echo htmlspecialchars($book['id']); ?>" class="w-full inline-block px-6 py-3 text-center text-lg font-semibold bg-gray-500 text-white hover:bg-gray-700 rounded-xl">Back</a>
        </div>
      </div>
    </div>
  </main>
</body>

</html>