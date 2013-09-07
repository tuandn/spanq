<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 7:06 PM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
    'size' => 100,
    'class' => 'large-text',
    'value' => set_value('txtName')
);

?>


<div id="content-header">
    <h1>Areas</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>area" class="current">Areas</a>
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
                    <form class="form-horizontal" method="post" action="addarea/insert" name="area_validate"
                          id="area_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Name</label>

                            <div class="controls">
                                <input type="text" name="txtName" id="txtName"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Parent area</label>

                            <div class="controls">
                                <?php echo $listArea ?>
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
        $("#area").addClass("active");
        $("#add_area").addClass("active");
    });
</script>