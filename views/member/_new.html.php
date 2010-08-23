Rigester New User
<?php View::form('/member', create);?>
<label><span>email:</span><input type="text" name="user[email]" /></label>
<label><span>name:</span><input type="text" name="user[name]" /></label>
<label><span>password:</span><input type="text" name="user[password]" /></label>
<label><span>confirm password:</span><input type="text" name="user[cpassword]" /></label>
<label><span>confirm password:</span><input type="submit" value="Register" /></label>
<?php View::_form(); ?>

