<?php 
include_once "../dao/CourseDao.php";
include_once "../dao/CategorieDao.php";

$courseDao = new CourseDao();
$catDao = new CategorieDao();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - EduOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">EduOnline</div>
            <div class="hidden md:flex space-x-8">
                <a href="index.html" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="courses.html" class="text-blue-600">Courses</a>
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
        <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
            <div class="container mx-auto px-4 text-center text-white">
                <h1 class="text-4xl font-bold mb-4">Browse Our Courses</h1>
                <p class="text-xl">Discover the perfect course to advance your skills</p>
            </div>
        </section>

        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <aside class="lg:w-64 space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-4">Categories</h3>
                        <div class="space-y-2">
                            <?php foreach($catDao->showCategories() as $categorie){ ?>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="rounded text-blue-600">
                                <span class="text-gray-700"><?=$categorie->getCatName() ?></span>
                            </label>
                            <?php } ?> 
                            
                        </div>
                    </div>


                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        Apply Filters
                    </button>
                </aside>

                <!-- Main Content -->
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <div class="w-full md:w-96">
                            <div class="relative">
                                <input type="text" placeholder="Search courses..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option>Most Popular</option>
                            <option>Newest</option>
                            <option>Highest Rated</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Course Cards -->
                         <?php foreach($courseDao->showCourses() as $course){ ?>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="../uploads/<?=$course->getThumbnail()?>" alt="Course" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <a href="../public/course-details.php?id=<?=$course->getCourseId();?>"><h3 class="text-xl font-semibold mb-2"><?php echo $course->getTitle(); ?></h3></a>
                                <p class="text-gray-600 mb-2">By <?=$course->getTeacher()->getFullName(); ?></p>
                                
                                <p class="text-lg font-bold text-blue-600"><?=$course->getCategorie()->getCatName(); ?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Repeat similar course cards -->
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center items-center space-x-2 mt-8">
                        <button class="px-3 py-2 rounded-lg border hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 rounded-lg border bg-blue-600 text-white">1</button>
                        <button class="px-4 py-2 rounded-lg border hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 rounded-lg border hover:bg-gray-50">3</button>
                        <span class="px-4 py-2">...</span>
                        <button class="px-4 py-2 rounded-lg border hover:bg-gray-50">10</button>
                        <button class="px-3 py-2 rounded-lg border hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="courses.js"></script>
</body>
</html>
