<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php include('common.php'); ?>
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
    <h3 class="archive-title"><?php $this->archiveTitle(array(
        'category' => _t('分类 %s 下的文章'),
        'search' => _t('包含关键字 %s 的文章'),
        'tag' => _t('标签 %s 下的文章'),
        'author' => _t('%s 发布的文章'),
    ), '', ''); ?></h3>
<?php else:  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle(array(
        'category' => _t('分类 %s 下的文章'),
        'search' => _t('包含关键字 %s 的文章'),
        'tag' => _t('标签 %s 下的文章'),
        'author' => _t('%s 发布的文章'),
    ), '', ' - '); ?><?php $this->options->title(); ?></a>
<?php endif ?>

<?php if ($this->have()): ?>
    <article>
        <ul class="listing">
            <?php
                if($this->is('search')){
                    $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'keywords='.$this->getKeywords())->parse('<li>{year}-{month}-{day} : <a class="post-url" href="{permalink}">{title}</a></li>');
                }
                else{
                    $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'slug='.$this->getArchiveSlug())->parse('<li>{year}-{month}-{day} : <a class="post-url" href="{permalink}">{title}</a></li>');
                }
            ?>
        </ul>
    </article>
<?php else: ?>
    <article class="post">
        <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
    </article>
<?php endif; ?>
<?php if(!$is_ajax):  ?>
    <?php
        echo $main_tail;
        $this->need('footer.php');
    ?>
<?php endif ?>
