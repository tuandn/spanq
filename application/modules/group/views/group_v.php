<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 10:31 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<script type="text/javascript">
    //delete row common by id
    function Delete(item) {
        var r = confirm("Are you sure ?");
        if (r) {
            var data_string = 'Id=' + $(item).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URI + "group/delete_by",
                data: data_string,
                success: function (data_form) {
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        }
    }

    $(document).ready(function () {
        $("#group").addClass("active");
        //$("#list_group").addClass("active");
    });


</script>

<div id="content-header">
    <h1>Groups</h1>
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
                    <h5>Groups</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Area</th>
                            <th style="text-align: center;">Edit</th>
                            <th style="text-align: center;">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listGroup as $item): ?>
                            <tr>
                                <td><?php echo $item->Name; ?></td>
                                <td><?php echo $item->AreaName; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-primary btn-mini"
                                       href="<?php echo base_url(); ?>group/edit?Id=<?php echo $item->Id; ?>&currentPage=<?php echo($this->uri->segment(3) == '' ? 1 : $this->uri->segment(3)); ?>">edit</a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="javascript:" id="<?php echo $item->Id; ?>"
                                       class="btn btn-danger btn-mini" onclick="return Delete(this);">delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="<?php echo base_url(); ?>group/addgroup" class="btn btn-primary">Add new group</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<div class="top_head">
    <div class="title">Group</div>
    <div class="control">
        <form action="<?php /*echo base_url(); */?>group/addgroup">
            <input type="submit" id="btnNew" value="New Group" class="bt"/>
        </form>
    </div>
</div>
<div class="clear"></div>
<div class="content">
    <table cellspacing="0" cellpadding="0">
        <tr>
            <th>Name</th>
            <th>Area</th>
            <th style="text-align: center;">Edit</th>
            <th style="text-align: center;">Delete</th>
        </tr>
        <?php /*foreach ($listGroup as $item): */?>
            <tr>
                <td><?php /*echo $item->Name; */?></td>
                <td><?php /*echo $item->AreaName; */?></td>
                <td style="text-align: center;">
                    <a href="<?php /*echo base_url(); */?>group/edit?Id=<?php /*echo $item->Id; */?>&currentPage=<?php /*echo($this->uri->segment(3) == '' ? 1 : $this->uri->segment(3)); */?>">edit</a>
                </td>
                <td style="text-align: center;">
                    <a href="javascript:" id="<?php /*echo $item->Id; */?>" class="del">delete</a>
                </td>
            </tr>
        <?php /*endforeach; */?>
    </table>
    <div class="paging">
        <?php /*echo $pagination */?>
    </div>

</div>-->