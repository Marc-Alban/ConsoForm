$(document).ready(function() {
    $('.input-number').on('input', function(e) {
        var input = $(this).val().replace(/[^\d]/g, ''); // Remove all non-numeric characters
        var formatted = input.replace(/\B(?=(\d{3})+(?!\d))/g, ' '); // Add space as thousand separator

        $(this).val(formatted);

        var valid = /^\d+( \d{3})*$/.test(formatted); // Check if input contains only digits and spaces in correct format

        var errorId = '#error-' + $(this).attr('name');
        var $inputGroupText = $(this).siblings('.input-group-text');
        if (valid) {
            $(errorId).addClass('d-none');
            $(this).removeClass('error-input');
            $inputGroupText.removeClass('input-group-text-error');
        } else {
            $(errorId).removeClass('d-none');
            $(this).addClass('error-input');
            $inputGroupText.addClass('input-group-text-error');
        }
    });

    // Telephone input validation
    $('.input-tel').on('input', function(e) {
        var input = $(this).val().replace(/\D/g, ''); // Remove all non-numeric characters
        $(this).val(input);

        var valid = /^\d{10}$/.test(input); // Check if input is exactly 10 digits

        var errorId = '#error-' + $(this).attr('name');
        if (valid) {
            $(errorId).addClass('d-none');
            $(this).removeClass('error-input');
        } else {
            $(errorId).removeClass('d-none');
            $(this).addClass('error-input');
        }
    });

    // Email input validation
    $('.input-email').on('input', function(e) {
        var input = $(this).val();
        var valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input); // Basic email validation regex

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