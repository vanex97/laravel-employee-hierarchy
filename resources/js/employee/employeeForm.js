let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

// Select 2 for position input.
let $positionSelect = $('#position-select').select2({
    theme: 'bootstrap4',
    ajax: {
        url: $('#position-select').attr('url'),
        dataType: 'json',
        type: "post",
        delay: 250,
        data:
            function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
        processResults: function (response) {
            return {
                results: response
            };
        },
        cache: true
    }
});
// Autocomplete for head input.
$("#head-input").autocomplete({
    source: function (request, response) {
        $.ajax({
            type: "post",
            url: $('#head-input').attr('url'),
            data: {
                _token: CSRF_TOKEN,
                term: request.term
            },
            dataType: "json",
            success: function (data) {
                var resp = $.map(data, function (obj) {
                    return obj.name;
                });
                response(resp);
            }
        });
    },
    minLength: 2
});
// Datetimepicker for date input.
$('#employment_date').datetimepicker({
    format: 'DD/MM/YY'
});
// Format salary value before submit form.
$('#employee_form').submit(function () {
    // Remove commas from salary value
    let $salary = $(this).find("input[name=salary]");
    $salary.val($salary.val().replaceAll(',', ''));
});
