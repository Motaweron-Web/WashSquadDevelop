<?php
use App\Models\Order;

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
$subscription = Order::where('date',$toDay)->where('service_id',77)->count();


?>
<div id="btn-new-event"   data-date="<?php echo $toDay;?>"
     class="getDataaa  p-1 p-xl-2 <?php echo $toDay . $active;?>">
    <div class="day-div p-2">
        <div class=" p-2 pb-4 "><?php echo $i;?></div>
        <div class="todo-func ">
            <span class="month"> <?php echo $subscription;?> </span>
            <p class="mb-0"> إشتراك </p>
            <img src="<?php echo url('assets/admin/images/car.png')?>" alt="">
        </div>
    </div>
</div>
