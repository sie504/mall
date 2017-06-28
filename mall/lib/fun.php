<?php
header("Content-type:text/html;charset=utf-8");
//数据库链接初始化
function mysqlInit($host,$username,$password,$dbName)
{
	//数据库操作
    //密码地址
    error_reporting(E_ALL ^ E_DEPRECATED);
    $con = mysql_connect($host,$username,$password);
    // 判断
    if(!$con)
    {
        return false;
    }
    //选择数据库
    mysql_select_db($dbName);
    //设置字符集
    mysql_set_charset('utf8');

    return $con;
}

//密码加密处理
function createPassword($password)
{
	if(!$password)
	{
		return false;
	}

	return md5(md5($password).'IMOOC');
}

// 消息提示 1:成功 2:失败
//封装跳转函数
function msg($type,$msg=null,$url=null)
{
    $toUrl = "Location:msg.php?type={$type}";
    //当msg为空时候，url不写入
    $toUrl.=$msg?"&msg={$msg}":'';
    //当url为空，toUrl不写入
    $toUrl.=$url?"&url={$url}":'';   
    header($toUrl);
    exit;
}



// 图片上传，函数的复用性
function imgUpload($file)
{
    //检查上传文件是否合法
    if(!is_uploaded_file($file['tmp_name']))
    {
        msg(2,'请上传符合规范的图像');
    }
    //图片类型验证
    $type = $file['type'];
    if(!in_array($type,array("image/png","image/gif","image/jpeg")))
    {
        msg(2,'请上传png,gif,jpg的图像');
    }
    //上传目录
    $uploadPath = './static/file/';
    //上传目录访问的url
    $uploadUrl = '/static/file/';
    //上传文件夹
    $fileDir = date('Y/md/',$_SERVER['REQUEST_TIME']);

    //检查上传目录是否存在
    if(!is_dir($uploadPath . $fileDir))
    {
        mkdir($uploadPath . $fileDir, 0755, true); //递归创建目录
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    //上传图片名称
    $img = uniqid().mt_rand(1000,9999).'.'.$ext;     //对上传文件的重命名，规律命令
    $imgPath = $uploadPath.$fileDir.$img;    //物理地址
    $imgUrl = 'http://localhost/mall'.$uploadUrl.$fileDir.$img; //url地址

    //  在页面打印出来看看
    // var_dump($imgPath,$imgUrl);
    // die;

    if(!move_uploaded_file($file['tmp_name'], $imgPath))
    {
        msg(2,'服务器繁忙，请稍候再试');
    }

    return $imgUrl;
}

//检查用户是否登录
function checkLogin()
{
    //开启session
    session_start();
    //用户未登录
    if(!isset($_SESSION['user']))
    {
        return false;
    }
    return true;
}

//获取当前url
function getUrl()
{
    $url = '';
    $url .= $_SERVER['SERVER_PORT'] == 443?'https://':'http://'; //如果端口号是443，就是https://
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    return $url;
}


//根据page生成url
function pageUrl($page, $url = '')
{
    $url = empty($url) ? getUrl() : $url;
    //查询url中是否存在?
    $pos = strpos($url,'?');
    if($pos === false)
    {
        $url .= '?page=' . $page;
    }
    else
    {
        $queryString = substr($url,$pos+1);
        // var_dump($queryString);
        //解析querystring为数组
        parse_str($queryString,$queryArr);
        // var_dump($queryArr);
        if(isset($queryArr['page']))
        {
            unset($queryArr['page']);
        }
        $queryArr['page'] = $page;
        // var_dump($queryArr);
        $queryStr = http_build_query($queryArr);
        $url = substr($url, 0,$pos).'?'.$queryStr;


    }
    return $url;
}






//分页显示
// int $total 数据总数
// int $currentPage 当前页
// int $pageSize 每页显示条数
// int $show 显示按钮数
function pages($total, $currentPage, $pageSize, $show = 6) 
{
    $pageStr = '';

    //仅当总数大于每页显示条数，才进行分页处理
    if($total > $pageSize)
    {
        //总页数
        $totalPage = ceil($total / $pageSize); //向上取整，获取总页数

        //对当前也进行处理
        $currentPage = $currentPage > $totalPage ? $totalPage : $currentPage;

        //分页起始页
        $from = max(1,($currentPage - intval($show/2)));
        //分页结束页
        $to = $from+$show-1;
       


        $pageStr .= '<div class="page-nav">';
        $pageStr .= '<ul>';
        // 仅当 当前页大于1的时候， 存在 首页和上一页按钮
        if($currentPage > 1)
        {
            $pageStr .= "<li><a href='".pageUrl(1)."'>首页</a></li>";
            $pageStr .= "<li><a href='" .pageUrl($currentPage-1). "'>上一页</a></li>";
        }


        //当结束页大于总页
        if($to>$totalPage){

            $to = $totalPage;
            $from = max(1,$to - $show + 1);

        }

        if($from > 1)
        {
            $pageStr .= '<li>...</li>';
        }

        for($i=$from;$i<=$to;$i++){
            if($i != $currentPage)
            {
                $pageStr .= "<li><a href='". pageUrl($i) ."'>{$i}</a></li>";
            }
            else
            {
                $pageStr .= "<li><span class='curr-page'>{$i}</span></li>";
            }
        }
        if($to < $totalPage)
        {
            $pageStr .= '<li>...</li>';
        }
        if($currentPage<$totalPage)
        {
            $pageStr .= "<li><a href='" . pageUrl($currentPage+1) ."'>下一页</a></li>";
            $pageStr .= "<li><a href='" . pageUrl($totalPage) . "'>尾页</a></li>";

        }
        
        $pageStr .= '</ul>';
        $pageStr .= '</div>';
    }

    return $pageStr;
}





?>