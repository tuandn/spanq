<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="menu_left">
    <div class="node">
        <div class="leaf" id="area">
            <a href="http://localhost/spanq/area">Areas</a>
        </div>
        <div class="leaf_node">
            <p id="add_area">
                <a href="http://localhost/spanq/area/addarea">New Area</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="landmark">
            <a href="http://localhost/spanq/landmark">Landmarks</a>
        </div>
        <div class="leaf_node">
            <p id="add_landmark">
                <a href="http://localhost/spanq/landmark/addlandmark">New Landmarks</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="station">
            <a href="http://localhost/spanq/station">Stations</a>
        </div>
        <div class="leaf_node">
            <p id="add_station">
                <a href="http://localhost/spanq/station/addstation">New Station</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="challenge">
            <a href="http://localhost/spanq/challenge">Challenges</a>
        </div>
        <div class="leaf_node">
            <p id="add_challenge">
                <a href="http://localhost/spanq/challenge/addchallenge">New Challenge</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="response">
            <a href="http://localhost/spanq/response">Response</a>
        </div>
        <div class="leaf_node">
            <p id="add_response">
                <a href="http://localhost/spanq/response/addresponse">New Response</a>
            </p>
        </div>
    </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>