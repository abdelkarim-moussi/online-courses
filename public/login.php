<?php
session_start();


    if(isset($_SESSION["urole"])){
        if($_SESSION['urole'] === "admin"){
            header("Location: adminDashboard.php");
        }
        elseif($_SESSION['urole'] === "teacher"){
            header("Location: teacherDashboard.php");
        }
        elseif($_SESSION['urole'] === "student"){
            header("Location: index.php");
        }
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css?v=<?php echo time(); ?>">
    <title>EduOnline - login</title>
</head>
<body class="bg-[#F0F5F9] flex flex-col gap-5 relative">

<header class="fixed w-full bg-white shadow-sm z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">EduOnline</div>
            <div class="hidden md:flex space-x-8 text-sm">
                <a href="index.php" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="courses_view.php" class="text-blue-600">Courses</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
            </div>
            <div class="hidden md:flex space-x-4 text-sm">
                <a href="signup.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Sign Up</a>
            </div>
            <button class="md:hidden text-gray-600">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>

<!-- login form -->
<div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0 my-10 w-full mt-[90px]">
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  login
              </h1>
            <form class="space-y-4 md:space-y-6" action="../includes/login.inc.php" method="post" id="signin-form">
                <div class="text-red-600"></div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  
                  <button type="submit" name="login" id="signin" class="w-full uppercase tracking-wide text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                  <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
                      don't have an account? <a href="signup.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">sign up here</a>
                  </p>
            </form>
          </div>
      </div>
  </div>

</body>
</html>