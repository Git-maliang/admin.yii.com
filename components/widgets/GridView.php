<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 上午10:43
 */

namespace app\components\widgets;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use app\components\i18n\Formatter;
use app\components\grid\DataColumn;

class GridView extends \yii\grid\GridView
{
    public $emptyText = '当前没有数据。';
    public $emptyTextOptions = ['class' => 'center'];
    public $pager = ['class' => 'app\components\widgets\LinkPager'];
    public $layout = "{items}\n<div class=\"row\"><div class=\"col-sm-4 hidden-xs hidden-sm grey\">{summary}</div><div class=\"col-sm-8\"><div class=\"dataTables_paginate paging_simple_numbers\">{pager}</div></div></div>";
    public $options = ['class' => 'dataTables_wrapper'];
    public $summaryOptions = ['class' => 'dataTables_info'];
    public $tableOptions = ['class' => 'table table-striped table-bordered table-hover dataTable'];

    /**
     * Initializes the grid view.
     * This method will initialize required property values and instantiate [[columns]] objects.
     */
    public function init()
    {
        if ($this->dataProvider === null) {
            throw new InvalidConfigException('The "dataProvider" property must be set.');
        }
        if ($this->emptyText === null) {
            $this->emptyText = Yii::t('yii', 'No results found.');
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if ($this->formatter === null) {
            $this->formatter = new Formatter();
        } elseif (is_array($this->formatter)) {
            $this->formatter = Yii::createObject($this->formatter);
        }

        if (!$this->formatter instanceof Formatter) {
            throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
        }
        if (!isset($this->filterRowOptions['id'])) {
            $this->filterRowOptions['id'] = $this->options['id'] . '-filters';
        }

        $this->initColumns();
    }

    /**
     * Renders the summary text.
     */
    public function renderSummary()
    {
        $pagination = $this->dataProvider->getPagination();
        if($count = $pagination->pageCount) {
            $js = <<<EOD
            $(".page-size").on("change", function () {
                var pageSize = $(this).val(),
                    pageLink = "{$pagination->createUrl(false)}";
                    pageLink = pageLink.replace("per-page={$pagination->pageSize}", "per-page="+pageSize);
                    window.location.href=pageLink;
            });
EOD;
            $this->getView()->registerJs($js);
            $items = [
                10 => 10,
                25 => 25,
                50 => 50,
                100 => 100
            ];
            return '显示' . Html::dropDownList(null, $pagination->pageSize, $items, ['class' => 'page-size sample-table-2_length']) . '条 - 共 ' . $count . ' 页 - 总计 ' . $this->dataProvider->getTotalCount() . ' 条数据';
        }
    }

    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns()
    {
        if (empty($this->columns)) {
            $this->guessColumns();
        }
        foreach ($this->columns as $i => $column) {
            if (is_string($column)) {
                $column = $this->createDataColumn($column);
            } else {
                $column = Yii::createObject(array_merge([
                    'class' => $this->dataColumnClass ? : DataColumn::className(),
                    'grid' => $this,
                ], $column));
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            $this->columns[$i] = $column;
        }
    }

    /**
     * Creates a [[DataColumn]] object based on a string in the format of "attribute:format:label".
     * @param string $text the column specification string
     * @return DataColumn the column instance
     * @throws InvalidConfigException if the column specification is invalid
     */
    protected function createDataColumn($text)
    {
        if (!preg_match('/^([^:]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
            throw new InvalidConfigException('The column must be specified in the format of "attribute", "attribute:format" or "attribute:format:label"');
        }

        return Yii::createObject([
            'class' => $this->dataColumnClass ? : DataColumn::className(),
            'grid' => $this,
            'attribute' => $matches[1],
            'format' => isset($matches[3]) ? $matches[3] : 'text',
            'label' => isset($matches[5]) ? $matches[5] : null,
        ]);
    }
}