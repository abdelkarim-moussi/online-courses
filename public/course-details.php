<?php
session_start();
include_once "../dao/CourseDao.php";
include_once "../classes/User.php";
include_once "../dao/UserDao.php";

if(isset($_SESSION["userId"])){
    if($_SESSION["urole"] === "admin"){
        header("Location: adminDashboard.php");
    }
    elseif($_SESSION["urole"] === "teacher"){
        header("Location: teacherDashboard.php");
    }
}

$user = new User();
$user->setId($_SESSION["userId"]);
$user->setRole($_SESSION["urole"]);
$userId = $user->getId();
$userRole = $user->getRole();


$userDao = new UserDao();

$courseDao = new CourseDao();
$co = new Course();
$co->setCourseId($_GET['id']);

$course = $courseDao->getCourseById($co->getCourseId());


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - EduOnline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">EduOnline</div>
            <div class="hidden md:flex space-x-8 text-sm">
                <a href="index.php" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="courses_view.php" class="text-gray-600 hover:text-blue-600">Courses</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
            </div>
            <div class="hidden md:flex space-x-4 text-sm">
                <?php if(isset($userId) && $userRole === "student"){ ?>
                    <!-- <a href="#" class="px-4 py-2 text-blue-600 hover:text-blue-700"><i class="fa-solid fa-user"></i></a> -->
                    <a href="../includes/logout.inc.php" class="px-4 py-2 text-blue-600 hover:text-blue-700">logout</i></a>
                    <a href="my-courses.php" class="px-4 py-2 text-blue-600 hover:text-blue-700">my courses</i></a>
                <?php } else{ ?>
                    <a href="login.php" class="px-4 py-2 text-blue-600 hover:text-blue-700">Login</a>
                    <a href="signup.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Sign Up</a>
                <?php } ?>
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
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4" id="courseTitle"><?=$course->getTitle();?></h1>
                        <p class="text-blue-100 mb-4" id="courseDescription"><?=$course->getDescription();?></p>
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
                            <span id="courseInstructor">By <?=$course->getTeacher()->getFullName();?></span>
                            <i class="fas fa-users ml-6 mr-2"></i>
                            <span> students enrolled</span>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-center">

                            <div class="aspect-w-16 aspect-h-9 mb-4">
                                <img class="max-h-[200px] w-full object-cover" src="../uploads/<?=$course->getThumbnail()?>" alt="Course Preview" class="rounded-lg w-full">
                            </div>
                
                            <button>
                                <?php if($userDao->isEnroled($user,$course) === "Enrolled"){ ?>
                                    <a href="#" class="w-full bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                                       Already Enrolled
                                    </a>

                                <?php }elseif($user === "student" && $userDao->isEnroled($user,$course) === "not-Enrolled") { ?>
                                    <a href="../includes/course.inc.php?action=enroll?<?=$course->getCourseId()?>" class="w-full bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                                        Enroll Now
                                    </a>
                                <?php } ?>
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
                        
                        <!-- Course Content -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 w-full">
                            <h2 class="text-2xl font-bold mb-4">Course Content</h2>
                            <iframe src="../uploads/<?=$course->getContent()?>" frameborder="0" class="w-full h-[350px]"></iframe>
                        </div>

                        
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:w-1/3">
                        <!-- Instructor -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Your Instructor</h2>
                            <div class="flex items-center mb-4">
                                <img src="../profile-imgs/" alt="Instructor" class="w-16 h-16 rounded-full mr-4">
                                <div>
                                    <h3 class="font-semibold"><?=$course->getTeacher()->getFullName() ?></h3>
                                    <p class="text-gray-600"></p>
                                </div>
                            </div>
                            <div class="space-y-2 text-gray-700">
                                
                                <div class="flex items-center">
                                    <i class="fas fa-award text-blue-600 mr-2"></i>
                                    <span>50,000+ Students</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-play-circle text-blue-600 mr-2"></i>
                                    <span><?php $numCourses = $courseDao->getNumCourseByUserId(3);
                                    echo $numCourses["numc"];?> Courses</span>
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
