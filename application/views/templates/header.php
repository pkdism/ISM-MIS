<?php $ui = new UI(); ?>
    <body class="skin-blue">
        <header class="header">
            <a href="<?= site_url("") ?>" class="logo">
                <img src="<?= base_url() ?>assets/images/mis-logo-small.png" />
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $this->session->userdata('name') ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?= base_url()."assets/images/".$this->session->userdata('photopath'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $this->session->userdata('name') ?>
                                        <small>
<?php
		if($this->authorization->is_auth('emp'))
			echo $this->session->userdata('designation').', '.$this->session->userdata('dept_name');
		if($this->authorization->is_auth('stu'))
			echo $this->session->userdata('dept_name');
?>
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= site_url('home') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= base_url()."assets/images/".$this->session->userdata('photopath'); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('name'); ?></p>

                            <a href="#"><i class="glyphicon glyphicon-user"></i> <?= $this->session->userdata('id'); ?></a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    
<?php

			function _drawNavbarMenuItem($mi, $order = null) {
                if($order != null) {
                    foreach($order as $index => $key) {
                        $val = $mi[$key];
                        $arrow = (is_array($val))? ' <i class="fa fa-angle-right pull-right"></i>': "";
                        $treeview = (is_array($val)) ? "treeview" : "";
                        $active = (current_url() === $val)? "active": "";
                        echo '<li class="' . $treeview . ' ' . $active .'"><a href="' . ((is_string($val)) ? $val : "#") . '">' . $arrow . $key . '</a>';

                        if(is_array($val)) {
                            echo '<ul class="treeview-menu">';
                            _drawNavbarMenuItem($val);
                            echo '</ul>';
                        }

                        echo '</li>';
                    }
                }
                else {
                    foreach ($mi as $key => $val) {
                        $arrow = (is_array($val)) ? ' <i class="fa fa-angle-right pull-right"></i>' : "";
                        $treeview = (is_array($val)) ? "treeview" : "";
                        $active = (current_url() === $val)? "active": "";
                        echo '<li class="' . $treeview . ' ' . $active .'"><a href="' . ((is_string($val)) ? $val : "#") . '">' . $arrow . $key . '</a>';
                        if (is_array($val)) {
                            echo '<ul class="treeview-menu">';
                            _drawNavbarMenuItem($val);
                            echo '</ul>';
                        }

                        echo '</li>';
                    }
                }
			}

			$dateTimeZone = new DateTimeZone('Asia/Kolkata');

			foreach($menu as $key => $val) {
				$unreadCount = 0;
				$readCount = 0;
				
				if(count($val) == 0) continue;

				if(isset($notifications[$key]["unread"])) $unreadCount = count($notifications[$key]["unread"]);
				if(isset($notifications[$key]["read"])) $readCount = count($notifications[$key]["read"]);
				?>
                
                        <li class="treeview -mis-menu-authtype">
                            <a href="#">
								<i class="fa fa-angle-right"></i>
                                <span><?= ucfirst($authKeys[$key]) ?></span>
                                <small class="badge pull-right role <?php if($unreadCount > 0) echo "bg-red"; ?>"><?= $unreadCount ?></small>
				<?
					echo '<div class="notification-drawer closed">';
	
					echo '<div class="unread">';
					if($unreadCount > 0) {
						echo '<h3>Unread Notifications &raquo;</h3>';
						foreach($notifications[$key]["unread"] as $row) {					
							$dateTime = new DateTime();
							$dateTime->setTimestamp(strtotime($row->send_date));
							$dateTime->setTimeZone($dateTimeZone);
							$ui->callout()
							   ->title(ucwords($row->title))
							   ->desc($row->description . ' <span class="label label-info pull-right" onclick="window.location=\''.site_url($row->path).'\'">Know More &raquo;</span>')
							   ->uiType("info")
		//					   ->date($dateTime->format('m/d/Y H:i A'))
		//					   ->photo(base_url().'assets/images/'.$row->photopath))
							   ->show();
						}
					}
					echo '</div>';
	
	
					$readCol = $ui->col()->width(12)->classes("read")->open();
					if($readCount > 0) {
						echo '<hr />';
						foreach($notifications[$key]["read"] as $row) {
							$dateTime = new DateTime();
							$dateTime->setTimestamp(strtotime($row->send_date));
							$dateTime->setTimeZone($dateTimeZone);
							echo "<div class='margin'>";
							echo '<b>'.ucwords($row->title).'</b>';
							echo '<p>'.$row->description . ' <span class="label label-info pull-right" onclick="window.location=\''.site_url($row->path).'\'">Know More &raquo; </span> </p>';
							echo '<hr />';
							echo "</div>";

						}
					}
					$readCol->close();
	
					if($readCount == 0 && $unreadCount == 0) echo "<center><br />No more notifications.</center>";
	
					echo '</div>';
				?>                    
                            </a>

                            <ul class="treeview-menu">
                                <?
                                    $menuKeys = array_keys($val);
                                    sort($menuKeys);
                                ?>
                            	<?= _drawNavbarMenuItem($val, $menuKeys); ?>
                            </ul>
                        </li>

		<? } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $title ?>
                        <small><?= $subtitle ?></small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="flash-data">
                        <?php
                            $ui = new UI();
                            if($this->session->flashdata('flashSuccess'))
                                $ui->alert()->uiType("success")->desc($this->session->flashdata('flashSuccess'))->show();
                            if($this->session->flashdata('flashError'))
                                $ui->alert()->uiType("error")->desc($this->session->flashdata('flashError'))->show();
                            if($this->session->flashdata('flashInfo'))
                                $ui->alert()->uiType("info")->desc($this->session->flashdata('flashInfo'))->show();
                            if($this->session->flashdata('flashWarning'))
                                $ui->alert()->uiType("warning")->desc($this->session->flashdata('flashWarning'))->show();
                        ?>
                    </div>