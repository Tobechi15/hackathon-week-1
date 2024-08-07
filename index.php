<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTherapy Startup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hidden {
            display: none;
        }

        .block {
            display: block;
        }

        .feature-card:hover {
            transform: scale(1.05);
            z-index: 10;
        }

        .feature-card { 
            transition: transform 0.3s;
        }

        .price-card:hover {
            transform: scale(1.05);
            z-index: 10;
        }

        .price-card {
            transition: transform 0.3s;
        }

        .carousel {
            display: flex;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            margin: 7.5px;
            min-width: 32.5%;
            scroll-snap-align: center;
            flex: 0 0 33.2%;
        }

        .carousel-nav {
            display: flex;  
            justify-content: center;
            margin-top: 1rem;
        }

        .carousel-nav button {
            margin: 0 0.25rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background-color: gray;
            border: none;
            cursor: pointer;
        }

        .carousel-nav button.active {
            background-color: blue;
        }

        .cou-cont {
            padding: 15px;
            overflow: hidden;
        }
        .ani{
            width: 500px;
        }
    </style>
</head>
<?php
session_start(); // Start the session
?>
<body class="font-sans bg-white">
    <!-- Header -->
    <header class="fixed z-30 w-full bg-white/80 backdrop-blur-sm transition-all duration-300 dark:bg-gray-black">
        <div class="container mx-auto px-4 py-4 xl:px-16 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600" style="cursor: pointer;"><a href="#home">TechTherapy</a></div>
            <div class="hidden md:flex space-x-4">
                <a href="index" class="text-gray-700 hover:text-blue-600">Home</a>
                <?php if (isset($_SESSION['is_logged_in'])) : ?>
                    <a href="p_dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                <?php endif; ?>
                <!-- <a href="#features" class="text-gray-700 hover:text-blue-600">Features</a> -->
                <a href="#about" class="text-gray-700 hover:text-blue-600">About Us</a>
                <a href="#reviews" class="text-gray-700 hover:text-blue-600">Reviews</a>
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
            <a href="#home" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Home</a>
            <!-- <a href="#features" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Features</a> -->
            <a href="#about" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">About Us</a>
            <a href="#reviews" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Reviews</a>
            <a href="#contact" class="block py-2 px-4 text-gray-700 hover:bg-gray-200">Contact</a>
            <a href="#signup" class="mx-4 hover:bg-gray-200 bg-blue-600 text-white px-4 py-2 rounded">Get Started</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-white text-black pt-32 py-20 text-left relative" id="home">
        <div class="flex items-center justify-center h-full">
          <div class="container mx-auto px-4 xl:px-16">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-16">
              <div class="flex flex-col gap-6 z-10 ani">
                <h1 class="text-5xl font-bold">Therapy at your convenience.</h1>
                <p class="mt-4 text-lg">Your healing is your journey, let us support you in your travels 
                    by helping you find affordable therapy sessions tailored to your needs.</p>
                <!-- <a href="signup.html" class="max-w-fit mt-8 bg-blue-600 text-white px-6 py-3 rounded inline-block">Get Started</a> -->
              </div>
              <div class="w-full md:w-1/2">
                <img src="assets/therapy2.gif" alt="Animated GIF" class="w-full">
                <!-- <video autoplay muted loop class="w-full">
                  <source src="assets/nina.mp4" type="video/mp4">
                </video> -->
              </div>
            </div>
          </div>
        </div>
      </section>
      

    <!-- Features Section -->
    <!-- <section id="features" class="bg-slate-100 py-20">
        <div class="container mx-auto px-4 xl:px-16">
          <h2 class="text-3xl font-bold text-center text-gray-800">Features</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center feature-card">
              <span class="material-symbols-outlined text-5xl text-blue-600">show_chart</span>
              <h3 class="text-xl font-semibold mt-4">Advanced Algorithmic Trading</h3>
              <p class="mt-2 text-gray-600">Leverage sophisticated algorithms designed to analyze market trends and execute trades with precision.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center feature-card">
              <span class="material-symbols-outlined text-5xl text-blue-600">schedule</span>
              <h3 class="text-xl font-semibold mt-4">24/7 Market Monitoring</h3>
              <p class="mt-2 text-gray-600">Never miss a trading opportunity with our round-the-clock market monitoring.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center feature-card">
              <span class="material-symbols-outlined text-5xl text-blue-600">security</span>
              <h3 class="text-xl font-semibold mt-4">Secure and Reliable</h3>
              <p class="mt-2 text-gray-600">Trade with confidence knowing that your data and transactions are protected by industry-leading security measures.</p>
            </div>
          </div>
        </div>
      </section> -->
      

    <!-- About Section --> 
    <section id="about" class="bg-blue-600 py-20" style="height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="text-center container mx-auto px-4 xl:px-16">
          <h2 class="text-3xl font-bold text-white">About Us</h2>
          <p class="mt-8 text-lg text-white">We understand how draining mental health issues can be or how frustrating it is to be stuck in a horrible
                situation and not be able to talk to anyone about it. The stigma around it isn't helpful either. So we created a
                platform to help connect people with therapists and vice versa. An often concern is cost (for both the therapist and patient), as a result
                we've tried to minimize it as much as possible, since the services provided are fully online, therapists don't need to pay for office space
                and patients can also save the cost of commuting. We are aware that the problem isn't entirely solved, nontheless we are always working to provide
                you with the best, so please bear with us. Have a suggestion? <a href="#contact"><u>Reach out, we'd love to hear it!</u></a>
          </p>
        </div>
      </section>
      

    <!-- Reviews Section -->
    <section id="reviews" class="py-20" style="height: 100vh;">
        <div class="container mx-auto px-4 xl:px-16">
            <h2 class="text-3xl font-bold text-center text-gray-800">What Our Customers Say</h2>
            <div class="cou-cont">
                <div class="carousel mt-8">
                    <div class="carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"Fantastic service! It has completely transformed how I manage my
                            mental health."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Jane Doe</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"Highly recommend this TechTherapy solution for anyone looking to
                            improve their mental health."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- John Smith</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"Exceptional customer support and easy-to-use interface."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Alice Johnson</p>
                    </div>
                    <!-- Additional Reviews -->
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"The best mental health tool I've ever used."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Michael Brown</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"User-friendly and highly effective."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Sarah Wilson</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"A game-changer for my business."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- David Clark</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"Excellent tool for mental health."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Emily Johnson</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"I love the detailed reports and insights."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Olivia Martinez</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"Highly intuitive and easy to use."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- James Lee</p>
                    </div>
                    <div class=" carousel-item border-2 bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="mt-2 text-gray-600">"A must-have for mental health."</p>
                        <div class="mt-4 text-yellow-500">
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star</span>
                            <span class="material-symbols-outlined">star_half</span>
                        </div>
                        <p class="mt-2 text-gray-800 font-semibold">- Sophia Roberts</p>
                    </div>
                </div>
            </div>
            <div class="carousel-nav">
                <button class="active"></button>
                <button></button>
                <button></button>
                <button></button>
            </div>
        </div>
    </section>

    <section class="bg-white text-black py-10 text-left relative flex items-center justify-center" style="height: 100vh;" id="contact">
    <div class="text-center w-full max-w-lg px-4 xl:px-16">
        <h2 class="text-3xl font-bold text-black mb-8">Contact Us</h2>
        <form class="space-y-4" name="submit-to-google-sheet">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="Name" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="Email" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" name="Message" rows="4" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
            </div>
        </form>
        <span id="msg" style="color: blue; margin-top: 10px; display: block;"></span>
    </div>
    </section>




    <!-- <section class="bg-white text-black py-10 text-left relative" style="height: 100vh;">
        <div class="container mx-auto px-4 xl:px-16">
            <div class="gap-x-16 md:flex md:items-center md:justify-between">
                <div class="w-full">
                    <video autoplay muted loot alt="Fancy SVG" class="mt-8 md:mt-0">
                        <source src="assets/nina.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="flex flex-col text-pretty gap-6 z-10 mt-8">
                    <h1 class="text-5xl font-bold">Trade Smarter with Automation</h1>
                    <p class="mt-4 text-lg">Unlock the potential of algorithmic trading with our advanced, user-friendly platform. Execute trades efficiently, monitor markets 24/7, and customize strategies to maximize your profits.</p>
                    <a href="signup.html" class="max-w-fit mt-8 bg-blue-600 text-white px-6 py-3 rounded inline-block">Get Started</a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- line 363 was first : class="flex justify-between items-center" -->
    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="container mx-auto px-4 xl:px-16">
            <div class="mt-4 text-center"> 
                <div>
                    <h3 class="text-lg font-bold">TechTherapy Startup</h3>
                    <p class="mt-2">Innovative solutions for your mental health.</p>
                </div>
                <div class="space-x-4">
                    <!-- <a href="#" class="hover:text-white">Privacy Policy</a> -->
                    <!-- <a href="#" class="hover:text-white">Terms of Service</a> -->
                    <!-- <a href="#contact" class="hover:text-white"><u>Have a question, reach out</u></a> -->
                </div>
            </div>
            <div class="mt-4 text-center">
                <p>&copy; 2024 TechTherapy Startup. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const carousel = document.querySelector('.carousel');
        const carouselItems = Array.from(document.querySelectorAll('.carousel-item'));
        const carouselNavButtons = document.querySelectorAll('.carousel-nav button');
        let currentIndex = 0;

        // Clone the first few items for seamless cycling
        const itemsToClone = 3; // Number of items to clone
        for (let i = 0; i < itemsToClone; i++) {
            const clone = carouselItems[i].cloneNode(true);
            carousel.appendChild(clone);
        }

        function showCarouselItem(index) {
            const itemsCount = carouselItems.length;
            const offset = (index * 100) / itemsCount;
            carousel.style.transform = `translateX(-${offset}%)`;
            carouselNavButtons.forEach((button, i) => {
                button.classList.toggle('active', i === index);
            });
        }

        function autoScroll() {
            const itemsCount = carouselItems.length;
            currentIndex = (currentIndex + 1) % itemsCount;
            if (currentIndex === 0) {
                // Reset to the original items without transition
                carousel.style.transition = 'none';
                carousel.style.transform = `translateX(0)`;
                setTimeout(() => {
                    carousel.style.transition = 'transform 0.5s ease-in-out';
                }, 50); // Small delay to ensure transition is re-enabled
            }
            showCarouselItem(currentIndex);
        }

        carouselNavButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                currentIndex = index;
                showCarouselItem(index);
                clearInterval(autoScrollInterval);
                autoScrollInterval = setInterval(autoScroll, 3000);
            });
        });

        showCarouselItem(currentIndex);

        let autoScrollInterval = setInterval(autoScroll, 3000);

        const scriptURL = 'https://script.google.com/macros/s/AKfycbzP1Szsstg86nJb0KLB3fb4t8mjz3XbMX0A1ek9fsVfzd2wuhDjabGPM-64nw_vKPY/exec'
        const form = document.forms['submit-to-google-sheet']
        const msg = document.getElementById("msg")

        form.addEventListener('submit', e => {
            e.preventDefault()
            fetch(scriptURL, { method: 'POST', body: new FormData(form)})
            .then(response => {
                msg.innerHTML = "Message sent successfully"
                setTimeout(function(){
                    msg.innerHTML = ""
                }, 5000)
                form.reset()
            })
            .catch(error => console.error('Error!', error.message))
        })


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
</body>

</html>