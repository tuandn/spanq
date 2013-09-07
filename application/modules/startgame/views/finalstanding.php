<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 7/2/13
 * Time: 10:34 PM
 * To change this template use File | Settings | File Templates.
 */


?>
<style type="text/css">


    table.list_station_random {
        border: 1px solid gray;
        width: 128%;
        margin-top: 48px;
        margin-left: -15px;
    }

    #head {
        display: none;
    }

    .top_head_final {
        margin-top: -111px;
        margin-left: -18px;
        line-height: 6px;
    }

    #top #logo {
        float: right;
        margin-right: -45px;
    }

    #left {
        display: none;
    }

    #path {
        margin-left: -15px;
        margin-top: 36px;
        float: left;
    }

</style>
<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/default/js/start_game.js"></script>

<div class="top_head_final">
    <div><h2>Bob's Bachelor Party</h2><br> Final Standings</div>
</div>

<div class="content">
    <div class="new">
        <table cellspacing="0" cellpadding="0" class="list_station_random">
            <thead>
            <th style="width: 25%;">Pos.</th>
            <th>Team</th>
            </thead>
            <?php $i = 1;
            foreach ($final_standing as $item): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $item->Name; ?></td>
                </tr>
                <?php $i++; endforeach; ?>
        </table>
    </div>
</div>
<br>
<br>
<br>

<?php foreach ($final_standing as $item): ?>
    <div id="path"><?php echo $item->Name . " Path to Victory."; ?></div>
    <?php break; endforeach; ?>


<div class="my_graph">

</div>