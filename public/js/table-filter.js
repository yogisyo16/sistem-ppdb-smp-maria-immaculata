document.getElementById('tahunAjaranSelect').addEventListener('change', function() {
    var selectedYear = this.value;
    var tableRows = document.querySelectorAll('#daftarTable tbody tr');
    
    tableRows.forEach(function(row) {
        var tahunAjaran = row.querySelector('td:nth-child(10)').textContent;
        if (tahunAjaran == selectedYear) {
        row.style.display = 'table-row';
        } else {
        row.style.display = 'none';
        }
    });
});