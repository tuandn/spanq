$(document).ready(function () {

    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();

    $('select').select2();

    $("#area_validate").validate({
        rules: {
            txtName: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#group_validate").validate({
        rules: {
            txtName: {
                required: true
            },
            txtContact: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#user_validate").validate({
        rules: {
            txtName: {
                required: true
            },
            txtEmail: {
                required: true,
                email: true
            },
            txtPhone: {
                required: true
            },
            txtPassword: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            txtConfirm: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#txtPassword"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#change_pass_validate").validate({
        rules: {
            txtPassword: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            txtConfirm: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#txtPassword"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#landmark_validate").validate({
        rules: {
            txtName: {
                required: true
            },
            txtLat: {
                required: true
            },
            txtLong: {
                required: true
            },
            txtAddress: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#response_validate").validate({
        rules: {
            txtAnswer: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#challenge_validate").validate({
        rules: {
            txtDesc: {
                required: true
            },
            txtHint1: {
                required: true
            },
            txtHint2: {
                required: true
            },
            txtNote: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#station_validate").validate({
        rules: {
            txtName: {
                required: true
            },
            txtEmail: {
                required: true,
                email: true
            },
            txtPerson: {
                required: true
            },
            txtPhone: {
                required: true
            },
            txtClue: {
                required: true
            },
            txtLat: {
                required: true
            },
            txtLong: {
                required: true
            },
            txtAddress: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#murder_validate").validate({
        rules: {
            txtType: {
                required: true
            },
            txtValue: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#challenge_setting_validate").validate({
        rules: {
            txtEBasePoint: {
                required: true,
                number: true
            },
            txtEpen: {
                required: true,
                number: true
            },
            txtEMaxNo: {
                required: true,
                number: true
            },
            txtDBasePoint: {
                required: true,
                number: true
            },
            txtDpen: {
                required: true,
                number: true
            },
            txtDMaxNo: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#checkin_setting_validate").validate({
        rules: {
            txtNoInvalid: {
                required: true,
                number: true
            },
            txtPenInvalid: {
                required: true,
                number: true
            },
            txtMaxNoPen: {
                required: true,
                number: true
            },
            txtMaxPoint: {
                required: true,
                number: true
            },
            txtMaxPointMini: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#who_am_i_setting_validate").validate({
        rules: {
            txtMaxPointMini: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#startgame_validate").validate({
        rules: {
            txtStations: {
                required: true,
                number: true,
                min: 1
            },
            txtTeams: {
                required: true,
                number: true,
                min: 1
            },txtGameName: {
                required: true
            }
            ,txtPhoneHint: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
    $("#who_am_i_validate").validate({
        rules: {
            txtAnswer: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
});