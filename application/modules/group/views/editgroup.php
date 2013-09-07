<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 10:34 PM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
    'size' => 100,
    'class' => 'large-text',
    'value' => $group->Name
);

$contact = array(
    'id' => "txtContact",
    'name' => 'txtContact',
    'size' => 100,
    'class' => 'large-text',
    'value' => $group->Contact
);

?>
<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/group.js"></script>

<div id="content-header">
    <h1>Groups</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>group" class="current">Groups</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5><?php echo $group->Name; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="group/update" name="group_validate"
                          id="group_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Name</label>

                            <div class="controls">
                                <?php echo form_input($name)?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Contact</label>

                            <div class="controls">
                                <?php echo form_input($contact) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Area</label>

                            <div class="controls">
                                <?php echo $listArea ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="hidden" id="txtId" name="txtId" value="<?php echo $group->Id; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Users</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php foreach ($listUser as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->Name; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      user_id="<?php echo $item->UserId; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini remove_button"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-modal" class="btn btn-primary">Add exist user</a>
                    <a href="<?php echo base_url(); ?>user/adduser" class="btn btn-primary">Add new user</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-dialog" title="Add exist user">
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
                <?php foreach ($allUser as $item): ?>
                    <tr>
                        <td><?php echo $item->Name; ?></td>
                        <td>
                            <input type="button" value="add"
                                   user_id="<?php echo $item->Id; ?>"
                                   name="btnAdd"
                                   class="btn btn-primary btn-mini" onclick="return AddUser(this)"/>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#group").addClass("active");
    });
</script>
