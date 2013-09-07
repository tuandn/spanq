<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 26/07/2013
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */
?>
<script type="text/javascript">

    $(document).ready(function () {
        $("#who_am_i").addClass("active");
    });

    //delete row common by id
    function Delete(item) {
        var c = confirm("Are you sure ?");
        if (c) {
            var data_string = 'Id=' + $(item).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URI + "who_am_i/delete_by",
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
    <h1>Who Am I</h1>
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
                    <h5>Answer</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Answer</th>
                            <th style="text-align: center;">Edit</th>
                            <th style="text-align: center;">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list_who_am_i_m as $item): ?>
                            <tr>
                                <td><?php echo $item->Answer; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-primary btn-mini"
                                       href="<?php echo base_url(); ?>who_am_i/edit?Id=<?php echo $item->Id; ?>">edit</a>
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
                    <a href="<?php echo base_url(); ?>who_am_i/add" class="btn btn-primary">Add new
                        answer</a>
                </div>
            </div>
        </div>
    </div>
</div>