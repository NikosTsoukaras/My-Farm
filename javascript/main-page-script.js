

//Sticky nav bar
window.onscroll = function(){
    var height = window.scrollY;
    var nav = document.getElementsByClassName("js--sticky-nav");

    
    if (height > 816){
        nav[0].classList.remove("display-none");
        nav[0].classList.remove("fadeOut");
    } 

    if (height < 816 && !nav[0].classList.contains("display-none")) {
        nav[0].classList.add("fadeOut");
        setTimeout(function() {
            nav[0].classList.add("display-none");
        }, 200);
    }
};