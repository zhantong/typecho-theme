<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
    <article>
        <ul class="listing">
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->parse('<li>{year}-{month}-{day} : <a class="post-url" href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </article>
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
<div class="column col-xs-12 col-sm-8 col-md-8 ol-lg-8" id="m-nav">
    <div id="main">
        <ul class="listing">
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->parse('<li>{year}-{month}-{day} : <a class="post-url" href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </div>

<?php $this->need('footer.php'); ?>
