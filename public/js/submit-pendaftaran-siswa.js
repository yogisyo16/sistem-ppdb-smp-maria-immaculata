function submitForm(action) {
    if (document.getElementById('form_pendaftaran_informasi_orangtua')) {
        var ayah = document.getElementById('nama_ayah').value;
        var ibu = document.getElementById('nama_ibu').value;
        var wali = document.getElementById('nama_wali').value;
        // console.log(ayah, ibu, wali);
        // console.log([ayah, ibu, wali].filter(val => val !== '').length === 1);
        if (ayah === '' && ibu === '' && wali === '') {
            return Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Data Orang Tua harus terisi paling tidak 1",
            });
        }else {
            const form = document.getElementById('form_pendaftaran_informasi_orangtua');
            form.action = action;
            form.submit();
        }
    }else if (document.getElementById('form_pendaftaran_informasi_sekolah')) {
        const form = document.getElementById('form_pendaftaran_informasi_sekolah');
        form.action = action;
        form.submit();
    }
}