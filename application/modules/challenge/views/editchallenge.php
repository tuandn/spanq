<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$desc = array(
    'id' => "txtDesc",
    'name' => 'txtDesc',
    'value' => $challenge->Description
);

$hint1 = array(
    'id' => "txtHint1",
    'name' => 'txtHint1',
    'value' => $challenge->Hint1
);

$hint2 = array(
    'id' => "txtHint2",
    'name' => 'txtHint2',
    'value' => $challenge->Hint2
);

$pin_code = array(
    'id' => "txtPinCode",
    'name' => 'txtPinCode',
    'value' => $challenge->pincode,
    'readonly' => 'readonly'
);

$answer = array(
    'id' => "txtAnswer",
    'name' => 'txtAnswer',
    'size' => 100,
);

// edit type
$type = array("Question", "Activity");

$cboType = "<select name=\"cboType\" id=\"cboType\" style=\"width: 150px;\" onchange=\"Check_Pin_code();\">";
$t = $challenge->Type;

foreach ($type as $i) {
    $s = $t == $i ? "selected" : "";
    $cboType .= "<option value=\"" . $i . "\" " . $s . ">" . $i . "</option>";
}
$cboType .= "</select>";


//edit difficulty
$difficulty = array("Easy", "Difficulty", "Choice Offered");

$cboDiff = "<select name=\"cboDiff\" style=\"width: 150px;\">";
$diff = $challenge->Difficulty;

foreach ($difficulty as $i) {
    $s = $diff == $i ? "selected" : "";
    $cboDiff .= "<option value=\"" . $i . "\" " . $s . ">" . $i . "</option>";
}
$cboDiff .= "</select>";

?>
<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/challenge.js"></script>

<div id="content-header">
    <h1>Challenges</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>challenge" class="current">Challenges</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5><?php echo $challenge->Description; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="challenge/update" name="challenge_validate"
                          id="challenge_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Description</label>

                            <div class="controls">
                                <?php echo form_input($desc) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Notes</label>

                            <div class="controls">
                                <textarea rows="3" style="width: 100%" name="txtNote"
                                          id="txtNote"><?php echo $challenge->Notes; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Type</label>

                            <div class="controls">
                                <?php echo $cboType; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Difficult</label>

                            <div class="controls">
                                <?php echo $cboDiff; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Hint1</label>

                            <div class="controls">
                                <?php echo form_input($hint1) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Hint2</label>

                            <div class="controls">
                                <?php echo form_input($hint2) ?>
                            </div>
                        </div>
                        <div class="control-group" id="pin_code">
                            <label class="control-label">Pin code</label>

                            <div class="controls">
                                <?php echo form_input($pin_code) ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="hidden" id="txtId" name="txtId" value="<?php echo $challenge->Id; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Responses</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php foreach ($listResponse as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->Answer; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      response_id="<?php echo $item->Id; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini remove_response"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-option-modal" class="btn btn-primary">Add option</a>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Available Stations</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php foreach ($listStation as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->StationName; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      station_id="<?php echo $item->StationId; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini remove_button"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-modal" class="btn btn-primary">Add exist station</a>
                    <a href="<?php echo base_url(); ?>station/addstation" class="btn btn-primary">Add new station</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-dialog" title="Available Stations">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Add</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allStation as $item): ?>
                    <tr>
                        <td><?php echo $item->Name; ?></td>
                        <td>
                            <input type="button" value="add"
                                   station_id="<?php echo $item->Id; ?>"
                                   name="btnAdd"
                                   class="btn btn-primary btn-mini" onclick="return AddStation(this)"/>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-add-option" title="Add Response">
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
                    <label class="control-label">Answer</label>

                    <div class="controls">
                        <?php echo form_input($answer) ?>
                        <span id="status-answer" class="error-inline"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Status</label>

                    <div class="controls">
                        <select name="cbStatus" id="cbStatus" style="width: 200px;">
                            <option value="1">True</option>
                            <option value="0">False</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="button" value="Save" class="btn btn-primary" id="btn_add_response">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    function Check_Pin_code() {
        // check show pincode
        var val = $("#cboType").val();
        if (val.toLowerCase() == "activity")
            $("#pin_code").show();
        else
            $("#pin_code").hide();

    }

    $(document).ready(function () {
        Check_Pin_code();

        $("#challenge").addClass("active");

        $("#btn_add_response").click(function () {
            var challenge_id = $("#txtId").val();
            var answer = $("#txtAnswer").val();
            var status = $("#cbStatus").val();

            if (answer.trim() == "") {
                $("#status-answer").html("Required.");
            } else {
                $("#status-answer").html("");
                var data_string = 'challenge_id=' + challenge_id + '&answer=' + answer + '&status=' + status;
                $.ajax({
                    type: "POST",
                    url: BASE_URI + "challenge/add_response",
                    data: data_string,
                    success: function (data_form) {
                        if (data_form) {
                            $('.status').html('Add response successfully.');
                            $("#txtAnswer").val("");
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                    }
                });
            }
        });

    });

</script>