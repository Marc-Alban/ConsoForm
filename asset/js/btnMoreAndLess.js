(function ($) {
    // Définition d'un plugin jQuery pour styliser des champs numériques
    $.fn.numberstyle = function (options) {
        // Paramètres par défaut du plugin
        var settings = $.extend({
            value: 0,  // Valeur initiale
            step: 1,   // Incrément/décrément
            min: 0,    // Valeur minimale
            max: 99    // Valeur maximale
        }, options);

        // Fonction pour valider et ajuster la valeur entrée par l'utilisateur
        function sanitizeInputValue(value) {
            if (isNaN(value) || value === '') {
                return settings.min;
            }
            return Math.min(Math.max(value, settings.min), settings.max);
        }

        // Application du plugin à chaque élément sélectionné
        return this.each(function () {
            var input = $(this);
            var container = $('<div class="numberstyle-qty row"></div>');
            var btnAdd = $('<div class="btn btn-secondary qty-btn qty-add">+</div>');
            var btnRem = $('<div class="btn btn-secondary qty-btn qty-rem">-</div>');

            // Récupération des attributs min, max, step ou utilisation des valeurs par défaut
            var min = parseFloat(input.attr('min') || settings.min);
            var max = parseFloat(input.attr('max') || settings.max);
            var step = parseFloat(input.attr('step') || settings.step);
            var value = parseFloat(input.val()) || settings.value;

            // Initialisation de la valeur et activation/désactivation des boutons
            value = sanitizeInputValue(value);
            input.val(value);
            btnAdd.toggleClass('disabled', value >= max);
            btnRem.toggleClass('disabled', value <= min);

            input.wrap(container).before(btnRem).after(btnAdd);

            // Gestion du clic sur le bouton d'augmentation
            btnAdd.click(function () {
                var oldValue = parseFloat(input.val()) || 0;
                if (oldValue < max) {
                    var newVal = sanitizeInputValue(oldValue + step);
                    input.val(newVal).trigger('change');
                }
            });

            // Gestion du clic sur le bouton de diminution
            btnRem.click(function () {
                var oldValue = parseFloat(input.val()) || 0;
                if (oldValue > min) {
                    var newVal = sanitizeInputValue(oldValue - step);
                    input.val(newVal).trigger('change');
                }
            });

            // Gestion des événements de modification sur le champ
            input.on('input change', function () {
                var currentValue = input.val();
                var sanitizedValue = sanitizeInputValue(parseFloat(currentValue));
                input.val(sanitizedValue);
                btnAdd.toggleClass('disabled', sanitizedValue >= max);
                btnRem.toggleClass('disabled', sanitizedValue <= min);
            });

            // Vide le champ lors du focus et restaure la valeur précédente si le champ est vide après le focus
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

    // Initialisation automatique des éléments avec la classe '.numberstyle'
    $(function () {
        $('.numberstyle').numberstyle();
    });

})(jQuery);

$(document).ready(function(){
    // Gestion des champs avec un comportement spécifique de sélection active
    function manageActiveSelection(fieldSelector) {
        $(fieldSelector).change(function(){
            $(fieldSelector).next('label').removeClass('btn-form-active');
            if($(this).is(':checked')) {
                $(this).next('label').addClass('btn-form-active');
            }
        });
    }

    // Activation de la gestion pour différents champs spécifiés
    manageActiveSelection('input[name="logement"]');
    manageActiveSelection('input[name="proprietaireLocataire"]');
    manageActiveSelection('input[name="proprietaireHeberge"]');
});
