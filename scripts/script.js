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
        width: "45%", 
        height: "60vh",
        inserting: true,
        sorting: true,
        editing: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer cet enregistrement?",
        controller:{
            loadData: function()
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchAccounts.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                return $.ajax({
                    type: "POST",
                    url: "fetchAccounts.php",
                    data: item
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchAccounts.php",
                    data: item
                });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchAccounts.php",
                    data: item
                });
            }
        },
        fields: [
            { name: "idUser", type: "text", width: "auto", visible: false },
            { name: "identifiant", type: "text", title:"IDENTIFIANT", width: "100px",
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "motPasse", title:"Mot Passe", type: "text", width: "80px", editing: false, validate: "required" },
            { name: "role", type: "text", title: "RÔLE",
              validate:{
                    validator: function(value){
                        return /^(professeur|etudiant)$/.test(value);
                    },
                    message: function(){return "Le rôle doit être soit: professeur OU etudiant !";}
                }
            },
            { name: "nom",title: "NOM", type: "text", width: "auto", editing: false, inserting: false},
            { name: "prenom", title: "PRÉNOM", type: "text", width: "auto", editing: false, inserting: false},
            { type: "control", width: "100px"}
        ]
    });
});
