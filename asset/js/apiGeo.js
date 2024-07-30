// /*
//  * Script de recherche d'adresse avec saisie de code postal et ville
//  *
//  * Contenu:
//  * 1. Initialisation des éléments du formulaire
//  * 2. Fonction de récupération des données d'adresse depuis l'API
//  * 3. Mise à jour de la liste des résultats
//  * 4. Gestion des événements d'entrée utilisateur
//  * 5. Gestion des clics en dehors de la liste des résultats
//  */

// document.addEventListener('DOMContentLoaded', function() {
//     const zipCodeInput = document.getElementById('codePostal');
//     const cityInput = document.getElementById('ville');
//     const resultsList = document.getElementById('resultsList');

//     //------------------------------------------------------------------------//
//     // 2. Fonction de récupération des données d'adresse depuis l'API
//     //------------------------------------------------------------------------//
//     function fetchAddressData(query) {
//         if (!navigator.onLine) {
//             console.error('No internet connection');
//             return;
//         }

//         if (query.length < 2) {
//             resultsList.innerHTML = '';
//             resultsList.style.display = 'none';
//             return;
//         }

//         const url = `https://api-adresse.data.gouv.fr/search/?q=${query}&type=municipality&limit=20`;

//         fetch(url)
//             .then(response => response.json())
//             .then(data => {
//                 const features = data.features;
//                 const isZipCode = /^\d{2,5}$/.test(query);
//                 updateResultsList(features, isZipCode);
//             })
//             .catch(error => console.error('Error fetching data:', error));
//     }

//     //------------------------------------------------------------------------//
//     // 3. Mise à jour de la liste des résultats
//     //------------------------------------------------------------------------//
//     function updateResultsList(features, isZipCode) {
//         resultsList.innerHTML = '';
//         if (features.length > 0) {
//             resultsList.style.display = 'block';
//             features.forEach(feature => {
//                 let city = feature.properties.city;
//                 const zipCode = feature.properties.postcode;

//                 city = city.replace(/(\d+)(e)?(\s+Arrondissement)?/i, '$1').trim();

//                 const li = document.createElement('li');
//                 li.textContent = isZipCode ? city : `${city} (${zipCode})`;
//                 li.style.cursor = 'pointer';
//                 li.addEventListener('click', () => {
//                     let cleanedCity = city.replace(/\d+/g, ''); // Remove any numbers from the city
//                     cityInput.value = cleanedCity.trim(); // Set the value after removing numbers
//                     zipCodeInput.value = zipCode;
//                     resultsList.innerHTML = '';
//                     resultsList.style.display = 'none';
//                 });
//                 resultsList.appendChild(li);
//             });
//         } else {
//             resultsList.style.display = 'none';
//         }
//     }

//     //------------------------------------------------------------------------//
//     // 4. Gestion des événements d'entrée utilisateur
//     //------------------------------------------------------------------------//
//     zipCodeInput.addEventListener('input', function() {
//         const query = this.value.trim();
//         fetchAddressData(query);
//     });

//     cityInput.addEventListener('input', function() {
//         const query = this.value.trim();
//         fetchAddressData(query);
//     });

//     //------------------------------------------------------------------------//
//     // 5. Gestion des clics en dehors de la liste des résultats
//     //------------------------------------------------------------------------//
//     document.addEventListener('click', function(e) {
//         if (!resultsList.contains(e.target) && !cityInput.contains(e.target) && !zipCodeInput.contains(e.target)) {
//             resultsList.innerHTML = '';
//             resultsList.style.display = 'none';
//         }
//     });
// });
