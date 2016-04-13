<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

</div>
        <footer id="footer" class="text-center">
            &copy; <?php echo date('Y'); ?>
            <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
            |
            <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>
            |
            <?php if ($this->options->icpNum): ?>
                <a href="http://www.miitbeian.gov.cn/" target="blank" rel="nofollow"><?php $this->options->icpNum(); ?></a>
            <?php endif; ?>
        </footer><!-- end #footer -->
    </div>
    <?php $this->need('sidebar.php'); ?>
</div>
</div>
<script src="
    <?php
        if ($this->options->jQueryUrl){
            $this->options->jQueryUrl();
        }
        else{
            $this->options->themeUrl('res/jquery/jquery-2.2.2.js');
        }
    ?>
"></script>
<script src="<?php $this->options->themeUrl('res/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('res/js/toc.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('res/js/alone.js'); ?>"></script>
<?php $this->footer(); ?>
    </body>
</html>
