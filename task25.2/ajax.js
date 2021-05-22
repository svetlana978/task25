$(document).ready(function() {
    $("#btn").click(
        function() {
            sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url: url, //url страницы (database.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            token = result.token;
            check(token, 'ajax_form', 'database.php');
        },
        error: function(response) { // Данные не отправлены
            //$('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}

function check(token, ajax_form, url) {
    $.ajax({
        url: url, //url страницы (database.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            //$('#result_form').html('tok: ' + token);
            database.checkLogPas(token);
        },
        error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}