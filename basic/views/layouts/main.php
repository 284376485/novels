<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

<!-- head nav and search start-->
<body class="page-type-square">
<div class="body-bg">
    <div class="wrap">
        

<script type="text/javascript">
       function doSearch(){
     var str=decodeURIComponent(document.getElementById("txtKeyWord").value);
     if(str!="" && str!="可搜书名和作者，请您少字也别输错字。"){
         location.href="/search/"+str;
         }
     else{
             alert("请输入关键字！");
         }
       }
</script>

<!--头部 -->
<div id="topnav">
<div class="container">
<div class="menu">
    <li><a href="/">首页</a></li>
    <li><a href="/class/xuanhuan/1">玄幻小说</a></li>
    <li><a href="/class/xianxia/1">仙侠修真</a></li>
    <li><a href="/class/dushi/1">都市小说</a></li>
    <li><a href="/class/lishi/1">历史小说</a></li>
    <li><a href="/class/wangyou/1">网游小说</a></li>
    <li><a href="/class/kehuan/1">科幻小说</a></li>
    <li><a href="/class/nvpin/1">女频小说</a></li>
    <li><a href="/class/quanben/1">全本小说</a></li>
    <!-- <li><a href="mokph.html">排行榜单</a></li> -->
    <!-- <li><a href="mokcase.html">我的书架</a></li> -->
</div>
</div>
</div>
<div id="searchbox">
<div class="divauto">
<a class="logo" href="http://www.moksos.com" title="墨客文学网">墨客文学网</a>
<div class="sousuobox">
<!-- <dl class="sousuo_sele">
<dt>按书名或作者 ▼</dt><dd><a href="javascript:void(0);" type="articlename">按作者/拼音/小说首字母搜索</a><a href="javascript:void(0);" type="author">按作者</a></dd>
</dl> -->
<input type="text" placeholder="可搜书名和作者/拼音/小说首字母" class="srk" name="searchkey" maxlength="180" id="txtKeyWord" onfocus="this.style.color = '#000000';this.focus();if(this.value=='可搜书名和作者，请您少字也别输错字。'){this.value='';}"
             ondblclick="javascript:this.value=''"  autocomplete="off">
<input type="submit" id="submitbtn"  value="搜 索" class="ssbtn_index" border="0" onclick="doSearch()">
</div>
</div>
</div>


<!-- head nav and search end -->

            <?= $content ?>
        </div>
    </div>

<!--     <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
 -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
