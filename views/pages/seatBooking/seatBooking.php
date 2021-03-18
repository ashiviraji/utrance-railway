<div class="flex-col-stretch-center margin-t-m">
    <div class="flex-col-stretch-center margin-b-huge">
        <div class="heading-tertiary">
            <span><?php echo $all_start; ?></span>&nbsp;to&nbsp;<span><?php echo $all_end; ?></span>
        </div>
        <div class="topic-greyed margin-b-xxs">
            <span>journey date</span>&nbsp;&ndash;&nbsp;<span class="seat-booking__day">
                <span>28</span>
                <span class="seat-booking__day-up">th</span>&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <span>November</span>&nbsp;
            <span>2020</span>
        </div>
        <div class="topic-greyed">
            <span>journey time</span>&nbsp;&ndash;&nbsp;<span><?php echo isset($trains['t2']) ? calcFullJourneyTime($trains['t1']['journey_time'], $trains['t2']['journey_time'], $wait_time) : calcFullJourneyTime($trains['t1']['journey_time']) ?></span>
        </div>
    </div>
    <form action="#" class="seat-booking__form">
        <?php
include_once "../views/components/seatBookingCard.php";

$i = 0;
foreach ($trains as $key => $value) {
    $i++;
    echo renderTrainBookingCard($value, $i);
}

?>
        <div class="seat-booking__total-price">
            <span class="margin-r-xs">final amount&nbsp;&colon;</span>
            <div>
                <span>Rs</span>&nbsp;<span id="finalAmount">500</span>
            </div>
        </div>
        <div class="seat-booking__btn-container">
            <button class="btn btn-round-blue">
                Book now
            </button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../../../utrance-railway/public/js/pages/seatBooking.js"></script>

<?php
function calcFullJourneyTime($train1Time, $train2Time = null, $waitTime = null)
{

    $fullHr = (int) substr($train1Time, 0, 2);
    $fullMin = (int) substr($train1Time, 3, 2);

    if (isset($train2Time)) {
        $fullHr += (int) substr($train2Time, 0, 2);
        $fullMin += (int) substr($train2Time, 3, 2);

        $fullHr += (int) substr($waitTime, 0, 2);
        $fullMin += (int) substr($waitTime, 3, 2);

        $fullHr += (int) ($fullMin / 60);
        $fullMin = $fullMin % 60;
    }

    if ($fullHr < 10) {
        $fullHr = "0" . $fullHr;
    }

    return $fullHr . " h " . $fullMin . " m";
}

?>