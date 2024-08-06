console.log("Hello world.");
let sections = document.querySelectorAll(".page_section");
let navContainer = document.querySelector(".admin_nav_container");
let menuBar = document.querySelector(".menu_bar");
let menuBtns = document.querySelectorAll(".menu_btn");
let menuText = document.querySelectorAll(".menu_text");
let deleteBtns = document.querySelectorAll(".delete_btn");
const overviewBtn = document.querySelector(".overview_btn");
let users = document.querySelector(".users_btn");
let users_view = document.querySelector(".users_overview_card");
let songs = document.querySelector(".songs_btn");
let songs_view = document.querySelector(".songs_overview_card");
let songsInfo = document.querySelector(".songs_info");
let services = document.querySelector(".services_btn");
let services_view = document.querySelector(".services_overview_card");
let equipments = document.querySelector(".eqipments_btn");
let equipments_view = document.querySelector(".equipments_overview_card");
let sessions = document.querySelector(".sessions_btn");
let sessions_view = document.querySelector(".sessions_overview_card");
let reviews = document.querySelector(".reviews_btn");
let reviews_view = document.querySelector(".reviews_overview_card");
let searchBtn = document.querySelector(".search_btn");

/*toggle menu*/
function adminMenu() {
  menuBar.classList.toggle("menu_bar_font_size");
  menuText.forEach((item) => {
    /*item.classList.toggle("show");
    item.classList.toggle("menu_bar_font_size");*/
  });

  navContainer.classList.toggle("admin_nav_container_width");
}

const screenWidth = screen.width;
if(screenWidth > 600){
  adminMenu();
}

//display Content
function changeDisplay(targetBtnClass, targetSect){
  
  function changeActiveStatus(targetBtnClass){
    menuBtns.forEach(item =>{
        if(item.classList.contains(targetBtnClass)){
          item.classList.add("activeBtn");
        }
        else{
          item.classList.remove("activeBtn");
        }
    });
  }

  function changeSection(targetSect){
    sections.forEach( sec =>{
      if(sec.classList.contains(targetSect)){
        sec.style.display = "block";
      }
      else{
        sec.style.display = "none";
      }
    });
    // targetSect.style.display= "none";
  }
  
  changeActiveStatus(targetBtnClass);
  changeSection(targetSect);
}

menuBar.addEventListener("click",adminMenu);

overviewBtn.addEventListener("click",()=>{ changeDisplay("overview_btn","overview_sec"); });
users.addEventListener("click",()=>{ changeDisplay("users_btn","users_sec"); });
users_view.addEventListener("click", ()=> {changeDisplay("users_btn","users_sec");});
songs.addEventListener("click",()=>{ changeDisplay("songs_btn","songs_sec"); });
searchBtn.addEventListener("click",()=>{ changeDisplay("songs_btn","songs_sec"); });
songs_view.addEventListener("click",()=>{ changeDisplay("songs_btn","songs_sec"); });
services.addEventListener("click",()=>{ changeDisplay("services_btn","services_sec"); });
services_view.addEventListener("click",()=>{ changeDisplay("services_btn","services_sec"); });
equipments.addEventListener("click",()=>{ changeDisplay("eqipments_btn","equipments_sec"); });
equipments_view.addEventListener("click",()=>{ changeDisplay("eqipments_btn","equipments_sec"); });
sessions.addEventListener("click",()=>{ changeDisplay("sessions_btn","sessions_sec"); });
sessions_view.addEventListener("click",()=>{ changeDisplay("sessions_btn","sessions_sec"); });
reviews.addEventListener("click",()=>{ changeDisplay("reviews_btn","reviews_sec"); });
reviews_view.addEventListener("click",()=>{ changeDisplay("reviews_btn","reviews_sec"); });

/*
deleteBtns.forEach( deleteBtn =>{
  deleteBtn.addEventListener("click",()=> {
    alert("Are you sure you want to delete?"); //confirm
  });
});*/

// printing functionality 
let printBtns = document.querySelectorAll(".print_btn");

printBtns.forEach((printBtn)=>{
printBtn.addEventListener('click', (event) => {
printReport();
setTimeout(function(){ window.close() },750);
});
});

function printReport() {
  window.print();
}