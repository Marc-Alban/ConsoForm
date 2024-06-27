$(document).ready(function() {
    $('.date-input').on('input', function(e) {
        var input = $(this).val().replace(/\D/g, ''); // Remove all non-numeric characters
        var formatted = '';
        var valid = true;

        if (input.length > 0) {
            formatted += input.substring(0, 2);
        }
        if (input.length > 2) {
            formatted += '/' + input.substring(2, 4);
        }
        if (input.length > 4) {
            formatted += '/' + input.substring(4, 8);
        }

        if (input.length === 8) {
            // Basic validation for date format
            var day = parseInt(input.substring(0, 2), 10);
            var month = parseInt(input.substring(2, 4), 10);
            var year = parseInt(input.substring(4, 8), 10);
            if (isNaN(day) || isNaN(month) || isNaN(year) || day < 1 || day > 31 || month < 1 || month > 12 || year < 1000 || year > 9999) {
                valid = false;
            }
        } else {
            valid = false;
        }

        $(this).val(formatted);

        var errorId = '#error-' + $(this).attr('name');
        if (valid) {
            $(errorId).addClass('d-none');
            $(this).removeClass('error-input');
        } else {
            $(errorId).removeClass('d-none');
            $(this).addClass('error-input');
        }
    });
});