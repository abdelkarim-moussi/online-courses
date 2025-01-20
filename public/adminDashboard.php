<?php
session_start();

include_once "../dao/CategorieDao.php";
include_once "../dao/UserDao.php";
include_once "../dao/CourseDao.php";
include_once "../dao/tagDao.php";


if(!isset($_SESSION["urole"])){
    header("Location:login.php");
}
if($_SESSION["urole"] === "teacher"){
    header("Location:teacherDashboard.php");
}
elseif($_SESSION["urole"] === "admin"){
    header("Location:adminDashboard.php.php");
}

else if($_SESSION["urole"] === "student"){
header("Location: index.php");
}


$userDao = new UserDao();
$catDao = new CategorieDao();
$courseDao = new CourseDao;
$tagDao = new TagDao();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css?v=<?php echo time(); ?>">
    <title>Online Courses</title>
</head>

<body class="flex bg-gray-100 p-6 gap-6 overflow-auto">

    <!-- Sidebar -->
    <section id="nav-bar" class="bg-white w-64 rounded-xl shadow-lg fixed h-screen">
        <div class="flex items-center justify-center py-6 border-b border-gray-200">
            <h4 class="text-2xl font-bold text-blue-600">Online<span class="text-gray-800">Courses</span></h4>
        </div>
        <div class="py-6">
            <ul class="space-y-3">
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold active-btn" data-id="courses"><i class="fa-solid fa-book"></i>Courses</a>
                </li>
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold" data-id="categories"><i class="fa-solid fa-gauge"></i>Categories</a>
                </li>
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold " data-id="addCategorie"><i class="fa-solid fa-list-check"></i>Add Categorie</a>
                </li>
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold " data-id="tags"><i class="fa-solid fa-tags"></i>Tags</a>
                </li>
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold " data-id="teachers"><i class="fa-solid fa-users-gear"></i>Teachers</a>
                </li>
                <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold " data-id="students"><i class="fa-solid fa-users"></i>Students</a>
                </li>
                <li class="absolute bottom-6 w-56 hover:bg-blue-50 rounded-md transition duration-200">
                    <a href="../includes/logout.inc.php" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold "><i class="fa-solid fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-1 bg-white rounded-xl shadow-lg ml-72 overflow-y-auto h-screen">
        <!-- Categories Section -->
        <section class="w-full section text-[#111C2D] bg-white sec1 relative" id="categories">
            <div class="border-b pb-2 flex justify-between items-center mb-5">
                <h1 class="text-lg mb-5 capitalize">Disponible categories</h1>
            </div>
            <table class="w-full rounded-lg text-sm">
                <thead>
                    <tr class="text-[#686a6d] capitalize">
                        <th class="font-normal">Categorie Id</th>
                        <th class="font-normal">Categorie name</th>
                        <th class="font-normal">number of courses</th>
                        <th class="font-normal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                
                    foreach ($catDao->showCategories() as $categorie) { ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-3"><?php echo $categorie->getCategorieId() ;?></td>
                            <td class="px-4 py-3"><?php echo $categorie->getCatName(); ?></td>
                            <td class="px-4 py-3"><?php $numCourses = $catDao->showCoursesNumByCat();
                                                        echo $numCourses["num"];
                                                    ?></td>
                            <td class="px-4 py-3 flex gap-3">
                                <a href="javascript:void(0);" onclick="openModal('<?php echo $categorie->getCategorieId(); ?>', '<?php echo $categorie->getCatName(); ?>', '<?php echo $categorie->getDescription(); ?>')" class="bg-orange-100 hover:bg-orange-200 text-orange-800 px-3 py-1 rounded-md text-sm">Update</a>
                                <a href="../includes/categorie.inc.php?idcat=<?php echo $categorie->getCategorieId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <!-- Add Categorie Section -->
        <section class="w-full section text-[#111C2D] bg-white sec2" id="addCategorie">
            <h1 class="text-lg mb-5 border-b pb-5 capitalize">Add new categorie</h1>
            <form class="space-y-4 md:space-y-6" action="../includes/categorie.inc.php" method="post" id="signup-form" enctype="multipart/form-data">
                <div>
                    <label for="categorie-name" class="block text-sm font-medium text-gray-700">Categorie Name</label>
                    <input type="text" name="categorie-name" id="categorie-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="categorie-description" class="block text-sm font-medium text-gray-700">Categorie Description</label>
                    <textarea name="categorie-description" id="categorie-description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <button type="submit" name="add-categorie" id="add-categorie" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Categorie</button>
            </form>
        </section>

        <!-- Teachers Section -->
        <section class="w-full section text-[#111C2D] bg-white sec3" id="teachers">
            <h1 class="text-lg mb-5 border-b pb-5 capitalize">Disponible Teachers</h1>
            <table class="w-full text-sm rounded-lg">
                <thead>
                    <tr class="text-[#686a6d] capitalize">
                        <th class="font-normal">Teacher Id</th>
                        <th class="font-normal">Teacher name</th>
                        <th class="font-normal">Email</th>
                        <th class="font-normal">Courses</th>
                        <th class="font-normal">Status</th>
                        <th class="font-normal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userDao->showUsersByRole("teacher") as $user) { ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-3"><?php echo $user->getId(); ?></td>
                            <td class="px-4 py-3"><?php echo $user->getFullName(); ?></td>
                            <td class="px-4 py-3"><?php echo $user->getEmail(); ?></td>
                            <td class="px-4 py-3"><?php $coursesNum = $userDao->calcCoursesForUser($user->getId());
                                                    echo $coursesNum["numcourses"]; ?></td>
                            <td class="px-4 py-3"><?php echo $user->getStatus(); ?></td>
                            <td class="px-4 py-3 flex gap-3">
                                <a href="../includes/user.inc.php?action=activate?<?php echo $user->getId(); ?>" class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1 rounded-md text-sm">Activate</a>
                                <a href="../includes/user.inc.php?action=suspend?<?php echo $user->getId(); ?>" class="bg-orange-100 hover:bg-orange-200 text-orange-800 px-3 py-1 rounded-md text-sm">Suspend</a>
                                <a href="../includes/user.inc.php?action=delete?<?php echo $user->getId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <!-- Students Section -->
        <section class="w-full section text-[#111C2D] bg-white sec4" id="students">
            <h1 class="text-lg mb-5 border-b pb-5 capitalize">Disponible Students</h1>
            <table class="w-full rounded-lg text-sm">
                <thead>
                    <tr class="text-[#686a6d] capitalize">
                        <th class="font-normal">Student Id</th>
                        <th class="font-normal">Student name</th>
                        <th class="font-normal">Email</th>
                        <th class="font-normal">Status</th>
                        <th class="font-normal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userDao->showUsersByRole("student") as $user) { ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-3"><?php echo $user->getId(); ?></td>
                            <td class="px-4 py-3"><?php echo $user->getFullName(); ?></td>
                            <td class="px-4 py-3"><?php echo $user->getEmail(); ?></td>
                            <td class="px-4 py-3"><?php echo $user->getStatus(); ?></td>
                            <td class="px-4 py-3 flex gap-3">
                                <a href="../includes/user.inc.php?action=activate?<?php echo $user->getId(); ?>" class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1 rounded-md text-sm">Activate</a>
                                <a href="../includes/user.inc.php?action=suspend?<?php echo $user->getId(); ?>" class="bg-orange-100 hover:bg-orange-200 text-orange-800 px-3 py-1 rounded-md text-sm">Suspend</a>
                                <a href="../includes/user.inc.php?action=delete?<?php echo $user->getId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <!-- Courses Section -->
        <section class="w-full section text-[#111C2D] bg-white sec5 active" id="courses">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-5">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-book text-blue-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->getNumCourses();
                                                        echo $row['num']; ?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">All Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-check text-green-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->getCoursesByStatus("accepted");
                                                        echo $row['num']; ?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Accepted Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-orange-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-clock text-orange-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->getCoursesByStatus("pending");
                                                        echo $row['num']; ?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Pending Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-times text-red-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->getCoursesByStatus("refused");
                                                        echo $row['num']; ?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Refused Courses</h3>
                </div>
            </div>
            <h1 class="text-lg mb-5 border-b pb-5 capitalize">disponible courses</h1>
            <p class="border-b pb-2 text-orange-400"><?php $row = $courseDao->getCoursesByStatus("pending");
                                                        if ($row['num'] == 0) {
                                                            echo "there is no pending courses";
                                                        } ?>
            </p>
            <table class="w-full rounded-lg text-sm">
                <thead>
                    <tr class="text-[#686a6d] capitalize">
                        <th class="font-normal">course Id</th>
                        <th class="font-normal max-w-[200px]">course title</th>
                        <th class="font-normal">teacher name</th>
                        <th class="font-normal">status</th>
                        <th class="font-normal">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courseDao->showCourses() as $course) { ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-3"><?=$course->getCourseId(); ?></td>
                            <td class="px-4 py-3"><?=$course->getTitle(); ?></td>
                            <td class="px-4 py-3"><?=$course->getTeacher()->getFullName(); ?></td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md text-sm"><?=$course->getStatus(); ?></span>
                            </td>

                            <td class="px-4 py-3 flex gap-3">
                                <?php if ($course->getStatus() === 'pending') { ?>
                                    <a href="../includes/course.inc.php?action=accept?<?=$course->getCourseId(); ?>" class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1 rounded-md text-sm">Accept</a>
                                    <a href="../includes/course.inc.php?action=refuse?<?=$course->getCourseId(); ?>" class="bg-orange-100 hover:bg-orange-200 text-orange-800 px-3 py-1 rounded-md text-sm">Refuse</a>
                                    <?php } else if($course->getStatus() === 'canceled'){?>
                                        <a href="../includes/course.inc.php?action=delete?<?=$course->getCourseId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Delete</a>
                                    <?php  ?>
                                    <?php } else { ?>
                                    <a href="../includes/course.inc.php?action=cancel?<?=$course->getCourseId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Cancel</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <!-- Tags Section -->
        <section class="w-full section text-[#111C2D] bg-white sec8 relative" id="tags">
            <div class="border-b pb-5 mb-5 flex justify-between items-center">
                <h1 class="text-lg capitalize">Disponible Tags</h1>
                <button id="addnewcat" onclick="openTagModal()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add New Tag</button>
            </div>
            <table class="w-full rounded-lg text-sm">
                <thead>
                    <tr>
                        <th class="font-normal">tag id</th>
                        <th class="font-normal">tag name</th>
                        <th class="font-normal">actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $tags = $tagDao->getTags();
                    foreach ($tags as $tag) { ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-3"><?php echo $tag->getTagId(); ?></td>
                            <td class="px-4 py-3"><?php echo $tag->getTagName(); ?></td>
                            <td class="px-4 py-3">
                                <a href="../includes/tag.in.php?idtag=<?php echo $tag->getTagId(); ?>" class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-md text-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Modals -->
    <div id="updateCatModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Update Categorie</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700"><i class="fa-solid fa-times"></i></button>
            </div>
            <form action="../includes/categorie.inc.php" method="post" class="space-y-4">
                <div>
                    <label for="up-cat-name" class="block text-sm font-medium text-gray-700">Categorie Name</label>
                    <input type="text" name="up-cat-name" id="up-cat-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="up-cat-description" class="block text-sm font-medium text-gray-700">Categorie Description</label>
                    <textarea name="up-cat-description" id="up-cat-description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <input type="hidden" name="up-cat-id" id="up-cat-id">
                <button type="submit" name="update-categorie" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update Categorie</button>
            </form>
        </div>
    </div>

    <div id="tag-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Add Tag</h2>
                <button onclick="closeTagModal()" class="text-gray-500 hover:text-gray-700"><i class="fa-solid fa-times"></i></button>
            </div>
            <form action="../includes/tag.in.php" method="post" class="space-y-4">
                <div>
                    <label for="tag-name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                    <input type="text" name="tag-name" id="tag-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" name="add-tag" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Tag</button>
            </form>
        </div>
    </div>

    <script>
        const catModal = document.getElementById("updateCatModal");
        const tagModal = document.getElementById("tag-modal");

        function openModal(catId, catName, catDesc) {
            catModal.classList.remove("hidden");
            document.getElementById("up-cat-name").value = catName;
            document.getElementById("up-cat-description").value = catDesc;
            document.getElementById("up-cat-id").value = catId;
        }

        function closeModal() {
            catModal.classList.add("hidden");
        }

        function openTagModal() {
            tagModal.classList.remove("hidden");
        }

        function closeTagModal() {
            tagModal.classList.add("hidden");
        }
    </script>

    <script src="../src/assets/js/script.js?v=<?php echo time();?>"></script>
</body>
</html>