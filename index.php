<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php while($this->next()): ?>
        <article class="post-brif">
            <h4 class="post-title"><u><a class="post-url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></u></h4>
            <div class="post-excerpt hidden-xs">
                <p><small><?php $this->excerpt(); ?></small></p>
            </div>
            <ul class="post-meta list-inline clearfix hidden-xs">
                <li><small><span class="glyphicon glyphicon-calendar"><?php $this->date('Y-m-d'); ?></span></small></li>
                <li><small><span class="glyphicon glyphicon-tag"><?php $this->category(', '); ?></span></small></li>
                <li class="pull-right"><a href="<?php $this->permalink() ?>#comments"><span class="glyphicon glyphicon-comment"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
            </ul>
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
<?php if(false): ?>
<div class="column col-xs-12 col-sm-4 col-md-4 col-lg-4 post-navi auto-scroll hidden-xs" id="m-nav">
    <div class="post-list" id="main" >
    </div>
    <div class="progress">
        <div id="load-more" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
            加载中...
        </div>
    </div>
</div><!-- end #main-->
<?php endif ?>
<div class="column col-xs-12 col-sm-8 col-md-8 ol-lg-8" id="m-nav">
    <div id="main">
    </div>
    <div class="progress">
        <div id="load-more" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
            加载中...
        </div>
    </div>
</div>
<?php //$this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
