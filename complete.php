<?php
require 'deletecache.php';
require 'compile.php';
?>

<?php if($_GET['refresh']):?>
  <script>
  setTimeout(function() {
    window.location.reload();
  }, 600 * 1000);
  </script>
<?php endif;?>