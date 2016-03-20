<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php while($this->next()): ?>
        <article class="post">
            <h4 class="post-title"><u><a class="post-url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></u></h4>

            <ul class="post-meta">
                <li>时间: <?php $this->date('F j, Y'); ?></li>
                <li>分类: <?php $this->category(','); ?></li>
                <li><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></li>
            </ul>
            <div class="post-excerpt">
                <?php $this->excerpt(); ?>
            </div>
        </article>
    <?php endwhile; ?>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>
<?php
/**
 * 这是 Typecho 0.9 系统的一套默认皮肤
 *
 * @package Typecho Replica Theme
 * @author Typecho Team
 * @version 1.2
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div class="column col-xs-12 col-sm-4 col-md-4 col-lg-4 post-navi auto-scroll" id="m-nav">
    <div class="post-list" id="main" >
    </div>
    <div id="load_more" class="post-list">
        <button class="load_more_button" onclick ="load_more_list()">加载更多</button>
    </div>
</div><!-- end #main-->

<div class="column col-xs-12 col-sm-8 col-md-8 ol-lg-8 auto-scroll">
    <div id="post">
    </div>
</div>
<?php //$this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
