<link rel="stylesheet" href="/default/skin/ptnn/css/question/fill.css">
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
          
                {each $easys as $easy}
                    <a href="/test/lesson?id={easy[id]}"> Đề {i} </a> <br>
                    <?php $i++; ?>                   
                {/each}
              
            </th>
        </tr>
        <tr >
            <th>Mức độ trung bình</th>
          
            <th >
          
                {each $normals as $normal}
                    <a href="/test/lesson?id={normal[id]}"> Đề {j} </a> <br>
                    <?php $j++; ?>                   
                {/each}
              
            </th>
        </tr>
        <tr >
            <th>Mức độ Khó</th>
          
            <th >
          
                {each $difficults as $difficult}
                    <a href="/test/lesson?id={difficult[id]}"> Đề {k} </a> <br>
                    <?php $k++; ?>                   
                {/each}
              
            </th>
        </tr>
        </thead>
    </table>


</div>
