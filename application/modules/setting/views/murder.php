<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 7:55 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").addClass("active");
        $("#list_murder").addClass("active");
    });

    //delete row common by id
    function Delete(item) {
        var c = confirm("Are you sure ?");
        if (c) {
            var data_string = 'Id=' + $(item).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URI + "setting/delete_by",
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
    <h1>Game Settings</h1>
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
									<i class="icon-th"></i>
								</span>
                    <h5>Murder Mystery</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Value</th>
                            <th style="text-align: center;">Edit</th>
                            <th style="text-align: center;">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listMurder as $item): ?>

                            <tr>
                                <td><?php echo $item->Type; ?></td>
                                <td><?php echo $item->Value; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-primary btn-mini"
                                       href="<?php echo base_url(); ?>setting/edit_murder?Id=<?php echo $item->Id; ?>&currentPage=<?php echo($this->uri->segment(3) == '' ? 1 : $this->uri->segment(3)); ?>">edit</a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="javascript:" id="<?php echo $item->Id; ?>" class="btn btn-danger btn-mini"
                                       onclick="return Delete(this);">delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="<?php echo base_url(); ?>setting/addmurder" class="btn btn-primary">Add new murder</a>
                </div>
            </div>
        </div>
    </div>
</div>
