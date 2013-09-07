<?php

$answer = array(
    'id' => "txtAnswer",
    'name' => 'txtAnswer',
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
                    <h5>Add new</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="who_am_i/insert" name="who_am_i_validate"
                          id="who_am_i_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Answer</label>

                            <div class="controls">
                                <?php echo form_input($answer) ?>
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
        $("#who_am_i").addClass("active");
    });
</script>