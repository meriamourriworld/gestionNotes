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
})