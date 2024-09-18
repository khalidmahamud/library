<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
  <script src="../public/js/main.js" defer></script>
</head>

<body>
  <header class="border-b border-gray-200">
    <nav class="max-w-7xl mx-auto p-6 flex justify-between items-center">
      <a href="index.php?action=books" class="text-3xl font-semibold">AIUB</a>
      <ul class="flex items-center space-x-6">
        <li>
          <a href="index.php?action=logout" class="px-6 py-3 text-lg font-semibold bg-gray-500 text-white rounded-xl hover:bg-gray-700">Log Out</a>
        </li>
        <form id="search-form" class="flex items-center">
          <input id="searchbar" type="search" name="query" placeholder="Search books..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
        </form>
      </ul>
    </nav>
  </header>
  <main class="max-w-7xl mx-auto">
    <div class="py-12 px-6">
      <div class="flex flex-col gap-6">
        <div id="search-results">

          <!-- Search results will be injected here -->
        </div>
      </div>
    </div>
  </main>

  <script>

  </script>
</body>

</html>