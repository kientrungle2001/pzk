<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/fill.css">
<div class="item bg_section">
<?php 
    $easys= $data->Easy();
    $normals= $data->Normal();
    $difficults= $data->Difficult();
    $i=1;
    $j=1;
    $k=1;
?>
<div  class="title_question">DANH SÁCH CÁC BÀI KIỂM TRA VỀ TỪ</div>

    <table class="tb_lesson" border="1px" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>Mức độ</th>
            <th>Chọn đề</th>
        </tr>
        <tr >
            <th>Mức độ dễ</th>
          
            <th >
          
                <?php foreach($easys as $easy): ?>
                    <a href="/test/lesson?id=<?php echo @$easy['id']?>"> Đề <?php echo $i ?> </a> <br>
                    <?php $i++; ?>                   
                <?php endforeach; ?>
              
            </th>
        </tr>
        <tr >
            <th>Mức độ trung bình</th>
          
            <th >
          
                <?php foreach($normals as $normal): ?>
                    <a href="/test/lesson?id=<?php echo @$normal['id']?>"> Đề <?php echo $j ?> </a> <br>
                    <?php $j++; ?>                   
                <?php endforeach; ?>
              
            </th>
        </tr>
        <tr >
            <th>Mức độ Khó</th>
          
            <th >
          
                <?php foreach($difficults as $difficult): ?>
                    <a href="/test/lesson?id=<?php echo @$difficult['id']?>"> Đề <?php echo $k ?> </a> <br>
                    <?php $k++; ?>                   
                <?php endforeach; ?>
              
            </th>
        </tr>
        </thead>
    </table>


</div>
