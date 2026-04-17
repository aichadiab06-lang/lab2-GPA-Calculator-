
$(document).ready(function () {
    $('#addCourse').click(function () {
        var row = $('.course-row').first().clone();
        row.find('input').val('');
        row.append('<div class="col-md-1"><button type="button" class="btn btn-danger remove-row">×</button></div>');
        $('#courses').append(row);
    });

    $(document).on('click', '.remove-row', function () {
        if ($('.course-row').length > 1) {
            $(this).closest('.course-row').remove();
        }
    });

    $('#gpaForm').submit(function (e) {
        e.preventDefault();
        $('#result').html('<div class="alert alert-secondary text-center">جاري حساب المعدل...</div>');

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

                    $('#result').html('<div class="alert ' + alertClass + ' text-center fw-bold">' + response.message + '</div>' + response.tableHtml);
                } else {
                    $('#result').html('<div class="alert alert-danger text-center">' + response.message + '</div>');
                }
            },
            error: function () {
                $('#result').html('<div class="alert alert-danger text-center">خطأ في الاتصال بالخادم.</div>');
             }
        });
    });
});
