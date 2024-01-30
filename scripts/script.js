//Mark the notifications as read on click on bell icon
const notifBell = document.getElementById("notifications");

notifBell.addEventListener("click", ()=>
{
    notifBell.style.setProperty("--color", "transparent");
});

//Managing settings student click
const settings = document.querySelector(".setting");

settings.addEventListener("click", ()=>
{
    const settingWindow = document.querySelector(".settingWindow");
    settingWindow.classList.toggle("display");
});

//Info card to show details about the course
const btns = document.querySelectorAll(".matiereHoraire svg");
btns.forEach((element,index) => {
    element.addEventListener("click", ()=>
    {
        const popup = document.querySelectorAll(".matiereHoraireDetails")[index];
        popup.classList.toggle("display");
    
    });
});