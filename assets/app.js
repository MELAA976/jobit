import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

let typeUser = document.querySelector("#typeUser");
let formInscription = document.querySelector("#formInscription");
let formChild = document.querySelectorAll(".formChild");
console.log(formChild);



formInscription.style.display = "none";
formChild.forEach(
    (elem)=>{
        //console.log(elem);
        elem.parentNode.style.display = "none";
        
    }
);

typeUser.addEventListener("change", (event)=>{
    
    let valueSelectType = event.target.value;
   
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

