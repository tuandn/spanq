<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$answer = array(
    'id' => "txtAnswer",
    'name' => 'txtAnswer',
    'size' => 100,
);

?>

<div id="content-header">
    <h1>Responses</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>response" class="current">Responses</a>
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
                    <form class="form-horizontal" method="post" action="response/insert" name="response_validate"
                          id="response_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Answer</label>

                            <div class="controls">
                                <?php echo form_input($answer) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Challenge</label>

                            <div class="controls">
                                <?php echo $cboChallenge ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <a href="<?php echo base_url(); ?>challenge/addchallenge" class="btn btn-primary">New
                                    Challenge</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>

                            <div class="controls">
                                <?php echo $cboStatus ?>
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
        $("#response").addClass("active");
        $("#add_response").addClass("active");
    });
</script>
