<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
    <article class="post">
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="column col-xs-12 col-sm-8 col-md-8 ol-lg-8" id="m-nav">
    <div id="main">
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
            <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        </article>
    </div>

<?php $this->need('footer.php'); ?>
