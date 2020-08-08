<?Php
$user_id = pzk_session()->getUserId();
if(isset($user_id)) {
    $lessons = _db()->useCB()->select('*')->from('lessons')->where(array('user_id', $user_id))->result();
    $i = 1;
    foreach($lessons as $val) {
        ?>
        <a href="/user/detaillesson/<?php echo $val['id']; ?>">Bài <?php echo $i; ?></a>
        <?php
        $i++;
    }
}

?>