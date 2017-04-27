$(document).ready(function () {
    $('#contacts').DataTable();
    var openedEditForm = {};
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
     * Close a previous edit form if it exists
     */
    function closePriviousEdit() {
        if (openedEditForm) {
            openedEditForm.value ? openedEditForm.value.html(openedEditForm.html) : '';
            openedEditForm = null;
        }
    }

    //Removes a value of a cell
    $(document).on('click', '.actions > .remove', function () {
        closePriviousEdit();
        var cell = $(this).closest('td');
        var source = cell.data('source');
        var value = cell.children('.value');
        var contactId = $(this).closest('tr').data('contact-id');
        var data = {};
        data[source] = null;
        data['source'] = source;
        data['newValue'] = null;
        $.ajax({
            type: "PATCH",
            url: "/contact/" + contactId,
            data: data,
            error: function (error) {
                console.log(error.responseText);
            },
            success: function () {
                value.empty();
            }
        });
    });


    //Opens a edit form on an appropriate cell
    $(document).on('click', '.actions > .edit', function () {
        closePriviousEdit();
        var cell = $(this).closest('td');
        var source = cell.data('source');
        var value = cell.children('.value');
        openedEditForm = {
            value: value,
            html: value.html()
        };
        var contactId = $(this).closest('tr').data('contact-id');
        $.ajax({
            type: "POST",
            url: "/contact/" + contactId + "/edit/part",
            data: {
                source: source,
                value: value.html()
            },
            error: function (error) {
                console.log(error.responseText);
            },
            success: function (editForm) {
                value.html(editForm);
            }
        });
    });


    //Edits a value of an appropriate cell
    $(document).on('click', '.edit-cell .confirm', function () {
        var editCell = $(this).closest('.edit-cell');
        var value = editCell.parent('.value');
        var source = editCell.data('source');
        var contactId = editCell.data('contact-id');
        var newValue = editCell.find('.edit-input > input').val();
        var data = {};
        data[source] = newValue;
        data['source'] = source;
        data['newValue'] = newValue;
        $.ajax({
            type: "PUT",
            url: "/contact/" + contactId,
            data: data,
            error: function (error) {
                console.log(error.responseText);
            },
            success: function (data) {
                console.log(data);
                value.html(newValue);
                openedEditForm = null;
            }
        });
    });

    //Removes a contact
    $('.actions-global > .delete').on('click', function () {
        closePriviousEdit();
        var answer = confirm('Do you want delete this contact?');
        if (answer === false) {
            return false;
        }
        var row = $(this).closest('tr');
        var contactId = row.data('contact-id');
        $.ajax({
            type: "DELETE",
            url: "/contact/" + contactId,
            error: function (error) {
                console.log(error);
            },
            success: function () {
                row.fadeOut('800', function () {
                    row.remove();
                });
            }
        });
    });


});