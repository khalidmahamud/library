<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Details</title>
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
    <div class="py-12 px-6">
      <div class="flex flex-col gap-6 content-center">
        <div class="p-6 bg-gray-100 rounded-xl">
          <div class="grid grid-cols-5 gap-6">
            <div class="col-span-3 flex items-center">
              <img src="<?php echo htmlspecialchars($book['img_url']); ?>" class="rounded-xl w-3/4" alt="" />
            </div>
            <div class="col-span-2 p-6 bg-gray-100 rounded-xl flex flex-col gap-2">
              <h1 class="mb-6 text-3xl"><?php echo htmlspecialchars($book['title']); ?></h1>
              <p class="text-gray-500 text-lg">
                <strong class="text-gray-500">Author: </strong><?php echo htmlspecialchars($book['author']); ?>
              </p>
              <article class="text-gray-700 text-lg">
                <strong class="text-gray-500">Description:</strong><br />
                <?php echo htmlspecialchars($book['description']); ?>
              </article>
              <p class="text-lg">
                <strong class="text-gray-500">Availability: </strong>
                <span class="<?php echo $book['is_available'] ? 'text-green-500' : 'text-red-500'; ?>">
                  <?php echo $book['is_available'] ? 'Available' : 'Not Available'; ?>
                </span>
              </p>
              <!-- Borrow Book Link -->
              <a href="index.php?action=borrow_book&id=<?php echo htmlspecialchars($book['id']); ?>" class="inline-block mt-6 px-6 py-3 text-center text-lg font-semibold bg-teal-500 text-white hover:bg-teal-700 rounded-xl">Borrow Book</a>
              <a href="index.php?action=books" class="inline-block px-6 py-3 text-center text-lg font-semibold bg-gray-500 text-white hover:bg-gray-700 rounded-xl">Back</a>

            </div>
          </div>
        </div>

      </div>
    </div>

  </main>
</body>

</html>