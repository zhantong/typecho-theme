<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
                    </div><!-- end #content -->
                    <footer id="footer" class="text-center">
                        &copy; <?php echo date('Y'); ?>
                        <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
                        |
                        <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>
                        |
                        <?php if ($this->options->icpNum): ?>
                            <a href="http://www.miitbeian.gov.cn/" target="blank" rel="nofollow"><?php $this->options->icpNum(); ?></a>
                        <?php endif; ?>
                    </footer>
                </div> <!-- end #middle -->
                <?php $this->need('sidebar.php'); ?>
            </div><!-- end div .row-fluid -->
        </div><!-- end #body -->
        <script src="<?php $this->options->jQueryUrl ? $this->options->jQueryUrl() : $this->options->themeUrl('res/jquery/jquery-2.2.3.min.js') ?>"></script>
        <script src="<?php $this->options->bootstrapJsUrl ? $this->options->bootstrapJsUrl() : $this->options->themeUrl('res/bootstrap-3.3.6/js/bootstrap.min.js') ?>"></script>
        <script src="<?php $this->options->themeUrl('res/js/alone.js'); ?>"></script>
        <script>
            $(document).ready(function () {
                <?php if(!empty($this->options->expandItems)): ?>
                    <?php if (in_array('TableOfContents', $this->options->expandItems)): ?>
                        $('#collapse-toc-page').collapse('show');
                    <?php endif; ?>
                    <?php if (in_array('Category', $this->options->expandItems)): ?>
                        $('#collapse-list-category').collapse('show');
                    <?php endif; ?>
                    <?php if (in_array('RelatedPosts', $this->options->expandItems)): ?>
                        $('#collapse-list-related-posts').collapse('show');
                    <?php endif; ?>
                    <?php if (in_array('PrevNextPosts', $this->options->expandItems)): ?>
                        $('#collapse-list-prev-next-posts').collapse('show');
                    <?php endif; ?>
                <?php endif; ?>
            });
        </script>
        <?php $this->footer(); ?>
    </body>
</html>
