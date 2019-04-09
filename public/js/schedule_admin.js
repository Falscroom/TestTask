$(function () {
    $('.day-time').datetimepicker({
        format: 'HH:mm',
    });

    $(document).ready(function () {
        $('.icheckbox_square-blue').on('change',function ($e) {
            if($(this).hasClass('checked'))
                $(this).parents('.day-container').find('.day-time').attr("disabled", false);
            else
                $(this).parents('.day-container').find('.day-time').attr("disabled", true);
        });

        $('.icheckbox_square-blue.checked').parents('.day-container').find('.day-time').attr("disabled", true);
    })
});