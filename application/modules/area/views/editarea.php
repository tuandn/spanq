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
    'value' => $area->Name
);

?>

<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/area.js"></script>
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
                    <h5><?php echo $area->Name; ?></h5>

                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="update" name="area_validate"
                          id="area_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Name</label>

                            <div class="controls">
                                <input type="text" name="txtName" id="txtName" value="<?php echo $area->Name; ?>"/>
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
                            <input type="hidden" id="txtId" name="txtId" value="<?php echo $area->Id; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Stations</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php foreach ($listStation as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->StationName; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      station_id="<?php echo $item->StationId; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini remove_button"/>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-modal" class="btn btn-primary">Add exist station</a>
                    <a href="<?php echo base_url(); ?>station/addstation" class="btn btn-primary">Add new station</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-dialog" title="Add exist station">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Add</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allStation as $item): ?>
                    <tr>
                        <td><?php echo $item->Name; ?></td>
                        <td>
                            <input type="button" value="add"
                                   station_id="<?php echo $item->Id; ?>"
                                   name="btnAdd"
                                   class="btn btn-primary btn-mini" onclick="return AddArea(this)"/>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
