function delete_db_obj (url) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "DELETE",
        url: url,
        data:{ _token: _token},
        success: function(html){
            location.reload();
        }
    });
}
