function show_alert(flag, message)
{
    var rand = Math.floor(Math.random() * 1000) + 1;
    console.log(rand);
    console.log(flag);
    console.log(message);
    var class_flag = "";
    if(flag) class_flag = "success";
    else class_flag = "danger";

    $("#alert_area").append("<div class='alert alert-" + class_flag + "' role='alert' id='alert-" + rand + "'>" + message + "</div>");
    $("#alert-" + rand).fadeTo(3000, 2000).slideUp(2000, function(){
        $("#alert-" + rand).slideUp(2000);
    });
}

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 350) {
        document.getElementById("top_button").style.display = "block";
    } else {
        document.getElementById("top_button").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}