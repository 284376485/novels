<!--头部 end-->
<?php 
use app\models\IndexModel;
use app\models\TransPinyin;

$IndexModel = new IndexModel();
$TransPinyin= new TransPinyin(); 

?>
				<div id="main">
				    <div class="hd" style="background:#fff;"><p class="authlistsea">搜索“<?php echo $keywords; ?>”结果列表 | 共有 <?php echo count($search_result); ?> 条结果</p></div>
					
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
            <?php foreach ($search_result as $search_result_book) { ?>
            <li>
                    <div class="topba-sm mx"><a target="_blank" href="Fiction_Catalog/<?php echo $TransPinyin->Pinyin($search_result_book['bookname']); ?>.html"><?php echo $search_result_book['bookname']; ?></a></div>
                    <div class="topba-zj mx"><a target="_blank" href="Fiction_Catalog/<?php echo $TransPinyin->Pinyin($search_result_book['bookname']); ?>/<?php echo $search_result_book['article_last_id']; ?>.html"><?php echo $search_result_book['article_last_title'] ?></a></div>
                    <div class="topba-cz mx"><?php echo $search_result_book['author']; ?></div>
                    <div class="topba-cz mx">27</div>
                    <div class="topba-tim mx"><?php  echo date('m/d H:i',strtotime($search_result_book['article_last_updatetime'])); ?></div>
                    <div class="topba-cz mx"><?php echo $IndexModel->Judge_Book_Status($search_result_book['status']); ?></div>
                </li>
            <?php }?>
          
                
        </ul>
    <div class="articlepage">
        <div class="pagelink" id="pagelink">
            
         </div>
      </div> 
    </div>
    </div>
    </div>
    </div>
</div>







					<div class="bd-index-gd-writ"><p style="margin-right:10px;"></p><p style="margin-left:10px;"></p></div>
					<div class="cl"></div>
				</div>
			</div>