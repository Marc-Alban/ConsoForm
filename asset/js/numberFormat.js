$(document).ready(function() {
    // Fonction de formatage des nombres avec des espaces
    function formatNumberWithSpaces(number) {
        return number.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    }

    // Fonction pour synchroniser les valeurs entre le champ visible et le champ caché
    function synchronizeValues($textInput, $numberInput) {
        var rawValue = $numberInput.val().replace(/[^\d]/g, '');
        var formattedValue = formatNumberWithSpaces(rawValue);
        $textInput.val(formattedValue);
        $numberInput.val(rawValue);
    }

    // Ajout des champs de texte virtuels
    $('.input-number').each(function() {
        var $numberInput = $(this);
        var $textInput = $('<input>', {
            type: 'text',
            class: $numberInput.attr('class'),
            placeholder: $numberInput.attr('placeholder'),
            'data-hidden-input': $numberInput.attr('id')
        });

        $numberInput.after($textInput);
        $numberInput.hide();

        // Synchronisation initiale des valeurs
        synchronizeValues($textInput, $numberInput);

        // Événement de saisie sur le champ de texte virtuel
        $textInput.on('input', function() {
            var input = $textInput.val().replace(/[^\d]/g, ''); // Supprimer tous les caractères non numériques
            var formatted = formatNumberWithSpaces(input);

            // Mettre à jour le champ de texte virtuel avec la valeur formatée
            $textInput.val(formatted);

            // Mettre à jour le champ caché avec la valeur brute
            $numberInput.val(input);

            // Validation
            var valid = /^\d+( \d{3})*$/.test(formatted); // Vérifier si l'entrée contient uniquement des chiffres et des espaces au format correct

            var errorId = '#error-' + $numberInput.attr('name');
            var $inputGroupText = $textInput.siblings('.input-group-text');
            if (valid) {
                $(errorId).addClass('d-none');
                $textInput.removeClass('error-input');
                $inputGroupText.removeClass('input-group-text-error');
            } else {
                $(errorId).removeClass('d-none');
                $textInput.addClass('error-input');
                $inputGroupText.addClass('input-group-text-error');
            }
        });
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
