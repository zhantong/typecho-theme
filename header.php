<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
    <head>
        <meta charset="<?php $this->options->charset(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>

        <!-- 使用url函数转换相关路径 -->
        <link rel="stylesheet" href="
            <?php
                if($this->options->bootstrapCssUrl){
                    $this->options->bootstrapCssUrl();
                }
                else{
                    $this->options->themeUrl('res/bootstrap/css/bootstrap.min.css');
                }
            ?>
        ">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('res/css/alone.css'); ?>">


        <!--[if lt IE 9]>
        <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
        <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- 通过自有函数输出HTML头部信息 -->
        <?php $this->header(); ?>
        <?php if ($this->options->siteStat): ?>
            <?php $this->options->siteStat(); ?>
        <?php endif; ?>
    </head>
    <body>
    <!--[if lt IE 8]>
        <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
    <![endif]-->
        <div id="body">
            <div class="row-fluid">
                <div id="test-parent" class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
                    <div class="row" id="test">
                        <div id="navi" class="col-sm-12 col-md-4">
                            <div class="dropdown">
                                    <a class="btn btn-lg dropdown-toggle visible-xs" id="logo" href="<?php $this->options->siteUrl(); ?>" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-home"></span>
                                        <span class="title-mini hidden-md"><?php $this->options->title() ?></span>
                                    </a>
                                    <a class="btn btn-lg btn-block hidden-xs" href="<?php $this->options->siteUrl(); ?>">
                                        <span class="glyphicon glyphicon-home"></span>
                                        <span class="title-mini hidden-md"><?php $this->options->title() ?></span>
                                    </a>
                                    <p class="text-center hidden-xs"><small><em><?php $this->options->description() ?></em></small></p>
                                <ul id="sidebar" class="dropdown-menu" aria-labelledby="logo">
                                    <li><a href="<?php $this->options->siteUrl(); ?>" id="mian-page-url" class="main-page text-center">文章列表</a></li>
                                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                    <?php while($pages->next()): ?>
                                        <?php if (!empty($this->options->showPages) && in_array($pages->slug, $this->options->showPages)): ?>
                                            <li>
                                                <a class="page-url text-center" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                    <li class="dropdown-submenu text-center">
                                        <a class="glyphicon glyphicon-search" href="#"></a>
                                        <ul class="dropdown-menu" style="padding:0;border:0;">
                                            <div class="input-group" id="search">
                                                <input type="text" class="form-control" placeholder="输入关键字搜索">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default">搜索</button>
                                                </span>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8 hidden-xs hidden-sm need-margin-top">
                            <div id="toc-bar">
                                <div id="show-in-post">
                                    <div class="panel-group" role="tablist">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="collapse-list-toc-heading">
                                                <h3 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-toc-page" aria-expanded="true" aria-controls="collapse-list-toc">
                                                        文章目录
                                                        <span class="collapse-toggle-icon small glyphicon glyphicon-resize-small"></span>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div id="collapse-toc-page" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapse-list-toc-heading">
                                                <div id="toc"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $this->need('showinpost.php'); ?>
                                </div>
                                <div id="show-not-in-post">
                                    <?php $this->need('shownotinpost.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 need-margin-top" id="m-nav">
                    <div id="content">
                        <div id="main">
