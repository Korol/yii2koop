<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 19:35
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget {

    public $tpl; // template for display this Menu
    public $model; // model for select list
    public $type = [
        'menu', // frontend Menu, default value
        'select', // backend Menu
    ];
    public $data; // Menu data from DB
    public $tree; // Menu data from DB, sorted by tree structure
    public $menuHtml; // Menu data from DB, sorted by tree structure and with HTML tags

    public function init()
    {
        parent::init();
        if($this->tpl === null || !in_array($this->tpl, $this->type)){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        // get cache
        if($this->tpl == 'menu.php'){
            $cashed_menu = Yii::$app->cache->get('left_menu');
            if(!empty($cashed_menu)){
                return $cashed_menu;
            }
        }

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        // set cache
        if($this->tpl == 'menu.php') {
            Yii::$app->cache->set('left_menu', $this->menuHtml, 60); // 60 = 1 min
        }
        return $this->menuHtml;
    }

    protected function getTree($id_field = 'id', $parent_field = 'parent_id', $childrens_key = 'childs'){
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if(!$node[$parent_field]){
                $tree[$id] = &$node;
            }
            else{
                $this->data[$node[$parent_field]][$childrens_key][$node[$id_field]] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
} 