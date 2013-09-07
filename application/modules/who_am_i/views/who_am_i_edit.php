<?php

$answer = array(
    'id' => "txtAnswer",
    'name' => 'txtAnswer',
    'value' => $who_am_i->Answer
);

?>

<div id="content-header">
    <h1>Who Am I</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>who_am_i" class="current">Answers</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5><?php echo $who_am_i->Answer; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="update" name="who_am_i_validate"
                          id="who_am_i_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Answer</label>

                            <div class="controls">
                                <?php echo form_input($answer) ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="hidden" name="txtId" id="txtId" value="<?php echo $who_am_i->Id; ?>">
                        </div>
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Clues</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Clue</th>
                            <th>Position</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list_clue as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->Clue; ?></td>
                                <td style="text-align: left;"><?php echo $item->Position; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      id="<?php echo $item->Id; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini"
                                                                      onclick="DeleteClue(this);"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-clue-modal" class="btn btn-primary">Add clue</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    function DeleteClue(item) {
        var c = confirm("Are you sure ?");
        if (c) {
            var data_string = 'Id=' + $(item).attr('id');
            $.ajax({
                type: "POST",
                url: "delete_clue",
                data: data_string,
                success: function (data_form) {
                    $(item).parent().parent().remove();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        }
    }

    $(document).ready(function () {
        $("#who_am_i").addClass("active");

        $("#btn_add_clue").click(function () {
            var answer_id = $("#txtId").val();
            var clue = $("#txtClue").val();
            var pos = $("#txtPosition").val();

            if (clue.trim() == "") {
                $("#status-answer").html("Required.");
                return false;
            }
            if (pos == "") {
                $("#status-pos").html("Required.");
                return false;
            }

            $("#status-answer").html("");
            var data_string = 'position=' + pos + '&answer_id=' + answer_id + '&clue=' + clue;
            $.ajax({
                type: "POST",
                url: BASE_URI + "who_am_i/insert_clue",
                data: data_string,
                success: function (data_form) {
                    if (data_form) {
                        $('.status').css("color","blue").html('Add response successfully.');
                        $("#txtClue").val("");
                        $("#txtPosition").val("0");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });

        });
    });
</script>

<div id="modal-add-clue" title="<?php echo "Add clue for answer " . $who_am_i->Answer ?>">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Clue</label>

                    <div class="controls">
                        <input type="text" name="txtClue" id="txtClue"/>
                        <span id="status-answer" class="error-inline"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Position</label>

                    <div class="controls">
                        <input type="text" name="txtPosition" id="txtPosition" value="0"
                               onkeypress="return isNumberKey(event)"/>
                        <span id="status-pos" class="error-inline"></span>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="button" value="Save" class="btn btn-primary" id="btn_add_clue">
                </div>
            </form>
        </div>
    </div>
</div>