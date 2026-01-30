$(document).ready(function(){
    const hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', function() {
        this.classList.toggle('is-active');
        // toggle visibility of the navigation menu
        document.querySelector('.mobileLinks').classList.toggle('is-active'); 
    });
});