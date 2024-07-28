<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DashP</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
session_start(); // Start the session
if (!isset($_SESSION['is_logged_in'])) {
  header('Location: \hackathon-week-1\login');
}
?>
  <!-- Header -->
  <header class="fixed top-0 z-30 w-full bg-white/80 backdrop-blur-sm transition-all duration-300 dark:bg-gray-black">
    <div class="container mx-auto px-4 py-4 xl:px-16 flex justify-between items-center">
        <div class="text-2xl font-bold text-blue-600" style="cursor: pointer;"><a href="#home">Menta</a></div>
        <div class="hidden md:flex space-x-4">
            <a href="\hackathon-week-1\" class="text-gray-700 hover:text-blue-600">Home</a>
            <a href="#features" class="text-gray-700 hover:text-blue-600">Features</a>
            <a href="#about" class="text-gray-700 hover:text-blue-600">About</a>
            <a href="#testimonials" class="text-gray-700 hover:text-blue-600">Testimonials</a>
            <a href="#contact" class="text-gray-700 hover:text-blue-600">Contact</a>
        </div>
        <?php if (isset($_SESSION['is_logged_in'])) : ?>
            <a href="script/logout" class="hidden md:block bg-blue-600 text-white px-4 py-2 rounded">Sign Out</a>
        <?php else : ?>
            <a href="signup" class="hidden md:block bg-blue-600 text-white px-4 py-2 rounded">Get Started</a>  
        <?php endif; ?>
        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden p">
        <a href="\hackathon-week-1\" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Home</a>
        <a href="#features" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Features</a>
        <a href="#about" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">About</a>
        <a href="#testimonials" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Testimonials</a>
        <a href="#contact" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Contact</a>
        <a href="signup" class="mx-4 hover:bg-gray-200 bg-blue-600 text-white px-4 py-2 rounded">Get Started</a>
    </div>
</header>
<div>
  <H1 class="container">Dashboard</H1>
</div>
  <script>
    function navigateTo() {
      window.location.href = 'login.html';
    }
  </script>
</body>
</html>
