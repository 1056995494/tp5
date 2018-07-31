<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\wamp64\www\demo\tp5\public/../application/demo\view\test\index.html";i:1532442767;s:56:"D:\wamp64\www\demo\tp5\application\demo\view\layout.html";i:1531323933;s:62:"D:\wamp64\www\demo\tp5\application\demo\view\index\header.html";i:1531502103;s:62:"D:\wamp64\www\demo\tp5\application\demo\view\index\footer.html";i:1531314208;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title; ?></title>
<link charset="utf-8" rel="stylesheet" href="/static/c1ommon.css">
</head>
<body>
<h2>测试</h2>
		<form method="POST" action="<?php echo url('test'); ?>">
			名字<input type="text" name="name"/>
			年龄<input type="text" name="age"/>
			<input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
			<input type="submit" value="提交"/>
		</form>

<div class="copyright">
	<a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP</a> 
	<span>V5</span> 
	<span>{ 十年磨一剑-为API开发设计的高性能框架 }</span>
</div>
</body>
</html>