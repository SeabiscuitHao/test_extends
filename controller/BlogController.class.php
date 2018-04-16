<?php
class BlogController{

    public function lists() {
            //每页的条数
            $limit = 300;

            //总条数
            $count = D('blog')->getCount();

            //总页数    条数除以每页数  向上取整
            $pageCount = ceil($count / $limit);

            //获取当前页码  默认是1
            $page = !empty($_GET['p']) ? $_GET['p'] : 1;

            //计算数据偏移量
            $offset = ($page-1) * $limit;

            $cateList = D('cate')->getLists();

            $cateid = empty($_GET['cate']) ? 0 : $_GET['cate'];

            foreach ($cateList as $key => $value) {
                $cateTmp[$value['id']] = $value;
            }
            
            // $blogObj = D('blog');
            // $lists = $blogObj->getLists();
            
            //获取数据

            $lists = D('blog')->getBlog(array(), $offset, $limit);
            foreach ($lists as $key => $value) {
                // $value['calssify_name'] = $cateTmp[$value['calssify_id']]['name'];
                $lists[$key] = D('blog') -> formatBlog($value,$cateTmp);
                // $lists[$key] = $value;
            }

            $banner = D('ad') -> getBanners();
            $result = array('error'=>0,'msg'=>'','data'=>array());

            $result['data']['blog'] = $lists;
            $result['data']['banner']  = $banner;
            $result['data']['cate'] = $cateList;
            echo json_encode($result);
            die();

            //include "./view/blog/lists.html";
        }
        // public function add($data) {
        //     $data = array(
        //         'title' => '456',
        //         'content' => '456',
        //         'creatgory_id' => '1',
        //         'user_id' => '2',
        //         'image' => '123',
        //         'read_num' => '1',
        //         'flag' => '1',
        //     );
        //     // echo $data;
        // }

        // public function select($data,$where) {
        //     $data = array(
        //         'title' => '456',
        //         'content' => '456',
        //         'creatgory_id' => '1',
        //         'user_id' => '2',
        //         'image' => '123',
        //         'read_num' => '1',
        //         'flag' => '1',
        //     );

        //     $where = array(
        //         'id' => '1',
        //     );

        // }

        // public function update($where,$data) {
        //     $data = array(
        //         'title' => '456',
        //         'content' => '456',
        //         'creatgory_id' => '1',
        //         'user_id' => '2',
        //         'image' => '123',
        //         'read_num' => '1',
        //         'flag' => '1',
        //     );

        //     $where = array(
        //         'id' => '1',
        //     );

        // }

        // public function del($where) {
        //     $where = array(
        //         'id' => '1',
        //     );
        // }

        public function info() {
            $result = array('error'=>0,'message'=>'','data'=>array());
            if (empty($_GET['id'])) {
                $result['error']     = '10001';
                $result['message']   = '参数错误';
                echo json_encode($result);
                die();
            }
            $id = empty($_GET['if']) ? 0 : $_GET['id'];
            $info = D('blog') -> getInfo($id);
            if (empty($info)) {
                $result['error']    = '10002';
                $result['message']  = '博客不存在';
                echo json_encode($result);
                die();
            }
        }
    public function test() {
        $data = array(
            'id' => 10,
            'title' => 'xixux',
        );
        $where = array(
            'id' => 2,
        );
        // $res = D('blog')->update($data,$where);
        var_dump($res);
    }

}