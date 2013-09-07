$(document).ready(function () {

    $(".remove_button").click(function () {
        var c = confirm("are you sure?");
        if (c) {
            var user_id = $(this).attr('user_id');
            RemoveUser(user_id);
            $(this).parent().parent().remove();
        }
    });

});

function AddUser(item) {
    var group_id = $("#txtId").val();
    var data_string = 'groupId=' + group_id + '&userId=' + $(item).attr('user_id');
    $.ajax({
        type: "POST",
        url: BASE_URI + "group/add_group_user",
        data: data_string,
        success: function (data_form) {
            if (data_form) {
                $('.status').html('Add station successfully.').css('color', "blue");
            }else{
                $('.status').html('station is existed.').css('color', "red");
                console.log('station is existed.');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('station is existed.').css('color', "red");
            console.log(xhr);
        }
    });
}
function RemoveUser(user_id) {
    var group_id = $("#txtId").val();
    var data_string = 'groupId=' + group_id + '&userId=' + user_id;
    $.ajax({
        type: "POST",
        url: BASE_URI + "group/delete_group_user",
        data: data_string,
        success: function (data_form) {
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}
