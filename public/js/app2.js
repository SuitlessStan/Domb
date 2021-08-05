$(document).ready(function() {
    $(function() {
        $('[data-tooltip="tooltip"]').tooltip();

        setInterval(function() { $('.navbar-brand').toggleClass('rotate-180') }, 1500);
        setInterval(function() { $('#surfer').toggleClass('rotate-x') }, 700);
        changeColor('#home-icon', ['#af3dff', '#55ffe1', '#ff3b94', '#a6fd29', '#37013a'], 1000);

    });

    // Alternate colors
    function changeColor(selector, colors, time) {
        /* Params:
         * selector: string,
         * colors: array of color strings,
         * every: integer (in mili-seconds)
         */
        var curCol = 0,
            timer = setInterval(function() {
                if (curCol === colors.length) curCol = 0;
                $(selector).css("color", colors[curCol]);
                curCol++;
            }, time);
    }

    // Display today's date
    var objToday = new Date(),
        weekday = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
        dayOfWeek = weekday[objToday.getDay()],
        domEnder = function() {
            var a = objToday;
            if (/1/.test(parseInt((a + "").charAt(0)))) return "th";
            a = parseInt((a + "").charAt(1));
            return 1 == a ? "st" : 2 == a ? "nd" : 3 == a ? "rd" : "th"
        }(),
        dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() + domEnder : objToday.getDate() + domEnder,
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
        curMonth = months[objToday.getMonth()],
        curYear = objToday.getFullYear(),
        curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
        curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),
        curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),
        curMeridiem = objToday.getHours() > 12 ? "PM" : "AM";
    var today = dayOfWeek + " " + dayOfMonth + " of " + curMonth;
    $('#date').html(today);





    $('#showForm').click(function() {

        $('#add_task').addClass('d-none');
        $('.form-container').removeClass('d-none');

    });

    $('#cancelTask').click(function() {

        $('.activities-container').addClass('d-none');
        $('.form-container').addClass('d-none');
        $('#add_task').removeClass('d-none');

    });

    $('#closeModal').click(function() {

        $('#add_task').removeClass('d-none');

    });

    $('#closeModalButton').click(function() {

        $('#add_task').removeClass('d-none');

    });









});
