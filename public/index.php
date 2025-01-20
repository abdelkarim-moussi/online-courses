<?php
session_start();
include_once "../dao/CourseDao.php";

if(isset($_SESSION["userId"])){
    $user_id = $_SESSION["userId"];

    if($user_id === "admin"){
        header("Location: adminDashboard.php");
    }
    elseif($user_id === "teacher"){
        header("Location: teacherDashboard.php");
    }

    $user = new User();
    $user->setId($_SESSION["userId"]);
    $user->setRole($_SESSION["urole"]);
    $userId = $user->getId();
$userRole = $user->getRole();
}





$courseDao = new CourseDao();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduOnline - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">EduOnline</div>
            <div class="hidden md:flex space-x-8 text-sm">
                <a href="#" class="text-blue-600">Home</a>
                <a href="courses_view.php" class="text-gray-600 hover:text-blue-600">Courses</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
                
            </div>
            <div class="hidden md:flex space-x-4 text-sm">
                <?php if(isset($userId) && $userRole === "student"){ ?>
                    <!-- <a href="#" class="px-4 py-2 text-blue-600 hover:text-blue-700"><i class="fa-solid fa-user"></i></a> -->
                    <a href="../includes/logout.inc.php" class="px-4 py-2 text-blue-600 hover:text-blue-700">logout</i></a>
                    <a href="MyCourses.php?id=<?=$user_id?>" class="px-4 py-2 text-blue-600 hover:text-blue-700" id="my-courses">
                        my courses
                    </a>
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

    <main>
        <section class="pt-24 pb-16" style="background:linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0.75)),url(../src/assets/imgs/bg.jpg);background-size:cover;">
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
                    <?php $popCourses = $courseDao->showPopulcarCourses();
                    foreach($popCourses as $course){?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="../uploads/<?=$course->getThumbnail();?>" alt="<?=$course->getTitle()?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <a href="course-details.php?id=<?=$course->getCourseId()?>"><h3 class="text-xl font-semibold mb-2"><?=$course->getTitle();?></h3></a>
                            <p class="text-gray-600 mb-2">By <?=$course->getTeacher()->getFullName();?></p>
                            
                            <p class="text-xl font-bold text-blue-600"><?=$course->getCategorie()->getCatName();?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gradient-to-r text-white" style="background:linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0.75)),url(../src/assets/imgs/bg1.jpg);background-size:cover;">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4">Start Learning Today</h2>
                <p class="text-xl mb-8">Join millions of learners from around the world</p>
                <button class="px-8 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 text-lg">
                    Get Started
                </button>
            </div>
        </section>
    </main>

    <section id="my-courses" class="w-[90%] lg:w-[30%] bg-gray-100 h-full fixed right-[100%] shadow-md overflow-auto">
        <button type="button" id="close-fav-md" class="mb-5"><i class="fa-solid fa-close text-xl hover:text-orange-400"></i></button>
        <div class="grid grid-cols-1 gap-5">
        
        </div>
    </section>


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

    <script src="../src/assets/js/script.js"></script>
</body>
</html>
