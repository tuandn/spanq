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
    <h1>Spanq Admin</h1>
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
    <!--<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>-->
    <ul>
        <li id="home"><a href="http://localhost/spanq/activity"><i class="icon icon-home"></i> <span>Spanq</span></a>
        </li>
        <li class="submenu" id="area">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Areas</span></a>
            <ul>
                <li><a href="http://localhost/spanq/area">List area</a></li>
                <li><a href="http://localhost/spanq/area/addarea">New area</a></li>
            </ul>
        </li>
        <li class="submenu" id="group">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Groups</span></a>
            <ul>
                <li><a href="http://localhost/spanq/group">List group</a></li>
                <li><a href="http://localhost/spanq/group/addgroup">New group</a></li>
            </ul>
        </li>
        <li class="submenu" id="user">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Users</span></a>
            <ul>
                <li><a href="http://localhost/spanq/user">List user</a></li>
                <li><a href="http://localhost/spanq/user/adduser">New user</a></li>
            </ul>
        </li>
        <li class="submenu" id="landmark">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Landmarks</span></a>
            <ul>
                <li><a href="http://localhost/spanq/landmark">List landmark</a></li>
                <li><a href="http://localhost/spanq/landmark/addlandmark">New landmark</a></li>
            </ul>
        </li>
        <li class="submenu" id="challenge">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Challenges</span></a>
            <ul>
                <li><a href="http://localhost/spanq/challenge">List challenge</a></li>
                <li><a href="http://localhost/spanq/challenge/addchallenge">New challenge</a></li>
            </ul>
        </li>
        <li class="submenu" id="response">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Responses</span></a>
            <ul>
                <li><a href="http://localhost/spanq/response">List response</a></li>
                <li><a href="http://localhost/spanq/response/addresponse">New response</a></li>
            </ul>
        </li>
        <li class="submenu" id="station">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Stations</span></a>
            <ul>
                <li><a href="http://localhost/spanq/station">List station</a></li>
                <li><a href="http://localhost/spanq/station/addstation">New station</a></li>
            </ul>
        </li>
        <li class="submenu" id="setting">
            <a href="javascript:"><i class="icon icon-th-list"></i> <span>Games Settings</span></a>
            <ul>
                <li><a href="http://localhost/spanq/setting/murder">List murder mystery</a></li>
                <li><a href="http://localhost/spanq/setting/addmurder">New murder mystery</a></li>
                <li><a href="http://localhost/spanq/setting/checkin">Checkin settings</a></li>
                <li><a href="http://localhost/spanq/setting/challenge">Challenge settings</a></li>
            </ul>
        </li>
    </ul>

</div>

<div id="content">
    <?php echo $this->scope["template"]["body"];?>

</div>

</body>
</html>
       <script type="text/javascript">
           $(document).ready(function (){
               $("#sidebar ul li.active").addClass("open");
           });
       </script>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>