$(document).ready(function () {
    $('#authors').DataTable({
        "order": [[1, "asc"]]
    });
    var table = $('#authors').DataTable();

    $('#authors tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        var author_id = data[0];

        $.ajax({
            type: "post",
            url: "ProcessAjax.php",
            data: { function2call: 'get_author', author_id: author_id },
            cache: false,
            success: function (data) {
                var author = JSON.parse(data);
                $('#author_id').val(author.author_id);
                $('#first_name').val(author.first_name);
                $('#middle_name').val(author.middle_name);
                $('#last_name').val(author.last_name);
            },
            error: function (err) {

            }
        });
    });
});