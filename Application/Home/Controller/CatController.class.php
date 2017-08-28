<?php

namespace Home\Controller;

use Think\Controller;

class CatController extends CommonController
{
    public function index()
    {
        $config = D("Basic")->select();
        $navs = D("Menu")->getBarMenus();

        $id = intval($_GET['id']);
        if (!$id) {
            return $this->error('ID不存在');
        }
        $advNews = D("PositionContent")->select(array('status' => 1, 'position_id' => 5), 2);
        $rankNews = $this->getRank();


        $p = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;

        $newList = D('News')->getNews(array('catid' => $id), $p, $pageSize);
        $pageCount = D('News')->getNewsCount(array('catid' => $id));


        $page = new \Think\Page($pageCount, $pageSize);
        $show = $page->show();


//        print_r($newList);
        $this->assign('result', array(
                'config' => $config,
                'navs' => $navs,
                'catId' => $id,
                'advNews' => $advNews,
                'rankNews' => $rankNews,
                'newsList' => $newList,
                'pageShow' => $show,
            )
        );


        $this->display();
    }

}