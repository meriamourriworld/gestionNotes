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
        width: "60%", 
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
            { name: "idUser", type: "text", width: "auto" },
            { name: "identifiant", type: "text", width: "auto", validate: "required"},
            { name: "role", type: "select", items: ["", "professeur", "etudiant"], validate: "required",
            validate: function(value)
            {
                if(value != 0) return true;
            }
            },
            // { name: "Nom", type: "text", width: "auto", editing: false, inserting: false},
            // { name: "Prenom", type: "text", width: "auto", editing: false, inserting: false},
            // { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            { type: "control", width: "auto"}
        ]
    });
});
// $(document).ready(function() {
//     $("#jsGrid").jsGrid({
//         width: "100%",
//         filtering: true,
//         sorting: true,
//         paging: true,
//         autoload: true,
//         pageSize: 10,
//         pageButtonCount: 5,
//         deleteConfirm: "Voulez-vous vraiment supprimer cet enregistrement ?",
//         controller: {
//             loadData: function() {
//                 return $.ajax({
//                     type: "GET",
//                     data: clients,
//                     // url: "../gestionComptes.php", // Assurez-vous que le chemin d'accès est correct
//                     // dataType: "json", // Indiquez le type de données attendu du serveur
//                 });
//             }
//         },
//         fields: [
//             { name: "idUser", type: "text", width: 50, title: "ID Utilisateur" },
//             { name: "identifiant", type: "text", width: 100, title: "Identifiant" },
//             { name: "role", type: "text", width: 100, title: "Rôle" },
//             { type: "control", editButton: false, deleteButton: false } // Contrôles d'édition et de suppression
//         ]
//     });
// });