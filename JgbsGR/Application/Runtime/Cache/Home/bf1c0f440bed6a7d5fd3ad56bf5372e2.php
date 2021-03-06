<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Center</title>
    <link rel="stylesheet" type="text/css" href="/Public/front/css/login.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/banner.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/skeleton.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/index_footer.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/index_header.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/all_project.css">
    <link rel="stylesheet" type="text/css" href="/Public/front/css/usercenter.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/project_content.css">
    <script src="/Public/front/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<header>
    <div class="nav">
        <ul>
            <li><a href="<?php echo U('index/index');?>">首页</a></li>
            <li><a href="#">关于我们</a></li>
            <li><a href="<?php echo U('../Admin/login/login');?>">平台OA</a></li>
            <li class='x1'><a href="#">公告<i></i></a>
                <div class="con">
                    <?php if(is_array($notices)): $i = 0; $__LIST__ = $notices;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i; echo ($notice["nt_content"]); ?>
                        <label style="position: absolute;float:right;top:120px;right: 10px">
                            <?php echo ($notice["nt_date"]); ?>
                        </label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </li>
        </ul>
    </div>
</header>
<?php if(isset($session_users["user_username"])): else: ?>
    <div class="btn btn_l" value="">登录</div><?php endif; ?>

<?php if(isset($session_users["user_username"])): ?><div class="btn_l" >
    <?php echo ($session_users["user_username"]); ?><a href="<?php echo U('Login/logout');?>">，注销</a>
</div><?php else: endif; ?>
<h2>个人中心</h2>
<div class="center">

    <section>
        <?php if(is_array($results)): $i = 0; $__LIST__ = $results;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><label style="position: absolute;margin: 45px; color: #fff;"><?php echo ($result["user_username"]); ?></label>
        <div class="line"></div>
            <div class="lb2"><label>用户名</label><span><?php echo ($result["user_username"]); ?></span></div>
            <div class="lb2"><label>性别</label><span><?php echo ($result["user_gender"]); ?></span></div>
            <div class="lb2"><label>年龄</label><span><?php echo ($result["user_age"]); ?></span></div>
            <div class="lb2"><label>联系电话</label><span><?php echo ($result["user_phone"]); ?></span></div>
            <!--<div class="lb2"><label>邮箱</label><span><?php echo ($result["user_email"]); ?></span></div>-->
            <div class="lb2"><label>完成委托数量</label><span><?php echo ($result["user_pro_num"]); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <button class="edit_btn btn_style" rel="<?php echo ($result["user_id"]); ?>">修改</button>
    </section>

    <aside class="headimg">

    </aside>
</div>

<div class="mask"></div>
<div class="edit" style="display: none;
    height: 220px;
    width: 400px;">
    <span class="close"></span>
    <div class="title"><h3>编辑</h3></div>
    <div class="lg">
        <form id="frm" action="" method="post">
            <span>用户名：<input class="user_name" name="user_username" type="text" /></span>
            <span>性别：<input class="user_gender" name="user_gender" type="text"/></span>
            <span>年龄：<input class="user_age" name="user_age" type="text" /></span>
            <span>联系电话：<input class="user_phone" name="user_phone" type="text" /></span>
            <!--<span>邮箱：<input class="user_email" name="user_email" type="text" /></span>-->
            <div><button class="btn_style sub" type="submit" value="" rel="1">保存</button></div>
        </form>
    </div>
</div>

<!--发布消息模块-->
<div class="consultDiv">

</div>

<!--页脚-->
<footer id="footer">
    <div id="foot_email" ><a href="mailto:qiushiyuan1994@qq.com" id="footerHello">qiushiyuan1994@qq.com</a></div>

    <h2 >18650380324   <span >|</span>   371890701</h2>
    <p>Have any questions or want to publish a carousel message, you can feel free to send an email to contact us.</p>
    <div>
        <a href="https://baidu.com" target="_blank"><img src="/Public/img/baidu.png" width="37" height="37" alt="twitter"></a>
        <a href="https://www.google.com" target="_blank"><img src="/Public/img/google.png" width="37" height="37" alt="facebook"></a>
        <a href="https://www.youku.com/" target="_blank"><img src="/Public/img/uk.png" width="37" height="37" alt="linkedin"></a>
    </div>
    <p class="foot_over">Copyright 2017 TKK College,Xiamen University Design. All Rights Reserved</p>
</footer>
</body>
<script>
    $('.edit_btn').click(function(){
        that = $(this);
        $.ajax({
            type: "POST",
            url: "/index.php/Home/UserInformation/edit_btn",
            data: {
                "uid": that.attr("rel")
            },
            dataType: 'json',
            success: function (jsonResult) {
                $('.sub').val(jsonResult.user_id);
                $('.user_name').val(jsonResult.user_username);
                $('.user_gender').val(jsonResult.user_gender);
                $('.user_age').val(jsonResult.user_age);
                $('.user_phone').val(jsonResult.user_phone);
//                $('.user_email').val(jsonResult.user_email);
            },
            error: function (e) {
                alert('error');
            }
        });
        $(".mask").css("display","block");
        $(".edit").show();
    });
    $('.close').click(function(){
        $(".edit").hide();
        $(".mask").css("display","none");
    });
    $('.sub').on('click',function(){
        that = $(this);
        $.ajax({
            type: "POST",
            url:"/index.php/Home/UserInformation/user_save",
            data: {
                "uid": that.val(),
                "user_name":$('.user_name').val(),
                "user_gender":$('.user_gender').val(),
                "user_age": $('.user_age').val(),
                "user_phone": $('.user_phone').val(),
//                "user_email":$('.user_email').val(),
            },
            dataType:'json',
            success:function(jsonResult){
                alert('修改成功');
            },
            error:function(e){
                alert('error');
            }
        });
    });
</script>
<!--header/js-->
<script>
    $('.x1').hover(function(){
        if($(".con").css('display')=='none'){
            $('.con').show(1000);
            $('i').css('border-color',' transparent transparent #fff transparent');
        }
    },function(){
        $('.con').hide(1000);
        $('i').css('border-color',' #fff transparent transparent transparent');
    })
    $(window).scroll(function(){
        var scroll_top = $(window).scrollTop();
        //console.log(scroll_top);
        if(scroll_top>72){
            $('.nav').addClass('scrollHeader');
            $('.btn').hide();
        }else{
            $('.nav').removeClass('scrollHeader');
            $('.btn').show();
        }
    })
</script>

</html>