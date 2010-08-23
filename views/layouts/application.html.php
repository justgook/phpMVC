<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php View::get('title'); ?></title>
      <?php View::render('layouts/stylesheets'); ?>
</head>
<body>
<ul>
	<li><?php View::link('About','page/about') ?></li>
	<li><?php View::link('Contacts','page/contacts') ?></li>
	<li><?php View::link('Members','member') ?></li>
	<li><?php View::link('Register','member/_new') ?></li>
	<li><?php View::link('Sing-in','session/_new') ?></li>
</ul><br />
<?php View::flash(); ?>
<br />
	<?php View::yield(); ?>
	<div style="border:3px double #F00;margin-top:30px">
	<?php echo Registry::getDebug(); ?>
	</div>
</body>
</html>
