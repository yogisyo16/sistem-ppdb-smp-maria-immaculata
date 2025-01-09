function submitDokumen(action) {
    if (document.getElementById('form_dokumen')) {
        const form = document.getElementById('form_dokumen');
        form.action = action;
        form.submit();
    }
}