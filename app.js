const menu = document.querySelector('#mobile-menu')
const menuLinks = document.querySelector('.shopping-menu')
const LinksMenu = document.querySelector('.navbar-menu')

const header = document.querySelector('.navbar')

menu.addEventListener('click', function(){
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
    LinksMenu.classList.toggle('active');
});


//This fixes the navigation bar at the top of the page
window.addEventListener('scroll', function(){
    header.classList.toggle("sticky", window.scrollY > 0);
});


// PRODUCT PAGE


//ANIMACION DEL SLIDER
 onload = start;

 function start(){
     var i = 1;
     function Move(){
         i = (i%6)+1 //Cambiar el numero 4 por la cantidad real de imagenes en el slider
         document.getElementById('i'+i).checked = true;
     }
     setInterval(Move,3000) //3000 = 3s
 }