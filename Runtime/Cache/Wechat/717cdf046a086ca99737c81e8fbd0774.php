<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<title>Bootstrap 101 Template</title>

<!-- Bootstrap -->
<link href="../../../../../Public/Wechat/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../../Public/Wechat/css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .main{margin-bottom: 60px;}
    .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
</style>
</head>
<body>
<div class="main">
    <!-- 头部 -->
    <!--导航部分-->
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid text-center">
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo U('Index/index');?>" class="navbar-link">首页</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo U('Index/my');?>" class="navbar-link">我的</a></p>
        </div>
    </div>
</nav>
<!--导航结束-->
    <!-- /头部 -->

    <!-- 主体 -->
    <!---->
<div id="main-container" class="container">
    <div class="row">
        
        <!-- 左侧 nav
        ================================================== -->
            <div class="span3 bs-docs-sidebar">
                
                <ul class="nav nav-list bs-docs-sidenav">
                    <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
                </ul>
            </div>
        
        

    <div class="container-fluid" id="list">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="row noticeList" data-category="<?php echo ($article["category_id"]); ?>">
                <a href="<?php echo U('Index/articleContent',[id=>$article['id']]);?>">
                    <div class="col-xs-2">
                        <img class="noticeImg" src="<?php echo ($article["path"]); ?>" />
                    </div>
                    <div class="col-xs-10">
                        <p class="title"><?php echo ($article["title"]); ?></p>
                        <p class="intro"><?php echo ($article["description"]); ?></p>
                        <p class="info"><?php echo ($article["view"]); ?> <span class="pull-right"><?php echo ($article["time"]); ?></span> </p>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php if($list != null){?>
    <div class="text-center">
        <button type="button" class="btn btn-info ajax-page" id="btn">获取跟多~~~</button>
    </div>
    <?php }else{ echo '请等待更新';} ?>
    </div>

    </div>
</div>


    <!-- /主体 -->

    <!-- 底部 -->
    
    <!-- 底部
    ================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="Public/Wechat/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="Public/Wechat/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "/wechat.php?s=", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

    <script >
        var p = 1;
        $('.text-center').on('click','.ajax-page',function () {
//        $('.ajax-page').click(function(){
            p++;
            var category_id = $('.noticeList:first').attr('data-category');
            var url = 'wechat.php?s=/Index/article/id/'+category_id+'/p/'+p;
            var html = '';
            $.getJSON(url,function (data) {
                if($(data).length){
                    $(data).each(function () {
                        html += '<div class="row noticeList" >\
                            <a href="/wechat.php?s=/Index/articleContent/id/'+this.id+'">\
                            <div class="col-xs-2">\
                            <img class="noticeImg" src="'+this.path+'" />\
                            </div>\
                            <div class="col-xs-10">\
                            <p class="title">'+this.title+'</p>\
                        <p class="intro">'+this.description+'</p>\
                        <p class="info">'+this.view+' <span class="pull-right">'+this.time+'</span> </p>\
                        </div>\
                        </a>\
                        </div>';
                    });
                   $('#list').append(html);
                }else{
                    $('#btn').attr('class','btn btn-info').html('没有啦,别点了')
                }
            })
        })
    </script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>


    <!-- /底部 -->
</body>

</html>