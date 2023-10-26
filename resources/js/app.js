import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Nav hamburger
const btn = document.getElementById("hamburger-icon");
const nav = document.getElementById("mobile-menu");

/*Dietary select*/
const dietaryBtn = document.getElementById("dropdownSearchButton");
const dietary = document.getElementById("dropdownSearch");

/*Phone form*/
const addButton = document.getElementById('add-phone-field');
const deleteButton = document.getElementById('delete-phone-field');
const phoneFieldsContainer = document.getElementById('additional-phone-fields');
const phoneFieldCountInput = document.getElementById('phone-field-count');
let phoneFieldIndex = parseInt(phoneFieldCountInput.value);




// Nav hamburger
btn.addEventListener("click", ()=>{
   nav.classList.toggle("flex");
   nav.classList.toggle("hidden");
});


/*Dietary select*/
dietaryBtn.addEventListener("click",()=>{
    dietary.classList.toggle("block");
    dietary.classList.toggle("hidden");
})


/*Phone form*/
addButton.addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'phone[]';
    input.placeholder = 'Write your next phone number';
    input.className = 'form-control shadow appearance-none border {{$errors->first(\'phone.\'.$i) ? \'border-red-500\' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-6 leading-tight focus:outline-none focus:shadow-outline';

    phoneFieldsContainer.appendChild(input);
    phoneFieldIndex++;
    phoneFieldCountInput.value = phoneFieldIndex;
});


/*deleteButton.addEventListener('click', function() {
    if (phoneFieldIndex > 0) {
        const lastPhoneField = phoneFieldsContainer.lastChild;
        phoneFieldsContainer.removeChild(lastPhoneField);
        phoneFieldIndex--;
        phoneFieldCountInput.value = phoneFieldIndex;
    }
});*/


/*
deleteButton.addEventListener('click', function() {
    if (phoneFieldIndex > 0) { // Upewnij się, że istnieje co najmniej jedno pole
        // Pobierz wszystkie pola numerów telefonów
        const phoneFields = phoneFieldsContainer.querySelectorAll('input[type="text"]');

        // Usuń ostatnie pole, niezależnie od jego zawartości
        const lastPhoneField = phoneFields[phoneFields.length - 1];
        phoneFieldsContainer.removeChild(lastPhoneField);

        phoneFieldIndex--;
        phoneFieldCountInput.value = phoneFieldIndex;
    }
});
*/


deleteButton.addEventListener('click', function() {
    if (phoneFieldIndex > 0) { // Upewnij się, że istnieje co najmniej jedno pole
        // Pobierz wszystkie pola numerów telefonów
        const phoneFields = phoneFieldsContainer.querySelectorAll('input[type="text"]');

        if (phoneFields.length > 1) {



            // Usuń ostatnie pole, niezależnie od jego zawartości
            const lastPhoneField = phoneFields[phoneFields.length - 1];
            phoneFieldsContainer.removeChild(lastPhoneField);

            phoneFieldIndex--;
            phoneFieldCountInput.value = phoneFieldIndex;

            const errorToDelete = document.getElementById(`errorDelete_${phoneFieldIndex}`);
            if (errorToDelete) {
                errorToDelete.remove();
            }

        }
    }
});

