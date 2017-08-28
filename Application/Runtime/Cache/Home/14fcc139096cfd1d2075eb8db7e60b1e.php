<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($result["config"]["title"]); ?></title>
    <meta name="keywords" content="<?php echo ($result['config']['keywords']); ?>"/>
    <meta name="description" content="<?php echo ($result["config"]["description"]); ?>"/>
    <link rel="stylesheet" href="/cms/Public/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="/cms/Public/css/home/main.css" type="text/css"/>
</head>
<body>
<header id="header">
    <div class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a href=".">
                    <img src="/cms/Public/images/logo.png" alt="">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="."
                    <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>
                    >首页</a></li>
                <?php if(is_array($result['navs'])): foreach($result['navs'] as $key=>$nav): ?><li><a href="./index.php?c=cat&a=index&id=<?php echo ($nav["menu_id"]); ?>" <?php if($nav['menu_id'] == $result['catId']): ?>class='curr'<?php endif; ?>><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">
                <div class="news-list">
                    <?php if(is_array($result['newsList'])): $i = 0; $__LIST__ = $result['newsList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
                            <dt><a target="_blank" href="./index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["title"]); ?></a></dt>
                            <dd class="news-img">
                                <a target="_blank" href="./index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="200"
                                                                                                     height="120"
                                                                                                     src=".<?php echo ($vo["thumb"]); ?>"
                                                                                                     alt="<?php echo ($vo["title"]); ?>"></a>
                            </dd>
                            <dd class="news-intro">
                                <?php echo ($vo["description"]); ?>
                            </dd>
                            <dd class="news-info">
                                <?php echo ($vo["keywords"]); ?> <span><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></span> 阅读(<i
                                    news-id="<?php echo ($vo["news_id"]); ?>" class="news_count node-<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["count"]); ?></i>)
                            </dd>
                        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <nav class="pager">

                        <?php echo ($result['pageShow']); ?>

                </nav>
            </div>



            <!--网站右侧信息-->
            <div class="col-sm-3 col-md-3">
  <div class="right-title">
    <h3>文章排行</h3>
    <span>TOP ARTICLES</span>
  </div>

  <div class="right-content">
    <ul>
      <?php if(is_array($result['rankNews'])): $k = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
        <a target="_blank" href="./index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
        <?php if($k == 1): ?><div class="intro">
          <?php echo ($vo["description"]); ?>
        </div><?php endif; ?>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <?php if(is_array($result['advNews'])): $k = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot">
    <a target="_blank" href=".<?php echo ($vo["url"]); ?>"><img src=".<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
        </div>
    </div>
</section>
</body>
<script src="/cms/Public/js/jquery.js"></script>
<!--<script src="/cms/Public/js/count.js"></script>-->
</html>