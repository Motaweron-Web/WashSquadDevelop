<?php
use App\Models\Order;
use App\Models\PeriodLimit;

if ($i < 10) {
    $newI = '0' . $i;
} else {
    $newI = $i;
}
$toDay = date('Y-m-d', strtotime($year . '-' . $month . '-' . $newI));

$active = '';
if (session()->get('activeDate') == $toDay) {
    $active = ' active ';
}

$polishing = Order::where('date',$toDay)->where('service_id',2)->sum('number_of_cars');
$wash = Order::where('date',$toDay)->where('service_id',1)->sum('number_of_cars');
$sterilization = Order::where('date',$toDay)->where('service_id',78)->sum('number_of_cars');

$polishingLimit = PeriodLimit::where('service_id',2)->sum('count');
$washLimit = PeriodLimit::where('service_id',1)->sum('count');
$sterilizationLimit = PeriodLimit::where('service_id',78)->sum('count');

$codeForServices = '';

if($washLimit){
    $class = 'availableTime';
    if (($washLimit - $wash) <= 0)
        $class = 'unavailableTime';

    $codeForServices .= '<span class="'.$class.'"> <img src="'.url('assets/admin/images/icons/2.png').'"> غسيل  </span>';
}
if($polishingLimit){
    $class = 'availableTime';
    if (($polishingLimit - $polishing) <= 0)
        $class = 'unavailableTime';

    $codeForServices .= '<span class="'.$class.'"> <img src="'.url('assets/admin/images/icons/3.png').'"> تلميع </span>';
}



if($sterilizationLimit){
    $class = 'availableTime';
    if (($sterilizationLimit - $sterilization) <= 0)
        $class = 'unavailableTime';

    $codeForServices .= '<span class="'.$class.'"> <img src="'.url('assets/admin/images/icons/5.png').'"> تعقيم  </span>';
}





?>
<div id="btn-new-event" data-date="<?php echo $toDay;?>" class="getData <?php echo $toDay . $active;?> p-1 p-xl-2">
    <div class="day-div p-2">
        <div class=" p-2 pb-4 "> <?php echo $i;?> </div>
        <div class="todo-func">
            <?php echo $codeForServices;?>
        </div>
    </div>
</div>
