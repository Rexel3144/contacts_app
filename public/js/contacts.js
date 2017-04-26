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
    $('.actions > .remove').on('click', function () {
        closePriviousEdit();
        var cell = $(this).closest('td');
        var source = cell.data('source');
        var value = cell.children('.value');
        var contactId = $(this).closest('tr').data('contact-id');
        $.ajax({
            type: "PATCH",
            url: "/contact/" + contactId,
            data: {source: source,
                newValue: null},
            error: function (error) {
                console.log(error);
            },
            success: function () {
                value.empty();
            }
        });
    });


    //Opens a edit form on an appropriate cell
    $('.actions > .edit').on('click', function () {
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

    $(document).on('click', '.edit-cell .confirm', function () {
        var editCell = $(this).closest('.edit-cell');
        var value = editCell.parent('.value');
        var source = editCell.data('source');
        var contactId = editCell.data('contact-id');
        var newValue = editCell.find('.edit-input > input').val();
        $.ajax({
            type: "PUT",
            url: "/contact/" + contactId,
            data: {source: source,
                newValue: newValue},
            error: function (error) {
                console.log(error);
            },
            success: function () {
                value.html(newValue);
            }
        });
    });


});