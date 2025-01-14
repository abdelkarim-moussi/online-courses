<?php
session_start();
include_once "../classes/Admin.php";

// if(isset($_SESSION['userId'])){

//     if($_SESSION['urole'] === "student" || $_SESSION['urole'] === "visitor"){
//         header("Location: index.php");
//     }
//     elseif($_SESSION['urole'] === "teacher"){
//         header("Location: index.php");
//     }
// }
// else header("Location: login.php");
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

<body class="flex bg-[#F0F5F9] p-3 relative gap-5 overflow-auto">

<!-- <button id="menu-button" type="button" class="text-[#111C2D] z-20 px-1 rounded absolute top-5 left-6 hover:text-orange-500"><i class="fa-solid fa-bars text-xl"></i></button> -->
<section id="nav-bar" class="px-3 text-[#111C2D] w-[300px] bg-white notActive rounded-xl shadow-lg shadow-gray-400">
            <div class="flex items-center justify-center py-2 border-b-[1px] border-gray-300">
                <h4 class="text-blue-500 font-extrabold text-[1.1rem] mt-5">Online<span class="text-[#111C2D]">/Courses</span>
                </h4>
            </div>
            
            <div class="py-5 dach">
                <ul class="pl-2 flex flex-col gap-y-6">
                    <li class="toggeled-item text-sm font-bold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center active-btn" ><i class="fa-solid fa-gauge"></i><a data-id ="categories" href="#">Categories</a></li>
                    <li class="toggeled-item text-sm font-bold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center" ><i class="fa-solid fa-list-check"></i><a data-id ="addCategorie" href="#">Add Categorie</a></li>
                    <li class="toggeled-item text-sm font-bold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center" ><i class="fa-solid fa-users-gear"></i><a data-id ="teachers" href="#">Teachers</a></li>
                    <li class="toggeled-item text-sm font-bold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center" ><i class="fa-solid fa-users-gear"></i><a data-id ="students" href="#">Students</a></li>
                    <li class="toggeled-item text-sm font-bold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center" ><i class="fa-solid fa-list"></i><a data-id ="courses" href="#">Courses</a></li>
                    <li class="toggeled-item absolute w-[200px] bottom-5 text-sm font-semibold tracking-wide  hover:bg-blue-500 hover:text-white hover:rounded-md py-1 pl-2 flex gap-3 items-center" ><a href="../includes/logout.inc.php"><i class="fa-solid fa-sign-out"></i> logout</a></li>
                </ul>
            </div>
            
</section>
    
<main class="w-full main-section text-sm h-[100%] rounded-xl shadow-lg shadow-gray-400">

    <!-- categories -->
    <section class="w-full section text-[#111C2D] bg-white  sec1 categories active relative" id="categories">
        <div class="border-b pb-2 flex justify-between items-center mb-5">
            <h1 class="text-lg mb-5 capitalize">Disponible categories</h1>
            <button id="addnewcat" class="bg-blue-500 px-3 py-1 text-sm rounded-md shadow-md text-white capitalize hover:bg-blue-600">add new categorie</button>
        </div>

        <table class="w-full rounded-lg">
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
         $admin = new Admin();
         foreach($admin->showCategories() as $categorie){ ?>
            <tr>
              <td class="font-normal">
              <?php echo $categorie["categorie_id"]; ?>
              </td>
              <td class="font-normal">
                  <?php echo $categorie["categorie_name"]; ?>
              </td>
              <td class="font-normal">
              <?php foreach($admin->showCoursesNumByCat() as $numCourses){echo $numCourses["num"];} ?>
              </td>
              <td class="font-normal flex justify-center gap-3">
              <!-- <button id="open">up</button> -->
                <a href="javascript:void(0);" onclick="openModal('<?php echo $categorie['categorie_id'];?>','<?php echo $categorie['categorie_name'];?>','<?php echo $categorie['description'];?>')"  class="bg-orange-100 hover:bg-orange-200 rounded-md py-1 px-3">update</a>
                <a href="../includes/categorie.inc.php?idcat=<?php echo $categorie['categorie_id']; ?>" class="bg-red-100 hover:bg-red-200 rounded-md py-1 px-3">delete</i></a>
              </td>

            </tr>
            <?php } ?>
         
         </tbody>
        </table>

      <!-- update categorie -->
        <div class="w-full hidden bg-white dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 fixed top-5" id="updateCatModal">
            <img src="../public/assets/imgs/close.png" alt="" class="w-[30px] float-right m-3 cursor-pointer" onclick="closeModal()" id="closeUpCatModal">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                 Update categorie
              </h1>
    
            <form class="space-y-4 md:space-y-6" action="../includes/categorie.inc.php" method="post" id="">

                 <div>
                      <label for="cat-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">categorie name</label>
                      <input type="text" name="catName" id="catName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 </div>
                 <div>
                    <label for="cat-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">categorie description</label>
                    <textarea name="catDes" id="catDes" class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                 </div>

                    <input type="hidden" name="catId" id="catId">

                  <button type="submit" name="update-categorie" id="update-cat" class="w-full uppercase tracking-wide text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">update Categorie</button>
        
            </form>

          </div>
        </div>
    </section>



    <!-- Add Categorie section -->
    <section ction class="w-full section text-[#111C2D] bg-white sec2" id="addCategorie">

        <h1 class="text-lg mb-5 border-b pb-5 capitalize">Add new categorie</h1>
        <form class="space-y-4 md:space-y-6" action="../includes/categorie.inc.php" method="post" id="signup-form" enctype="multipart/form-data">
                 <div>
                      <label for="cat-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">categorie name</label>
                      <input type="text" name="cat-name" id="cat-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="categorie example">
                  </div>
                 <div>
                    <label for="cat-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">categorie description</label>
                    <textarea name="cat-description" id="cat-description" class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="categorie..."></textarea>
                    <div class="error text-sm text-red-600"></div>
                </div>
                
                  <button type="submit" name="add-categorie" id="add-categorie" class="w-full uppercase tracking-wide text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Categorie</button>
        
        </form>
    </section>

    <!-- Teachers list -->
    <section class="w-full section text-[#111C2D] bg-white sec3" id="teachers">
        <h1 class="text-lg mb-5 border-b pb-5 capitalize">Disponible Teachers</h1>

        <table class="w-full rounded-lg">
            <thead>
                <tr class="text-[#686a6d] capitalize">
                <th class="font-normal">Teacher Id</th>
                <th class="font-normal">Teacher name</th>
                <th class="font-normal">Email</th>
                <th class="font-normal">Courses</th>
                </tr>
            </thead>

            <tbody>
            
            <?php 
            $admin = new Admin();
            foreach($admin->showUsersByRole("teacher") as $user){ ?>
            <tr>
                <td class="font-normal">
                    <?php echo $user["user_id"]; ?>
                </td>
                <td class="font-normal">
                <?php echo $user["firstname"] ." ".$user["lastname"]; ?>
                </td>
                <td class="font-normal">
                <?php echo $user["email"]; ?>
                </td>
                <?php foreach($admin->calcCoursesForUser($user["user_id"]) as $coursesNum){ ?>
                <td class="font-normal">
                    <?php echo $artNum["numar"] ?>
                </td>
                <?php } ?>

            </tr>
            <?php } ?>
            
            </tbody>
        </table>

    </section>

    <!-- Students List -->
    <section class="w-full section text-[#111C2D] bg-white sec4" id="students">
        
    </section>


    <!-- Courses -->
    <section class="w-full section text-[#111C2D] bg-white sec5" id="courses">
        <h1>courses list</h1>
    </section>
    

</main>








<script>

const catModal = document.getElementById("updateCatModal");
var catId;
var catName;
var catDesc;
function openModal(catId,catName,catDesc){

   catModal.classList.remove("hidden");

   document.getElementById("catName").value = catName;
   document.getElementById("catDes").textContent = catDesc;
   document.getElementById("catId").value = catId;

}

const toggledItems = document.querySelectorAll(".toggeled-item");
const sections = document.querySelectorAll("section");
const globalSection = document.querySelector("body");

   for(let i = 0; i < toggledItems.length; i++){
       toggledItems[i].addEventListener("click", function (){
           let curentSection = document.querySelectorAll(".active-btn");
           curentSection[0].classList.remove("active-btn")
           this.className += " active-btn";
       })
   }

   globalSection.addEventListener('click',(e)=>{
    
     const id = e.target.dataset.id;

      if(id){
        
        toggledItems.forEach(item=>{
           item.classList.remove("active");
        })

        sections.forEach(section=>{
           section.classList.remove("active");
        })
        // e.target.classList.add("active");

        let element = document.getElementById(id);
        element.classList.add("active");
        console.log(element);
        
      }
   })
 

</script>


<script src="../src/assets/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>