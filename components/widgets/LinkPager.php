<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/7
 * Time: 下午1:21
 */

namespace app\components\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * Class GoLinkPager
 * @package app\components\widgets
 */
class LinkPager extends \yii\widgets\LinkPager
{
    public $firstPageLabel = '首页';
    public $lastPageLabel = '未页';
    public $nextPageLabel = '下一页';
    public $prevPageLabel = '上一页';
    public $pageCssClass = 'hidden-sm hidden-xs';
    /**
     * @var string the CSS class for the "first" page button.
     */
    public $firstPageCssClass = 'first';
    /**
     * @var string the CSS class for the "last" page button.
     */
    public $lastPageCssClass = 'last';
    /**
     * @var string the CSS class for the "previous" page button.
     */
    public $prevPageCssClass = 'prev';
    /**
     * @var string the CSS class for the "next" page button.
     */
    public $nextPageCssClass = 'next';
    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'active';

    public $disabledPageCssClass = 'disabled';

    // 是否包含跳转功能跳转 默认false
    public $go = false;

    public $maxButtonCount = 8;

    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }
        $buttons = [];
        $currentPage = $this->pagination->getPage();
        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }
        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }
        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }
        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }
        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // go
        if ($this->go) {
            $goPage = $currentPage + 2;
            if($goPage >$pageCount ){
                $goPage = $pageCount;
            }
            $goHtml = <<<goHtml
                <div class="form grey hidden-xs hidden-sm" style="float: left; margin-left: 10px; font-size: 12px;">
                    <span class="text">共 {$pageCount} 页</span>
                    <span class="text">到第</span>
                    <input class="input center" type="number" value="{$goPage}" min="1" max="{$pageCount}" aria-label="页码输入框" style="height: 30px; line-height: 26px; margin-top:2px; width: 46px;">
                    <span class="text">页</span>
                    <span class="btn go-page btn-info" role="button" tabindex="0" style="border: solid 1px #ccc; padding: 0; height: 28px; width:46px; line-height: 26px;">确定</span>
                </div>
goHtml;
            $buttons[] = $goHtml;
            $pageLink = $this->pagination->createUrl(false);
            $goJs = <<<goJs
                $(".go-page").on("click", function () {
                    var _this = $(this),
                        _pageInput = _this.siblings("input"),
                        goPage = _pageInput.val(),
                        pageLink = "{$pageLink}";
                        pageLink = pageLink.replace("page=1", "page="+goPage);
                    if (goPage >= 1 && goPage <= {$pageCount}) {
                        window.location.href=pageLink;
                    } else {
                        _pageInput.focus();
                    }
                });
goJs;
            $this->view->registerJs($goJs);
        }
        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }

    /**
     * Renders a page button.
     * You may override this method to customize the generation of page buttons.
     * @param string $label the text label for the button
     * @param int $page the page number
     * @param string $class the CSS class for the page button.
     * @param bool $disabled whether this page button is disabled
     * @param bool $active whether this page button is active
     * @return string the rendering result
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        if ($active) {
            Html::addCssClass($options, $class);
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $tag = ArrayHelper::remove($this->disabledListItemSubTagOptions, 'tag', 'span');

            return Html::tag('li', Html::tag($tag, $label, $this->disabledListItemSubTagOptions), $options);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::tag('li', Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }
}

/*GoLinkPager::widget([
    'pagination' => $pages,
    'go' => true,
]);*/