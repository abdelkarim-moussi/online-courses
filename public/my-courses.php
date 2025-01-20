<?php

session_start();
include_once "../dao/CourseDao.php";
include_once "../dao/UserDao.php";
include_once "../classes/User.php";

// Redirect if not logged in
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
}

$courseDao = new CourseDao();
$userDao = new UserDao();

$user = new User();
$user->setId($_SESSION["userId"]);

// Get enrolled courses for the user
$enrolledCourses = $userDao->getEnrolledCourses($user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - EduOnline</title>
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
                <a href="my-courses.php" class="text-blue-600">My Courses</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
            </div>
            <div class="hidden md:flex space-x-4 text-sm">
                <a href="#" class="px-4 py-2 text-blue-600 hover:text-blue-700"><i class="fa-solid fa-user"></i></a>
                <a href="../includes/logout.inc.php" class="px-4 py-2 text-blue-600 hover:text-blue-700">Logout</a>
            </div>
        </nav>
    </header>

    <main class="pt-20">
        <section class="bg-gradient-to-r py-12" style="background:linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0.75)),url(../src/assets/imgs/bg1.jpg);background-size:cover;">
            <div class="container mx-auto px-4 text-center text-white">
                <h1 class="text-4xl font-bold mb-4">My Courses</h1>
                <p class="text-xl">Track your learning progress</p>
            </div>
        </section>

        <section class="container mx-auto px-4 py-12">
            <?php if (empty($enrolledCourses)): ?>
                <div class="text-center py-12">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">You haven't enrolled in any courses yet</h2>
                    <p class="text-gray-600 mb-8">Explore our course catalog and start learning today!</p>
                    <a href="courses_view.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Browse Courses</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <?php if ($course->getThumbnail()): ?>
                                <img src="../uploads/<?= htmlspecialchars($course->getThumbnail()) ?>" alt="<?= htmlspecialchars($course->getTitle()) ?>" class="w-full h-48 object-cover">
                            <?php else: ?>
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-book text-4xl text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($course->getTitle()) ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($course->getDescription()) ?></p>
                                
                                <?php if ($course->getTeacher()): ?>
                                    <p class="text-sm text-gray-500 mb-4">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        <?= htmlspecialchars($course->getTeacher()->getFullName()) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($course->getCategorie()): ?>
                                    <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm mb-4">
                                        <?= htmlspecialchars($course->getCategorie()->getCatName()) ?>
                                    </span>
                                <?php endif; ?>
                                
                                <div class="mt-4">
                                    <a href="course-details.php?id=<?= $course->getCourseId() ?>" 
                                       class="inline-block px-4 py-2 rounded hover:text-blue-700 hover:underline transition duration-300 mx-auto">
                                        Continue Learning
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">EduOnline</h3>
                    <p class="text-gray-400">Empowering learners worldwide with quality online education.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="courses_view.php" class="text-gray-400 hover:text-white">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> EduOnline. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
