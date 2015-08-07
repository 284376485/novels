<?php 
use app\models\IndexModel; 
$this->title=$bookinfo['bookname'];
//增加meta
$this->registerMetaTag(['name' => 'description', 'content' => $bookinfo['Description'] ], 'description');
$this->registerMetaTag(['name' => 'keywords', 'content' => $bookinfo['bookname']], 'keywords');
$this->registerMetaTag(['name' => 'copyright', 'content' => $bookinfo['bookname'].'由网友上传'], 'copyright');
$this->registerMetaTag(['name' => 'author', 'content' => $bookinfo['author']], 'author');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'novel'], 'og:type');
$this->registerMetaTag(['property' => 'og:title', 'content' => $bookinfo['bookname']], 'og:title');
$this->registerMetaTag(['property' => 'og:description', 'content' => $bookinfo['Description']], 'og:description');
$this->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->getHostInfo().'/BookImages/'.$bookinfo['bookname_pinyin'].'.jpg'], 'og:image');
$this->registerMetaTag(['property' => 'og:novel:category', 'content' => Yii::$app->params['Class'][$bookinfo['Class']]], 'og:category');
$this->registerMetaTag(['property' => 'og:novel:author', 'content' => $bookinfo['author']], 'og:author');
$this->registerMetaTag(['property' => 'og:novel:book_name', 'content' => $bookinfo['bookname']], 'og:book_name');
$this->registerMetaTag(['property' => 'og:novel:read_url', 'content' => Yii::$app->request->getHostInfo().'/directory/'.$bookinfo['bookname_pinyin'].'/index'], 'og:read_url');
$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->request->getHostInfo().'/directory/'.$bookinfo['bookname_pinyin'].'/index'], 'og:url');
$this->registerMetaTag(['property' => 'og:novel:status', 'content' => '连载'], 'og:status');
$this->registerMetaTag(['property' => 'og:novel:update_time', 'content' => $bookinfo['updatetime']], 'og:update_time');
$this->registerMetaTag(['property' => 'og:novel:latest_chapter_name', 'content' => $bookinfo['article_last_title']], 'og:novel:latest_chapter_name');
$this->registerMetaTag(['property' => 'og:novel:latest_chapter_url', 'content' => yii::$app->request->getHostInfo().'/directory/'.$bookinfo['bookname_pinyin'].'/'.$bookinfo['article_last_id']], 'og:novel:latest_chapter_url');

//增加click
$Index= new  IndexModel();
//$Index->add_click($bookinfo['id'],$bookinfo['click']);
?>

				<div id="main">
					<div class="kl">
						<div class="v-nav"> 
							<p><a href="/">XXX</a> &gt;<a href="/class/<?php echo $bookinfo['Class']; ?>/1"> <?php echo Yii::$app->params['Class'][$bookinfo['Class']]; ?></a> &gt;<a href="./index"><?php echo $bookinfo['bookname']; ?></a> </p><span><a  href="./index" target="_blank"><?php echo $bookinfo['bookname']; ?>全文下载</a></span>
						</div>
						<div class="u-bx">
							<div class="umg"><img alt="<?php echo $bookinfo['bookname']; ?>" src="/BookImages/<?php echo $bookinfo['bookname_pinyin']; ?>.jpg"></div>
							<div class="mltit">
								<h1><?php echo $bookinfo['bookname']; ?></h1>
								<div class="auths">作者：<?php echo $bookinfo['author'] ?></div>
							</div>
							<p>介绍：<br />&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bookinfo['Description']; ?><br /><br /><br /></p>
						</div>
					</div>
					<div class="bdwrit">
						<p style="margin-right:10px;"></p><p style="margin-left:10px;"></p>
					</div>
					<div class="mulu">
						<div class="t">
							
							<div class="jm"><h3>《<?php echo $bookinfo['bookname']; ?>》</h3></div>
							<ul class="pox">
							<?php foreach ($article_info as $articleid) { ?>
								<li><a style="" target="_blank" href="/directory/<?php echo $bookinfo['bookname_pinyin']; ?>/<?php echo $articleid['id']; ?>"><?php echo $articleid['article_title']; ?></a></li>
							<?php } ?>

							</ul>
							
						</div>
					</div>
					<div class="cl"></div>
				</div>
			</div>
			<div id="footer">
				<div class="bd">
					<div class="sp-20"></div>
					<div class="lpic clear">
						<h5>墨客文学网提示：</h5> 
						<div class="blogroll">
							①、文章阅读页面，方向键左右(← →)为前后翻页，回车键则是返回目录章节。<br>
							②、如果您发现本书内容有与法律抵触之处，请马上向本站举报，墨客文学网需要您们的建议和更多的参与互动！<br>
							③、如果您发现<strong>造化之门</strong>最新章节更新过慢，请发短信通知我们，我们会立即处理，您的热心是对网站最大的支持！ 
						</div>
					</div>
					<div class="rtext"></div>
					<p class="cp">Copyright &copy; 2014 <a href="http://www.moksos.com">墨客文学网</a>(http://www.moksos.com) 无弹窗无广告 免费阅读版<script language="javascript" type="text/javascript" src="js/tongji.js"></script></p>
				</div>
			</div>
		</div>
	</body>
</html>