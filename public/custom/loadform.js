function loadEditForm(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            $('#editFormContainer').html(response);
        },
        error: function () {
            alert('Failed to load the edit form.');
        }
    });
}

function loadCreateForm(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            $('#createFormContainer').html(response);
        },
        error: function () {
            alert('Failed to load the edit form.');
        }
    });
}
