<?php
class PzkAdminModel
{
    public function getUser($username)
    {
        static $data = array();
        if (!$username) return false;
        if (!@$data[$username]) {
            if (is_numeric($username)) {
                $userId = $username;
                $conds = "`id`='$userId'";
            } else {
                $conds = "`username`='$username'";
            }
            $users = _db()->select('*')->from('user')
                ->where($conds)->limit(0, 1)->result();
            if ($users) $data[$username] = $users[0];
            else $data[$username] = false;
        }
        return $data[$username];
    }

    public function login($username, $password)
    {
        $password = md5(trim($password));
        $users = _db()->select('a.id, a.status, a.name, a.areacode, a.district, a.school, a.class, a.classname, a.usertype_id, a.categoryIds, at.level')
            ->from('admin a')
            ->join('admin_level at', 'a.usertype_id = at.id')
            ->where("a.name='$username' and a.password='$password'")
            ->where("a.status = 1")
            ->limit(0, 1);
        $users = $users->result_one();

        if ($users) {
            return $users;
        } else {
            return false;
        }
    }

    public function logout()
    {
        pzk_session()->del('adminUser');
        pzk_session()->del('adminId');
        pzk_session()->del('adminLevel');
        pzk_session()->del('adminAreacode');
        pzk_session()->del('adminDistrict');
        pzk_session()->del('adminClass');
        pzk_session()->del('adminClassname');
        pzk_session()->del('categoryIds');
    }

    public function checkAction($action, $level)
    {
        $users = _db()->select('a.*')
            ->from('admin_level_action a')
            ->where("admin_action='$action' and admin_level='$level'")
            ->where(array('software', pzk_request('softwareId')))
            ->limit(0, 1);
        $users = $users->result();
        if (count($users) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkActionType($type, $controller, $level)
    {
        $type   =     trim($type);
        $user    =     _db()->select('*')->fromAdmin_level_action()->where(
            array(
                'action_type'    => $type,
                'admin_action'    => $controller,
                'admin_level'    => $level,
                'software'        => pzk_request('softwareId')
            )
        )->limit(0, 1);
        $users = $user->result_one();
        if ($users) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllLevel()
    {
        $data = _db()->select('id, level')->from('admin_level')->result();
        return $data;
    }

    /**
     * Kiểm tra xem user đã tồn tại hay chưa
     * @param String $username tên đăng nhập
     * @return Boolean tồn tại hay chưa
     */
    public function checkUser($username)
    {
        $username = trim($username);
        $users = _db()->select('count(*) as c')
            ->from('admin')
            ->whereName($username)
            ->result_one();
        if ($users['c']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Kiểm tra id và password
     */
    public function checkPass($userid, $pass)
    {
        $pass = trim($pass);
        $pass = md5($pass);
        $users = _db()->select('count(*) as c')
            ->from('admin')
            ->whereId($userid)
            ->wherePassword($pass)
            ->result_one();
        if ($users['c']) {
            return true;
        } else {
            return false;
        }
    }
}
