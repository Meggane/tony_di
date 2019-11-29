require('../css/style.css');

$(document).ready(function(){
    $('#title_index img').animate({
        left: '42%',
        width: "+=100px"
    }, 1000)
        .animate({
            width: "-=100px",
        }, 500);
    $("#emoji_index img").animate({
        opacity: "1",
        width: "+=30px"
    }, 1000)
        .animate({
            width: "-=30px"
        }, 500);
});