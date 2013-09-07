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
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/fullcalendar.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/unicorn.main.css"/>
    <link rel="stylesheet" href="http://localhost/spanq/application/themes/bootstrap/css/unicorn.grey.css"
          class="skin-color"/>
</head>
<body>


<div id="header">
    <h1>Spanq Admin</h1>
</div>

<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a title="" href="http://localhost/spanq/login/logout"><i class="icon icon-share-alt"></i> <span
                class="text">Logout</span></a></li>
    </ul>
</div>

<div id="sidebar">
    <!--<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>-->
    <ul>
        <li class="active"><a href="#"><i class="icon icon-home"></i> <span>Spanq</span></a></li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Areas</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New area</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Groups</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New group</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Landmarks</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New landmark</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Challenges</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New challenge</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Responses</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New response</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Murder mystery</span> <span class="label">1</span></a>
            <ul>
                <li><a href="#">New murder mystery</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Checkin settings</span></a>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>Challenge settings</span></a>
        </li>
    </ul>

</div>

<div id="content">
    <?php echo $this->scope["template"]["body"];?>

</div>


<script src="http://localhost/spanq/application/themes/bootstrap/js/excanvas.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/jquery.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/jquery.ui.custom.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/bootstrap.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/jquery.flot.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/jquery.flot.resize.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/jquery.peity.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/fullcalendar.min.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/unicorn.js"></script>
<script src="http://localhost/spanq/application/themes/bootstrap/js/unicorn.dashboard.js"></script>
</body>
</html>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>