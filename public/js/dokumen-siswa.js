function addInput(){
    const fieldInput = document.getElementById("inputFields");
    const inputKejuaraan = document.createElement("input");

    inputKejuaraan.setAttribute("type", "file");
    inputKejuaraan.setAttribute("class", "form-control");
    inputKejuaraan.setAttribute("accept", "image/jpeg, image/jpg, image/png, application/pdf");
    inputKejuaraan.setAttribute("id", "file_sertifikat_kejuaraan[]"+" inputRemove");
    inputKejuaraan.setAttribute("name", "file_sertifikat_kejuaraan[]");
    fieldInput.appendChild(inputKejuaraan);
}

function removeInput() {
    const fieldInput = document.getElementById("file_sertifikat_kejuaraan[] inputRemove");
    fieldInput.remove();
}