$(document).ready(function () {
    $("#open-modal").click(function () {
        $("#modal-dialog").dialog("open");
        return false;
    })

    $("#open-option-modal").click(function () {
        $("#modal-add-option").dialog("open");
        return false;
    })

    $("#open-check_in-modal").click(function () {
        $("#modal-check_in-option").dialog("open");
        return false;
    })

    $("#open-challenge-modal").click(function () {
        $("#modal-challenge-option").dialog("open");
        return false;
    })
    $("#open-clue-modal").click(function () {
        $("#modal-add-clue").dialog("open");
        return false;
    })

    $("#open-message-modal").click(function () {
        $(".status_send").html("");
        $("#modal-message-option").dialog("open");
        return false;
    })


    try {
        $("#modal-dialog").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");
                    location.reload();
                }
            }
        });
    } catch (e) {

    }

    try {
        $("#modal-add-option").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");
                    location.reload();
                }
            }
        });
    } catch (e) {
    }

    try {
        $("#modal-message-option").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");
                }
            }
        });
    } catch (e) {
    }

    try {
        $("#modal-check_in-option").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");
                }
            }
        });
    } catch (e) {
    }

    try {
        $("#modal-challenge-option").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");

                }
            }
        });
    } catch (e) {
    }
    try {
        $("#modal-add-clue").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Close: function () {
                    $(this).dialog("close");
                    location.reload();
                }
            }
        });
    } catch (e) {
    }
    $(".ui-dialog-titlebar-close").click(function () {
        location.reload();
    });
});

