<?php
    $date='';

    echo '<ul class="timeline">';

    if(count($notices)==0) {
        echo '<li class="time-label">
                        <span class="bg-blue">'.date('d M Y',strtotime($Qdate)).'</span>
                    </li>';
        echo '<li>
                <i class="fa fa-info-circle"></i>
                <div class="timeline-item">
                    <div class="timeline-body">No notices were posted on or before '.date('d M Y',strtotime($Qdate)).'.</div>
                </div>
            </li>';
    }

    foreach($notices as $key => $notice) {
        $sender_designation = ucwords($notice->auth_name).', '.$notice->department;
        $sender_name = $notice->salutation.'. '.$notice->first_name.' '.trim($notice->middle_name.' '.$notice->last_name);
        $notice_date = date_format(new DateTime($notice->posted_on, new DateTimeZone('Asia/Kolkata')), "d M Y");
        $notice_time = date_format(new DateTime($notice->posted_on, new DateTimeZone('Asia/Kolkata')), "h:i a");

        $notice_sub = $notice->notice_sub;
        $attachment = base_url()."assets/files/information/notice/".$notice->notice_path;

        //parsing

        //date
        if($date != $notice_date) {
            echo '<li class="time-label">
                        <span class="bg-blue">'.$notice_date.'</span>
                    </li>';
            $date = $notice_date;
        }

        //notice
        echo '<li>
                <i class="fa fa-info-circle"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> '.$notice_time.'</span>
                    <h3 class="timeline-header"><a>'.$sender_name.'</a><br /><small>'.$sender_designation.'</small></h3>
                    <div class="timeline-body">'.$notice_sub.'</div>
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