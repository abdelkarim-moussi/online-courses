const menuButton = document.getElementById("menu-button");
const navBar = document.getElementById("nav-bar");
const icon = document.querySelector(".fa-solid")
const toggledItems = document.querySelectorAll(".toggeled-item");
const sections = document.querySelectorAll("section");
const globalSections = document.querySelector("body")
const addnewCatBtn = document.getElementById("addnewcat");
const addnewArtBtn = document.getElementById("addnewart");

const closeUpCatModal = document.getElementById("closeUpCatModal");

const open = document.getElementById("open");



function sectionSwitch(){
   for(let i = 0; i < toggledItems.length; i++){
       toggledItems[i].addEventListener("click", function (){
           let curentSection = document.querySelectorAll(".active-btn");
           curentSection[0].classList.remove("active-btn")
           this.className += " active-btn";
       })
   }

   globalSections.addEventListener('click',(e)=>{
    
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
 

}
sectionSwitch();


function addNewCategorie(){

   document.getElementById("addCategorie").classList.remove("hidden");
   document.getElementById("categories").classList.add("hidden");
   console.log("clicked");

}



