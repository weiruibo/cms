<?php

namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class IndexController extends CommonController
{
    public function index($type = '')
    {

        $config = D("Basic")->select();
        $navs = D("Menu")->getBarMenus();
        //获取排行
        $rankNews = $this->getRank();
        // 获取首页大图数据
        $topPicNews = D("PositionContent")->select(array('status' => 1, 'position_id' => 2, 'thumb' => array('neq', "")), 1);
        // 首页3小图推荐
        $topSmailNews = D("PositionContent")->select(array('status' => 1, 'position_id' => 3, 'thumb' => array('neq', "")), 3);
        $listNews = D("News")->select(array('status' => 1, 'thumb' => array('neq', '')), 5);

        $advNews = D("PositionContent")->select(array('status' => 1, 'position_id' => 5), 1);
        $this->assign('result', array(
            'config' => $config,
            'navs' => $navs,
            'topPicNews' => $topPicNews,
            'topSmailNews' => $topSmailNews,
            'listNews' => $listNews,
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catId' => 0,

        ));
        /**
         * 生成页面静态化
         */
        $this->display();
    }

    public function build_html()
    {
        $this->index('buildHtml');
        return show(1, '首页缓存生成成功');
    }


    public function crontab_build_html()
    {
        if (APP_CRONTAB != 1) {
            die("the_file_must_exec_crontab");
        }
        $result = D("Basic")->select();
        if (!$result['cacheindex']) {
            die('系统没有设置开启自动生成首页缓存的内容');
        }
        $this->index('buildHtml');

    }

//    public function getCount()
//    {
//        if (!$_POST) {
//            return show(0, '没有任何内容');
//        }
//
//        $newsIds = array_unique($_POST);
//
//        try {
//            $list = D("News")->getNewsByNewsIdIn($newsIds);
//        } catch (Exception $e) {
//            return show(0, $e->getMessage());
//        }
//
//        if (!$list) {
//            return show(0, 'notdataa');
//        }
//
//        $data = array();
//        foreach ($list as $k => $v) {
//            $data[$v['news_id']] = $v['count'];
//        }
//        return show(1, 'success', $data);
//    }
    public function getCount()
    {
//        print_r($_POST);

        if (!$_POST) {
            return show(0, '无内容');
        }

        $news_id = array_unique($_POST);
//        print_r($news_id);

        $data = array();
        $error = array();
        $res = array();
        foreach ($news_id as $k) {

            $result = D('News')->find($k);
            $data[] = $result;
//            print_r($result);
            if (!$result) {
                $error[] = $k;
            }
        }

        if ($error) {
//            print_r($error);
            return show(0, '数据有误');
        }

//        print_r($data);

        foreach ($data as $k => $v) {
//            print_r($v);

            $res[$v['news_id']] = $v['count'];
        }

//        print_r($res);

        return show(1,'success',$res);
    }

}