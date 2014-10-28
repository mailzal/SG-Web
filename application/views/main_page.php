<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<a href='<?php echo site_url('main_list/user_management')?>'>User</a> |
		<a href='<?php echo site_url('main_list/course_management')?>'>Course</a> |
		<a href='<?php echo site_url('main_list/game_management')?>'>Game</a> |
		<a href='<?php echo site_url('main_list/score_management')?>'>Score</a> |
		<a href='<?php echo site_url('main_list/stroke_management')?>'>Stroke</a> |
		<a href='<?php echo site_url('main_list/user_has_game_management')?>'>User has Game</a> |
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
