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
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
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
  <main class="flex-1">
    <div class="flex md:grid-cols-3">
      <!-- Sidebar -->
      <aside
        class="bg-white p-4 pt-32 rounded shadow-md top-0 left-0 w-64 flex flex-col pt-[4rem] h-screen transition-transform -translate-x-full sm:translate-x-0">
        <h2 class="text-xl font-bold mb-4">Dashboard</h2>
        <nav>
          <ul>

            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Dashboard</a></li>
            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Appointments</a></li>
            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Patients</a></li>
            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Settings</a></li>
          </ul>
        </nav>
      </aside>
      <?php
        include 'script/config.php';
        include 'script/demo.php';
        
        $appointments = readFromFirebase('appointments');
        $users = readFromFirebase('users');

        function sortByDateDesc($a, $b) {
          return strtotime($a['date']) - strtotime($b['date']);
        }
        
      
        if ($appointments) {
          uasort($appointments, 'sortByDateDesc');
        }
      ?>

      <div class="flex-1 pt-16 px-8 h-screen overflow-y-scroll">
        <div class="grid grid-cols-6 pt-4 my-4">
          <button id="addAppointmentButton" class=" w-40 bg-blue-600 text-white py-2 px-4 rounded">Add
            Appointment</button>
        </div>
        <?php if ($appointments): ?>
        <div class="grid grid-cols-4 my-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <!-- Widgets -->
          <div class="bg-white p-4 rounded shadow-md">
            <?php
            $completedCount = 0;
            if($appointments) {
              foreach($appointments as $id => $appointment) {
                if (isset($appointment['done']) && $appointment['done'] === 0) {
                  $completedCount++;
                }
              }
            }
            $userCount = 0;
            if ($users) {
                foreach ($users as $id => $user) {
                    $userCount++;
                }
            }
            ?>
            <p class="text-gray-500">Total Patients</p>
            <p id="patientCount" class="text-2xl font-semibold">
              <span class="font-medium material-symbols-outlined">person </span>
              <?php echo $userCount; ?>
            </p>
          </div>
          <div class="bg-white p-4 rounded shadow-md">
            <p class="text-gray-500">Upcoming Appointments</p>
            <ul id="upcomingAppointments" class="list-disc pl-5">
              <!-- Upcoming appointments will be added here -->
              <?php
              $doki = [];
                            foreach($appointments as $id => $appointment) {
                              if (isset($appointment['done']) && $appointment['done'] === 0) {
                                array_push($doki, $appointment);
                              }
                            }
                            $fot = $doki[0];
                            echo $fot['title'] . ' - ' . $fot['date']. ' - ' . $fot['title'];
              ?>
            </ul>
          </div>
          <div class="bg-white p-4 rounded shadow-md">
            <p class="text-gray-500">Scheduled appointment</p>
            <p id="patientCount" class="text-2xl font-semibold">
              <?php echo $completedCount; ?>
            </p>
          </div>
          <div class="bg-white p-4 rounded shadow-md">
            <h3 class="text-lg font-bold">Recent Activities</h3>
            <ul id="recentActivities" class="list-disc pl-5">
              <!-- Recent activities will be added here -->
            </ul>
          </div>
        </div>
        <!-- Main Content -->
        <div class="w-full flex gap-4">
          <section class="w-2/3 mt-4 bg-white p-4 rounded shadow-md">
            <?php
require 'script\dash.php';
              $database = new Database;
              $database->query("SELECT * FROM `appointment` WHERE `done` = 0 ORDER BY ID DESC");
              $rows = $database->resultset();
            ?>
            <h2 class="text-xl font-bold mb-4">Upcoming Appointments</h2>

            <table class="min-w-full bg-white">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b">Patient Name</th>
                  <th class="py-2 px-4 border-b">Date</th>
                  <th class="py-2 px-4 border-b">Time</th>
                  <th class="py-2 px-4 border-b">Action</th>
                </tr>
              </thead>
              <tbody id="appointmentsTableBody">
                <!-- Appointments will be dynamically added here -->
                <?php foreach($appointments as $id => $appointment) : ?>
                <?php if (isset($appointment['done']) && $appointment['done'] === 0): ?>
                <tr>
                  <td class="py-2 px-4 border-b">
                    <?php echo $appointment['title'] ?>
                  </td>
                  <td class="py-2 px-4 border-b">
                    <?php echo $appointment['date'] ?>
                  </td>
                  <td class="py-2 px-4 border-b">
                    <?php echo $appointment['time'] ?>
                  </td>
                  <td class="py-2 px-4 border-b">
                    <form method="post" action="script/dashboard.php">
                      <input type="submit" name="delete" value="Delete" class="text-red-600 hover:text-red-800">
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                    </form>
                    <form method="post" action="script/dashboard.php">
                      <input type="submit" name="done" value="done" class="text-green-600 hover:text-green-800">
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                    </form>
                  </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </section>
          <!-- calendar -->
          <section class="col-span-2 mt-4 bg-white p-4 rounded shadow-md">
            <div id="calendar" class="mb-8"></div>
          </section>
        </div>
        <section class="w-2/3 mt-4 bg-white p-4 rounded shadow-md">
          <h2 class="text-xl font-bold mb-4">Past Appointments</h2>

          <table class="min-w-full bg-white">
            <thead>
              <tr>
                <th class="py-2 px-4 border-b">Patient Name</th>
                <th class="py-2 px-4 border-b">Date</th>
                <th class="py-2 px-4 border-b">Time</th>
                <th class="py-2 px-4 border-b">Action</th>
              </tr>
            </thead>
            <tbody id="appointmentsTableBody">
              <!-- Appointments will be dynamically added here -->
              <?php foreach($appointments as $id => $appointment) : ?>
              <?php if (isset($appointment['done']) && $appointment['done'] === 1): ?>
              <tr>
                <td class="py-2 px-4 border-b">
                  <?php echo $appointment['title'] ?>
                </td>
                <td class="py-2 px-4 border-b">
                  <?php echo $appointment['date'] ?>
                </td>
                <td class="py-2 px-4 border-b">
                  <?php echo $appointment['time'] ?>
                </td>
                <td class="py-2 px-4 border-b">
                  <form method="post" action="script/dashboard.php">
                    <input type="submit" name="delete" value="Delete" class="text-red-600 hover:text-red-800">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                  </form>
                </td>
              </tr>
              <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
        <?php else: ?>
        <div class="flex-1 pt-16 px-8 h-screen overflow-y-scroll">
          <p>No appointments found.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </main>
  <!-- Add Appointment Modal -->
  <div id="addAppointmentModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded shadow-lg max-w-md w-full">
      <h2 class="text-xl font-bold mb-4">Add Appointment</h2>
      <form id="addAppointmentForm" method="post" action="script/dashboard.php">
        <div class="mb-4">
          <label for="patientName" class="block text-sm font-medium text-gray-700">Patient Name</label>
          <select id="cars" name="patientName" class="mt-1 block p-2 w-full border-gray-300 rounded-md shadow-sm">
            <?php foreach($users as $user) : ?>
            <option value="<?php echo $user['username'] ?>">
              <?php echo $user['username'] ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-4">
          <label for="appointmentDate" class="block text-sm font-medium text-gray-700">Start Time (ISO 8601):</label>
          <input type="datetime-local" id="appointmentDate" name="appointmentDate"
            class="mt-1 block p-2 w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="appointmentDuration" class="block text-sm font-medium text-gray-700">Duration (minutes):</label>
          <input type="number" id="appointmentDuration" name="appointmentDuration"
            class="mt-1 block p-2 w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="appointmentTimezone" class="block text-sm font-medium text-gray-700">Timezone:</label>
          <input type="text" id="appointmentTimezone" name="appointmentTimezone"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="UTC">
        </div>
        <div class="mb-4">
          <label for="appointmentAgenda" class="block text-sm font-medium text-gray-700">Agenda:</label>
          <input type="text" id="appointmentAgenda" name="appointmentAgenda"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="flex justify-end">
          <input type="hidden" id="timestamp" name="create_date">
          <button type="button" id="closeModalButton"
            class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Cancel</button>
          <input type="submit" onclick="setCurrentTimestamp()" class="bg-blue-600 text-white py-2 px-4 rounded"
            style="background-color: #2563eb;" name="add" value="Add">
        </div>
      </form>
    </div>
  </div>
  </div>
</body>
<script src="script/app.js"></script>

<script>
  function setCurrentTimestamp() {
    const hiddenInput = document.getElementById('timestamp');
    const currentDate = new Date();
    const timezoneOffsetInHours = currentDate.getTimezoneOffset() / 60;
    currentDate.setHours(currentDate.getHours() - timezoneOffsetInHours);
    const currentTimestamp = currentDate.toISOString();
    hiddenInput.value = currentTimestamp;
  }

  // Ensure the function runs after the page is fully loaded
  setCurrentTimestamp();
</script>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAcwVOZ1Khwak8nmr8A4ZRGqTbCtf-FIC8",
    authDomain: "therapy-719a7.firebaseapp.com",
    projectId: "therapy-719a7",
    storageBucket: "therapy-719a7.appspot.com",
    messagingSenderId: "1001194092414",
    appId: "1:1001194092414:web:2bd6d6dfa507246976252f",
    measurementId: "G-8MSGH5VXJ8"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>

</html>