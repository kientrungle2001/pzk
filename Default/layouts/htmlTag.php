<?php if($data->getTagName() == 'br' || $data->getTagName() == 'hr') { echo '<'.$data->getTagName().' />'; } else { ?>
<<?php echo $data->getTagName()?> <?php if (strpos($data->getId(), 'unique') === FALSE){ echo 'id="'.$data->getId().'"';} ?>
  <?php 
  $attrs = array('name', 'type', 'class', 'style', 'value', 'selected', 'href', 'src', 'role', 'aria-controls', 'data-toggle');
        foreach($attrs as $attr):?>
    <?php if(isset($data->$attr) && $data->$attr !== ''):?>
      <?php echo $attr?>="<?php echo $data->$attr?>"
    <?php endif;?>
  <?php endforeach;?>><?php echo $data->getText()?><?php echo $data->displayChildren('all')?></<?php echo $data->getTagName()?>>
<?php } ?>