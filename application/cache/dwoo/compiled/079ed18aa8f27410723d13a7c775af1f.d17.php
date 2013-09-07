<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php echo $this->scope["template"]["partials"]["metadata"]; ?>

<?php echo $this->scope["template"]["metadata"]; ?>

<title><?php echo $this->scope["template"]["title"]; ?></title>

<style>
body {
    font-size: 62.5%;
}

label, input {
    display: block;
}

input.text {
    margin-bottom: 12px;
    width: 95%;
    padding: .4em;
}

fieldset {
    padding: 0;
    border: 0;
    margin-top: 25px;
}

h1 {
    font-size: 1.2em;
    margin: .6em 0;
}

div#users-contain {
    width: 350px;
    margin: 20px 0;
}

div#users-contain table {
    margin: 1em 0;
    border-collapse: collapse;
    width: 100%;
}

div#users-contain table td, div#users-contain table th {
    border: 1px solid #eee;
    padding: .6em 10px;
    text-align: left;
}

.ui-dialog .ui-state-error {
    padding: .3em;
}

.validateTips {
    border: 1px solid transparent;
    padding: 0.3em;
}

<

/
styl
	
	
    <script language

=
"JavaScript"
type

=
"text/javascript"
src

=
"http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-1.8.0.min.js"
>
<

/
script>
    <script language

=
"JavaScript"
type

=
"text/javascript"
src

=
"http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-ui-1.8.23.custom.min.js"
>
<

/
script>
    <script language

=
"JavaScript"
type

=
"text/javascript"
src

=
"http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.ui.datepicker-vi.js"
>
<

/
script>
    <script language

=
"JavaScript"
type

=
"text/javascript"
src

=
"http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.corner.js"
>
<

/
script>
	<script type

=
"text/javascript"
language

=
"javascript"
>
$

(
document

)
.

        ready

(
function

(
)
{
/
/
alert
(
BASE_URL
)
;
    $("#nav-frame-email"
)
.

        corner

(
"6px"
)
;
$

(
"#btnContinue"
)
.

        corner

(
"3px"
)
;

    }

)
;

function

        editQuestion

(
id

)
{
alert
(
'question'
+
id
)
;
}

/
/
bat dau
		$

(
function

(
)
{
    $("#dialog:ui-dialog"
)
.

        dialog

(
"destroy"
)
;

$

(
"#dialog-form"
)
.

        dialog

(
{
autoOpen: false,
height:

300
,
width:

350
,
modal: true,
buttons: {

"Create an account"
: function() {
}

,
Cancel: function() {
    $(this

)
.

        dialog

(
"close"
)
;
    }

    }

,
close: function() {
    allFields . val("") . removeClass("ui-state-error");
}

    }

)
;

$

(
"#create-user"
)
.

        button

(
)
.

        click

(
function

(
)
{
    $("#dialog-form"
)
.

        dialog

(
"open"
)
;
    }

)
;
    }

)
;

<

/
script>
<

/
head>
<body>
	<div id

=
"container"
>
<div id

=
"dialog-form"
title

=
"Create new user"
>
<p class

=
"validateTips"
>
All form fields are required.<

/
p>
			<form>
				<fieldset>
					<label for

=
"name"
>
Name<

/
label>
					<input type

=
"text"
name

=
"name"
id

=
"name"
class

=
"text ui-widget-content ui-corner-all"
/
>
<label for

=
"email"
>
Email<

/
label>
					<input type

=
"text"
name

=
"email"
id

=
"email"
value

=
""
class

=
"text ui-widget-content ui-corner-all"
/
>
<label for

=
"password"
>
Password<

/
label>
					<input type

=
"password"
name

=
"password"
id

=
"password"
value

=
""
class

=
"text ui-widget-content ui-corner-all"
/
>
<

/
fieldset>
			<

/
form>
		<

/
div>
		<button id

=
"create-user"
>
Create new user<

/
button>






<!--
Banner

-->
<?php echo $this->scope["template"]["partials"]["banner"];?>

<!--
/
Banner

-->

<!--
Menu

-->
<?php echo $this->scope["template"]["partials"]["menu"];?>

<!--
/
Menu

-->

<!--
Main

-->
<div id

=
"main"
>
<!--
Top friend

-->
<?php echo $this->scope["template"]["partials"]["top_friend"];?>

<!--
/
Top friend

-->

<!--
Main Left

-->
<?php echo $this->scope["template"]["body"];?>

<!--
/
Main Left

-->

<!--
Main Right

-->
<div id

=
"main-right"
>
<?php echo $this->scope["template"]["partials"]["main_right"];?>

<?php echo $this->scope["template"]["partials"]["main_right_bottom"];?>

<

/
div>
			<div class

=
"clear"
>
<

/
div>






<!--
/
Main Right

-->

<div class

=
"clear"
>
<

/
div>
		<

/
div>
		<div class

=
"clear"
>
<

/
div>






<!--
/
Main

-->

<!--
Footer

-->
<?php echo $this->scope["template"]["partials"]["footer"];?>

<!--
/
Footer

-->

<

/
div>
<

/
body>
<

/
html><?php /* end template body */
return $this->buffer . ob_get_clean();
?>