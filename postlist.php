<?php
/**
 * 文章列表模板
 *
 * @package custom
 */

$this->need('header.php'); ?>

<article class="content">
  <section class="post">
    <ul class="listing">
      <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->parse('<li>{year}-{month}-{day} : <a href="{permalink}">{title}</a></li>'); ?>
    </ul>
  </section>
</article>
<?php $this->need('footer.php'); ?>
