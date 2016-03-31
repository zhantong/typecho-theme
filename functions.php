<?php

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

function themeConfig($form)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', null, null, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);

    $db = Typecho_Db::get();
    $pages = $db->fetchAll($db->select('slug,title')->from('table.contents')->where('type=?', 'page'));
    $list = array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项'), );
    foreach ($pages as $key => $value) {
        $pagesArray[$value['slug']] = $value['title'];
    }
    $list = array_merge($list, $pagesArray);
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', $list,
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    $form->addInput($sidebarBlock->multiMode());
    $showPages = new Typecho_Widget_Helper_Form_Element_Checkbox('showPages', $pagesArray, array_keys($pagesArray), _t('独立页面显示'));
    $form->addInput($showPages->multiMode());
    $secondbarPage = new Typecho_Widget_Helper_Form_Element_Checkbox('secondbarPage', $list,
    array('ShowCategory', 'ShowArchive'), _t('第二栏显示（非文章页面）'));
    $form->addInput($secondbarPage->multiMode());
    $secondbarList=array(
        'ShowRelatedPosts' => _t('显示相关文章'),
        'ShowPrevNextPosts' => _t('显示上一篇/下一篇'),
    );
    $secondbarPost=new Typecho_Widget_Helper_Form_Element_Checkbox('secondbarPost', $secondbarList,
    array('ShowRelatedPosts', 'ShowPrevNextPosts'), _t('第二栏显示（文章页面）'));
    $form->addInput($secondbarPost->multiMode());
}

function PageToLinks($page)
{
    $content = $page->content;
    $title = $page->title;
    echo "<h3 class='widget-title'>".$title.'</h3>';
    $content = str_replace('<ul>', "<ul class='widget-list'>", $content);
    echo $content;
}
/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/
