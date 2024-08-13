$(document).ready(function() {
    var statusInpt = false;
    var table = $('#html5-extension').DataTable({
        ajax: {
            url: "PHP/users_all.php",
            dataSrc: ""
        },
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        columns: [
            {
                data: null,
                defaultContent: '',
                className: 'dt-center',
                orderable: false,
                render: function(data, type, row, meta) {
                    return '<input type="checkbox" class="user-checkbox" value="' + row.id + '">';
                }
            },
            { data: 'NAME', title: 'Name' },
            { data: 'MAIL', title: 'Mail' },
            { data: 'SALARY', title: 'Salary' },
            { 
                data: 'B_ID', 
                title: 'Business',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var bussOpt = $('#busList').val().split('|'),html;
                        bussOpt.forEach(e => {
                            var bB = e.split(':');
                            html = html+'<option value="'+bB[0]+'" ' + (data == bB[0] ? 'selected' : '') + '>'+bB[1]+'</option>';
                        });
                        return '<select class="business-select custom-select">' + html + '</select>';
                    }
                    return data;
                }
            },
            { data: 'ADDRESS', title: 'Address' },
            {
                data: 'GENDER',
                title: 'Gender',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return '<select class="business-select custom-select">' +
                            '<option value=""> -- Select -- </option>' +
                            '<option value="Male" ' + (data == "Male" ? 'selected' : '') + '>Male</option>' +
                            '<option value="Female" ' + (data == "Female" ? 'selected' : '') + '>Female</option>' +
                        '</select>';
                    }
                    return data;
                }
            },
            {
                data: 'BLOOD',
                title: 'Blood Type',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return '<select class="business-select custom-select">' +
                            '<option value=""> -- Select -- </option>' +
                            '<option value="A+" ' + (data == "A+" ? 'selected' : '') + '>A+</option>' +
                            '<option value="A-" ' + (data == "A-" ? 'selected' : '') + '>A-</option>' +
                            '<option value="B+" ' + (data == "B+" ? 'selected' : '') + '>B+</option>' +
                            '<option value="B-" ' + (data == "B-" ? 'selected' : '') + '>B-</option>' +
                            '<option value="O+" ' + (data == "O+" ? 'selected' : '') + '>O+</option>' +
                            '<option value="O-" ' + (data == "O-" ? 'selected' : '') + '>O-</option>' +
                            '<option value="AB+" ' + (data == "AB+" ? 'selected' : '') + '>AB+</option>' +
                            '<option value="AB-" ' + (data == "AB-" ? 'selected' : '') + '>AB-</option>' +
                        '</select>';
                    }
                    return data;
                }
            },            
            { data: 'FEDERAL_ID', title: 'Federal ID' },
            { data: 'DATE', title: 'Date'}
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        buttons: [
            {
                text: '+ New User',
                className: 'btn',
                action: function (e, dt, node, config) {
                    $('#new_users').modal('show');
                }
            },
            {
                extend: 'copy',
                className: 'btn',
                exportOptions: {
                    columns: ':visible:not(:first-child)',
                    rows: { selected: true }
                }
            },
            {
                extend: 'csv',
                className: 'btn',
                exportOptions: {
                    columns: ':visible:not(:first-child)',
                    rows: { selected: true }
                }
            },
            {
                extend: 'excel',
                className: 'btn',
                exportOptions: {
                    columns: ':visible:not(:first-child)',
                    rows: { selected: true }
                }
            },
            {
                extend: 'pdf',
                className: 'btn',
                exportOptions: {
                    columns: ':visible:not(:first-child)',
                    rows: { selected: true }
                }
            },
            {
                extend: 'print',
                className: 'btn',
                exportOptions: {
                    columns: ':visible:not(:first-child)',
                    rows: { selected: true }
                }
            }
        ],
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 10
    });

    // Habilitar la edición en línea
    $('#html5-extension').on('dblclick', 'td:not(:first-child, :last-child)', function() {
        var cell = $(this);
        if(statusInpt) {return true;}
        if(cell.index() !== 9) {
            statusInpt = true;
            var currentContent = cell.text();
            cell.html('<input type="text" class="form-control" value="' + currentContent + '">');
            var input = cell.find('input');
            input.focus();

            input.blur(function() {
                var newValue = input.val();
                cell.html(newValue);
                updateData(table.row(cell.parent()).index(), cell.index(), newValue);
            });

            input.keypress(function(e) {
                if (e.which == 13) {
                    var newValue = input.val();
                    cell.html(newValue);
                    updateData(table.row(cell.parent()).index(), cell.index(), newValue);
                }
            });
        }
    });

    // Manejar cambios en el select de Estatus
    $('#html5-extension').on('change', '.business-select', function() {
        var cell = $(this).closest('td');
        var newValue = $(this).val();
        var rowIndex = table.cell(cell).index().row;
        var columnIndex = table.cell(cell).index().column;
        updateData(rowIndex, columnIndex, newValue);
    });

    function updateData(rowIndex, columnIndex, newValue) {
        var rowData = table.row(rowIndex).data();
        var columnName = table.settings().init().columns[columnIndex].data;
        rowData[columnName] = newValue;
        statusInpt = false;
        
        if (rowData.NAME && rowData.MAIL && rowData.SALARY && rowData.B_ID) {
            $.ajax({
                url: 'PHP/users_update.php',
                method: 'POST',
                data: rowData,
                success: function(datos) {
                    if (datos.Status === 'Ok') {
                        table.row(rowIndex).data(rowData).draw();
                    }else {
                        $('#html5-extension').DataTable().ajax.reload();
                        if (datos.Message) {
                            swal({ title: 'Error', text: datos.Message, type: 'error', padding: '2em'});
                        }else {
                            swal({ title: 'One moment...', text: "Your session got expired, please login again", type: 'alert', padding: '2em'}).then((function(t){location.reload();}));
                        }
                    }
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    swal({ title: 'Ups...', text: "We are experiencing some issues", type: 'error', padding: '2em'});
                    console.log('code: '+xhr.status+' message: '+thrownError);
                    $('#html5-extension').DataTable().ajax.reload();
                }
            });
        } else {
            $('#html5-extension').DataTable().ajax.reload();
            swal({ title: 'Wait', text: "You can't leave empty information", type: 'error', padding: '2em'});
        }
    }
});

function saveUser(btn) {
    var name = $('#user_name').val(),
        mail = $('#user_mail').val(),
        busi = $('#user_business').val(),
        salary = $('#user_salary').val();
    if(name && mail && busi && salary) {
        $(btn).html('Loading...').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: 'PHP/users_new.php',
            data: { name:name, mail:mail, busi:busi, salary:salary },
            success:function(datos){
                $(btn).html('Save').prop('disabled', false);
                if (datos.Status === 'Ok') {
                    swal({ title: 'Great!', text: datos.Message, type: 'success', padding: '2em'}).then(function(){
                        $('#html5-extension').DataTable().ajax.reload();
                        $('#user_name').val('');
                        $('#user_mail').val('');
                        $('#user_salary').val('');
                        $('#new_users').modal('hide');
                    });
                }else {
                    if (datos.Message) {
                        swal({ title: 'Error', text: datos.Message, type: 'error', padding: '2em'});
                    }else {
                        swal({ title: 'One moment...', text: "Your session got expired, please login again", type: 'alert', padding: '2em'}).then((function(t){location.reload();}));
                    }
                }
            },
            error:function (xhr, ajaxOptions, thrownError) {
                $(btn).html('Save').prop('disabled', false);
                swal({ title: 'Ups...', text: "We are experiencing some issues", type: 'error', padding: '2em'});
                console.log('code: '+xhr.status+' message: '+thrownError);
            }
        });
    } else {
        swal({ title: 'Wait', text: "You have to fill all the information", type: 'error', padding: '2em'});
    }
}