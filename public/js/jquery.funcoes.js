$(document).ready(function () {

    $('#tableDataTablePtBr').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/pt-BR.json"
        }, "columnDefs": [{
            "targets": 0,
            "searchable": true
        }],
        "lengthMenu": [10, 15, 25],
        "searching": true
    });
    
});