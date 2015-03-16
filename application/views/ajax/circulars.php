<?php
    $date='';

    echo '<ul class="timeline">';

    if(count($circulars)==0) {
        echo '<li class="time-label">
                        <span class="bg-blue">'.date('d M Y',strtotime($Qdate)).'</span>
                    </li>';
        echo '<li>
                <i class="fa fa-file-text-o"></i>
                <div class="timeline-item">
                    <div class="timeline-body">No circulars were posted on or before '.date('d M Y',strtotime($Qdate)).'.</div>
                </div>
            </li>';
    }

    foreach($circulars as $key => $circular) {
        $sender_designation = ucwords($circular->auth_name).', '.$circular->department;
        $sender_name = $circular->salutation.'. '.$circular->first_name.' '.trim($circular->middle_name.' '.$circular->last_name);
        $circular_date = date_format(new DateTime($circular->posted_on, new DateTimeZone('Asia/Kolkata')), "d M Y");
        $circular_time = date_format(new DateTime($circular->posted_on, new DateTimeZone('Asia/Kolkata')), "h:i a");

        $circular_sub = $circular->circular_sub;
        $attachment = base_url()."assets/files/information/circular/".$circular->circular_path;

        //parsing

        //date
        if($date != $circular_date) {
            echo '<li class="time-label">
                        <span class="bg-blue">'.$circular_date.'</span>
                    </li>';
            $date = $circular_date;
        }

        //circular
        echo '<li>
                <i class="fa fa-info-circle"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> '.$circular_time.'</span>
                    <h3 class="timeline-header"><a>'.$sender_name.'</a><br /><small>'.$sender_designation.'</small></h3>
                    <div class="timeline-body">'.$circular_sub.'</div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs" href="'.$attachment.'">Download Attachments</a>
                    </div>
                </div>
            </li>';
    }
    echo '<li>
            <i class="fa fa-clock-o"></i>
        </li>   ';
    echo '</ul>';
?>