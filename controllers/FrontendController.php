<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 23:29
 */

namespace app\controllers;

use app\components\MyAray;
use app\models\Category;
use Yii;

class FrontendController extends AppController{

    public $title_part = 'Магазин | Народная Кооперация';
    public $themeName = '';
    public $sidebarMenuData;
    public $sidebarMenuConnected = [];

    public function init()
    {
        $this->getThemeName();
        $this->getSidebarMenu();
        $this->getCartQty();
    }

    /**
     * @param null $title
     * @param null $keywords
     * @param null $description
     */
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = (!empty($title)) ? $title . ' | ' . $this->title_part : $this->title_part;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

    /**
     *
     */
    public function getThemeName()
    {
        $themeBaseUrl = $this->view->theme->getBaseUrl();
        if(!empty($themeBaseUrl)){
            $theme_ex = explode('/', $themeBaseUrl);
            $this->themeName = end($theme_ex);
        }
        return;
    }

    /**
     *
     */
    public function getSidebarMenu()
    {
        $this->sidebarMenuData = Category::find()->indexBy('id')->asArray()->all();
        $this->view->params['sidebar_menu'] = $this->getTree();
        return;
    }

    /**
     * @param string $id_field
     * @param string $parent_field
     * @param string $childrens_key
     * @return array
     */
    protected function getTree($id_field = 'id', $parent_field = 'parent_id', $childrens_key = 'childs'){
        $tree = [];
        if(!empty($this->sidebarMenuData)){
            foreach ($this->sidebarMenuData as $id => &$node) {
                if(!$node[$parent_field]){
                    $tree[$id] = &$node;
                }
                else{
                    $this->sidebarMenuData[$node[$parent_field]][$childrens_key][$node[$id_field]] = &$node;
                }
            }
        }
        return $tree;
    }

    /**
     * @param int $id
     */
    public function setActiveCategory($id = 0)
    {
        if(!empty($this->view->params['sidebar_menu'])){
            foreach ($this->view->params['sidebar_menu'] as $menu_row) {
                if(!empty($menu_row['childs']))
                    $this->buildConnected($menu_row['childs'], $menu_row['id'], $this->sidebarMenuConnected);
                else
                    $this->view->params['active_menu_id'] = $id;
            }
            if(!empty($id) && !empty($this->sidebarMenuConnected)){
                if(in_array($id, array_keys($this->sidebarMenuConnected))){
                    $this->view->params['active_menu_id'] = $id;
                }
                else{
                    foreach ($this->sidebarMenuConnected as $c_key => $c_value) {
                        if(in_array($id, $c_value)){
                            $this->view->params['active_menu_id'] = $c_key;
                            break;
                        }
                    }
                }
            }
        }
        else{
            $this->view->params['active_menu_id'] = 0;
        }
        $this->view->params['active_category_id'] = $id;
    }

    /**
     * @param $array
     * @param int $key
     * @param $result
     */
    public function buildConnected($array, $key = 0, &$result){
        foreach($array as $row){
            $result[$key][] = $row['id'];
            if(!empty($row['childs'])){
                $this->buildConnected($row['childs'], $key, $result);
            }
        }
    }

    /**
     * @param $category_id
     * @return array
     */
    public function getSubcategoriesIds($category_id)
    {
        $all_categories = Category::find()->indexBy('id')->asArray()->all();
        if(!empty($all_categories)){
            $list = $this->fetch_recursive($all_categories, $category_id);
            if(!empty($list)){
                $list = MyAray::toolIndexArrayBy($list, 'id');
                return (!empty($list)) ? array_keys($list) : [];
            }
        }
        return array();
    }

    /**
     * @param $src_arr
     * @param $currentid
     * @param bool $parentfound
     * @param array $cats
     * @return array
     * //$list = fetch_recursive($cats, 6);
     */
    public function fetch_recursive($src_arr, $currentid, $parentfound = false, $cats = array())
    {
        foreach($src_arr as $row)
        {
            if((!$parentfound && $row['id'] == $currentid) || $row['parent_id'] == $currentid)
            {
                $rowdata = array();
                foreach($row as $k => $v)
                    $rowdata[$k] = $v;
                $cats[] = $rowdata;
                if($row['parent_id'] == $currentid)
                    $cats = array_merge($cats, $this->fetch_recursive($src_arr, $row['id'], true));
            }
        }
        return $cats;
    }

    public function getCartQty()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->view->params['cart_qty'] = (!empty($session['cart.qty'])) ? '(' . $session['cart.qty'] . ')' : '';
    }
} 