import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');



/*if (document.title == "Register") {

    
let typeUser = document.querySelector("#typeUser");
let formInscription = document.querySelector("#formInscription");
let formChild = document.querySelectorAll(".formChild");





formInscription.style.display = "none";

formChild.forEach(
    (elem)=>{
        //console.log(elem);
        elem.parentNode.style.display = "none";
        
     }
);


typeUser.addEventListener("change", (event)=>{
    
    
    let valueSelectType = typeUser.value;
    console.log(valueSelectType);
    
    //Transformation de la variable en cookie pour l'enoyer du coté php
    document.cookie = "userType = "+ valueSelectType; 

switch (valueSelectType) {
  
    case "recruteur":
        
        formInscription.style.display = "block";
        formChild.forEach(
            (elem)=>{
                //console.log(elem);
                elem.parentNode.style.display = "none";

                document.querySelector("#registration_form_nom").parentNode.style.display = "block";
                document.querySelector("#registration_form_prenom").parentNode.style.display = "block";
                document.querySelector("#registration_form_date_naissance").parentNode.style.display = "block";
                document.querySelector("#registration_form_telephone").parentNode.style.display = "block";
                document.querySelector("#registration_form_email").parentNode.style.display = "block";
                document.querySelector("#registration_form_photo").parentNode.style.display = "block";
                document.querySelector("#registration_form_adresse").parentNode.style.display = "block";
                document.querySelector("#registration_form_entreprise").parentNode.style.display = "block";
                document.querySelector("#registration_form_presentation").parentNode.style.display = "block";

            }
        );

        break;
    case "candidat":
        formInscription.style.display = "block";
        formChild.forEach(
            (elem)=>{
                //console.log(elem);
                elem.parentNode.style.display = "none";

                document.querySelector("#registration_form_nom").parentNode.style.display = "block";
                document.querySelector("#registration_form_prenom").parentNode.style.display = "block";
                document.querySelector("#registration_form_date_naissance").parentNode.style.display = "block";
                document.querySelector("#registration_form_adresse").parentNode.style.display = "block";
                document.querySelector("#registration_form_telephone").parentNode.style.display = "block";
                document.querySelector("#registration_form_email").parentNode.style.display = "block";
                document.querySelector("#registration_form_date_naissance").parentNode.style.display = "block";
                document.querySelector("#registration_form_photo").parentNode.style.display = "block";
                document.querySelector("#registration_form_presentation").parentNode.style.display = "block";
            }
        );
       
        break;

    case "partenaire":
            formInscription.style.display = "block";
            formChild.forEach(
                (elem)=>{
                    elem.parentNode.style.display = "none";

                    document.querySelector("#registration_form_nom").parentNode.style.display = "block";
                    document.querySelector("#registration_form_prenom").parentNode.style.display = "block";
                    document.querySelector("#registration_form_adresse").parentNode.style.display = "block";
                    document.querySelector("#registration_form_telephone").parentNode.style.display = "block";
                    document.querySelector("#registration_form_email").parentNode.style.display = "block";
                    document.querySelector("#registration_form_logo").parentNode.style.display = "block";
                    document.querySelector("#registration_form_presentation").parentNode.style.display = "block";
                    document.querySelector("#registration_form_site_web").parentNode.style.display = "block";
                    document.querySelector("#registration_form_date_naissance").parentNode.readOnly = true;
                }
            );
            
        break;
    default:
        formInscription.style.display = "none";
        break;
   }
    
})

}


/*if (document.title == "New PublicaOffre") {
    
    //creation de la condition d'affichage de  la duree de contrant en CDD
    let typeContrat = document.getElementById("publica_offre_typeContrat");
    let dureeCdd = document.getElementById("publica_offre_duree");
    let addCat = document.querySelector("#addCat");
    let category = document.querySelector('#category')

    //console.log(addCat);
    //console.log(typeContrat);

    typeContrat.addEventListener("change", ()=>{

        //console.log(typeContrat.value);

        if (typeContrat.value == "1") { //pour value = CDD
            dureeCdd.parentNode.style.display = "none";
            dureeCdd.value = "";
        }else{ //pour value = CDD
            dureeCdd.parentNode.style.display = "block";
        }
 })

category.style.display = "none"
 addCat.addEventListener("click", ()=>{
    category.style.display = "none"
 })


}*/

