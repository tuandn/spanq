<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 24/07/2013
 * Time: 23:13
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="content-header">
    <h1>All Games</h1>
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
                    <h5>Games</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Started</th>
                            <th>Type</th>
                            <th>Area</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_game as $item): ?>
                            <tr>
                                <td><?php echo $item->GameName; ?></td>
                                <td><?php echo $item->StartTime; ?></td>
                                <td><?php echo $item->Type; ?></td>
                                <td><?php echo $item->AreaName; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-primary btn-mini"
                                       href="<?php echo base_url(); ?>game/view?Id=<?php echo $item->Id; ?>">view</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $("#game").addClass("active");
    });
</script>