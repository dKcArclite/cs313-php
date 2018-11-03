$(document).ready(function () {
    $('#series').DataTable({
        "order": [[1, "asc"]]
    });

    var table = $('#series').DataTable();

    $('#series tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        var series_id = data[0];

        $.ajax({
            type: "post",
            url: "ProcessAjax.php",
            data: { function2call: 'get_series_by_id', series_id: series_id },
            cache: false,
            success: function (data) {
                var series = JSON.parse(data);
                $('#author_id').val(series.author_id);
                $('#series_id').val(series.series_id);
                $('#series_edit_input').val(series.series);
                $('#description').val(series.description);
                $('#Authors').val(series.author_id).trigger("change");
                updateCount();
            },
            error: function (err) {
            }
        });
    });

    function updateCount() {
        var length = $('#description').val().length;
        var length = 1000 - length;
        $('#chars').text(length);
    }
});