<?php $this->load->view('admin/components/page_head'); ?>


<style>
.sidebar .sidebar-menu>li>a {
    display: block !important;
}
</style>


<body class="skin-blue">


    <header class="header">
        <a class="logo">
            Bayswater
        </a>

        <style style="text/css">
        .horizontally {
            height: 50px;
            overflow: hidden;
            position: relative;
            background: #0014A7;
            color: white;
            border: 1px solid orange;
        }

        .horizontally p {
            position: absolute;
            width: 100%;
            height: 100%;
            margin: 0;
            line-height: 50px;
            text-align: center;
            /* Starting position */
            -moz-transform: translateX(50%);
            -webkit-transform: translateX(50%);
            transform: translateX(50%);
            /* Apply animation to this element */
            -moz-animation: horizontally 5s linear infinite alternate;
            -webkit-animation: horizontally 5s linear infinite alternate;
            animation: horizontally 10s linear infinite alternate;
        }

        /* Move it (define the animation) */
        @-moz-keyframes horizontally {
            0% {
                -moz-transform: translateX(50%);
            }

            100% {
                -moz-transform: translateX(-50%);
            }
        }

        @-webkit-keyframes horizontally {
            0% {
                -webkit-transform: translateX(50%);
            }

            100% {
                -webkit-transform: translateX(-50%);
            }
        }

        @keyframes horizontally {
            0% {
                -moz-transform: translateX(50%);
                /* Browser bug fix */
                -webkit-transform: translateX(50%);
                /* Browser bug fix */
                transform: translateX(50%);
            }

            100% {
                -moz-transform: translateX(-50%);
                /* Browser bug fix */
                -webkit-transform: translateX(-50%);
                /* Browser bug fix */
                transform: translateX(-50%);
            }
        }
        </style>

        <div class="horizontally">
            <p>From 12th February, twe added £20 p/w supplement applied to all homestay bookings for under 18. (All
                international students in Canada must have insurance)</p>
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-6J28VYV949"></script>
            <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-6J28VYV949');
            </script>
        </div>


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



                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span> Admin <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header bg-light-blue">
                                <img src="<?php echo $this->config->item('base_url2').'img/'.$this->session->userdata('img'); ?>"
                                    class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $this->session->userdata('name'); ?>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url().'user/edit/'.$this->session->userdata('id'); ?>"
                                        class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?php echo anchor('user/logout', '<span class="btn btn-default btn-flat"> Sign out</span>'); ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">

        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $this->config->item('base_url2').'img/'.$this->session->userdata('img'); ?>"
                            class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Hello, <?php echo $this->session->userdata('name'); ?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu" style="display: block !important">
                    <li>
                        <?php echo anchor('fees', '<i class="fa fa-calculator"></i> <span>Fees calculator</span>'); ?>
                    </li>
                    <!-- <li>
                            <?php echo anchor('notifications', '<i class="fa fa-bell"></i> <span>My notifications</span>'); ?>
                        </li> -->
                    <?php  if($user_group->admins == 1) {?>
                    <li>
                        <?php echo anchor('user', '<i class="fa fa-user"></i> <span>Admins</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->users_groups == 1) {?>
                    <li>
                        <?php echo anchor('user/groups', '<i class="fa fa-users"></i> <span>User\'s group</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->clients == 1) {?>
                    <li class="treeview <?php echo (in_array($this->uri->segment(1), array('clients'))) ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="fa fa-graduation-cap"></i>
                            <span>Clients</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo anchor('clients','<i class="fa fa-angle-double-right"></i> Clients</a></li>'); ?>
                            <li><?php echo anchor('clients/print_clients','<i class="fa fa-angle-double-right"></i>Print clients</a></li>'); ?>
                            <li><?php echo anchor('clients/send_emails','<i class="fa fa-angle-double-right"></i>Send emails</a></li>'); ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->clients == 1) {?>
                    <li style="position: relative;">
                        <?php echo anchor('notes/all', '<i class="fa fa-bell"></i> <span>Notes</span>'); ?>
                        <div id="notesnum">
                            <?php if ($mynotesnum) { ?> <span class="displaynotifnum"> <?php echo $mynotesnum; ?>
                            </span> <?php } ?>
                        </div>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->countries == 1) {?>
                    <li>
                        <?php echo anchor('regions', '<i class="fa fa-globe"></i> <span>Regions</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->countries == 1) {?>
                    <li>
                        <?php echo anchor('countries', '<i class="fa fa-globe"></i> <span>Countries</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->cities == 1) {?>
                    <li>
                        <?php echo anchor('cities', '<i class="fa fa-map-marker"></i> <span>Cities</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->schools == 1) {?>
                    <li>
                        <?php echo anchor('schools', '<i class="fa fa-university"></i> <span>Schools</span>'); ?>
                    </li>
                    <?php } ?>

                    <?php  if($user_group->courses == 1) {?>
                    <li class="treeview <?php echo (in_array($this->uri->segment(1), array(
                        'courses', 
                        'Courses_Addons', 
                        'Courses_Family', 
                        'Courses_Exam', 
                        'Courses_Professional', 
                        'Courses_Premium',
                        'Courses_Exam_Prices',
                        'Courses_Premium_Prices'
                        ))) ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="fa fa-leanpub"></i>
                            <span>Courses Fees</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo anchor('courses','<i class="fa fa-angle-double-right"></i>Courses</a></li>'); ?>
                            <li><?php echo anchor('Courses_Addons','<i class="fa fa-angle-double-right"></i>Add-ons</a></li>'); ?>
                            <li><?php echo anchor('Courses_Family','<i class="fa fa-angle-double-right"></i>Family Options</a></li>'); ?>
                            <li><?php echo anchor('Courses_Exam','<i class="fa fa-angle-double-right"></i>Exam Preparation</a></li>'); ?>
                            <li><?php echo anchor('Courses_Professional','<i class="fa fa-angle-double-right"></i>Professional</a></li>'); ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php  if($user_group->accommodation == 1) {?>
                    <li>
                        <?php echo anchor('accommodation', '<i class="fa fa-building"></i> <span>Accommodation</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->airports == 1) {?>
                    <li>
                        <?php echo anchor('airports', '<i class="fa fa-plane"></i> <span>Airports</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->currency == 1) {?>
                    <li>
                        <?php echo anchor('currency', '<i class="fa fa-money"></i> <span>Currency</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->branches == 1) {?>
                    <li>
                        <?php echo anchor('branches', '<i class="fa fa-sitemap"></i> <span>Branches</span>'); ?>
                    </li>
                    <?php } ?>
                    <?php  if($user_group->settings == 1) {?>
                    <li>
                        <?php echo anchor('settings', '<i class="fa fa-gear"></i> <span>Settings</span>'); ?>
                    </li>
                    <?php } ?>



                </ul>
            </section>
        </aside>

        <aside class="right-side">

            <?php  $this->load->view($subview); ?>

        </aside>


        <?php $this->load->view('admin/components/page_tail'); ?>