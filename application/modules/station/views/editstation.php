<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
    'size' => 100,
    'class' => 'large-text',
    'value' => $station->Name
);

$email = array(
    'id' => "txtEmail",
    'name' => 'txtEmail',
    'size' => 100,
    'class' => 'large-text',
    'value' => $station->ContactEmail
);

$person = array(
    'id' => "txtPerson",
    'name' => 'txtPerson',
    'size' => 100,
    'class' => 'large-text',
    'value' => $station->ContactPerson
);

$phone = array(
    'id' => "txtPhone",
    'name' => 'txtPhone',
    'size' => 100,
    'class' => 'large-text',
    'value' => $station->ContactPhone
);

$clue = array(
    'id' => "txtClue",
    'name' => 'txtClue',
    'size' => 50,
    'class' => 'small-text',
    'value' => $station->Clue
);
$lat = array(
    'id' => "txtLat",
    'name' => 'txtLat',
    'size' => 50,
    'class' => 'small-text',
    'value' => $station->LocationLat
);

$long = array(
    'id' => "txtLong",
    'name' => 'txtLong',
    'size' => 50,
    'class' => 'small-text',
    'value' => $station->LocationLong
);

$difficulty = array("Easy", "Difficulty", "Choice Offered");

$cboDiff = "<select name=\"cboDiff\" class=\"small-text\">";
$diff = $station->Difficulty;

foreach ($difficulty as $i) {
    $s = $diff == $i ? "selected" : "";
    $cboDiff .= "<option value=\"" . $i . "\" " . $s . ">" . $i . "</option>";
}
$cboDiff .= "</select>";

?>
<style>
    .pos-relative {
        position: relative !important;
    }
</style>
<!--<script type="text/javascript" src="<?php /*echo base_url(); */?>application/themes/bootstrap/js/gears_init.js">
</script>
<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?sensor=false&language=vi&region=hcm"></script>-->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/station.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $("#station").addClass("active");
        initialize();
        if(browserName()=="Chrome"){
            $("#modal-dialog-map").parent().addClass("pos-relative");
            $("#div_id").css("position","absolute");
        }

    });

    // google map
    var map;
    var lat, lng;

    function initialize() {
        var latlng = new google.maps.LatLng(51.4975941, -0.0803232);
        var map = new google.maps.Map(document.getElementById('div_id'), {
            center: latlng,
            zoom: 11,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: 'Set lat/lon values for this property',
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function(a) {
            console.log(a);
            lat = a.latLng.lat();
            lng = a.latLng.lng();
        });
    }

</script>
<div id="content-header">
    <h1>Stations</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>station" class="current">Stations</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5><?php echo $station->Name; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="station/update" name="station_validate"
                          id="station_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Name</label>

                            <div class="controls">
                                <?php echo form_input($name) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Area</label>

                            <div class="controls">
                                <?php echo $listArea ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Clue</label>

                            <div class="controls">
                                <?php echo form_input($clue) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Difficult</label>

                            <div class="controls">
                                <?php echo $cboDiff; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Address</label>

                            <div class="controls">
                                <textarea rows="3" name="txtAddress" id="txtAddress"
                                          onblur="return set_location_by_address(this);"><?php echo $station->Address; ?></textarea>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <a id="open-modal-map" class="btn btn-primary">Show google map</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Location lat</label>

                            <div class="controls">
                                <?php echo form_input($lat) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Location long</label>

                            <div class="controls">
                                <?php echo form_input($long) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Contact person</label>

                            <div class="controls">
                                <?php echo form_input($person) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Contact email</label>

                            <div class="controls">
                                <?php echo form_input($email) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Contact phone</label>

                            <div class="controls">
                                <?php echo form_input($phone) ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="hidden" id="txtId" name="txtId" value="<?php echo $station->Id; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Available Challenges</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php foreach ($listChallenge as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->Type; ?></td>
                                <td style="text-align: left;"><?php echo $item->Difficulty; ?></td>
                                <td style="text-align: left;"><?php echo $item->Description; ?></td>
                                <td style="text-align: right;"><input type="button" value="remove"
                                                                      challenge_id="<?php echo $item->ChallengeId; ?>"
                                                                      name="btnRemove"
                                                                      class="btn btn-danger btn-mini remove_button"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-modal" class="btn btn-primary">Add exist challenge</a>
                    <a href="<?php echo base_url(); ?>challenge/addchallenge" class="btn btn-primary">Add new
                        challenge</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-dialog" title="Add Exist Challenge">
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
                    <th>Type</th>
                    <th>Difficulty</th>
                    <th>Description</th>
                    <th>Add</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allChallenge as $item): ?>
                    <tr>
                        <td><?php echo $item->Type; ?></td>
                        <td><?php echo $item->Difficulty; ?></td>
                        <td><?php echo $item->Description; ?></td>
                        <td>
                            <input type="button" value="add"
                                   challenge_id="<?php echo $item->Id; ?>"
                                   name="btnAdd"
                                   class="btn btn-primary btn-mini" onclick="return AddChallenge(this)"/>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-dialog-map" title="Google map" style="height: 400px !important; ">

    <div id="div_id" style="height:400px; width:570px;"></div>

</div>
