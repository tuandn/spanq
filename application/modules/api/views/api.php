<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/8/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <script language="JavaScript" type="text/javascript"
            src="<?php echo base_url(); ?>application/themes/bootstrap/js/jquery-1.10.1.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0
        }

        #wrapper {
            width: 800px;
            margin: 20px auto
        }

        #nav, #nav ul {
            list-style: none;
            position: relative;
            line-height: 1.5em
        }

        #nav a:link, #nav a:active, #nav a:visited {
            display: block;
            padding: 0px 5px;
            border: 1px solid #3883cc;
            color: #fff;
            text-decoration: none;
            background: #3883cc
        }

        #nav a:hover {
            background: #fff;
            color: #333
        }

        #nav li {
            float: left;
            position: relative
        }

        #nav ul {
            position: absolute;
            width: 12em;
            top: 1.5em;
            display: none
        }

        #nav li ul a {
            width: 12em;
            float: left
        }

        #nav ul ul {
            top: auto
        }

        #nav li ul ul {
            left: 12em;
            margin: 0px 0 0 10px
        }

        #nav li:hover ul ul, #nav li:hover ul ul ul, #nav li:hover ul ul ul ul {
            display: none
        }

        #nav li:hover ul, #nav li li:hover ul, #nav li li li:hover ul, #nav li li li li:hover ul {
            display: block
        }

        .classapi {
            display: none;
            padding-left: 50px;
        }

    </style>
    <script language="JavaScript" type="text/javascript"
            src="<?php echo base_url(); ?>application/themes/admin/js/jquery-1.10.1.min.js">


    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nav li a').click(function () {
                //Fetch the value of the 'slide' data attribute of the clicked link
                var id = $(this).text();

                $(".classapi").hide();
                if (id == "Join To Game") {
                    $("#jointogame").show();
                } else if (id == "Get Landmarks") {
                    $("#latestclude").show();
                } else if (id == "Get Station By Id") {
                    $("#getstationbyid").show();
                } else if (id == "get_challenge_station_by_diff") {
                    $("#getstationdiff").show();
                } else if (id == "Challenge Station") {
                    $("#get_challenge").show();
                } else if (id == "get_station_level_diff") {
                    $("#get_station_level_diff").show();
                } else if (id == "complete_challenge_station") {
                    $("#complete_challenge_station").show();
                } else if (id == "quit_challenge") {
                    $("#quit_challenge").show();
                } else if (id == "check_in_location") {
                    $("#check_in_location").show();
                } else if (id == "get_position_team") {
                    $("#get_position_team").show();
                } else if (id == "Send Message") {
                    $("#gmc_msg").show();
                } else if (id == "post_status") {
                    $("#post_status").show();
                } else if (id == "get_game_standing") {
                    $("#get_game_standing").show();
                } else if (id == "register_device") {
                    $("#get_register_device").show();
                } else if (id == "un_register_device") {
                    $("#get_un_register_device").show();
                }else if (id == "Game History") {
                    $("#game_history").show();
                }else if (id == "Get Clue") {
                    $("#get_clue").show();
                }else if (id == "Get Answer") {
                    $("#get_answer").show();
                }


            });
        });
    </script>
    <title>Rest APIs</title>
</head>
<body>


<div id="wrapper" style="text-align: center;">

    <div id="logo">
    </div>
    <h1 style="margin: 0 auto;">Rest APIs</h1>
    <ul id="nav">
        <li><a href="javascript:">Join To Game</a></li>
        <li><a href="javascript:">Get Landmarks</a></li>
        <li><a href="javascript:">Get Station By Id</a></li>
        <li><a href="javascript:">get_challenge_station_by_diff</a></li>
        <li><a href="javascript:">Challenge Station</a></li>
        <li><a href="javascript:">get_station_level_diff</a></li>
        <li><a href="javascript:">complete_challenge_station</a></li>
        <li><a href="javascript:">quit_challenge</a></li>
        <li><a href="javascript:">check_in_location</a></li>
        <li><a href="javascript:">get_position_team</a></li>
        <li><a href="javascript:">post_status</a></li>
        <li><a href="javascript:">get_game_standing</a></li>
        <li><a href="javascript:">Send Message</a></li>
        <li><a href="javascript:">register_device</a></li>
        <li><a href="javascript:">un_register_device</a></li>
        <li><a href="javascript:">Game History</a></li>
        <li><a href="javascript:">Get Clue</a></li>
        <li><a href="javascript:">Get Answer</a></li>
    </ul>
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<div id="gmc_msg" class="classapi">

    <h2>Test API Send Mesage GCM</h2>

    <form action="api/send_notify_message" method="post">
        Register Id : <input type="text" id="register_id" name="register_id"/><br><br>
        Message : <textarea rows="3" id="message" name="message"></textarea><br>
        <input type="submit" value="Send Message" id="btnLogin"/>
    </form>
    <hr>
</div>


<div id="jointogame" class="classapi">

    <h2>Join To Game</h2>

    <form action="api/jointhegame" method="post">
        Access Code : <input type="text" id="access_code" name="access_code"/>
        Register Id : <input type="text" id="regId" name="regId"/><br>
        <input type="submit" value="Join Game" id="btnLogin"/>
    </form>
    <hr>
</div>

<div id="latestclude" class="classapi">
    <h2>Test API Get Landmarks</h2>

    <form action="api/getlandmarks" method="get">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Game Id:</td>
                <td><input type="text" id="game_id" name="game_id"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Get Landmarks" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="getstationbyid" class="classapi">
    <h2>Test API Get Station By Id</h2>

    <form action="api/getstationbyid" method="get">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Station Id:</td>
                <td><input type="text" id="station_id" name="station_id"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Get Station By Id" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="getstationdiff" class="classapi">
    <h2>Test API get_station_detail_by_level_difficulty</h2>

    <form action="api/get_station_detail_by_level_difficulty" method="get">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Station Id:</td>
                <td><input type="text" id="station_id" name="station_id"/></td>
            </tr>
            <tr>
                <td>Difficulty:</td>
                <td>
                    <select name="difficult">
                        <option value="0">Easy</option>
                        <option value="1">Difficulty</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Get Station Level" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="get_challenge" class="classapi">
    <h2>Test API Get Station</h2>

    <form action="api/get_challenge_station" method="get">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Station Id:</td>
                <td><input type="text" id="station_id" name="station_id"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="get_challenge_station" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="get_station_level_diff" class="classapi">
    <h2>Test API get_challenge_station_by_level_difficulty</h2>

    <form action="api/get_challenge_station_by_level_difficulty" method="get">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Station Id:</td>
                <td><input type="text" id="station_id" name="station_id"/></td>
            </tr>
            <tr>
                <td>Difficulty:</td>
                <td>
                    <select name="difficult">
                        <option value="0">Easy</option>
                        <option value="1">Difficulty</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Get Station Level" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="complete_challenge_station" class="classapi">
    <h2>Test API Get Station</h2>

    <form action="api/complete_challenge_station" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Difficulty:</td>
                <td>
                    <select name="difficult">
                        <option value="Easy">Easy</option>
                        <option value="Difficulty">Difficulty</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Challenge Id:</td>
                <td><input type="text" id="challenge_id" name="challenge_id"/></td>
            </tr>

            <tr>
                <td>Mark:</td>
                <td><input type="text" id="mark" name="mark"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="quit_challenge" class="classapi">
    <h2>Test API quit_challenge</h2>

    <form action="api/quit_challenge" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Difficulty:</td>
                <td>
                    <select name="difficult">
                        <option value="0">Easy</option>
                        <option value="1">Difficulty</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Challenge Id:</td>
                <td><input type="text" id="challenge_id" name="challenge_id"/></td>
            </tr>

            <tr>
                <td>Game Id:</td>
                <td><input type="text" id="game_id" name="game_id"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="check_in_location" class="classapi">
    <h2>Test API check_in_location</h2>

    <form action="api/check_in_location" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Station Id:</td>
                <td><input type="text" id="station_id" name="station_id"/></td>
            </tr>

            <tr>
                <td>Latitude:</td>
                <td><input type="text" id="latitude" name="latitude"/></td>
            </tr>

            <tr>
                <td>Longitude:</td>
                <td><input type="text" id="longitude" name="longitude"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="get_position_team" class="classapi">
    <h2>Test API get_position_team</h2>

    <form action="api/get_position_team" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Game Id:</td>
                <td><input type="text" id="game_id" name="game_id"/></td>
            </tr>


            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="post_status" class="classapi">
    <h2>Test API post_status</h2>

    <form action="api/post_status" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Game Id:</td>
                <td><textarea name="status_message" rows="3"></textarea></td>
            </tr>


            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="get_game_standing" class="classapi">
    <h2>Test API get_game_standing</h2>

    <form action="api/get_game_standing" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>
            <tr>
                <td>Game Id:</td>
                <td><input type="text" name="game_id"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="get_register_device" class="classapi">
    <h2>Register Device</h2>

    <form action="api/register" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Register Id:</td>
                <td><input type="text" name="regId"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="get_un_register_device" class="classapi">
    <h2>Un Register Device</h2>

    <form action="api/unregister_device" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Register Id:</td>
                <td><input type="text" name="regId"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/>
                </td>
            </tr>

        </table>

    </form>
    <hr>
</div>


<div id="game_history" class="classapi">
    <h2>Game History</h2>

    <form action="api/game_history" method="post">
        <table>
            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="get_clue" class="classapi">
    <h2>Get Clue</h2>

    <form action="api/get_clue_whoami" method="post">
        <table>

            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Game Id :</td>
                <td><input type="text" id="game_id" name="game_id"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>

<div id="get_answer" class="classapi">
    <h2>Get Answer</h2>

    <form action="api/answer_whoami" method="post">
        <table>

            <tr>
                <td>Access Code :</td>
                <td><input type="text" id="access_code" name="access_code"/></td>
            </tr>

            <tr>
                <td>Game Id :</td>
                <td><input type="text" id="game_id" name="game_id"/></td>
            </tr>

            <tr>
                <td>Answer :</td>
                <td><input type="text" id="answer" name="answer"/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" value="get json" id="btnLogin"/></td>
            </tr>

        </table>

    </form>
    <hr>
</div>


</body>
</html>

