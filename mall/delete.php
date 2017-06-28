<?php
include_once './lib/fun.php';
if(!checkLogin())
{
	msg(2,'请登录','login.php');
}

//校验 url中商品id
$goodsId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : '';

//如果id不存在，跳转到商品列表
if(!$goodsId)
{
    msg(2,'参数非法','index.php');
}

//根据商品id查询商品信息
$con = mysqlInit('127.0.0.1','root','','imooc_mail');

$sql = "SELECT `id` FROM `im_goods` WHERE `id`={$goodsId}";
$obj = mysql_query($sql);
// $result = mysql_fetch_assoc($obj); 拿到查询结果的数组
//当根据id查询商品信息为空，跳转商品列表页，，$goods直接获取了查询数组
if(!$goods = mysql_fetch_assoc($obj))
{
    msg(2,'画品不存在','index.php');
}

$sql = "DELETE FROM `im_goods` where `id` = {$goodsId} LIMIT 1";
//如果删除是成功的。。
if($result = mysql_query($sql))
{
	// mysql_query_rows()
	msg(1,'操作成功','index.php');
}
else
{
	msg(2,'操作失败','index.php');
}

//注意项
//项目中，不会真正的删除商品，而是更新商品表中的status,1:正常操作 -1 删除操作
//2 增加商品编辑时， update_time..




?>