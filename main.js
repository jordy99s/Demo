const menu = document.querySelector('#mobile-menu')

const menuLinks = document.querySelector('.shopping-menu')

const header = document.querySelector('.shopping-navbar')

menu.addEventListener('click', function(){
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

//This fixes the navigation bar at the top of the page
window.addEventListener('scroll', function(){
    header.classList.toggle("sticky", window.scrollY > 0);
});

function cancelFunction(){
    window.location.href="index.php";
}
