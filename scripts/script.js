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
if($("#jsFrid"))      
{
    $("#jsGrid").jsGrid({
        width: "60%", 
        inserting: true,
        sorting: true,
        editing: true,
        filtering: true,
        paging: true,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer cet enregistrement?",
 
        fields: [
            { name: "idUser", type: "text", width: "auto", visible: false },
            { name: "Identifiant", type: "text", width: "auto", validate: "required"},
            { name: "Role", type: "select", items: ["", "professeur", "etudiant"], validate: "required",
            validate: function(value)
            {
                if(value != 0) return true;
            }
            },
            { name: "Nom", type: "text", width: "auto", editing: false, inserting: false},
            { name: "Prenom", type: "text", width: "auto", editing: false, inserting: false},
            // { name: "Nom", type: "select", items: countries, valueField: "Id", textField: "Name" },
            // { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            { type: "control", width: "auto"}
        ]
    });
}
