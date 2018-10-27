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
                $('#series_edit').val(series.series);
                $('#description').val(series.description);
                $('#Authors').val(series.author_id).trigger("change")
            },
            error: function (err) {
            }
        });
    });
});