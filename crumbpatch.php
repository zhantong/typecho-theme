<ol class="breadcrumb">
    <li><a class="main-page" href="<?php $this->options->siteUrl(); ?>">主页</a></li>
    <li>
        <?php if ($this->is('index')): ?>
          最近更新
        <?php elseif ($this->is('post')): ?>
          <?php $this->category(); ?>
        <?php else: ?>
          <?php $this->archiveTitle(' » ','',''); ?>
        <?php endif; ?>
    </li>
</ol>
