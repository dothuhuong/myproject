$(function() {
    var today = new Date();
    var maxDate = new Date(2019,0,31);
    var maxDiff = parseInt((maxDate.getTime() - today.getTime())/(1000*60*60*24)) + 1;
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: '+'+BussinessDate.getBeforeNumberOfDays(15)+'d',
        maxDate: '+'+maxDiff.toString()+'d',
        beforeShowDay: function(date) {
            var ret = [true];
            // 日曜日
            if (date.getDay() == 0) {
                ret = [true, 'sunday'];
            }
            // 祝日
            if (BussinessDate.isHoliday(date)) {
                ret = [true, 'sunday'];
            }
            return ret;
        }
    });
});