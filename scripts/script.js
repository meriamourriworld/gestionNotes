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

    //Professeur without account
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


    //Étudiants without account
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

    /*****************************MATIERES************************************ */
     //MATIERE grid
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
    /*****************************CLASSES************************************ */
     //CLASSE grid
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

    /*****************************PROFESSEURS************************************ */

     //PROFESSEUR grid
     $("#jsGridProfesseurs").jsGrid({
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
        deleteConfirm: "Voulez-vous vraiment archiver ce professeur ?",
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
                            console.log("success");
                            $("#jsGridProfesseurs").jsGrid("loadData");
                    }
            });
            },
            updateItem: function(item)
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
                    type: "PUT",
                    url: "fetchProfesseurs.php",
                    contentType: false,
                    processData: false,
                    data: formData
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
            { name: "adresseProf", title: "ADRESSE", type: "textarea", width: "auto"},
            { name: "mailProf", title: "MAIL", type: "text", width: "auto"},
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
                },
                editTemplate: function() {
                    var editControl = document.createElement("input");
                    editControl.setAttribute("type", "file");
                    editControl.setAttribute("id", "photoProf");
                    return editControl;
                },
                editValue: function(value, item) {
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

            { type: "control", width: "100px"}
        ]
    });
});
