<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 4:54 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<?php echo form_open_multipart(); ?>
    <div id="container">
        <div id="top">
        </div>
        <div id="main">
            <div id="logo"></div>
            <div class="clear"></div>
            <input type="text" id="email" name="email"/>
            <input type="password" id="password" name="password"/>
            <input type="submit" value="Login" id="btnLogin"/>
        </div>
        <div id="footer">
        </div>
    </div>
<?php echo form_close(); ?>