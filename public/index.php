<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduHub - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">EduHub</div>
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-blue-600">Home</a>
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

    <main>
        <section class="pt-24 pb-16 bg-gradient-to-r from-blue-600 to-blue-800">
            <div class="container mx-auto px-4 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Unlock Your Potential with Online Learning</h1>
                <p class="text-xl mb-8">Access thousands of courses from expert instructors worldwide</p>
                <div class="max-w-2xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" placeholder="What do you want to learn?" class="flex-1 px-6 py-3 rounded-lg text-gray-800">
                        <button class="px-8 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            <i class="fas fa-search mr-2"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Why Choose EduHub?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 text-center rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <i class="fas fa-laptop-code text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-3">Expert Instructors</h3>
                        <p class="text-gray-600">Learn from industry professionals and experienced educators</p>
                    </div>
                    <div class="p-6 text-center rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <i class="fas fa-clock text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-3">Learn at Your Pace</h3>
                        <p class="text-gray-600">Access content 24/7 and learn on your own schedule</p>
                    </div>
                    <div class="p-6 text-center rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <i class="fas fa-certificate text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-3">Certificates</h3>
                        <p class="text-gray-600">Earn recognized certificates upon course completion</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Popular Courses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="https://via.placeholder.com/300x200" alt="Web Development" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Web Development Bootcamp</h3>
                            <p class="text-gray-600 mb-2">By John Smith</p>
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-600">4.5 (2.3k reviews)</span>
                            </div>
                            <p class="text-xl font-bold text-blue-600">$89.99</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="https://via.placeholder.com/300x200" alt="Data Science" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Data Science Fundamentals</h3>
                            <p class="text-gray-600 mb-2">By Sarah Johnson</p>
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">5.0 (1.8k reviews)</span>
                            </div>
                            <p class="text-xl font-bold text-blue-600">$94.99</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="https://via.placeholder.com/300x200" alt="Digital Marketing" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Digital Marketing Mastery</h3>
                            <p class="text-gray-600 mb-2">By Mike Wilson</p>
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">4.0 (1.5k reviews)</span>
                            </div>
                            <p class="text-xl font-bold text-blue-600">$79.99</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4">Start Learning Today</h2>
                <p class="text-xl mb-8">Join millions of learners from around the world</p>
                <button class="px-8 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 text-lg">
                    Get Started
                </button>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white">
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

    <script src="script.js"></script>
</body>
</html>
