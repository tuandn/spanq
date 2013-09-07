<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 7:06 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<script language="javascript" src="<?php echo base_url(); ?>application/themes/bootstrap/js/jquery.cookie.js"></script>
<script language="javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/jquery.treeview.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#navigation").treeview({
            collapsed: false,
            unique: true,
            persist: "location"
        });

        $("#area").addClass("active");
        //$("#list_area").addClass("active");
    });

    function Delete(item) {
        var c = confirm("Are you sure ?");
        if (c) {
            var data_string = 'Id=' + $(item).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URI + "area/delete_by",
                data: data_string,
                success: function (data_form) {
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("There was an error. Check constraint please !");
                }
            });
        }
    }
</script>

<div id="content-header">
    <h1>Areas</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <!--<a href="<?php /*echo base_url(); */?>area" class="current">Areas</a>-->
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>List area</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php if ($strArea) echo $strArea ?>
                </div>
                <div class="form-actions">
                    <a href="<?php echo base_url(); ?>area/addarea" class="btn btn-primary">Add new area</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Areas</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Parent area</th>
                            <th style="text-align: center;">Edit</th>
                            <th style="text-align: center;">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /*echo  $strArea; */?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="<?php /*echo base_url(); */?>area/addarea" class="btn btn-primary">Add new area</a>
                </div>
            </div>
        </div>
    </div>
</div>-->

