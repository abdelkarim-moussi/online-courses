<?php
session_start();

include_once "../classes/Teacher.php";
include_once "../classes/Admin.php";
include_once "../classes/User.php";
include_once "../dao/UserDao.php";
include_once "../dao/CourseDao.php";
include_once "../dao/tagDao.php";
include_once "../dao/CategorieDao.php";

if(isset($_SESSION['userId'])){
    if($_SESSION['urole'] === "admin"){
        header("Location: adminDashboard.php");
    }
    elseif($_SESSION['urole'] === "student"){
        header("Location: index.php");
    }
    
}
else header("Location: login.php");

$userdao = new UserDao();
$courseDao = new CourseDao();
$categorieDao = new CategorieDao();
$tagDao = new TagDao();

$user = new User();
$user->setId($_SESSION["userId"])
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css?v=<?php echo time(); ?>">
    <title>EduOnline - teacher</title>
</head>

<body class="flex bg-[#F0F5F9] p-4 relative gap-5">

<!-- <button id="menu-button" type="button" class="text-[#111C2D] z-20 px-1 rounded absolute top-5 left-6 hover:text-orange-500"><i class="fa-solid fa-bars text-xl"></i></button> -->


<section id="nav-bar" class="px-3 text-[#111C2D] w-[300px] bg-white notActive rounded-xl shadow-lg shadow-gray-400">
            <div class="flex items-center justify-center py-2 border-b-[1px] border-gray-300">
                <h4 class="text-blue-500 font-extrabold text-[1.1rem] mt-5">Edu<span class="text-[#111C2D]">/Online</span>
                </h4>
            </div>
            
            <div class="py-5 dach">
                <ul class="pl-2 flex flex-col gap-y-6">
                    <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold active-btn" data-id="courses"><i class="fa-solid fa-book"></i>Courses</a>
                    </li>
                    <!-- <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold" data-id="enrollments"><i class="fa-solid fa-bookmark"></i>Enrollments</a>
                    </li> -->
                    <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold" data-id="add-course"><i class="fa-solid fa-add"></i>Add Course</a>
                    </li>
                    <li class="hover:bg-blue-50 toggeled-item rounded-md transition duration-200">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold" data-id="profile"><i class="fa-solid fa-user"></i>Profile</a>
                    </li>

                    <li class="absolute bottom-6 w-56 hover:bg-blue-50 rounded-md transition duration-200">
                    <a href="../includes/logout.inc.php" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold "><i class="fa-solid fa-sign-out"></i>Logout</a>
                    </li>
                   
                </ul>
            </div>
            
</section>
    
<main class="w-full main-section text-sm h-[100%] rounded-xl shadow-lg shadow-gray-400">



<!-- Courses -->
<section class="w-full section text-[#111C2D] bg-white rounded-lg shadow-md sec6 active relative" id="courses">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-5">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-book text-blue-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->getNumCourseByUserId($user->getId()); echo $row["numc"]?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">All Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-check text-green-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->showNumCoursesByStatByTeacher("accepted"); echo $row["numc"]?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Accepted Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-orange-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-clock text-orange-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->showNumCoursesByStatByTeacher("pending"); echo $row["numc"]?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Pending Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-times text-red-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?php $row = $courseDao->showNumCoursesByStatByTeacher("refused"); echo $row["numc"]?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Refused Courses</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-times text-red-600"></i>
                        </div>
                        <h1 class="text-3xl font-bold"><?=$courseDao->getEnrollements($user->getId());?></h1>
                    </div>
                    <h3 class="text-gray-600 mt-2">Errollements</h3>
                </div>
            </div>

    <div class="flex items-enter justify-between mb-5 border-b pb-5">
    <h1 class="text-lg capitalize">Disponible courses</h1>
    </div>
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
            
         <?php 
           
            foreach($courseDao->getCoursesByUserId($user->getId()) as $row ){
            ?>
            <tr>
              <td class="font-normal">
                <?php echo $row->getCourseId();?>
              </td>
              <td class="font-normal">
              <?php echo $row->getTitle();?>
              </td>
              <td class="font-normal">
              <?php echo $row->getTeacher()->getFullName();?>
              </td>
              <td class="font-normal">
                  <p class="bg-blue-50 rounded-md"><?php echo $row->getStatus();?></p>
              </td>
              <td class="font-normal flex justify-center gap-3">
                <a href="javascript:void(0);" onclick="openUpCourseModal('<?php echo $row->getCourseId(); ?>','<?php echo $row->getTitle(); ?>','<?php echo $row->getContent(); ?>')" class="bg-yellow-100 hover:bg-yellow-200 rounded-md py-1 px-3">update</a>
                <a href="../includes/course.inc.php?action=delete?<?=$row->getCourseId(); ?>" class="bg-red-100 hover:bg-red-200 rounded-md py-1 px-3">delete</a>
              </td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
    
    
    <!-- update course -->
    <div class="w-full hidden bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 absolute top-5" id="updateCourseModal">
        <img src="../public/assets/imgs/close.png" alt="" class="w-[30px] float-right m-3 cursor-pointer" onclick="closeCourseModal()" id="closeUpCatModal">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                 Update course
              </h1>
    
            <form class="space-y-4 md:space-y-6 text-sm" action="../includes/article.inc.php" method="post" id="">

                 <div>
                      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">title</label>
                      <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>
                 <div>
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">course-content</label>
                    <textarea name="content" id="content" class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                 </div>
                 <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>

                    <input type="hidden" name="courseId" id="courseId">

                  <button type="submit" name="update-course" id="update-course" class="w-full uppercase tracking-wide text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">update Course</button>
        
            </form>

          </div>
    </div>

    </section>
    
<!-- Add Course section -->
<section class="w-full section text-[#111C2D] bg-white rounded-lg shadow-md sec7" id="add-course">
    <h1 class="text-lg mb-5 border-b pb-5 capitalize">Add new course</h1>
    <form class="space-y-4 md:space-y-6" action="../includes/course.inc.php" method="POST" id="signup-form" enctype="multipart/form-data">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50" placeholder="course title">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50"></textarea>
                </div>
                <div>
                <label for="course-content" class="block text-sm font-medium text-gray-700">course-content type(video or document)</label>
                    <select name="course-content" id="course-content" onchange="updateContent()" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                        <option value="" selected disabled>choose type</option>
                        <option value="video">video</option>
                        <option value="document">document</option>
                    </select>
                </div>
                <div class="hidden" id="video-container">
                    <label for="video" class="block text-sm font-medium text-gray-700">upload video</label>
                    <input type="file" name="video" id="video" accept="video/*" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                </div>
                <div class="hidden" id="document-container">
                    <label for="document" class="block text-sm font-medium text-gray-700">upload document</label>
                    <input type="file" name="document" id="document" accept=".pdf,.docx,.ppt" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                </div>
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700">course thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                </div>
            
                <div>
                      <label for="categorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                      <select name="categorie" id="categorie" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                      <?php foreach($categorieDao->showCategories() as $cat){ ?>
                      <option value="<?php echo $cat->getCatName(); ?>"><?php echo $cat->getCatName(); ?></option>
                      <?php } ?>
                      </select>
                </div>
                <div>
                    <label for="tags" class="block my-4 text-sm font-medium text-gray-900">
                        Tags
                    </label>
                    <div class="mt-1 flex gap-5 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-50">
                        <?php
                        $tags = $tagDao->getTags();
                         foreach($tags as $tag) {?>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="tags[]" value="<?php echo $tag->getTagName(); ?>" 
                                class="w-4 h-4 text-primary-500 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2">
                            <label for="tags" class="ml-2 text-sm font-medium text-gray-900">
                                <?php echo $tag->getTagName(); ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <button type="submit" name="add-course" id="add-course" class="w-full uppercase tracking-wide text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Course</button>
        
            </form>
    </section>

<!-- pesonal info -->
<section class="w-full section text-[#111C2D] bg-white rounded-lg shadow-md sec6" id="profile">

<h1 class="text-lg mb-5 border-b pb-5 capitalize">My personal informations </h1>
    <?php $userInfo = $userdao->UserInfo($user->getId()) ?>
   <div class="flex flex-col gap-2 border-t border-1 py-5 px-10 shadow-md rounded-md text-sm">
        <img src="../profile-imgs/<?=$userInfo->getPhoto();?>" alt="author image" class="w-[80px] h-[80px] p-2 rounded-full object-cover">
        <p>firstname : <span class="font-semibold"><?=$userInfo->getFirstName() ?></span></p>
        <p>lastname : <span class="font-semibold"><?=$userInfo->getLastName() ?></span></p>
        <p>email : <span class="font-semibold"><?=$userInfo->getEmail() ?></span></p>
        <p>role : <span class="font-semibold"><?=$userInfo->getRole() ?></span></p>
        
   </div>
 <?php ?>


 <!-- update info -->
 <div class="w-full hidden bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 absolute top-5" id="profileModal">
        <img src="../public/assets/imgs/close.png" alt="" class="w-[30px] float-right m-3 cursor-pointer" onclick="closeInfoModal()">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                 Update Inormations
              </h1>
    
            <form class="space-y-4 md:space-y-6 text-sm" action="../includes/updateUser.inc.php" method="post" id="" enctype="multipart/form-data">

                 <div>
                      <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">firstname</label>
                      <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>
                 <div>
                    <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lastname</label>
                    <textarea name="lname" id="lname" class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                 </div>
                 <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>
                 <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>

                    <input type="hidden" name="userId" id="userId">

                  <button type="submit" name="update-user" id="update-info" class="w-full uppercase tracking-wide text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">update Article</button>
        
            </form>

          </div>
    </div>
</section>


</main>

<script>

const courseModal = document.getElementById("updateCourseModal");
const profileModal = document.getElementById("profileModal");
var artId;
var title;
var content;
var image;

function openUpCourseModal(artId,title,content){

    courseModal.classList.remove("hidden");

   document.getElementById("title").value = title;
   document.getElementById("content").textContent = content;
   document.getElementById("artId").value = artId;

}

function closeCourseModal(){
    courseModal.classList.add("hidden");
}


function infoModal(fname,lname,email){

profileModal.classList.remove("hidden");

document.getElementById("fname").value = fname;
document.getElementById("lname").value = lname;
document.getElementById("email").value = email;
document.getElementById("userId").value = userId;

}


function closeInfoModal(){

  profileModal.classList.add("hidden");

}

const cont = document.getElementById("course-content");
console.log(cont);
function updateContent(){
    console.log(cont.value);
   if(cont.value === "video"){
      document.getElementById("video-container").classList.remove("hidden");
      document.getElementById("document-container").classList.add("hidden");
   }
   else if(cont.value === "document"){
    document.getElementById("video-container").classList.add("hidden");
    document.getElementById("document-container").classList.remove("hidden");
   }
}

</script>



<script src="../src/assets/js/script.js?v=<?php echo time(); ?>"></script>
    
</body>
</html>