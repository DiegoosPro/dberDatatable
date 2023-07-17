
var tableRoles;

document.addEventListener('DOMContentLoaded', function() {
    tableRoles = $('#tableRoles').DataTable({
        "processing": true,
        "serverSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });
});

    
