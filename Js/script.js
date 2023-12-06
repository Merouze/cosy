
// ************Navbar**************************



// Sélectionnez le menu burger et le menu mobile
const menuToggle = document.querySelector('.menu-toggle');
const mobileMenu = document.querySelector('#mobile-menu');

// Ajoutez un gestionnaire d'événement au menu burger pour basculer la visibilité du menu mobile
menuToggle.addEventListener('click', () => {
  if (mobileMenu.style.display === 'block') {
    mobileMenu.style.display = 'none'; // Cache le menu mobile
  } else {
    mobileMenu.style.display = 'block'; // Affiche le menu mobile
  }
});




// *****************************FormLocalStotrage*********************

// document.addEventListener("DOMContentLoaded", function () {
//   const form = document.querySelector(".form");

//   form.addEventListener("submit", function (e) {
//     e.preventDefault(); // Empêche l'envoi par défaut du formulaire

//     // Récupérer les valeurs des champs en utilisant les IDs
//     const name = document.querySelector("#inputName").value;
//     const email = document.querySelector("#inputEmail").value;
//     const phoneNumber = document.querySelector("#inputNumber").value;
//     const message = document.querySelector("#commentaire").value;
//     const dateIn = document.querySelector("#dateIn").value;
//     const dateOut = document.querySelector("#dateOut").value;
//     const numberNight = document.querySelector("#inputNumberNight").value;
//     const checkData = document.querySelector("#check").checked;
//     const housingChoice = document.querySelector("#input-choice").value;
//     // Créer un objet contenant les données
//     const formData = {
//       dateIn,
//       dateOut,
//       numberNight,
//       name,
//       email,
//       phoneNumber,
//       message,
//       checkData,
//       housingChoice,
//     };
//     // Stocker les données dans le Local Storage
//     localStorage.setItem("formData", JSON.stringify(formData));
//     // Afficher un message de confirmation dans la console
//     console.log("Données stockées dans le Local Storage");
//     // Réinitialiser le formulaire après stockage des données
//     form.reset();
//   });
// });

// *************************Input Navigateur date**************************

const dateIn = document.getElementById('dateIn');
const dateOut = document.getElementById('dateOut');
const dateError = document.getElementById('dateError');
const dateOutError = document.getElementById('dateOutError');
const numberNight = document.querySelector('.numberNight');

// Obtenez la date actuelle
const currentDate = new Date();

// Définissez la date d'arrivée par défaut sur la date actuelle
dateIn.valueAsDate = currentDate;

// Calcul de la date de départ à J+1
const nextDay = new Date(currentDate);
nextDay.setDate(currentDate.getDate() + 1);
dateOut.valueAsDate = nextDay;

// Mettez en place un écouteur d'événement sur la date d'arrivée pour ajuster la date de départ
dateIn.addEventListener('change', function () {
  const selectedDateIn = new Date(dateIn.value);

  if (selectedDateIn < currentDate) {
    dateError.textContent = "*Dates invalides";
    dateIn.valueAsDate = currentDate;
    dateOut.valueAsDate = nextDay;
  } else {
    dateError.textContent = "";
    // Calcul de la date de départ à J+1
    const nextDay = new Date(selectedDateIn);
    nextDay.setDate(selectedDateIn.getDate() + 1);
    dateOut.valueAsDate = nextDay;

    // Effacez le message d'erreur de la date de départ lorsque vous sélectionnez une nouvelle date d'arrivée
    dateOutError.textContent = "";
  }
});

// Mettez en place un écouteur d'événement sur la date de départ pour vérifier si elle est antérieure à la date d'arrivée ou à la date actuelle
dateOut.addEventListener('change', function () {
  const selectedDateIn = new Date(dateIn.value);
  const selectedDateOut = new Date(dateOut.value);

  if (selectedDateOut <= selectedDateIn) {
    dateOutError.textContent = "*Date de départ antérieure à la date d'arrivée";
  } else {
    dateOutError.textContent = "";

    // Calcul du nombre de nuits entre la date d'arrivée et la date de départ
    const timeDifference = selectedDateOut - selectedDateIn;
    const numberOfNights = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

    // Affichage du nombre de nuits dans l'input correspondant
    numberNight.value = numberOfNights;
  }
});


// *********************************calendar **************************************


// document.addEventListener('DOMContentLoaded', function() {
//   let calendarEl = document.getElementById('calendar');
//   let calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: 'dayGridMonth',
//     events: [
      
//       {
//         title: 'Logement 1',
//         start: '2023-12-01',
//         end: '2023-12-10',
//         color: 'green',
//       },
//       {
//         title: 'Logement 2',
//         start: '2023-12-01',
//         end: '2023-12-10',
//         color: 'blue',
//       },
//       {
//         title: 'Logement 3',
//         start: '2023-12-01',
//         end: '2023-12-10',
//         color: 'red',
//       }
//     ],
//   });
//   calendar.render();
// });


// ***********************************************************************Validation formulaire


// // Sélectionnez tous les éléments avec la classe "form" et "validation-form"
// const forms = document.querySelectorAll('.form');
// const validationDivs = document.querySelectorAll('.validation-form');

// // Parcourez tous les formulaires
// forms.forEach(function (form, index) {
//   // Écoutez l'événement "submit" de chaque formulaire
//   form.addEventListener('submit', function (e) {
//     // Empêchez le comportement par défaut du formulaire (rechargement de la page)
//     e.preventDefault();

//     // Affichez le message de confirmation dans la div de validation correspondante
//     const validationDiv = validationDivs[index];
//     const confirmationMessage = document.createElement('div');
//     confirmationMessage.classList.add('alert', 'alert-success');
//     confirmationMessage.textContent = 'Votre formulaire a été envoyé avec succès. Vous recevrez un e-mail de confirmation.';

//     // Effacez le contenu précédent de la div de validation
//     validationDiv.innerHTML = '';

//     // Ajoutez le message à la div de validation
//     validationDiv.appendChild(confirmationMessage);
//   });
// });


// ****************************slider*********

let slideIndex = 0;
showSlides();

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");

  if (slideIndex >= slides.length) {
    slideIndex = 0;
  }

  if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  }
  if (slides[slideIndex]) {
    // Vérifier si slides[slideIndex] est défini avant d'accéder à sa propriété 'style'.
    slides[slideIndex].style.display = "block";
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex].style.display = "block";

  setTimeout(showSlides, 2000); // Change image every 2 seconds
};

// document.getElementById("form").addEventListener("click", function(event) {

//   console.log("Le bouton a été cliqué !");
// });