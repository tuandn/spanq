<?php

$desc = array(
    'id' => "txtDesc",
    'name' => 'txtDesc',
);

$hint1 = array(
    'id' => "txtHint1",
    'name' => 'txtHint1',
);

$hint2 = array(
    'id' => "txtHint2",
    'name' => 'txtHint2',
);

$pin_code = array(
    'id' => "txtPinCode",
    'name' => 'txtPinCode',
    'value' => rand(0000, 9999),
    'readonly' => 'readonly'
);

?>

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
                    <h5>Add new</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="challenge/insert" name="challenge_validate"
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
                                          id="txtNote"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Type</label>

                            <div class="controls">
                                <select name="cboType" id="cboType" style="width: 150px;" onchange="Check_Pin_code();">
                                    <option value="Question">Question</option>
                                    <option value="Activity">Activity</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Difficult</label>

                            <div class="controls">
                                <select name="cboDiff" style="width: 150px;">
                                    <option value="Easy">Easy</option>
                                    <option value="Difficulty">Difficulty</option>
                                    <option value="Choice Offered">Choice Offered</option>
                                </select>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#challenge").addClass("active");
        $("#add_challenge").addClass("active");

        Check_Pin_code();

    });
    function Check_Pin_code() {
        // check show pincode
        var val = $("#cboType").val();
        if (val.toLowerCase() == "activity")
            $("#pin_code").show();
        else
            $("#pin_code").hide();

    }

</script>