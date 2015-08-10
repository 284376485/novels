<!-- 获取章节信息 -->
<?php
foreach($article_info as $key => $value) 
		{
			if($article_id == $value['id']){
				$content_info = $value;			
				$pre_id = $key - 1 ;
				$next_id = $key + 1 ;
				break;
			}
		}
if($pre_id < 0)
	$pre_id = 0;
if($next_id == count($article_info))
{
	$next_id -= 1; 
}	
//head info
$this->title = $content_info['article_title'];
//head info end	
	if($article_info[$pre_id]['id'] && $pre_id != 0)
		$pre_link = './'.$article_info[$pre_id]['id'];
	else
		$pre_link = './index';
	

	if($article_info[$next_id]['id'] && $next_id !=( count($article_info) -1 ))
		$next_link = './'.$article_info[$next_id]['id'];
	else
		$next_link = './index';
	?>	


<script language="javascript">
			document.onkeydown=keypage
			var prevpage="<?php echo $pre_link; ?>"
			var nextpage="<?php echo $next_link; ?>"
			var index_page = "./index"
			function keypage() {
			if (event.keyCode==37) location=prevpage
			if (event.keyCode==39) location=nextpage
			if (event.keyCode == 13) document.location = index_page
			}
		</script>


<div class="mail-cont">
					<div class="wen-zhang-biao-ti">
						<div id="read-dao-hang">
							<ul><li><a href="/">XXX网</a><i>&gt;</i></li><li><a href="/class/<?php echo $bookinfo['Class']; ?>/1"> <?php echo Yii::$app->params['Class'][$bookinfo['Class']]; ?></a><i>&gt;</i></li><li><a href="./index"><?php echo $bookinfo['bookname']; ?></a><i>&gt;</i></li><li><?php echo $content_info['article_title']; ?></li><a rel="nofollow" target="_blank" title="把该章节加入标签，方便下次续读" href="#"><span class="readshu">加入书签</span></a></ul>
						</div>
						<div class="zhang-jie-biao-ti"><h1>
						<?php echo $content_info['article_title']; ?>
						</h1></div>
					</div>
					<div class="zhang-txt-nei-rong">
						﻿<?php  
							@$filename = "novel_directory/".$bookinfo['bookname_pinyin'].'/'.$article_id.'.txt';  
							@$content = file_get_contents($filename);     //得到字符串  
							if(empty($content))
								echo '本章貌似为空';
							else
								echo $content;  
						?>  
						<div class="bd-load-s"></div>
						<?php 
						//判断上一章是否存在
							if(empty($article_info[$pre_id]))
								$pre_text = '无上一章';
							else
								$pre_text = '<a id="pager_prev" href="./'.$article_info[$pre_id]['id'].'">'.$article_info[$pre_id]['article_title'].'</a>';
						//判断下一章是否存在
							if(empty($article_info[$next_id]))
							{
								$next_text = '无下一章';
							}
							else
							{
								$next_text = '<a id="pager_next" href="./'.$article_info[$next_id]['id'].'">'.$article_info[$next_id]['article_title'].'</a>';
							}

						 ?>
						<div id="pageselect"><?php echo $pre_text; ?> | <a id="pager_current" href="./index">返回目录</a> | <?php echo $next_text; ?></div><div class="b-g-w"></div>
						<div class="biao-qian-love-bd">
							<div class="shu-ping-shijian">
								<div class="wen-xin-ti-shi"><a rel="nofollow" target="_blank" title="把该章节加入标签，方便下次续读" href="#"><span class="botshu">加入书签</span></a>温馨提示：方向键左右(← →)前后翻页，上下(↑ ↓)上下滚用。</div>
							</div>
						</div>
					</div>

			</div>
		</div>

