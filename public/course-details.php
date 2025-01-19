<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - EduHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">EduHub</div>
            <div class="hidden md:flex space-x-8">
                <a href="index.html" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="courses.html" class="text-gray-600 hover:text-blue-600">Courses</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
            </div>
            <div class="hidden md:flex space-x-4">
                <button class="px-4 py-2 text-blue-600 hover:text-blue-700">Login</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Sign Up</button>
            </div>
            <button class="md:hidden text-gray-600">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>

    <main class="pt-20">
        <!-- Course Header -->
        <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="md:w-1/2">
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4" id="courseTitle">Advanced JavaScript Course</h1>
                        <p class="text-blue-100 mb-4" id="courseDescription">Master modern JavaScript with advanced concepts, design patterns, and real-world applications.</p>
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400" id="courseRating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-white ml-2">4.5 (2.3k reviews)</span>
                        </div>
                        <div class="flex items-center text-white mb-4">
                            <i class="fas fa-user-graduate mr-2"></i>
                            <span id="courseInstructor">By John Smith</span>
                            <i class="fas fa-users ml-6 mr-2"></i>
                            <span>12,345 students enrolled</span>
                        </div>
                        <div class="flex items-center text-white">
                            <i class="fas fa-clock mr-2"></i>
                            <span>20 hours of content</span>
                            <i class="fas fa-globe ml-6 mr-2"></i>
                            <span>English</span>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <div class="aspect-w-16 aspect-h-9 mb-4">
                                <img src="https://via.placeholder.com/640x360" alt="Course Preview" class="rounded-lg w-full">
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-4" id="coursePrice">$89.99</div>
                            <button class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg mb-4 hover:bg-blue-700 transition-colors">
                                Enroll Now
                            </button>
                            <button class="w-full border border-blue-600 text-blue-600 py-3 px-6 rounded-lg hover:bg-blue-50 transition-colors">
                                Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Content -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Main Content -->
                    <div class="lg:w-2/3">
                        <!-- What You'll Learn -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">What You'll Learn</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Advanced JavaScript concepts and ES6+ features</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Object-oriented programming in JavaScript</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Asynchronous programming with Promises</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Modern JavaScript design patterns</span>
                                </div>
                            </div>
                        </div>

                        <!-- Course Content -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Course Content</h2>
                            <div class="space-y-4">
                                <div class="border rounded-lg">
                                    <button class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <i class="fas fa-chevron-down mr-4"></i>
                                            <span class="font-semibold">1. Introduction to Advanced JavaScript</span>
                                        </div>
                                        <span class="text-gray-500">4 lectures • 45min</span>
                                    </button>
                                </div>
                                <div class="border rounded-lg">
                                    <button class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <i class="fas fa-chevron-down mr-4"></i>
                                            <span class="font-semibold">2. Object-Oriented Programming</span>
                                        </div>
                                        <span class="text-gray-500">6 lectures • 1h 15min</span>
                                    </button>
                                </div>
                                <div class="border rounded-lg">
                                    <button class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <i class="fas fa-chevron-down mr-4"></i>
                                            <span class="font-semibold">3. Asynchronous Programming</span>
                                        </div>
                                        <span class="text-gray-500">5 lectures • 1h 30min</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Requirements</h2>
                            <ul class="list-disc list-inside space-y-2 text-gray-700">
                                <li>Basic knowledge of JavaScript and ES6</li>
                                <li>Understanding of HTML and CSS</li>
                                <li>A code editor (VS Code recommended)</li>
                                <li>Enthusiasm to learn advanced concepts</li>
                            </ul>
                        </div>

                        <!-- Description -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Description</h2>
                            <div class="prose max-w-none">
                                <p class="mb-4">
                                    This comprehensive course will take you on a journey through advanced JavaScript concepts
                                    and modern development practices. You'll learn everything from advanced ES6+ features to
                                    complex design patterns used in professional development.
                                </p>
                                <p class="mb-4">
                                    Throughout the course, you'll work on real-world projects that will help you master:
                                </p>
                                <ul class="list-disc list-inside mb-4">
                                    <li>Advanced scope and closures</li>
                                    <li>Prototypal inheritance</li>
                                    <li>Async/await patterns</li>
                                    <li>Modern JavaScript tooling</li>
                                </ul>
                                <p>
                                    By the end of this course, you'll have the skills and confidence to build complex
                                    applications using advanced JavaScript concepts.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:w-1/3">
                        <!-- Instructor -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Your Instructor</h2>
                            <div class="flex items-center mb-4">
                                <img src="https://via.placeholder.com/100" alt="Instructor" class="w-16 h-16 rounded-full mr-4">
                                <div>
                                    <h3 class="font-semibold">John Smith</h3>
                                    <p class="text-gray-600">Senior JavaScript Developer</p>
                                </div>
                            </div>
                            <div class="space-y-2 text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                                    <span>4.8 Instructor Rating</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-award text-blue-600 mr-2"></i>
                                    <span>50,000+ Students</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-play-circle text-blue-600 mr-2"></i>
                                    <span>15 Courses</span>
                                </div>
                            </div>
                        </div>

                        <!-- Share -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-bold mb-4">Share This Course</h2>
                            <div class="flex space-x-4">
                                <a href="#" class="text-blue-600 hover:text-blue-700">
                                    <i class="fab fa-facebook text-2xl"></i>
                                </a>
                                <a href="#" class="text-blue-400 hover:text-blue-500">
                                    <i class="fab fa-twitter text-2xl"></i>
                                </a>
                                <a href="#" class="text-blue-700 hover:text-blue-800">
                                    <i class="fab fa-linkedin text-2xl"></i>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-700">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">EduHub</h3>
                    <p class="text-gray-400">Empowering learners worldwide with quality education</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 EduHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="course-details.js"></script>
</body>
</html>
