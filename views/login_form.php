<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main class="max-w-7xl mx-auto py-12 px-6">
    <div class="p-12 w-1/3 mx-auto bg-gray-100 rounded-xl">
      <h1 class="mb-6 text-3xl text-center">Log In</h1>

      <form action="index.php?action=login" method="POST" class="space-y-5">
        <div class="space-y-2">
          <label for="username">Your Username</label>
          <input type="text" id="username" name="username" class="w-full py-4 px-6 rounded-md">
        </div>
        <div class="space-y-2">
          <label for="password">Your Password</label>
          <input type="password" id="password" name="password" class="w-full py-4 px-6 rounded-md">
        </div>
        <input type="submit" name="submit" value="Submit" class="pointer mt-6 py-4 w-full text-lg bg-teal-500 hover:bg-teal-700 rounded-xl text-white"></input>
      </form>

      <div class="mt-6 text-center">
        <a href="index.php?action=forgot_password" class="text-lg text-red-400 pointer hover:underline">Forgot Password?</a>
      </div>
    </div>
  </main>
</body>

</html>
