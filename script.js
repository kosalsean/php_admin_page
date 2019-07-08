$(function () {
    var tblResult = $('.tbl-result');
    var name = $('#txt-name');
    var id = $('#txt-id');
    var color = $("#txt-color");
    var ind;
    var photo_path = $('#img-name');
    $('#txt-file').change(function () {
        // alert('hi');
        var eThis = $(this);
        var form = $(this).closest('form.upl');
        var form_data = new FormData(form[0]);
        //! ========================== upload files =================================
        $.ajax({
            url: 'upload-file.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            dataType: 'JSON',
            cache: false,
            processData: false,
            success: function (data) {
                $('#img-name').val(data.source);
                // alert(data.source);
                var img_name = data.source;
                $('.img-box').css({
                    'background-image': 'url("' + img_name + '")'
                });
            }
        });
    });
    name.focus();
    //! ============================== btn post click ==========================
    $('#btn-post').click(function () {
        var input = '<input type="text" class="img-name" value="' + $('#img-name').val() + '">';
        var eThis = $(this);
        if (name.val() == "") {
            alert('Insert name');
            name.focus();
            return;
        }
        var form = $(this).closest('form.upl');
        var form_data = new FormData(form[0]);
        //!     var color = $("#txt-color");
        //!===================== save menu =======================
        $.ajax({
            url: 'save-menu.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            dataType: 'JSON',
            cache: false,
            processData: false,
            beforeSend: function () {
                eThis.html(' <img src="img/loading.gif" width="50px">');
                eThis.css({
                    'pointer-events': 'none',
                    'opacity': '0.7',
                    'padding': '0',
                    'height': '50px'
                });
            },
            success: function (data) {
                if (data.dpl == true) {
                    alert("Name is duplicated!");
                    name.focus();
                } else if (data.insert == false) {
                    alert("Data can't save!");
                } else {
                    if (data.last_id == 'edit') {
                        alert('edit');
                    } else {
                        var btn_edit = '<div class="btn-edit">Edit</div>'
                        var img = '<img class="row-img" src="' + $('#img-name').val() + '">';
                        var tr = '<tr class="alternate-row"><td>' + data.last_id + '</td><td>' + name.val() + '</td><td>' + color.val() + '</td> <td>' + img + input + '</td> <td> ' + btn_edit + ' </td></tr>';
                        tblResult.append(tr);
                        name.val('');
                        name.focus();
                        id.val(data.last_id + 1);
                        $('.img-box').css({
                            'background-image': 'url("images.png")'
                        });
                        $('#img-name').val('');

                    }
                };
                eThis.html("POST");
                eThis.css({
                    'pointer-events': 'auto',
                    'opacity': '1',
                    'padding': '5px',
                    'height': '20px',
                });
            }
        });
    });
    //!-------------- EDIT DATA --------------------
    $('body').on('click', '.btn-edit', function () {
        var eThis = $(this);
        var tr = eThis.parents('tr');
        let id2 = tr.find('td:eq(0)').text();
        let name2 = tr.find('td:eq(1)').text();
        let color2 = tr.find('td:eq(2)').text();
        let img2 = tr.find('td:eq(3) img').attr('src', photo_path.val());
        id.val(id2);
        name.val(name2);
        color.val(color2);
        $('.img-box').css({
            'background-image': 'url("' + img2 + '")'
        });
        $('#txt-edit-id').val(id2);
        ind = tr.index();
        alert(ind);
    });
    //!------------------------------------- wrong 
    // $('.btn-edit').click(function () {
    // });


});