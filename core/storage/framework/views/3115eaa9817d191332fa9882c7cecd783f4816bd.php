<script>
    (function ($) {
        "use strict"

        $(document).ready(function () {
            $('.icp-dd').iconpicker();

            $('.icp-dd').on('iconpickerSelected', function (e) {
                let selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
        });
    })(jQuery);

    function setSelectedClass(selector, className) {
        $(selector).parent().find('.icp-dd').data('selected', className);
        $(selector).parent().find('.iconpicker-component i').attr('class', className);
        $(selector).val(className)
    }
</script>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/iconpicker/js.blade.php ENDPATH**/ ?>