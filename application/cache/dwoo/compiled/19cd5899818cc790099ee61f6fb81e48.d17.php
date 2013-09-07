<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->scope["template"]["partials"]["metadata"];?>

    <?php echo $this->scope["template"]["metadata"];?>

    <title><?php echo $this->scope["template"]["title"];?></title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="http://localhost/spanq/application/themes/bootstrap/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/jquery.gritter.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/uniform.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/select2.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/fullcalendar.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/unicorn.main.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/jquery.treeview.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/jquery-ui.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/dialog.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/unicorn.grey.css"
          class="skin-color"/>
    <style type="text/css">
        .check_box {
            float: left;
            margin-left: 0px;
        }

        .error-inline {
            color: #B94A48;
        }

        .success-inline {
            color: #468847 !important;
        }
    </style>

    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/config.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.min.js"></script>

    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery-ui.custom.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.gritter.min.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.peity.min.js"></script>

    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.uniform.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/select2.min.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.validate.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/unicorn.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/jquery.dataTables.min.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/unicorn.tables.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/validation.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/popup.modal.js"></script>
    <script language="javascript" type="text/javascript"
            src="http://localhost/spanq/application/themes/bootstrap/js/common.js"></script>


</head>
<body>


<div id="header">
    <h1><img src="http://localhost/spanq/application/themes/bootstrap/img/logo.png" alt="Spanq" height="31px"
             width="191px"/>
    </h1>
</div>

<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a href="#" title=""><i class="icon icon-user"></i> <span
                class="text">Administrator</span></a></li>
        <li class="btn btn-inverse"><a title="" href="http://localhost/spanq/login/logout"><i
                class="icon icon-share-alt"></i> <span
                class="text">Logout</span></a></li>
    </ul>
</div>

<div id="sidebar">
    <ul>
        <li id="home"><a href="http://localhost/spanq/activity"><i class="icon icon-home"></i> <span>Spanq</span></a>
        </li>
        <li class="" id="area">
            <a href="http://localhost/spanq/area"><i class="icon icon-th-list"></i> <span>Areas</span></a>
            <ul>
                <li id="add_area"><a href="http://localhost/spanq/area/addarea">New area</a></li>
            </ul>
        </li>
        <li class="" id="group">
            <a href="http://localhost/spanq/group"><i class="icon icon-th-list"></i> <span>Groups</span></a>
            <ul>
                <li id="add_group"><a href="http://localhost/spanq/group/addgroup">New group</a></li>
            </ul>
        </li>
        <li class="" id="user">
            <a href="http://localhost/spanq/user"><i class="icon icon-th-list"></i> <span>Users</span></a>
            <ul>
                <li id="add_user"><a href="http://localhost/spanq/user/adduser">New user</a></li>
            </ul>
        </li>
        <li class="" id="landmark">
            <a href="http://localhost/spanq/landmark"><i class="icon icon-th-list"></i> <span>Landmarks</span></a>
            <ul>
                <li id="add_landmark"><a href="http://localhost/spanq/landmark/addlandmark">New landmark</a></li>
            </ul>
        </li>
        <li class="" id="station">
            <a href="http://localhost/spanq/station"><i class="icon icon-th-list"></i> <span>Stations</span></a>
            <ul>
                <li id="add_station"><a href="http://localhost/spanq/station/addstation">New station</a></li>
            </ul>
        </li>
        <li class="" id="challenge">
            <a href="http://localhost/spanq/challenge"><i class="icon icon-th-list"></i> <span>Challenges</span></a>
            <ul>
                <li id="add_challenge"><a href="http://localhost/spanq/challenge/addchallenge">New challenge</a></li>
            </ul>
        </li>
        <li class="submenu" id="setting">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Games Settings</span></a>
            <ul>
                <!--<li id="list_murder"><a href="http://localhost/spanq/setting/murder">List murder mystery</a></li>
                <li id="add_murder"><a href="http://localhost/spanq/setting/addmurder">New murder mystery</a></li>-->
                <li id="setting_checkin"><a href="http://localhost/spanq/setting/checkin">Checkin settings</a></li>
                <li id="setting_challenge"><a href="http://localhost/spanq/setting/challenge">Challenge settings</a>
                <li id="setting_who_am_i"><a href="http://localhost/spanq/setting/who_am_i">Who am i settings</a>
                </li>
            </ul>
        </li>
        <li class="" id="start_game">
            <a href="http://localhost/spanq/startgame"><i class="icon icon-th-list"></i> <span>Start a Game</span></a>
            <ul>
                <li id="game_parameter"><a href="http://localhost/spanq/startgame">Game Parameters</a></li>
                <li id="game_station"><a href="javascript:">Stations</a></li>
                <li id="game_team"><a href="javascript:">Teams</a></li>
            </ul>
        </li>
        <li class="" id="game">
            <a href="http://localhost/spanq/game"><i class="icon icon-th-list"></i> <span>All games</span></a>
        </li>
        <li class="" id="who_am_i">
            <a href="http://localhost/spanq/who_am_i"><i class="icon icon-th-list"></i> <span>Who Am I</span></a>
        </li>
    </ul>

</div>

<div id="content">
    <?php echo $this->scope["template"]["body"];?>

</div>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar ul li.active").addClass("open");
    });
</script>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>