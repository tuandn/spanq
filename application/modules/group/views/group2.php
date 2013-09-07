<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 10:31 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="top_head">
    <div class="title">Group</div>
    <div class="control">
        <form action="<?php echo base_url(); ?>group/addgroup">
            <input type="submit" id="btnNew" value="New Group"/>
        </form>
    </div>
</div>
<div class="clear"></div>
<div class="content">
    <table cellspacing="0" cellpadding="0">
        <tr>
            <th>Name</th>
            <th>Area</th>
        </tr>
        <?php foreach($listGroup as $item): ?>
            <tr>
                <td><?php echo $item->Name ;?></td>
                <td><?php echo $item->AreaName; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="paging">
        <?php //echo $pagination; ?>
    </div>

</div>