// Button sidebar
    // <button id="toggle-hide-btn" class="btn btn-info mb-2 invisible"  type="button" data-bs-toggle="collapse" data-bs-target="#collapseProgress">
    //     <i class="material-icons">published_with_changes</i>
    //     <span>Progress</span>
    // </button>

// Button for progress on phone

    // Homemade
// const hamburger2 = document.querySelector("toggle-hide-btn");

// hamburger2.addEventListener("click", function(){
//     document.querySelector("#button-progress").classList.toggle("expand")
// });

    //Bootsrap 5
// function hideButtonMobile(){
//     if(document.documentElement.clientWidth < 768) {
//         this.document.querySelector("#toggle-hide-btn").classList.remove("invisible");
//     }
//     else if(document.documentElement.clientWidth >= 768) {
//         this.document.querySelector("#toggle-hide-btn").classList.add("invisible");
//     }
// }

// window.onresize = hideButtonMobile;


// Number for Input Number

function isNumber(evt) {
    evt = (evt) ? evt : window.Event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var input = evt.target.value;
    if ( charCode == 46 || (charCode > 31 && charCode < 48) || charCode > 57 ) {
        if (charCode == 46) {
            // Check if there's already a decimal point in the input
            if (input.indexOf('.') != -1) {
                return false;
            }
            return true;
        }
        return false;
    }
    if (input.indexOf('.') != -1) {
        var decimalPart = input.substring(input.indexOf('.') + 2);
        console.log(decimalPart.length >= 2 && charCode != 8 && charCode != 46);
        if (decimalPart.length >= 2 && charCode != 8 && charCode != 46) {
            return false;
        }
    }
    return true;
}


const formPendaftaran = document.getElementById("form_pendaftaran");
const formDokumen = document.getElementById("form_dokumen");

let formAction = "";
let formAction2 = "";

if (formPendaftaran) {
    formAction = formPendaftaran.getAttribute("action");
}

if (formDokumen) {
    formAction2 = formDokumen.getAttribute("action");
}

const badgeColor1 = document.getElementById("badge-for-progress-1");
const badgeColor2 = document.getElementById("badge-for-progress-2");
const badgeColor3 = document.getElementById("badge-for-progress-3");
const badgeColor4 = document.getElementById("badge-for-progress-4");

if(formPendaftaran){
    // badgeColor1.classList.toggle("text-bg-secondary");
    // badgeColor1.classList.toggle("text-bg-info");
    // badgeColor2.classList.toggle("text-bg-secondary");
}else if(formDokumen && !formPendaftaran){
    // badgeColor1.classList.toggle("text-bg-secondary");
    // badgeColor2.classList.toggle("text-bg-secondary");
    // badgeColor2.classList.toggle("text-bg-info");
}