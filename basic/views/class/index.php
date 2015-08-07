<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\IndexModel;
$IndexModel = new IndexModel();
$men=Yii::$app->cache;
?>
<?php
?>
        <div id="main">
            <div class="left fl editors-choice" style="margin-bottom:8px;">
		        <div class="left-bd">
			        <div class="mod">
				        <div class="hd" style="height:50px;"></div>
				        <div class="bd">
					        <div class="txt-items-two-columns">
					            <!-- 本类6本小说推荐开始 -->
					            <?php foreach($Class_Recommendation as $value){ ?>
					                    <div class="txtbox-item big">
							                <div class="txtbox-bd">
								                <div class="clear">
									                <div class="txtbox-pic">
										                <div class="txtbox-pic-wrap">
											                <a target="_blank" href="/directory/<?php echo $value['bookname_pinyin']; ?>/index" class="deep-blue">
												                <img width="70" height="98" src="/BookImages/<?php echo $value['bookname_pinyin']; ?>.jpg"
												                alt="<?php echo $value['bookname']; ?>">
											                </a>
										                </div>
									                </div>
									                <div class="txtbox-content">
										                <h5>
											                <a target="_blank" href="/directory/<?php echo $value['bookname_pinyin']; ?>/index">
												                <?php echo $value['bookname']; ?>
											                </a>
										                </h5>
										                <div class="txtbox-text">
											                <p class="desc">
											                	<?php echo $value['Description']; ?>
											                </p>
											                <p class="info">
												                作者：<?php echo $value['author']; ?>											                </p>
										                </div>
									                </div>
								                </div>
							                </div>
						                </div>
					                <?php } ?>
					            <!-- 本类6本小说推荐结束 -->
					                
					        </div>
				        </div>
			        </div>
		        </div>
	        </div>				        
        
<div class="left fl editors-choice">
    <div class="left-bd">
    <div class="mod">
    <div class="topba-box">
    <div class="topba-title">
    <div class="topba-sm hgce">书名</div>
    <div class="topba-zj hgce">最新章节</div>
    <div class="topba-cz hgce">作者</div>
    <div class="topba-cz hgce">点击数</div>
    <div class="topba-tim hgce">更新日期</div>
    <div class="topba-cz hgce">状态</div>
    </div>
    <div class="topba-cont">
        <ul class="topba-list">
            <!-- 本类小说最新更新开始 -->
            <?php foreach($Class_Novel as $value) { ?>
            <li>
                    <div class="topba-sm mx"><a target="_blank" href="/directory/<?php echo $value['bookname_pinyin']; ?>/index"><?php echo $value['bookname']; ?></a></div>
                    <div class="topba-zj mx"><a target="_blank" href="/directory/<?php echo $value['bookname_pinyin']; ?>/<?php echo $value['article_last_id']; ?>"><?php echo $value['article_last_title']; ?></a></div>
                    <div class="topba-cz mx"><?php echo $value['author']; ?></div>
                    <div class="topba-cz mx"><?php echo $value['click']; ?></div>
                    <div class="topba-tim mx"><?php echo date('m-d H:i:s',strtotime($value['article_last_updatetime'])); ?></div>
                    <div class="topba-cz mx"><?php echo $IndexModel->Judge_Book_Status($value['status']); ?></div>
            </li>
            <?php } ?>
        	<!-- 本类小说最新更新结束 -->
                
        </ul>
    <div class="articlepage">
        <div class="pagelink" id="pagelink">
            <div id="UC_TopUpdate1_pnlPage">
	
            <b id="pagestats">共<b class="orange0"><?php echo $pagination->totalCount; ?></b>部小说 当前：<?php echo $Now_Page; ?>/<?php echo $pagination->totalCount; ?></b>
            <div id="UC_TopUpdate1_PageBar"  class="pagen">
	            <!-- <ul> -->
						<?= LinkPager::widget(['pagination' => $pagination]) ?>
	            <!-- </ul> -->
            </div>
</div>
         </div>
      </div> 
    </div>
    </div>
    </div>
    </div>
</div>






           
            <div class="bd-index-gd-writ">
            <p style="margin-right:10px;"></p>
            <p style="margin-left:10px;"></p>
            </div>       
            <div class="cl"></div>
        </div>
    </div>
        <div id="footer">
            <div class="bd">
                
<p class="cp">
本站全部书籍均由网民上传，若被转载的<a href="http://www.moksos.com"><strong>墨客文学网</strong></a>文章信息侵犯了您的权益，请与本站管理员联系。邮箱：xxxx#gmail.com (请将#替换为@)<br>
墨客文学网提供都市小说、历史小说、言情小说、玄幻小说、网游小说、科幻小说等网络小说<a href="http://www.moksos.com"><strong>墨客文学网</strong></a>无广告免费阅读和txt全集下载。<br>
Copyright (C) 2014-2015 墨客文学网  All Rights Reserved.&nbsp;&nbsp;粤ICP备98465800号-1<script language="javascript" type="text/javascript" src="js/tongji.js"></script>
</p>

            </div>
        </div>
</div>
</body>
</html>