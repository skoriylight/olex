<?php

namespace app\modules\catalog\components;

use app\modules\catalog\models\Category;
use app\modules\main\components\Tr;
use yii\grid\GridView;
use Yii;
use yii\web\View;


Class CartGridView extends GridView
{
    protected $categories = null;
    protected $cat_id = 0;
    protected $column_count;
    public $group_attr = 'name_t';
    public $group_model;
    public $keyMap = [];
    public $relationModel = 'getModel';

    public $dataColumnClass = 'app\modules\catalog\components\CartColumn';


    public function init()
    {
        parent::init();
        $this->categories = Category::find()->where(['parent_id' => null])->indexBy('id')->all();
        $this->column_count = count($this->columns);

        $js = <<<JS
        $(document).on('click', '[data-toggle="cart-collapse"]', function(){
            var aria_expanded = $(this).attr('aria-expanded');
            var target = $(this).data('target');
            var blocks = $(target);
            if(aria_expanded == 'true') {
                blocks.slideUp(600);
                $(this).attr('aria-expanded', 'false');
            } else {
                blocks.slideDown(600);
                $(this).attr('aria-expanded', 'true');
            }
        });
JS;

        $this->view->registerJS($js, View::POS_READY, 'cart-collapse');
    }

    public function groupItems()
    {
        $models = [];
        foreach ($this->dataProvider->getModels() as $model) {

            if (!isset($model->{$this->relationModel}()->product->category->root)) {
                $name = Tr::t('cart-main', 'NO_CATEGORY');
                $cat_id = 0;
            } else {
                $rootModel = $model->{$this->relationModel}()->product->category->root;
                $name = $rootModel->{$this->group_attr};
                $cat_id = $rootModel->id;

            }
            $models[$cat_id]['name'] = $name;
            $models[$cat_id]['id'] = $cat_id;
            $models[$cat_id]['items'][] = $model;

            $this->keyMap[$model->id] = $cat_id;
        }
        return $models;
    }


    protected function getCatRows($item, $options)
    {
        $content = $this->render('cart-grid-view/template-row-active', ['name' => $item['name'], 'options' => $options]);
        return "<tr ><td data-toggle='cart-collapse' aria-expanded=\"true\" data-target=\".cart-block-{$item['id']}\" colspan='{$this->column_count}' >
        {$content}</td></tr>";
    }

    public function getEmptyCatRows()
    {
        $res = '<tbody>';
        foreach ($this->categories as $cat) {
            $res .= $this->getCatRows($cat, ['active' => false]);
        }
        return $res . "</tbody>";
    }

    public function renderTableBody()
    {
        //$models = array_values($this->dataProvider->getModels());
        $groups = $this->groupItems();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($groups as $groupId => $models) {
            $rows[] = $this->getCatRows($models, ['count' => count($models['items']), 'active' => true]);
            $rows[] = "<tbody>";
            foreach ($models['items'] as $index => $model) {
                $key = $keys[$index];
                if ($this->beforeRow !== null) {
                    $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                    if (!empty($row)) {
                        $rows[] = $row;
                    }
                }

                $rows[] = $this->renderTableRow($model, $key, $index);

                if ($this->afterRow !== null) {
                    $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                    if (!empty($row)) {
                        $rows[] = $row;
                    }
                }
            }
            $rows[] = "</tbody>";
            unset($this->categories[$groupId]);
        }
        $rows[] = $this->getEmptyCatRows();

        if (empty($rows) && $this->emptyText !== false) {
            $colspan = count($this->columns);

            return "<tbody>\n<tr><td colspan=\"$colspan\">" . $this->renderEmpty() . "</td></tr>\n</tbody>";
        } else {
            return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
        }
    }


}