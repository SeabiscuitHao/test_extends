<?php
    class UserController {
        public function login(){
            include "./view/user/login.html";
        }

        public function reg(){
            include "./view/user/reg.html";
        }


        public function doLogin(){
            $phone    = empty($_POST['phone']) ? 0 :$_POST['phone'];
            $password = empty($_POST['password']) ? 0 :$_POST['password'];
            $formate  = empty($_POST['formate']) ? 'json' :$_POST['formate'];
            $result = array('error'=>'0','message'=>'','data'=>array());

            $format = empty($_POST['format']) ? json : $_POST['format'];

            
            
            // $mysqli = new mysqli('localhost','root','root','zt_test');
            // $sql = "select * from zt_user where phone = '{$phone}'";
            // $query = $mysqli -> query($sql);
            // include "./model/UserModel.class.php";
            // $model = new User();
            // $query = $model -> getUserInfoBy($phone);

            // if (!empty($model)) {
            //     $res = $query -> fetch_array(MYSQLI_ASSOC);
            //     if ($res['password'] == $password) {
            //         $_SESSION['me'] = $res;
            //         header("location:index.php?c=message&a=lists");
            //     }
            // }else{
            //     echo "<script>alert('该用户不存在！');</script>";
            // }
        }
        public function logout(){
            $_SESSION['me'] = array();
            header("location:index.php?c=user&a=login");
        }

        public function doReg(){
            header('Content-type: application/json');
            $phone      = empty($_POST['phone']) ? 0 : $_POST['phone'];
            $name       = empty($_POST['uname']) ? 0 : $_POST['uname'];
            $password   = empty($_POST['password']) ? 0 : $_POST['password'];

            $result = array('error'=>0,'message'=>'','data'=>array());

            $formate = !empty($_POST['formate']) ? $_POST['formate'] : 'json';
            if (empty($phone) || empty($password)) {
                var_dump($phone);
            // var_dump(empty($phone));var_dump(empty($password));
                if ($formate == 'json') {
                    //die('123');
                    $result['error'] = '1';
                    $result['message'] = '参数错误';
                    echo json_encode($result);die();
                } else {
                    die('参数错误');
                }
            }
            $model = D('user');
            $info = $model->getUserInfoByPhone($phone);
            //var_dump($info);
            //如果有重复的电话
            if (!empty($info)) {
                if ($formate == 'json') {
                    $result['error'] = '2';
                    $result['message'] = '电话号已经被注册';
                    echo json_encode($result);die();
                } else {
                    die('电话号已经被注册');
                }
            }
    
            $model -> addUserInfo($phone,$name,$password);
            if (!empty($model)) {
                if ($formate == 'json') {
                    //var_dump($result);
                    $result['data'] = array();
                    echo json_encode($result);
                    die();
                } else {
                    header("location:index.php?c=user&a=Login");die();
                }
            }
        } 
    }





















        // public function doLogin() {
        //     $phone 		= $_POST['phone'];
        //     $password 	= $_POST['password'];

        //     $mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
        //     $sql = "select * from zt_user where phone = '{$phone}' ";
        //     $query = $mysqli->query($sql);
        //     $info = $query->fetch_array(MYSQLI_ASSOC);
        //     if ($info['password'] == $password) {
        //         unset($info['password']);

        //         $_SESSION['me'] = $info;
        //     }
        //     header('location:index.php?c=message&a=lists');
        // }

        // public function reg() {
        //     include "./view/user/reg.html";
        // }

        // public function doReg() {
        //     $uname 		= $_POST['uname'];
        //     $phone 		= $_POST['phone'];
        //     $password 	= $_POST['password'];

        //     $mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
        //     $sql = "select * from zt_user where phone = '{$phone}'";
        //     $query = $mysqli->query($sql);

        //     if ($query->num_rows > 0) {
        //         header('location:index.php?c=user&a=login');
        //         die();
        //     }

        //     $sql = "insert into zt_user (name,phone,password) value ('{$uname}', '{$phone}', '{$password}')";
            
        //     $query = $mysqli->query($sql);
        //     header('location:index.php?c=user&a=login');
        // }

        // public function logout() {
        //     $_SESSION = array('a'=>'b','c'=>'d');
        //     header('location:index.php?c=user&a=login');
        // }

