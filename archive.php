<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'){
        $is_ajax=true;
    }
    else{
        $is_ajax=false;
    }
?>
<?php if(!$is_ajax):  ?>
    <?php
        $this->need('header.php');
    ?>
<?php else:  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle(array(
        'category' => _t('分类 %s 下的文章'),
        'search' => _t('包含关键字 %s 的文章'),
        'tag' => _t('标签 %s 下的文章'),
        'author' => _t('%s 发布的文章'),
    ), '', ' - '); ?><?php $this->options->title(); ?></a>
<?php endif ?>

<?php if ($this->have()): ?>
    <?php
        if($this->is('search')){
            $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'keywords='.$this->getKeywords())->to($posts);
        }
        else{
            $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'slug='.$this->getArchiveSlug())->to($posts);
        }
    ?>
    <article>
        <h1 class="archive-title"><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章'),
        ), '', ''); ?></h1>
        <ul class="listing">
            <?php while($posts->next()): ?>
                <li class="list-group-item">
                    <small><em><?php $posts->date('Y-m-d'); ?></em></small>
                    <span class="badge"><?php $posts->viewsNum(); ?></span>
                    <a class="post-url" href="<?php $posts->permalink() ?>"><?php $posts->title() ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </article>
<?php else: ?>
    <article class="post">
        <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
    </article>
<?php endif; ?>
<?php if(!$is_ajax):  ?>
    </div>
    <?php $this->need('footer.php'); ?>
<?php endif ?>
