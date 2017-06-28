<?php
header("Content-type:text/html;charset=utf-8");
//url type参数处理 1：操作成功 2:操作失败
//判断type存在，如果在1,2之间，直接获取GET['type']、如果不存在type且不在1，2之间，强制为1
//细心 $_GET,不是$GET
$type = isset($_GET['type']) && in_array(intval($_GET['type']),array(1, 2)) ? intval($_GET['type']) :1;
$title = $type == 1?'操作成功':'操作失败';
$msg =  isset($_GET['msg']) ? trim($_GET['msg']) : '操作成功';
$url = isset($_GET['url'])?trim($_GET['url']):''; //如果url存在，trim否则返回''

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="./static/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./static/css/done.css"/>
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
</div>
<div class="content">
    <div class="center">

        <div class="image_center">
                <?php if($type == 1): ?>
                <span class="smile_face">:)</span>  
                <?php else: ?>         
                <span class="smile_face">:(</span>
                <?php endif; ?>
        </div>
        <div class="code">
            <?php echo $msg ?>
        </div>
        <div class="jump">
            页面在 <strong id="time" style="color: #009f95">3</strong> 秒 后跳转
        </div>
    </div>

</div>
<div class="footer">
    <p><span>M-GALLARY</span>©2017 POWERED BY IMOOC.INC</p>
</div>
</body>
<script src="./static/js/jquery-1.10.2.min.js"></script>
<script>
    $(function () {
        var time = 3;
        var url = "<?php echo $url ?>"||null; //js读取php变量,如果读取到url变量，默认为null
        setInterval(function () {
            if (time > 1) {
                time--;
                console.log(time);
                $('#time').html(time);
            }
            else {
                $('#time').html(0);
                if(url)
                {
                    location.href=url;
                }
                else
                {
                    history.go(-1); //跳转到原来页面
                }
                    
            }
        }, 1000);

    })
</script>
</html>