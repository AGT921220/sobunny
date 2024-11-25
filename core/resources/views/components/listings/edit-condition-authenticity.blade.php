<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {

            @if(!empty($condition))
                $("#item-condition").prop("checked", true);
                $(".condition_disable_enable input[type='radio']").prop("disabled", false);
                $("#condition-1").removeClass('radio_disable_color');
                $("#condition-2").removeClass('radio_disable_color');
            @else
                $("#item-condition").prop("checked", false);
                $(".condition_disable_enable input[type='radio']").prop("disabled", true);
            @endif


            $(document).on('click', '#item-condition', function() {
                if ($(this).prop("checked")) {
                    $(".condition_disable_enable input[type='radio']").prop("disabled", false);
                    $("#condition-1").removeClass('radio_disable_color');
                    $("#condition-2").removeClass('radio_disable_color');
                } else {
                    // If checkbox is unchecked, uncheck radio buttons, disable them, and add disable color
                    $("#condition-1 input[type='radio']").prop("checked", false);
                    $("#condition-2 input[type='radio']").prop("checked", false);

                    $(".condition_disable_enable input[type='radio']").prop("disabled", true);
                    $("#condition-1").addClass('radio_disable_color');
                    $("#condition-2").addClass('radio_disable_color');
                }
            });

            @if(!empty($authenticity))
                $("#item-authenticity").prop("checked", true);
                $(".authenticity_disable_enable input[type='radio']").prop("disabled", false);
                $("#authenticity-1").removeClass('radio_disable_color');
                $("#authenticity-2").removeClass('radio_disable_color');
            @else
                $("#item-authenticity").prop("checked", false);
                $(".authenticity_disable_enable input[type='radio']").prop("disabled", true);
            @endif

            $(document).on('click', '#item-condition', function() {
                if ($(this).prop("checked")) {
                    $(".authenticity_disable_enable input[type='radio']").prop("disabled", false);
                    $("#authenticity-1").removeClass('radio_disable_color');
                    $("#authenticity-2").removeClass('radio_disable_color');
                } else {
                    // If checkbox is unchecked, uncheck radio buttons, disable them, and add disable color
                    $("#authenticity-1 input[type='radio']").prop("checked", false);
                    $("#authenticity-2 input[type='radio']").prop("checked", false);

                    $(".authenticity_disable_enable input[type='radio']").prop("disabled", true);
                    $("#authenticity-1").addClass('radio_disable_color');
                    $("#authenticity-2").addClass('radio_disable_color');
                }
            });

            // Radio button change event
            $(document).on('click', 'input[name="condition"]', function() {
                $('#hiddenCondition').val($(this).val());
            });

            // Radio button change event Authenticity
            $(document).on('click', 'input[name="authenticity"]', function() {
                $('#hiddenAuthenticity').val($(this).val());
            });

            // Condition radio buttons
            $(document).on('change', 'input[name="condition"]', function () {
                let selectedValue = $('input[name="condition"]:checked').val();
                $('#condition').val(selectedValue);
            });

            // authenticity radio buttons
            $(document).on('change', 'input[name="authenticity"]', function () {
                let selectedValue = $('input[name="authenticity"]:checked').val();
                $('#authenticity').val(selectedValue);
            });
        });
    })(jQuery)
</script>