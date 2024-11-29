// Get ID of Input
var hsl_udp = document.getElementById('hsl_udp');
var hsl_spp = document.getElementById('hsl_spp');
var hsl_ups = document.getElementById('hsl_ups');
var hsl_uang_seragam = document.getElementById('hsl_uang_seragam');
var hsl_uang_kegiatan = document.getElementById('hsl_uang_kegiatan');
var hsl_uang_alat = document.getElementById('hsl_uang_alat');

var total_tunai = document.getElementById('total_tunai');
var total_uang = document.getElementById('total_uang');

var pembayaran_udp = document.getElementById('pembayaran_udp');
var pembayaran_spp = document.getElementById('pembayaran_spp');
var pembayaran_ups = document.getElementById('pembayaran_ups');
var pembayaran_uang_seragam = document.getElementById('pembayaran_uang_seragam');
var pembayaran_uang_kegiatan = document.getElementById('pembayaran_uang_kegiatan');
var pembayaran_uang_alat = document.getElementById('pembayaran_uang_alat');

var total_dibayar = document.getElementById('total_dibayar');

// Listener Currency
// Pembayaran
hsl_udp.addEventListener('input', function(e)
{
    hsl_udp.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_udp.value = formatRupiah(0, 'Rp. ');
});

hsl_spp.addEventListener('input', function(e)
{
    hsl_spp.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_spp.value = formatRupiah(0, 'Rp. ');
});

hsl_ups.addEventListener('input', function(e)
{
    hsl_ups.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_ups.value = formatRupiah(0, 'Rp. ');
});

hsl_uang_seragam.addEventListener('input', function(e)
{
    hsl_uang_seragam.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_uang_seragam.value = formatRupiah(0, 'Rp. ');
});

hsl_uang_kegiatan.addEventListener('input', function(e)
{
    hsl_uang_kegiatan.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_uang_kegiatan.value = formatRupiah(0, 'Rp. ');
});

hsl_uang_alat.addEventListener('input', function(e)
{
    hsl_uang_alat.value = formatRupiah(this.value, 'Rp. ');
    pembayaran_uang_alat.value = formatRupiah(0, 'Rp. ');
});

// Dibayar
pembayaran_udp.addEventListener('input', function(e)
{
    pembayaran_udp.value = formatRupiah(this.value, 'Rp. ');
});

pembayaran_spp.addEventListener('input', function(e)
{
    pembayaran_spp.value = formatRupiah(this.value, 'Rp. ');
});

pembayaran_ups.addEventListener('input', function(e)
{
    pembayaran_ups.value = formatRupiah(this.value, 'Rp. ');
});

pembayaran_uang_seragam.addEventListener('input', function(e)
{
    pembayaran_uang_seragam.value = formatRupiah(this.value, 'Rp. ');
});

pembayaran_uang_kegiatan.addEventListener('input', function(e)
{
    pembayaran_uang_kegiatan.value = formatRupiah(this.value, 'Rp. ');
});

pembayaran_uang_alat.addEventListener('input', function(e)
{
    pembayaran_uang_alat.value = formatRupiah(this.value, 'Rp. ');
});

hsl_spp.addEventListener('input', calculateValue);
hsl_udp.addEventListener('input', calculateValue);
hsl_ups.addEventListener('input', calculateValue);
hsl_uang_seragam.addEventListener('input', calculateValue);
hsl_uang_kegiatan.addEventListener('input', calculateValue);
hsl_uang_alat.addEventListener('input', calculateValue);

pembayaran_udp.addEventListener('input', calculateValue);
pembayaran_spp.addEventListener('input', calculateValue);
pembayaran_ups.addEventListener('input', calculateValue);
pembayaran_uang_seragam.addEventListener('input', calculateValue);
pembayaran_uang_kegiatan.addEventListener('input', calculateValue);
pembayaran_uang_alat.addEventListener('input', calculateValue);

function calculateValue(){
    var udpValue = parseFloat(hsl_udp.value.replace('Rp. ', '').replace(/\./g, ''));
    var sppValue = parseFloat(hsl_spp.value.replace('Rp. ', '').replace(/\./g, ''));
    var upsValue = parseFloat(hsl_ups.value.replace('Rp. ', '').replace(/\./g, ''));
    var seragamValue = parseFloat(hsl_uang_seragam.value.replace('Rp. ', '').replace(/\./g, ''));
    var kegiatanValue = parseFloat(hsl_uang_kegiatan.value.replace('Rp. ', '').replace(/\./g, ''));
    var alatValue = parseFloat(hsl_uang_alat.value.replace('Rp. ', '').replace(/\./g, ''));

    var pembayaran_udpValue = parseFloat(pembayaran_udp.value.replace('Rp. ', '').replace(/\./g, ''));
    var pembayaran_sppValue = parseFloat(pembayaran_spp.value.replace('Rp. ', '').replace(/\./g, ''));
    var pembayaran_upsValue = parseFloat(pembayaran_ups.value.replace('Rp. ', '').replace(/\./g, ''));
    var pembayaran_uang_seragamValue = parseFloat(pembayaran_uang_seragam.value.replace('Rp. ', '').replace(/\./g, ''));
    var pembayaran_uang_kegiatanValue = parseFloat(pembayaran_uang_kegiatan.value.replace('Rp. ', '').replace(/\./g, ''));
    var pembayaran_uang_alatValue = parseFloat(pembayaran_uang_alat.value.replace('Rp. ', '').replace(/\./g, ''));

    var totalValue = udpValue + sppValue + upsValue + seragamValue + kegiatanValue + alatValue;
    var totalPaid = pembayaran_udpValue + pembayaran_sppValue + pembayaran_upsValue + pembayaran_uang_seragamValue + pembayaran_uang_kegiatanValue + pembayaran_uang_alatValue;

    var totalValue = totalValue - totalPaid;
    var totalMoney = udpValue + sppValue + upsValue + seragamValue + kegiatanValue + alatValue;
    total_uang.value = formatRupiah(totalMoney, '');
    total_tunai.value = formatRupiah(totalValue, '');
    total_dibayar.value = formatRupiah(totalPaid, '');
}

// Function Currency
function formatRupiah(angka, prefix)
{
    angka = angka.toString();
    var isNegative = angka.startsWith('-');
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? (isNegative ? '-' + rupiah : rupiah) : (rupiah ? 'Rp. ' + (isNegative ? '-' + rupiah : rupiah) : '');
}

function submitForm(formId){
    var total_tunai = document.getElementById('total_tunai');
    console.log(formId);
    if (total_tunai.value.startsWith('Rp. -')) {
        Swal.fire({
            icon: "error",
            title: "Perhitungan salah",
            text: "Terjadi Perhitungan minus!",
        });
        return false;
    } else {
        form.submit();
    }
}