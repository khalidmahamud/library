<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Borrow Book</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <header class="border-b border-gray-200">
    <nav class="max-w-7xl mx-auto p-6 flex justify-between items-center">
      <a href="index.php?action=books" class="text-3xl font-semibold">AIUB</a>
      <ul class="flex items-center space-x-6">
        <li>
          <a href="#" class="px-6 py-3 text-lg font-semibold bg-teal-500 text-white rounded-xl hover:bg-teal-700">Borrow Book</a>
        </li>
        <li>
          <a href="index.php?action=logout" class="px-6 py-3 text-lg font-semibold bg-gray-500 text-white rounded-xl hover:bg-gray-700">Log Out</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="max-w-7xl mx-auto">
    <div class="py-12 px-6">
      <div class="p-6 bg-gray-100 rounded-xl">
        <h1 class="mb-6 text-3xl">Borrow Book</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
          <div class="mb-4 text-red-500">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
            <?php unset($_SESSION['error']); ?>
          </div>
        <?php endif; ?>
        
        <form action="borrow_book_process.php" method="POST" class="space-y-5">
          <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($_GET['book_id']); ?>">
          
          <div class="space-y-2">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" class="w-full py-4 px-6 rounded-md" required>
          </div>
          
          <div class="space-y-2">
            <label for="return_date">Return Date</label>
            <input type="date" id="return_date" name="return_date" class="w-full py-4 px-6 rounded-md" required>
          </div>
          
          <input type="submit" value="Borrow Book" class="mt-6 py-4 w-full text-lg bg-teal-500 hover:bg-teal-700 rounded-xl text-white">
        </form>
      </div>
    </div>
  </main>
</body>

</html>
