<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php echo $this->scope["template"]["partials"]["metadata"]; ?>

<?php echo $this->scope["template"]["metadata"]; ?>

<title><?php echo $this->scope["template"]["title"]; ?></title>

<link href="http://localhost/socialnetwork/application/themes/default/css/jquery-ui.css" rel="stylesheet"
      type="text/css"/>
<link href="http://localhost/socialnetwork/application/themes/default/css/ui.theme.css" rel="stylesheet"
      type="text/css"/>

<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-1.8.0.min.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.bgiframe-2.1.2.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-ui-i18n.min.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-ui-1.8.23.custom.min.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.ui.datepicker-vi.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.corner.js"></script>
<script language="JavaScript" type="text/javascript"
        src="http://localhost/socialnetwork/application/themes/default/js/jquery/easyTooltip.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        //alert(BASE_URL);
        $("#nav-frame-email").corner("6px");
        $("#btnContinue, #easyTooltip").corner("3px");
        $("a.avatarFriend").easyTooltip();

        $.datepicker.setDefaults($.datepicker.regional[ "vi" ]);
        $("input#birthday").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1980:2010'
        });

        //Huy dialog khi load trang
        $("#dialog:ui-dialog").dialog("destroy");

        var question = $("#txtquestion"),
            allFields = $([]).add(question),
            tips = $(".validateTips");

        function updateTips(t) {
            tips
                .text(t)
                .addClass("ui-state-highlight");
            setTimeout(function () {
                tips.removeClass("ui-state-highlight", 1500);
            }, 500);
        }

        function checkLength(o, n, min, max) {
            if (o.val().length > max || o.val().length < min) {
                o.addClass("ui-state-error");
                updateTips("Độ dài của câu hỏi phải trong khoảng " +
                    min + " đến " + max + " ký tự.");
                return false;
            } else {
                return true;
            }
        }

        function createQuestion() {
            $.ajax({
                url: BASE_URL + "question/createQuestion/?question=" + question.val(),
                type: 'POST',
                dataType: 'html',
                error: function () {
                    updateTips("Chức năng đang cập nhật!");
                },
                success: function (output_string) {
                    if (parseInt(output_string) > 0) {
                        $("table#questions").append("<tr id='row" + output_string + "' style='height: 40px;'><td><input id='question" + output_string + "' type='text' disabled='disabled' style='width: 285px;' value='" + question.val() + "'> <a href='javascript:editQuestion(" + output_string + ");'>Sửa</a> | <a href='javascript:delQuestion(" + output_string + ");'>Xóa</a></td></tr>");
                        $("#dialog-form").dialog("close");
                    } else {
                        updateTips("Xử lý không thành công!");
                    }
                }
            });
        }


        function action() {
            if ($("#actionQuestion").val() == "add") {
                createQuestion();
            } else {
                updateQuestion();
            }
        }


        $("#dialog-form").dialog({
            autoOpen: false,
            height: 215,
            width: 380,
            modal: true,
            buttons: {
                " Ok ": function () {
                    var bValid = true;
                    allFields.removeClass("ui-state-error");
                    bValid = bValid && checkLength(question, "", 3, 300);
                    if (bValid) {
                        action();
                    }
                },
                "Hủy bỏ": function () {
                    $(this).dialog("close");
                }
            },
            close: function () {
                allFields.val("").removeClass("ui-state-error");
            }
        });

        $("#create-question")
            .click(function () {
                $("#dialog-form").dialog("open");
                $("#ui-dialog-title-dialog-form").text("Thêm mới câu hỏi");
                $("#actionQuestion").val("add");
                $("#questionID").val("");
                $("#txtquestion").val("");
            });

        $('input#question_off').change(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    url: BASE_URL + "user/home/updateQuestionState/0",
                    type: 'POST',
                    dataType: 'html',
                    error: function () {
                        alert("Xử lý không thành công!");
                    },
                    success: function (output_string) {
                        //alert(output_string);
                        $("table#questions").addClass("ui-state-hiden");
                        $("p#add_question").addClass("ui-state-hiden");
                        $("p#question_choice").addClass("ui-state-view");
                    }
                });
            }
        });

        $('input#question_on').change(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    url: BASE_URL + "user/home/updateQuestionState/1",
                    type: 'POST',
                    dataType: 'html',
                    error: function () {
                        alert("Xử lý không thành công!");
                    },
                    success: function (output_string) {
                        //alert(output_string);
                        $("table#questions").removeClass("ui-state-hiden");
                        $("p#add_question").removeClass("ui-state-hiden");
                        $("p#question_choice").removeClass("ui-state-view");
                    }
                });
            }
        });


    });

    function editQuestion(id) {
        //alert($( "INPUT#question"+id ).val());
        $("#dialog-form").dialog("open");
        $("#ui-dialog-title-dialog-form").text("Cập nhật câu hỏi");
        $("#actionQuestion").val("edit");
        $("#questionID").val(id);
        $("#txtquestion").val($("INPUT#question" + id).val());
    }

    function updateQuestion() {
        var id = $("#questionID").val();
        var body = $("#txtquestion").val();
        var tag = "#question" + id;
        $.ajax({
            url: BASE_URL + "question/updateQuestion/" + id + "/?body=" + body,
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert("Chức năng đang cập nhật!");
            },
            success: function (output_string) {
                if (parseInt(output_string) > 0) {
                    $(tag).val(body);
                    $("#dialog-form").dialog("close");
                } else {
                    updateTips("Xử lý không thành công!");
                }
            }
        });
    }

    function delQuestion(id) {
        var answer = confirm("Bạn có muốn xóa câu hỏi này ?");
        if (answer) {
            $.ajax({
                url: BASE_URL + "question/deleteQuestion/" + id,
                type: 'POST',
                dataType: 'html',
                error: function () {
                    alert("Chức năng đang cập nhật!");
                },
                success: function (output_string) {
                    if (parseInt(output_string) > 0) {
                        var row = "#row" + id;
                        $("#questions tbody TR").remove(row);
                    } else {
                        alert("Xóa câu hỏi không thành công!");
                    }
                }
            });
        }
    }


</script>
</head>
<body>
<div id="container">

    <!-- Banner -->
    <?php echo $this->scope["template"]["partials"]["banner"]; ?>

    <!-- /Banner -->

    <!-- Menu -->
    <?php echo $this->scope["template"]["partials"]["menu"]; ?>

    <!-- /Menu -->

    <!-- Main -->
    <div id="main">
        <!-- Top friend -->
        <?php echo $this->scope["template"]["partials"]["top_friend"]; ?>

        <!-- /Top friend -->

        <!-- Main Left -->
        <?php echo $this->scope["template"]["body"]; ?>

        <!-- /Main Left -->

        <!-- Main Right -->
        <div id="main-right">
            <?php echo $this->scope["template"]["partials"]["main_right"]; ?>

            <?php echo $this->scope["template"]["partials"]["main_right_bottom"]; ?>

        </div>
        <div class="clear"></div>
        <!-- /Main Right -->

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- /Main -->

    <!-- Footer -->
    <?php echo $this->scope["template"]["partials"]["footer"]; ?>

    <!-- /Footer -->

</div>
</body>
</html><?php /* end template body */
return $this->buffer . ob_get_clean();
?>