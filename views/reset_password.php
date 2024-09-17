<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main class="max-w-7xl mx-auto py-12 px-6">
    <div class="p-12 w-1/3 mx-auto bg-gray-100 rounded-xl">
      <h1 class="mb-6 text-3xl text-center">Reset Password</h1>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-4 text-red-500 text-center">
          <?php echo htmlspecialchars($_SESSION['error']); ?>
          <?php unset($_SESSION['error']); ?>
        </div>
      <?php endif; ?>

      <form action="index.php?action=update_password" method="POST" class="space-y-5">
        <div class="space-y-2">
          <label for="password">New Password</label>
          <input type="password" id="password" name="password" class="w-full py-4 px-6 rounded-md">
        </div>
        <div class="space-y-2">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="w-full py-4 px-6 rounded-md">
        </div>
        <input type="submit" value="Update Password" class="mt-6 py-4 w-full text-lg bg-teal-500 hover:bg-teal-700 rounded-xl text-white"></input>
      </form>
    </div>
  </main>
</body>

</html>
