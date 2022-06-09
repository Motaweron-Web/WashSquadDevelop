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

$main = Order::where('date',$toDay);
$polishing = Order::where('date',$toDay)->where('service_id',2);
$wash = Order::where('date',$toDay)->where('service_id',1);
$sterilization = Order::where('date',$toDay)->where('service_id',78);
$subscription = Order::where('date',$toDay)->where('service_id',77);
$gift = Order::where('date',$toDay)->where('service_id',79);

$codeForServices = '';
if ($polishing->count()){
    $codeForServices = $codeForServices."<span class='polish'> ".$polishing->count()."  p</span>";
}


if ($wash->count()){
    $codeForServices = $codeForServices."<span class='wash'> ".$wash->count()."  w</span>";
}

if ($sterilization->count()){
    $codeForServices = $codeForServices."<span class='sterili'> ".$sterilization->count()."  s</span>";
}


if ($subscription->count()){
    $codeForServices = $codeForServices."<span class='month'> ".$subscription->count()."  m</span>";
}

if ($gift->count()){
    $codeForServices = $codeForServices."<span class='gift'> ".$gift->count()."  g</span>";
}

?>
<div id="btn-new-event"  data-date="<?php echo $toDay;?>"
     class=" p-1 p-xl-2 getData <?php echo $toDay . $active;?>">
    <div class="day-div p-2">
        <div class=" p-2 pb-4 "><?php echo $i;?></div>
        <div class="todo-func">
            <?php echo $codeForServices;?>
        </div>
    </div>
</div>
