/*
 * Plugin jQuery pour la gestion de l'incrémentation et décrémentation de valeurs numériques
 *
 * Contenu:
 * 1. Initialisation du plugin avec des options par défaut
 * 2. Fonction de validation et de nettoyage de la valeur d'entrée
 * 3. Configuration des boutons d'incrémentation et de décrémentation
 * 4. Gestion des événements de clic sur les boutons
 * 5. Gestion des événements de changement et de saisie sur le champ de saisie
 * 6. Initialisation automatique pour les éléments avec la classe `.numberstyle`
 */


/*
 * Script de gestion de masque pour les champs de saisie numérique
 *
 * Contenu:
 * 1. Initialisation et gestion des champs de saisie numériques avec masque
 *    1.1. Masquage du champ de saisie numérique original
 *    1.2. Création et gestion du champ de saisie texte affiché
 *    1.3. Synchronisation des valeurs entre les champs
 */

$(document).ready(function () {
    $("input[type='number'].mask").each(function () {
        let $numberInput = $(this);

        // 1.1. Masquage du champ de saisie numérique original
        let originalPlaceholder = $numberInput.attr('placeholder');
        $numberInput.css({
            opacity: 0,
            position: 'absolute',
            zIndex: -1,
        });

        // 1.2. Création et gestion du champ de saisie texte affiché
        let $textDisplay = $("<input type='text' inputmode='numeric' class='mask-display form-control form-input col-11' placeholder='" + originalPlaceholder + "'/>");
        $textDisplay.css({
            position: 'relative',
            zIndex: 1,
        }).insertAfter($numberInput);

        let originalId = $numberInput.attr('id');
        $textDisplay
            .attr('id', originalId + '_text')
            .css({
                position: 'relative',
                zIndex: 1,
            })
            .insertAfter($numberInput);

        // 1.3. Synchronisation des valeurs entre les champs
        $textDisplay.on('input', function () {
            let inputValue = $(this).val().replace(/\D/g, '');
            let numericValue = inputValue.length > 9 ? inputValue.substring(0, 9) : inputValue;
            $numberInput.val(numericValue);
            let formattedValue = numericValue.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
            $(this).val(formattedValue);
        });

        if ($numberInput.val()) {
            $textDisplay.val($numberInput.val().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ")).trigger('input');
        }
    });
});

(function ($) {
    $.fn.numberstyle = function (options) {
        var settings = $.extend({
            value: 0,
            step: 1,
            min: 0,
            max: 99
        }, options);

        // 2. Fonction de validation et de nettoyage de la valeur d'entrée
        function sanitizeInputValue(value) {
            if (isNaN(value) || value === '') {
                return settings.min;
            }
            return Math.min(Math.max(value, settings.min), settings.max);
        }

        return this.each(function () {
            var input = $(this);
            var container = $('<div class="numberstyle-qty row"></div>');
            var btnAdd = $('<div class="btn btn-secondary qty-btn qty-add">+</div>');
            var btnRem = $('<div class="btn btn-secondary qty-btn qty-rem">-</div>');

            var min = parseFloat(input.attr('min') || settings.min);
            var max = parseFloat(input.attr('max') || settings.max);
            var step = parseFloat(input.attr('step') || settings.step);
            var value = parseFloat(input.val()) || settings.value;

            // Set up initial values and disable buttons if necessary
            value = sanitizeInputValue(value);
            input.val(value);
            btnAdd.toggleClass('disabled', value >= max);
            btnRem.toggleClass('disabled', value <= min);

            // 3. Configuration des boutons d'incrémentation et de décrémentation
            input.wrap(container).before(btnRem).after(btnAdd);

            // 4. Gestion des événements de clic sur les boutons
            btnAdd.click(function () {
                var oldValue = parseFloat(input.val()) || 0;
                if (oldValue < max) {
                    var newVal = sanitizeInputValue(oldValue + step);
                    input.val(newVal).trigger('change');
                }
            });

            btnRem.click(function () {
                var oldValue = parseFloat(input.val()) || 0;
                if (oldValue > min) {
                    var newVal = sanitizeInputValue(oldValue - step);
                    input.val(newVal).trigger('change');
                }
            });

            // 5. Gestion des événements de changement et de saisie sur le champ de saisie
            input.change(function () {
                var newVal = sanitizeInputValue(parseFloat(input.val()));
                input.val(newVal);
                btnAdd.toggleClass('disabled', newVal >= max);
                btnRem.toggleClass('disabled', newVal <= min);
            });

            input.on('input change', function () {
                var currentValue = input.val();
                var sanitizedValue = sanitizeInputValue(parseFloat(currentValue));
                if (currentValue !== '' && (isNaN(sanitizedValue) || currentValue !== sanitizedValue.toString())) {
                    input.val(sanitizedValue);
                }
                btnAdd.toggleClass('disabled', sanitizedValue >= max);
                btnRem.toggleClass('disabled', sanitizedValue <= min);
            });

            // Empty the field on focus and restore on focusout if empty
            input.focus(function () {
                $(this).data('oldValue', input.val());
                input.val('');
            }).focusout(function () {
                if (input.val() === '') {
                    var oldValue = $(this).data('oldValue');
                    input.val(oldValue || settings.min).trigger('change');
                }
            });
        });
    };

    // 6. Initialisation automatique pour les éléments avec la classe `.numberstyle`
    $(function () {
        $('.numberstyle').numberstyle();
    });

})(jQuery);

/*
 * Script de gestion des classes actives pour les boutons radio et les cases à cocher
 *
 * Contenu:
 * 1. Initialisation et gestion des changements d'état des boutons radio et des cases à cocher
 *    1.1. Gestion du champ "logement"
 *    1.2. Gestion du champ "proprietaireLocataire"
 *    1.3. Gestion du champ "proprietaireHeberge"
 *    1.4. Gestion du champ "fichageBanque"
 *    1.5. Gestion du champ "civilite"
 *    1.6. Gestion du champ "tresorerieYesOrNot"
 *    1.7. Gestion du champ "emprunt"
 */

$(document).ready(function(){
    // 1.1. Gestion du champ "logement"
    $('input[name="logement"]').change(function(){
        $('input[name="logement"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.2. Gestion du champ "proprietaireLocataire"
    $('input[name="proprietaireLocataire"]').change(function(){
        $('input[name="proprietaireLocataire"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.3. Gestion du champ "proprietaireHeberge"
    $('input[name="proprietaireHeberge"]').change(function(){
        $('input[name="proprietaireHeberge"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.4. Gestion du champ "fichageBanque"
    $('input[name="fichageBanque"]').change(function(){
        $('input[name="fichageBanque"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.5. Gestion du champ "civilite"
    $('input[name="civilite"]').change(function(){
        $('input[name="civilite"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.6. Gestion du champ "tresorerieYesOrNot"
    $('input[name="tresorerieYesOrNot"]').change(function(){
        // Remove 'active' class from all buttons
        $('input[name="tresorerieYesOrNot"]').next('label').removeClass('btn-form-active');

        // Add 'active' class to the selected button
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });

    // 1.7. Gestion du champ "emprunt"
    $('input[name="emprunt"]').change(function(){
        $('input[name="emprunt"]').next('label').removeClass('btn-form-active');
        if($(this).is(':checked')) {
            $(this).next('label').addClass('btn-form-active');
        }
    });
});
