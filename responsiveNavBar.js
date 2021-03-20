
function navSlide() {

const burger = document.querySelector('.burger');
const nav = document.querySelector('.navbar ul');
const navLinks = document.querySelectorAll('.navbar ul li')

burger.addEventListener('click', () =>{
    //toggle nav
    nav.classList.toggle('nav-active');

    //animate links
    navLinks.forEach((link ,index) => {
        if (link.style.animation){
            link.style.animation = ' ';
        } else{
        link.style.animation = 'navLinkFade 0.5s ease forwards ${index / 5 + 1.5}s';
        }
    });

    //burger animation
    burger.classList.toggle('toggle');
});

}

navSlide();
// {/* console.log("tushar nav bar"); */}


