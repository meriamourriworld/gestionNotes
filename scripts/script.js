//Mark the notifications as read on click on bell icon
const notifBell = document.getElementById("notifications");

notifBell.addEventListener("click", ()=>
{
    notifBell.style.setProperty("--color", "transparent");
});

//Managing settings student click
const settings = document.querySelector(".setting");
if(settings)
{
    settings.addEventListener("click", ()=>
    {
        const settingWindow = document.querySelector(".settingWindow");
        settingWindow.classList.toggle("display");
    });
}

//Info card to show details about the course
const btns = document.querySelectorAll(".matiereHoraire svg");
if(btns)
{
    btns.forEach((element,index) => {
        element.addEventListener("click", ()=>
        {
            const popup = document.querySelectorAll(".matiereHoraireDetails")[index];
            popup.classList.toggle("display");
        
        });
    });
}

/****************************Liste des comptes utilisateurs avec JSGRID**********************************/ 

var clients = [
    { "idUser": "Otto Clay", "identifiant": 25, "role": 1},
    { "idUser": "sdfkbg", "identifiant": 255, "role": 2},
    { "idUser": "test", "identifiant": 122, "role": 2},
];

$( document ).ready(function() {
    $("#jsGrid").jsGrid({
        width: "40%", 
        inserting: true,
        sorting: true,
        editing: true,
        filtering: true,
        paging: true,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer cet enregistrement?",
        controller:{
            loadData: function()
            {
                return $.ajax({
                    type: "GET",
                    url: "fetch.php",
                    dataType: "json"
                });
            }
        },
        fields: [
            { name: "idUser", type: "text", width: "auto", visible: false },
            { name: "identifiant", type: "text", title:"IDENTIFIANT", width: "auto",
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "role", type: "text", title: "RÔLE",
                validate:{
                    validator: function(value){
                        return /^(professeur|etudiant)$/.test(value);
                    },
                    message: function(){return "Le rôle doit être soit: professeur OU etudiant !";}
                }
            },
            // { name: "Nom", type: "text", width: "auto", editing: false, inserting: false},items: ["", "professeur", "etudiant"]
            // { name: "Prenom", type: "text", width: "auto", editing: false, inserting: false},
            // { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            { type: "control", width: "100px"}
        ]
    });
});
