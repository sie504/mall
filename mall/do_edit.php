<?php
//商品信息
header("Content-type:text/html;charset=utf-8");
include_once './lib/fun.php';

if(!checkLogin())
{
    msg(2,'请登录','login.php');
}

//表单进行了提交处理
if(!empty($_POST['name']))
{
	$con = mysqlInit('127.0.0.1','root','','imooc_mail');

	if(!$goodsId = intval($_POST['id']))
	{
		msg(2,'参数非法');
	}

	//根据商品id校验商品信息
	$sql = "SELECT * FROM  `im_goods` WHERE `id`={$goodsId}";
	$obj = mysql_query($sql);
	// $result = mysql_fetch_assoc($obj); 拿到查询结果的数组
	//当根据id查询商品信息为空，跳转商品列表页，，$goods直接获取了查询数组
	if(!$goods = mysql_fetch_assoc($obj))
	{
    msg(2,'画品不存在','index.php');
	}

	//处理表单数据
    //商品名称
    $name = mysql_real_escape_string(trim($_POST['name']));
    //商品价格
    $price = intval($_POST['price']);
    // 商品简介
    $des = mysql_real_escape_string(trim($_POST['des']));
    //商品详情
    $content = mysql_real_escape_string(trim($_POST['content']));

    $nameLength = mb_strlen($name,'utf-8');
    if($nameLength <= 0 || $nameLength > 30)
    {
        msg(2,'商品名称在1-30字符之内');
    }
    $desLength = mb_strlen($des,'utf-8');
    if($desLength <= 0 || $desLength > 100)
    {
        msg(2,'商品简介应在1-100字符之间');
    }

    if($price<= 0 || $price>9999999999)
    {
        msg(2,'商品价格应小于9999999999');
    }
    if(empty($content))
    {
        msg(2,'商品详情不能为空');
    }


    //更新数组
    $update = array(
	    'name'		=> $name,
	    'price'		=> $price,
	    'des'		=> $des,
    	'content'	=> $content
	);


    //仅当用户选择上传图片，才进行图片上传处理
    if($_FILES['file']['size'] > 0)
    {
    	$pic = imgUpload($_FILES['file']);
    	$update['pic'] = $pic;
    }

    

    // var_dump($updateSql);
    // die;

    //只更新被用户修改的信息，对比数据库数据跟用户表单数据
    foreach ($update as $k => $v)
    {
    	if($goods[$k] == $v)      //对应key相等，删除要更新的字段
    	{
    		unset($update[$k]);
    	}
    }
    //对比2个数组，如果没有需要更新的字段
    if(empty($update))
    {
    	msg(1,'操作成功','edit.php?id=' . $goodsId);
    }

    // var_dump($update);
    // die;


    //更新sql处理
    //update `im_goods` set `name`='value',`price`='value' where 
    $updateSql = '';
    foreach($update as $k => $v)
    {
    	$updateSql .= "`{$k}` = '{$v}' ,";
    }

    $updateSql = rtrim($updateSql,','); //把其中的右边的,去掉

    unset($sql, $obj, $result);
    $sql = "UPDATE  `im_goods` SET {$updateSql} WHERE `id` = {$goodsId}";
    //当更新成功

    if($result = mysql_query($sql))
    {
    	//mysql_affected_rows(); 影响行数
    	msg(1,'操作成功','edit.php?id=' . $goodsId);
    }
    else
    {
    	msg(2,'修改失败','edit.php?id=' . $goodsId);
    }

}
else
{
	msg(2,'路由非法',index.php);
}

?>