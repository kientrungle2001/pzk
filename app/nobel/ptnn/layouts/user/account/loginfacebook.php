<?php
    if(pzk_session('login')){

?>
<?php } else{ 

?>

<?php 
  include('/3rdparty/loginfacebook/src/facebook.php');
  $facebook = new Facebook(array(
    'appId' => '1552342791689162',
    'secret' => 'c5496ab5545b2eee110a17c4c114e526',
   
  ));
  
  $fbUserId = $facebook->getUser();
 $loginUrl = $facebook->getLoginUrl(array('scope' => 'email'));

if ($fbUserId) {
    try {
        $user_profile = $facebook->api('/me');
       
        if (!empty($user_profile)) {
        //$query="SELECT .... WHERE a.`fbid`='$fbUserId'";   
          $id=$user_profile['id'];
          $name = $user_profile['name'];
         
          $data->CheckFB($id,$name);
          echo '<script>window.close();</script>';
    }
    } catch (FacebookApiException $e) {
        $user_profile = null;
    }
     
} else {
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'email'));
    header('Location: ' . $loginUrl);
}
}
  ?>
