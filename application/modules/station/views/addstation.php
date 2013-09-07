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
);

$email = array(
    'id' => "txtEmail",
    'name' => 'txtEmail',
);

$person = array(
    'id' => "txtPerson",
    'name' => 'txtPerson',
);

$phone = array(
    'id' => "txtPhone",
    'name' => 'txtPhone',
);

$clue = array(
    'id' => "txtClue",
    'name' => 'txtClue',
);
$lat = array(
    'id' => "txtLat",
    'name' => 'txtLat',
);

$long = array(
    'id' => "txtLong",
    'name' => 'txtLong',
);

?>
<style>
    .pos-relative {
        position: relative !important;
    }
</style>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#station").addClass("active");
            $("#add_station").addClass("active");
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
                        <h5>Add new</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="station/insert" name="station_validate"
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
                                    <select name="cboDiff" style="width: 150px;">
                                        <option value="Easy">Easy</option>
                                        <option value="Difficulty">Difficulty</option>
                                        <option value="Choice Offered">Choice Offered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address</label>

                                <div class="controls">
                                    <textarea rows="3" style="width: 100%" name="txtAddress" id="txtAddress"
                                              onblur="return set_location_by_address(this);"></textarea>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="modal-dialog-map" title="Google map" style="height: 400px !important; ">

    <div id="div_id" style="height:400px; width:570px;"></div>

</div>