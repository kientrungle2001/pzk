<?php if($data->tagName == 'br' || $data->tagName == 'hr') { echo '<'.$data->tagName.' />'; } else { ?>
<<?php echo $data->tagName?> <?php if (strpos($data->id, 'unique') === FALSE){ echo 'id="'.$data->id.'"';} ?>
  <?php 
  $attrs = array('name', 'type', 'class', 'style', 'value', 'selected', 'href', 'src', 'role', 'aria-controls', 'data-toggle');
        foreach($attrs as $attr):?>
    <?php if(isset($data->$attr) && $data->$attr !== ''):?>
      <?php echo $attr?>="<?php echo $data->$attr?>"
    <?php endif;?>
  <?php endforeach;?>><?php echo $data->text?><?php echo $data->displayChildren('all')?></<?php echo $data->tagName?>>
<?php } ?>