document.getElementById('btnFile').addEventListener('click', function() {
    document.getElementById('imgFile').hidden=false;
    document.getElementById('btnFile').hidden=true;
    document.getElementById('hideFile').hidden=false;
})

document.getElementById('hideFile').addEventListener('click', function() {
    document.getElementById('imgFile').hidden=true;
    document.getElementById('btnFile').hidden=false;
    document.getElementById('hideFile').hidden=true;
})