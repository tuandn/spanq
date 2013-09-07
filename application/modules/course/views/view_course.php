<?php
if ($this->session->userdata("RoleId") != "1" and $this->session->userdata("RoleId") != "5") {
    redirect("login");
}
?>
<div id="content-header">
    <h1>List course</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>List course</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Started</th>
                            <th>Type</th>
                            <th>Area</th>
                            <!--<th>View</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_game as $item): ?>
                            <tr>
                                <td><?php echo $item->GameName; ?></td>
                                <td><?php echo $item->StartTime; ?></td>
                                <td><?php echo $item->Type; ?></td>
                                <td><?php echo $item->AreaName; ?></td>
                                <!--<td style="text-align: center;">
                                    <a class="btn btn-primary btn-mini"
                                       href="<?php /*echo base_url(); */?>game/view?Id=<?php /*echo $item->Id; */?>">view</a>
                                </td>-->
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="<?php echo base_url(); ?>course" class="btn btn-primary">Add new
                        course</a>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $("#course").addClass("active");
    });
</script>