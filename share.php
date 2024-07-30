<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Management Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.0/main.min.js"></script>
</head>
<body class="bg-white text-gray-800">
    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-600 text-white py-4" style="background-color: #2563eb;">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Doctor Appointment Management Dashboard</h1>
                <button id="addAppointmentButton" class="bg-blue-800 py-2 px-4 rounded" style="background-color: #1e40af;">Add Appointment</button>
            </div>
        </header>

        <main class="container mx-auto px-4 flex-1">
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Sidebar -->
                <aside class="bg-white p-4 rounded shadow-md">
                    <nav>
                        <ul>
                            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Dashboard</a></li>
                            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Appointments</a></li>
                            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Patients</a></li>
                            <li><a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Settings</a></li>
                        </ul>
                    </nav>
                </aside>

                <!-- Main Content -->
                <section class="col-span-2 bg-white p-4 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4">Dashboard</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        <!-- Widgets -->
                        <div class="bg-blue-100 p-4 rounded shadow-md">
                            <h3 class="text-lg font-bold">Total Patients</h3>
                            <p id="patientCount" class="text-2xl font-semibold">0</p>
                        </div>
                        <div class="bg-blue-100 p-4 rounded shadow-md">
                            <h3 class="text-lg font-bold">Upcoming Appointments</h3>
                            <ul id="upcomingAppointments" class="list-disc pl-5">
                                <!-- Upcoming appointments will be added here -->
                            </ul>
                        </div>
                        <div class="bg-blue-100 p-4 rounded shadow-md">
                            <h3 class="text-lg font-bold">Recent Activities</h3>
                            <ul id="recentActivities" class="list-disc pl-5">
                                <!-- Recent activities will be added here -->
                            </ul>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold mb-4">Appointment Calendar</h2>
                    <div id="calendar" class="mb-8"></div>
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
                        </tbody>
                    </table>
                </section>
            </div>
        </main>

        <!-- Add Appointment Modal -->
        <div id="addAppointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-8 rounded shadow-lg max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">Add Appointment</h2>
                <form id="addAppointmentForm">
                    <div class="mb-4">
                        <label for="patientName" class="block text-sm font-medium text-gray-700">Patient Name</label>
                        <input type="text" id="patientName" name="patientName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="appointmentDate" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="appointmentDate" name="appointmentDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="appointmentTime" class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" id="appointmentTime" name="appointmentTime" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="closeModalButton" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded" style="background-color: #2563eb;">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script/app.js"></script>
</body>
</html>
