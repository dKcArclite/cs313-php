$(document).ready(function () {

    var table = $('#genres').DataTable();

    $('#genres tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        var genre_id = data[0];

        $.ajax({
            type: "post",
            url: "ProcessAjax.php",
            data: { function2call: 'get_genre', genre_id: genre_id },
            cache: false,
            success: function (data) {
                var genre = JSON.parse(data);
                $('#genre_id').val(genre.genre_id);
                $('#genre').val(genre.genre);
                $('#description').val(genre.description);
            },
            error: function (err) {
            }
        });
    });
});