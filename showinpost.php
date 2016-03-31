<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php if (!empty($this->options->secondbarPost) && in_array('ShowRelatedPosts', $this->options->secondbarPost)): ?>
    <section id="related-posts">
        <h3 class="widget-title"><?php _e('相关文章'); ?></h3>
        <?php $this->related(5)->to($relatedPosts); ?>
        <ul class="list-group">
            <?php while ($relatedPosts->next()): ?>
                <li class="list-group-item"><a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><?php $relatedPosts->title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->secondbarPost) && in_array('ShowPrevNextPosts', $this->options->secondbarPost)): ?>
    <section id="prev-next-posts">
        <ul class="list-group">
            <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
            <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
        </ul>
    </section>
<?php endif; ?>
