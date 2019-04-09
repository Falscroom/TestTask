$(document).ready(function(){
    $('.datepicker').datepicker({
        'autoClose' : true,
        'format' : 'yyyy/mm/dd'
    });
    $('select').formSelect();
    $('.timepicker').timepicker({
        'autoClose' : true,
        'twelveHour' : false
    });
    $('.timepicker').change(function () {
        let time = $(this).val().split(':');
        time[1] = Math.round(time[1] / 30) * 30;
        if(time[1] === 60 || time[1] === 0) {
            if(time[1] === 60)
                time[0] = time[0] === '23' ? '00' : parseInt(time[0],10) + 1;
            time[1] = '00';
        }
        $(this).val(
            time[0] + ':' + time[1]
        );
    })
});