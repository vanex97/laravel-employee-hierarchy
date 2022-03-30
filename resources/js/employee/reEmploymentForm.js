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
