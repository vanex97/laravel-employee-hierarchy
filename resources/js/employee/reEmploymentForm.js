let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(".head-input").each(function () {
    $(this).autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "post",
                url: $(".head-input").attr('url'),
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
});
$('#employee-table').DataTable({
    autoWidth: false,
    ordering: false,
    searching: false,
    paging: false,
    info: false,
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 1 },
        { responsivePriority: 2, targets: -1 }
    ]
});
$('#confirm-button').click(function() {
    let $deleteAlert = $('#delete-alert');
    // Clear delete alert
    $deleteAlert.empty();

    // Get empty employee inputs
    let deletedEmployees = [];
    $('.head-input:empty').each(function () {
        if (!$(this).val()) {
            deletedEmployees.push($(this).attr('employee'));
        }
    });
    // Set alert text
    if (deletedEmployees.length) {
        $deleteAlert.append('The following employees and their subordinates will be also removed:<br>')
    }
    deletedEmployees.forEach(function (element) {
        $deleteAlert.append('<strong>'+element+'</strong><br>')
    });
})
