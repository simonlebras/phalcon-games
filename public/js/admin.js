$(function () {
    $('.admin button').click(function () {
        if (confirm("Are you sure you want to delete this account")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/admin/delete',
                data: {'id': id}
            }).done(function (data) {
                $('#'+id).fadeOut();
            }).fail(function () {
                alert("An error occured");
            })
        }
    });
});