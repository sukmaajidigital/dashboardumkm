document.addEventListener('DOMContentLoaded', function () {
    // Ekspos fungsi ke window object
    window.loadEditForm = function (url) {
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
    };
    window.loadViewForm = function (url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#viewFormContainer').html(response);
            },
            error: function () {
                alert('Failed to load the edit form.');
            }
        });
    };

    window.loadCreateForm = function (url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#createFormContainer').html(response);
            },
            error: function () {
                alert('Failed to load the create form.');
            }
        });
    };
    window.loadCreateSubForm = function (url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#createSubFormContainer').html(response);
            },
            error: function () {
                alert('Failed to load the create form.');
            }
        });
    };
    window.loadCreateSub2Form = function (url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#createSub2FormContainer').html(response);
            },
            error: function () {
                alert('Failed to load the create form.');
            }
        });
    };
});
