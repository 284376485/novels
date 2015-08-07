<?php

use yii\helpers\Html;
use yii\models\bookinfo;
$this->title='XXX网';
?>

<!--头部 end-->
        <div id="main">
            <div class="left fl editors-choice">
                <div class="left-bd">
                
                    <div class="mod">
                        <div class="hd">
                            <img src="img/t.png" alt="封面推荐">
                        </div>
                        <div class="bd">
                            <div class="txt-items-two-columns">
                                <!--循环推荐-->
                                <?php  foreach ($Home_Recommended->Obtain_Home_Recommended() as $book) { ?>
		                                <div class="txtbox-item big">
			                                <div class="txtbox-bd">
				                                <div class="clear">
					                                <div class="txtbox-pic">
						                                <div class="txtbox-pic-wrap">
							                                <a target="_blank" href="directory/<?php echo $book['bookname_pinyin']; ?>/index" class="deep-blue">
								                                <img width="70" height="98" src="BookImages/<?php echo $book['bookname_pinyin'];?>.jpg" alt="<?php echo $book['bookname']; ?>">
							                                </a>
						                                </div>
					                                </div>
					                                <div class="txtbox-content">
						                                <h5>
							                                <a target="_blank" href="directory/<?php echo $book['bookname_pinyin']; ?>/index"><?php echo $book['bookname'] ; ?></a>
                                                           
						                                </h5>
						                                <div class="txtbox-text">
							                                <p class="desc">
							                                <!-- 描述从文件读 -->
								                                <?php echo substr($book['Description'],0,225).'...'; ?>
							                                </p>
							                                <p class="info">
								                                作者：<?php echo $book['author'];?>
							                                </p>
						                                </div>
					                                </div>
				                                </div>
			                                </div>
		                                </div>
	                            <?php } ?>
		                               
	                                
                                <!--推荐 end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="bd-index-gd-writ">
                <p style="margin-right:10px;"></p><p style="margin-left:10px;"></p>
            </div>
            <div class="cont-k">
                <div class="indli">
	                <div class="listbiao-dd"><div class="biaotou-head">最近更新</div>
		                <ul class="jinri-geng">
		                <div class="kkxl"><p class="lei_l">分类</p><p class="name_m">书名/最新章节</p><p class="auth_z">作者</p><p class="time_s">更新时间</p>
		                </div>
		                      <?php foreach ($Now_Update as $key => $update) { ?>

                                <li><p class="lei_l">[都市言情]</p><p class="name_m"><a class="tit_n" href="directory/<?php echo $update['bookname_pinyin']; ?>/index"  target="_blank"><?php echo $update['bookname']; ?></a><a class="last_z" href="directory/<?php echo $update['bookname_pinyin']; ?>/<?php echo $update['article_last_id']; ?>"  target="_blank"><?php echo $update['article_last_title']; ?></a></p><p class="auth_z"><?php echo $update['author']; ?></p>
                                <?php echo date("m/d H:i",strtotime($update['article_last_updatetime']));?>
                                </li>
                               
                              <?php }?>
		                <div class="more_d"></div>
		                </ul>
	                </div>
                </div>
                <div class="rige-lite info-bg">
                    <div class="tuishuo">推荐小说</div>
                    <div class="number1">
                         
                                <a href="64/64859/" target="_blank">
                                    <img src="BookFiles/BookImages/taigushenwang.jpg" alt="太古神王">
                                </a>
                                <p>
                                    <a href="64/64859/" target="_blank">
                                        太古神王
                                    </a>
                                </p>
                                <span>
                                    作者：净无痕
                                </span>
                            
                    </div>
                    <ul class="hot-xs">
                        <!-- 14 -->
                        <?php foreach($Recommendation_Right as $key => $value){ ?>
                                <li>
                                    <p><?php echo $value['click']; ?></p>
                                    <a href="directory/<?php echo $value['bookname_pinyin']; ?>/index" target="_blank"><?php echo $value['bookname']; ?></a>
                                </li>

                        <?php } ?>
                            
                            
                    </ul>
                    <div class="more_d"></div>
                </div>
                <div class="rige-lite info-bg"><div class="tuishuo">最新小说</div>
                    <div class="number1">
                    
                        
                        
                            
                               <a href="76/76086/" target="_blank"><img src="BookFiles/BookImages/hongmozhuxi.jpg" alt="红魔主席"></a>
                        <p><a href="76/76086/" target="_blank">红魔主席</a></p>
                        <span>作者：锦锭</span>
                            
                    </div>
                    <ul class="hot-xs">
                        <!-- 14 -->
                        <?php foreach($Home_New_Book_updata as $key => $value){ ?>
                                <li><p><?php echo date("m/d",strtotime($value['updatetime'])); ?></p><a href="directory/<?php echo $value['bookname_pinyin']; ?>/index" target="_blank"><?php echo $value['bookname']; ?></a></li>
                        <?php } ?>
                            
                    </ul>
                    <div class="more_d"></div>
                </div>
                
            </div>
            <div class="cl"></div>
        </div>
    </div>
    <div id="footer">
    <div class="bd">
        <div class="sp-20"></div>
         
<div class="lpic clear">
<h5>联动导航</h5> 
<div class="blogroll">

</div>
</div>
        
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