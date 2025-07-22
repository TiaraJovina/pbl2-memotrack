<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemoTrack - Your Memory Companion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-blue-500">MemoTrack</h1>
            </div>
            <div class="space-x-4">
                <a href="#features" class="text-gray-600 hover:text-blue-500 transition">Features</a>
                <a href="#about" class="text-gray-600 hover:text-blue-500 transition">About</a>
                <a href="#contact" class="text-gray-600 hover:text-blue-500 transition">Contact</a>
                <a href="/login" class="text-blue-500 border border-blue-500 px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white transition">Login</a>
                <a href="/register" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Daftar</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                Capture Your Moments with <span class="text-blue-500">MemoTrack</span>
            </h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                MemoTrack helps you organize your thoughts, track your memories, and stay productive with ease.
            </p>
            <a href="/register" class="bg-blue-500 text-white px-6 py-3 rounded-md text-lg hover:bg-blue-600 transition">
                Try MemoTrack Now
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-gray-900 text-center mb-12">Why Choose MemoTrack?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Easy Note-Taking</h4>
                    <p class="text-gray-600">Quickly jot down ideas and organize them effortlessly.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Track Your Time</h4>
                    <p class="text-gray-600">Stay on top of your schedule with built-in reminders.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Secure & Private</h4>
                    <p class="text-gray-600">Your data is safe with top-notch security features.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">About MemoTrack</h3>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                MemoTrack is designed to make your life easier by providing a seamless way to capture, organize, and revisit your thoughts and memories. Whether you're a student, professional, or creative, MemoTrack is your perfect companion.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">Get in Touch</h3>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Have questions or need support? Reach out to our team, and we'll get back to you as soon as possible.
            </p>
            <a href="mailto:support@memotrack.com" class="bg-blue-500 text-white px-6 py-3 rounded-md text-lg hover:bg-blue-600 transition">
                Contact Us
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">© 2025 MemoTrack. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>