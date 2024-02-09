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

$( document ).ready(function() {
    //acounts grid
    if($("#jsGrid").length >0)
    {
    $("#jsGrid").jsGrid({
        width: "90%", 
        height: "40vh",
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
            { name: "idUser", type: "text",title:"ID", width: "auto",inserting: false ,editing: false},
            { name: "identifiant", type: "text", title:"IDENTIFIANT", width: "auto",
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "motPasse", title:"Mot Passe", type: "text", width: "auto", editing: false, validate: "required" },
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
    }
    //Professeur without account
    if($("#profSansComptes").length >0)
    {
    $("#profSansComptes").jsGrid({
        width: "100%", 
        height: "40vh",
        inserting: false,
        deleting: false,
        sorting: true,
        editing: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        controller:{
            loadData: function()
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchPrAccounts.php",
                    dataType: "json"
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchPrAccounts.php",
                    data: item
                });
            },
        },
        fields: [
            { name: "id", type: "text", width: "auto", visible: false },
            { name: "idProf", type: "text", title:"ID", width: "auto", editing: false},
            { name: "nomProf", type: "text", title:"NOM", width: "100px", editing: false},
            { name: "prenomProf", type: "text", title:"PRÉNOM", width: "100px", editing: false},
            { name: "matiere", type: "text", title:"MATIÈRE", width: "100px", editing: false},
            { name: "profil", type: "text", title:"PROFIL", width: "100px"},
            { type: "control", width: "100px", deleteButton: false}
        ]
    });
    }

    //Étudiants without account
    if($("#etudSansComptes").length >0)
    {
    $("#etudSansComptes").jsGrid({
        width: "100%", 
        height: "40vh",
        inserting: false,
        deleting: false,
        sorting: true,
        editing: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        controller:{
            loadData: function()
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchStAccounts.php",
                    dataType: "json"
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchStAccounts.php",
                    data: item
                });
            },
        },
        fields: [
            { name: "id", type: "text", width: "auto", visible: false },
            { name: "cne", type: "text", title:"CNE", width: "auto", editing: false},
            { name: "nomEtud", type: "text", title:"NOM", width: "auto", editing: false},
            { name: "prenomEtud", type: "text", title:"PRÉNOM", width: "auto", editing: false},
            { name: "classe", type: "text", title:"CLASSE", width: "auto", editing: false},
            { name: "profil", type: "text", title:"PROFIL", width: "auto"},
            { type: "control", width: "100px", deleteButton: false}
        ]
    });
    }
    /*****************************MATIERES************************************ */
     //MATIERE grid
     if($("#jsGridMatieres").length >0)
    {
     $("#jsGridMatieres").jsGrid({
        width: "90%", 
        height: "75vh",
        inserting: true,
        sorting: true,
        editing: true,
        deleting: true,
        filtering: true,
        paging: true,
        pageSize: 3,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer cette Matière?",
        controller:{
            loadData: function()
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchMatieres.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                return $.ajax({
                    type: "POST",
                    url: "fetchMatieres.php",
                    data: item
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchMatieres.php",
                    data: item
                });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchMatieres.php",
                    data: item
                });
            }
        },
        fields: [
            { name: "id", type: "text", width: "auto",visible: false},
            { name: "idMat", title: "ID", type: "text", width: "auto", editing:false,
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "nomMat", title: "TITRE", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs Titre est obligatoire!";}
            }
            },
            { name: "objectifMat", title: "OBJECTIF", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs objectif est obligatoire!";}
            }
            },
            { name: "coefMat", title: "COEFFICIENT", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs coefficient est obligatoire!";}
            }
            },
            { type: "control", width: "100px"}
        ]
    });
}
    /*****************************CLASSES************************************ */
     //CLASSE grid
     if($("#jsGridClasses").length >0)
     {
     $("#jsGridClasses").jsGrid({
        width: "90%", 
        height: "75vh",
        inserting: true,
        sorting: true,
        editing: true,
        deleting: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer cette Classe?",
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchClasses.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                return $.ajax({
                    type: "POST",
                    url: "fetchClasses.php",
                    data: item
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchClasses.php",
                    data: item
                });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchClasses.php",
                    data: item
                });
            }
        },
        fields: [
            { name: "id", type: "text", width: "auto",visible: false},
            { name: "idClasse", title: "ID", type: "text", width: "auto", editing:false,
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "nomClasse", title: "LIBELLÉ", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs Libellé est obligatoire!";}
            }
            },
            { name: "nbEtudiants", title: "NB ÉTUDIANTS", type: "number", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs Nombre étudiants est obligatoire et doit être un nombre!";}
            }
            },
            { name: "niveauClasse", title: "NIVEAU", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs niveau est obligatoire!";}
            }
            },
            { name: "descClasse", title: "DESCRIPTION", type: "text", width: "auto"},
            { type: "control", width: "100px"}
        ]
    });
     }
    /*****************************PROFESSEURS************************************ */
     //PROFESSEUR grid
     if($("#jsGridProfesseurs").length >0)
     {
     $("#jsGridProfesseurs").jsGrid({
        width: "100%", 
        height: "75vh",
        inserting: true,
        sorting: true,
        editing: false,
        deleting: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment archiver ce professeur ?",
        rowClick: function(args) { 
            window.location.href= "modifierProfesseur.php?idProf='"+ args.item.idProf +"'";
        },
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchProfesseurs.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                var formData = new FormData();
                formData.append("idProf", item.idProf);
                formData.append("nomProf", item.nomProf);
                formData.append("prenomProf", item.prenomProf);
                formData.append("dateNaissance", item.dateNaissance);
                formData.append("adresseProf", item.adresseProf);
                formData.append("mailProf", item.mailProf);
                formData.append("telProf", item.telProf);
                formData.append("photoProf", item.photoProf);
                formData.append("matiere", item.matiere);
                formData.append("profil", item.profil);
                return $.ajax({
                    type: "POST",
                    url: "fetchProfesseurs.php",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        $("#jsGridProfesseurs").jsGrid("loadData");
                    }
            });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchProfesseurs.php",
                    data: item
                });
            }
        },

        fields: [
            { name: "id", type: "text", width: "auto",visible: false},
            { name: "idProf", title: "ID", type: "text", width: "auto", editing:false,
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "nomProf", title: "NOM", type: "text", width: "auto"},
            { name: "prenomProf", title: "PRÉNOM", type: "text", width: "auto"},
            { name: "dateNaissance", title: "NAISSANCE", type: "text", width: "auto"},
            { name: "adresseProf", title: "ADRESSE", type: "textarea", width: "200px"},
            { name: "mailProf", title: "MAIL", type: "text", width: "100px"},
            { name: "telProf", title: "TÉLÉPHONE", type: "text", width: "auto"},
            { name: "photoProf", title: "PHOTO", type: "imageUploader", width: "200px", align: "center",editing: true,
                itemTemplate: function(value, item) {
                    if(value != null) return '<img src="data:image/png;base64,' + value + '" width="45" height="45">';
                    else return "";
                },
               insertTemplate: function() {
                    var editControl = document.createElement("input");
                    editControl.setAttribute("type", "file");
                    editControl.setAttribute("id", "photoProf");
                    return editControl;
                },
                insertValue: function(value, item) {
                    if(document.getElementById('photoProf'))
                    {
                        var fileInput = document.getElementById('photoProf');
                        var file = fileInput.files[0];
                        return file;
                    }
                }
            },
            { name: "matiere", title: "MATIÈRE", type: "text", width: "auto"},
            { name: "profil", title: "PROFIL", type: "number", width: "auto"},

            { type: "control", width: "100px", editButton: false}
        ]
    });
     }
        /*****************************ETUDIANTS************************************ */
     //ETUDIANT grid
     if($("#jsGridEtudiants").length >0)
     {
     $("#jsGridEtudiants").jsGrid({
        width: "100%", 
        height: "75vh",
        inserting: true,
        sorting: true,
        editing: false,
        deleting: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment archiver cet étudiant ?",
        rowClick: function(args) { 
            window.location.href= "modifierEtudiant.php?cne='"+ args.item.cne +"'";
        },
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchEtudiants.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                var formData = new FormData();
                formData.append("cne", item.cne);
                formData.append("nomEtud", item.nomEtud);
                formData.append("prenomEtud", item.prenomEtud);
                formData.append("dnEtud", item.dnEtud);
                formData.append("adresseEtud", item.adresseEtud);
                formData.append("mailEtud", item.mailEtud);
                formData.append("telEtud", item.telEtud);
                formData.append("photoEtud", item.photoEtud);
                formData.append("classe", item.classe);
                formData.append("profil", item.profil);
                return $.ajax({
                    type: "POST",
                    url: "fetchEtudiants.php",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        $("#jsGridEtudiants").jsGrid("loadData");
                    }
            });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchEtudiants.php",
                    data: item
                });
            }
        },

        fields: [
            { name: "id", type: "text", width: "auto",visible: false},
            { name: "cne", title: "CNE", type: "text", width: "auto", editing:false,
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "nomEtud", title: "NOM", type: "text", width: "auto"},
            { name: "prenomEtud", title: "PRÉNOM", type: "text", width: "auto"},
            { name: "dnEtud", title: "NAISSANCE", type: "text", width: "auto"},
            { name: "adresseEtud", title: "ADRESSE", type: "textarea", width: "200px"},
            { name: "mailEtud", title: "MAIL", type: "text", width: "100px"},
            { name: "telEtud", title: "TÉLÉPHONE", type: "text", width: "auto"},
            { name: "photoEtud", title: "PHOTO", type: "imageUploader", width: "200px", align: "center",editing: true,
                itemTemplate: function(value, item) {
                    if(value != null) return '<img src="data:image/png;base64,' + value + '" width="45" height="45">';
                    else return "";
                },
               insertTemplate: function() {
                    var editControl = document.createElement("input");
                    editControl.setAttribute("type", "file");
                    editControl.setAttribute("id", "photoEtud");
                    return editControl;
                },
                insertValue: function(value, item) {
                    if(document.getElementById('photoEtud'))
                    {
                        var fileInput = document.getElementById('photoEtud');
                        var file = fileInput.files[0];
                        return file;
                    }
                }
            },
            { name: "classe", title: "CLASSE", type: "text", width: "auto"},
            { name: "profil", title: "PROFIL", type: "number", width: "auto"},

            { type: "control", width: "100px", editButton: false}
        ]
    });
}

   /*****************************Devoirs************************************ */
     //Devoirs grid
     if($("#jsGridDevoirs").length >0)
     {
     $("#jsGridDevoirs").jsGrid({
        width: "90%", 
        height: "75vh",
        inserting: true,
        sorting: true,
        editing: true,
        deleting: true,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        deleteConfirm: "Voulez-vous vraiment supprimer ce Devoir ?",
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchDevoirs.php",
                    dataType: "json"
                });
            },
            insertItem: function(item)
            {
                return $.ajax({
                    type: "POST",
                    url: "fetchDevoirs.php",
                    data: item
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchDevoirs.php",
                    data: item
                });
            },
            deleteItem: function(item)
            {
                return $.ajax({
                    type: "DELETE",
                    url: "fetchDevoirs.php",
                    data: item
                });
            }
        },
        fields: [
            { name: "idDev", title: "ID", type: "text", width: "auto", editing:false,
                validate:{
                    validator: "required",
                    message: function(){return "Le champs identifiant est obligatoire!";}
                }
            },
            { name: "titreDev", title: "TITRE", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "Le champs TITRE est obligatoire!";}
            }
            },
            { name: "descDev", title: "DESCRIPTION", type: "textarea", width: "auto"},
            { name: "dateEcheance", title: "Date Échéance", type: "text", width: "auto",
            validate:{
                validator: "required",
                message: function(){return "La date d'échéance est obligatoire !";}
            }
            },
            { type: "control", width: "100px"}
        ]
    });
     }

        /*****************************NOTES************************************ */
     //Notes grid
     if($("#jsGridNotes").length >0)
     {
     $("#jsGridNotes").jsGrid({
        width: "100%", 
        height: "50vh",
        inserting: false,
        sorting: true,
        editing: true,
        deleting: false,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchNotes.php",
                    dataType: "json"
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchNotes.php",
                    data: item,
                    success: function(response) {
                        $("#jsGridNotes").jsGrid("loadData");
                        $("#jsGridNotesEtudiants").jsGrid("loadData");
                    }
                });
            },
        },
        fields: [
            { name: "cne", title: "CNE", type: "text", width: "auto", editing:false},
            { name: "nomEtud", title: "NOM", type: "text", width: "auto", editing:false},
            { name: "prenomEtud", title: "PRÉNOM", type: "text", width: "auto", editing:false},
            { name: "classe", title: "CLASSE", type: "text", width: "auto", editing:false},
            { name: "note", title: "NOTE", type: "text", width: "auto", validate: "required"},
            { type: "control", width: "100px", deleteButton: false, insertButton: false}
        ]
    });
     }

       /*****************************NOTES/ETUDIANTS/DEVOIRS************************************ */
     //Notes/etudiant/devoir grid
     if($("#jsGridNotesEtudiants").length >0)
     {
     $("#jsGridNotesEtudiants").jsGrid({
        width: "90%", 
        height: "50vh",
        inserting: false,
        sorting: true,
        editing: true,
        deleting: false,
        filtering: true,
        paging: true,
        pageSize: 5,
        autoload: true,
        controller:{
            loadData: function(filter)
            {
                return $.ajax({
                    type: "GET",
                    url: "fetchNotesDevoirs.php",
                    dataType: "json"
                });
            },
            updateItem: function(item)
            {
                return $.ajax({
                    type: "PUT",
                    url: "fetchNotesDevoirs.php",
                    data: item,
                    success: function(response) {
                        $("#jsGridNotesEtudiants").jsGrid("loadData");
                    }
                });
            },
        },
        fields: [
            { name: "etudiant", title: "CNE", type: "text", width: "auto", editing:false},
            { name: "devoir", title: "DEVOIR", type: "text", width: "auto", editing:false},
            { name: "note", title: "NOTE", type: "text", width: "auto", validate: "required"},
            { type: "control", width: "100px", deleteButton: false, insertButton: false}
        ]
    });
     }
});
