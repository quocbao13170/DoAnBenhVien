function openmenu(){
    document.querySelector(".bakabakaka").style.display = "inherit";
    document.querySelector(".v-nav").style.width = "12vw";
    document.querySelector(".wrapper").style.width = "87.1vw";
    document.querySelector(".close-menu").style.display = "inherit";
    document.querySelector(".open-menu").style.display = "none";
    document.querySelector(".icon-name1").style.display = "inherit";
    document.querySelector(".icon-name2").style.display = "inherit";
    document.querySelector(".icon-name3").style.display = "inherit";
    document.querySelector(".logo2").style.display = "inherit";
    
}
function closemenu(){
    document.querySelector(".bakabakaka").style.display = "none";
    document.querySelector(".v-nav").style.width = "4.3vw";
    document.querySelector(".wrapper").style.width = "94.8vw";
    document.querySelector(".close-menu").style.display = "none";
    document.querySelector(".open-menu").style.display = "inherit";
    document.querySelector(".icon-name").style.display = "none";
    document.querySelector(".icon-name1").style.display = "none";
    document.querySelector(".icon-name2").style.display = "none";
    document.querySelector(".icon-name3").style.display = "none";
    document.querySelector(".logo2").style.display = "none";
}

function loginform(){
    document.querySelector(".login-guess").style.display = "inherit";   
}

function openform(myVar){
    document.querySelector(".form-popup").style.display = "inherit";
    document.querySelector("#tag3tg").value = myVar;
}
function exitform(){
    document.querySelector(".form-popup").style.display = "none";
}
function formenable(){
    document.getElementById('tag0cn').disabled = false;
    document.getElementById('tag1k').disabled = false;
    document.getElementById('tag2bs').disabled = false;
    document.getElementById('tag3tg').disabled = false;
}


function pre2(){
    document.querySelector(".switch-button1").style.display = "none";
    document.querySelector(".switch-button2").style.display = "inherit";
    document.querySelector(".prediction2").style.transform = "translateX(0)";
    document.querySelector(".prediction").style.transform = "translateX(-100%)";
    
}
function pre1(){
    document.querySelector(".switch-button1").style.display = "inherit";
    document.querySelector(".switch-button2").style.display = "none";
    document.querySelector(".prediction2").style.transform = "translateX(100%)";
    document.querySelector(".prediction").style.transform = "translateX(0)";
    
}

function openprofile(){
    document.querySelector(".profile-window").style.transform = "translateY(0)";
    document.querySelector(".open-window").style.display = "none";
    document.querySelector(".close-window").style.display = "inherit";
}
function closeprofile(){
    document.querySelector(".profile-window").style.transform = "translateY(85%)";
    document.querySelector(".open-window").style.display = "inherit";
    document.querySelector(".close-window").style.display = "none";
}