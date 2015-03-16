<? $ui = new UI();

	$row = $ui->row()->open();
		$eventsCol = $ui->col()->width(8)->open();
			$unreadBadge = ($unreadNotice > 0)? '<small class="badge bg-red">'.$unreadNotice.'</small>': '';
			$eventsTabBox = $ui->tabBox()
						   	   ->tab("notices", $ui->icon("info-circle") ." Notices " . $unreadBadge, true)
						   	   ->tab("circulars", $ui->icon("file-text-o") . " Circulars")
						   	   ->tab("minutes", $ui->icon("users") . " Meetings ")
						       ->open();

				$noticesTab = $ui->tabPane()
								 ->id("notices")
								 ->active()
								 ->open();
					?>
                <div id="notices">
                </div>


<!-- <div>
<?php foreach($notices as $key => $notice) { ?>

<div class="notice">
    <div class="sender-info">
        <div class="dp">
            <img src="<?= base_url()."assets/images/".$notice->photopath; ?>" />
        </div>
        <div class="sender">
            <p class="sender-designation"><?= ucwords($notice->auth_name) ?>, <?= $notice->department ?></p>
            <p class="sender-name"><?= $notice->salutation ?> <?= $notice->first_name ?> <?= $notice->middle_name ?> <?= $notice->last_name ?></p>
            <p class="notice-date"><?= date_format(new DateTime($notice->posted_on), "d M Y h:m:s") ?></p>
        </div>
    </div>

    <div class="notice-content">
        <div class="content">
            <?= $notice->notice_sub ?>
        </div>

        <div class="attachments">
            <a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download attachment</a>
        </div>
    </div>

</div>


<?php } ?>
</div> -->
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-user bg-aqua"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                    </div>
                                </li> -->
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <!-- <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li> -->
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class='margin' />
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                        </div>
                                    </div>
                                </li>
                                 --><!-- END timeline item -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body">
                                            <iframe width="300" height="169" src="//www.youtube.com/embed/fLe_qO4AE-M" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- END timeline item -->
                                <!-- <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul> -->
					<?
				$noticesTab->close();

				$circularsTab = $ui->tabPane()
								 ->id("circulars")
								 ->open();
?>
                <div id="circulars">
                </div>
                          <!--  <ul class="timeline">
                                <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li> -->
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class='margin' />
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <!-- <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body">
                                            <iframe width="300" height="169" src="//www.youtube.com/embed/fLe_qO4AE-M" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- END timeline item -->
                                <!-- <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul> -->
<?
				$circularsTab->close();

				$minutesTab = $ui->tabPane()
								 ->id("minutes")
								 ->open();
?>
<?
				$minutesTab->close();
			$eventsTabBox->close();
?>





<?
		$eventsCol->close();

		$calendarCol = $ui->col()->width(4)->open();
			$calendar = $ui->box()
						   ->solid()
						   ->containerClasses("bg-blue-gradient")
						   ->title("Calendar")
						   ->icon($ui->icon("calendar"))
						   ->open();
				?><div id="calendar"></div><?
			$calendar->close();
		$calendarCol->close();

	$row->close();
?>
<script type="text/javascript">

    $(document).ready(function() {
        $("#calendar").datepicker("setDate", moment("<?= date('d-m-Y',time()+19800);?>", "DD-MM-YYYY").toDate());
        $("#calendar").datepicker().on('changeDate',function(e) {
            getNotices(e.format('yyyy-mm-dd'));
            getCirculars(e.format('yyyy-mm-dd'));
        });

        getNotices('<?= date("Y-m-d",time()+19800);?>');
        getCirculars('<?= date("Y-m-d",time()+19800);?>');
	});

    function getNotices(date) {
        $.ajax({
            url: site_url("home/getNotices" + "/" + date),
            success: function(result) {
                $("#notices").html(result);
            }
        });
    }

    function getCirculars(date) {
        $.ajax({
            url: site_url("home/getCirculars" + "/" + date),
            success: function(result) {
                $("#circulars").html(result);
            }
        });
    }
</script>