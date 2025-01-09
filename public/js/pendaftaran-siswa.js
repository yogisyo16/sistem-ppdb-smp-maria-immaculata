const dateInput = document.getElementById('tanggal_lahir');
const maxDate = new Date(dateInput.max);
const maxYear = maxDate.getFullYear();

console.log(dateInput.value);

dateInput.addEventListener('input', ()=> {
    const inputDate = new Date(dateInput.value);
    const inputYear = inputDate.getFullYear();

    if (inputYear > maxYear) {
        dateInput.value = dateInput.max;
    }
    
})