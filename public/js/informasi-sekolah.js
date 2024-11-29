document.getElementById('nilai_aspd').hidden = true;


document.getElementById('is_diy').addEventListener('change', function() {
    var selectedValue = this.value;
    var nilaiAspd = document.getElementById('nilai_aspd');

    if (selectedValue === '1') {
        nilaiAspd.hidden = false;
    } else {
        nilaiAspd.hidden = true;
    }
});

function checkValue(inputField) {
    const value = parseInt(inputField.value);
    const lenght = inputField.value.length;
    if (value > 100) {
        if(lenght >= 3) {
            inputField.value = 100;
        }
        // You can also add error handling or display a message here
    }
}