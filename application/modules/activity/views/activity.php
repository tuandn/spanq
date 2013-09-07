<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 01/07/2013
 * Time: 23:47
 * To change this template use File | Settings | File Templates.
 */
date_default_timezone_set("UTC");
?>

<div id="content-header">
    <h1>Activity</h1>

</div>
<div id="breadcrumb">
    <a href="<?php echo base_url();?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="#" class="current">Activity</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Latest Games</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Started</th>
                            <th>Type</th>
                            <th>Area</th>
                            <th>Complete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($latest_game as $item): ?>
                        <tr>
                            <td><?php echo $item->StartTime; ?></td>
                            <td><?php echo $item->Type; ?></td>
                            <td><?php echo $item->AreaName; ?></td>
                            <td style="text-align: center;">
                                <input type="checkbox"
                                       name="cbComplete" <?php echo $item->Completed ? "checked" : ""; ?> />
                            </td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Latest Challenge Responses</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Station</th>
                            <th>Team</th>
                            <th>Passed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($latest_challenge as $item): ?>

                        <tr>
                            <td><?php $date = date_create($item->createdate); echo date_format($date,"d/M/y h:m"); ?></td>
                            <td><?php echo $item->station_name; ?></td>
                            <td><?php echo $item->team_name; ?></td>
                            <td style="text-align: center;">
                                <input type="checkbox"
                                       name="cbComplete" <?php echo $item->status == "0" ? "checked" : ""; ?>  />
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
    $(document).ready(function (){
        $("#home").addClass("active");
    });
</script>

