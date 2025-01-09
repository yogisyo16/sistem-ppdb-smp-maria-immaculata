function validateRegister(){
    var value = document.getElementById('password').value;
    if(value.length < 6){
        return document.getElementById('password-wrong').hidden=false;
    } else {
        return document.getElementById('password-wrong').hidden=true;
    }
}

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('bi-eye');
});