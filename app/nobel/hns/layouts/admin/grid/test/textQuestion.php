<?php
$OrderBy = pzk_request()->getOrderBy();
$testId = pzk_request()->getTestId();
if($OrderBy) {
    switch ($OrderBy) {
        case 1:
            $data->orderBy = 'id asc';
            break;
        case 2:
            $data->orderBy = 'ordering asc';
            break;
        default:
            $data->orderBy = 'id asc';
    }

}
$data->setConditions(array('and', $data->getConditions(), array('like', 'testId', "%,$testId,%") ));

$items = $data->getItems();
$sttc = 1;

?>



        <?php foreach($items as $item): ?>
        <?php


        $answer = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
        ?>


                        <strong>Câu <?php echo $sttc ?>: <?php echo getLatex(strip_tags($item['name'])); ?></br></strong>
                        <?php
                        $i = 1;
                        $recomend = false;
                        foreach($answer as $val) {
                            switch ($i) {
                                case 1:
                                    $stt = 'A';
                                    break;
                                case 2:
                                    $stt = 'B';
                                    break;
                                case 3:
                                    $stt = 'C';
                                    break;
                                case 4:
                                    $stt = 'D';
                                    break;
                                case 5:
                                    $stt = 'E';
                                    break;
                                case 6:
                                    $stt = 'F';
                                    break;
                                case 7:
                                    $stt = 'G';
                                    break;
                                default:
                                    $stt = '';
                            }
                            if($val['status'] == 1) {
                                $dapan = '<strong>'.'Đáp án là '. $stt.'. '.getLatex(strip_tags($val['content'], '<img>')).'</strong>'.'</br>';
                                $recomend = getLatex($val['recommend']);
                            }
                            echo $stt.'. '.getLatex(strip_tags($val['content'], '<img>')).'</br>';
                            $i++;
                        }
                        echo $dapan.'<br>';
                        if($recomend) {
                            echo $recomend.'</br></br>';
                        }
                        ?>






        <?php $sttc++;
        ?>

        <?php endforeach; ?>




