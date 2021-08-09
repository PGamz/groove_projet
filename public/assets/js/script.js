///////// MENU BURGUER ///////////////////////////
const navSlide = () => {
    const burguer = document.querySelector(".burguer");
    const nav = document.querySelector(".nav-links");
    const navLinks = document.querySelectorAll("header .nav-links li");
    burguer.addEventListener("click", () => {
        nav.classList.toggle("nav-active");
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = "";
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards  ${index / 7 + 0.5}s`;
            }
        });
        burguer.classList.toggle("toggle");

    });
           
   };
navSlide();




///////// DELETE CONFIRMATION MODAL///////////////////////////

const openModal = document.getElementById("openModal");

openModal.onclick = function(){
    modal.style.display="block";
}


const modal = document.getElementById("del");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    
};

