<?php
$i = 1;
$flag = 0;
while ($i <= $number_of_day) {
    for($j=1 ; $j<=7 ; $j++){
        if($i > $number_of_day)
            break;

        if($flag) {
            if ($year . '-' . $month . '-' . $i == date('Y') . '-' . date('m') . '-' . (int)date('d'))
                include(resource_path('views/admin/available_times/parts/toDay.php'));
            else
                include(resource_path('views/admin/available_times/parts/day.php'));

            $i++;
        }elseif($j == $start_day){
            if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                include(resource_path('views/admin/available_times/parts/toDay.php'));
            else
                include(resource_path('views/admin/available_times/parts/day.php'));

            $flag = 1;
            $i++;
            continue;
        }
        else {
            include(resource_path('views/admin/available_times/parts/prevMonth.php'));
        }

    }
}
?>
