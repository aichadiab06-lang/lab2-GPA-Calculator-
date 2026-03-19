$(document).ready(function () {
    $('#addCourse').click(function () {
        var row = $('.course-row').first().clone();
        row.find('input').val('');
        row.append('<div class="col-auto"><button type="button" class="btn btn-danger remove-row">X</button></div>');
        $('#courses').append(row);
    });

    $(document).on('click', '.remove-row', function () {
        if ($('.course-row').length > 1) {
            $(this).closest('.course-row').remove();
        }
    });

    $('#gpaForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'calculate.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var alertClass = 'alert-info';
                    if (response.gpa >= 3.7) alertClass = 'alert-success';
                    else if (response.gpa >= 2.0) alertClass = 'alert-warning';
                    else alertClass = 'alert-danger';

                    $('#result').html('<div class="alert ' + alertClass + '">' + response.message + '</div>' + response.tableHtml);
                } else {
                    $('#result').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function () {
                $('#result').html('<div class="alert alert-danger">Server error.</div>');
            }
        });
    });
});
