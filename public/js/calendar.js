function addListeners() {
    $('.vcal-date').click(function ($e) {
        $(this).hasClass('vcal-date--selected') ? $(this).removeClass('vcal-date--selected') : $(this).addClass('vcal-date--selected');

        let el = $('.vcal-date--selected');
        if( el.length  === 2 )
            el.eq(0).nextUntil(el.eq(1)).addClass('vcal-date--selected');
        if(el.length > 2)
            el.removeClass('vcal-date--selected');
    });
}
$(document).ready( function () {
    vanillaCalendar.init({
        sundayFirst: true,
    });
    $(function () {
        $('.day-time').datetimepicker({
            format: 'HH:mm',
        });
    });
    $('.vcal-btn').click( function ($e) {
        addListeners();
    });
    $('.icheckbox_square-blue').on('change',function ($e) {
        if($(this).hasClass('checked'))
            $(this).parents('.day-container').find('.day-time').attr("disabled", false);
        else
            $(this).parents('.day-container').find('.day-time').attr("disabled", true);
    });
    addListeners();
});
$('#form_save').click( function ($e) {
    let el = $('.vcal-date--selected');
    if(el.length >= 1) {
        let inputs = $('.range');
        inputs.eq(0).val(
            el.first().data('calendar-date')
        );
        inputs.eq(1).val(
            el.last().data('calendar-date')
        );
    }
});