///////// MENU ASIDE BURGUER ///////////////////////////
const asideSlide = () => {
    const burguer = document.querySelector(".asideburguer");
    const nav = document.querySelector(".aside-links");
    const navLinks = document.querySelectorAll(".aside-links li");
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
asideSlide();