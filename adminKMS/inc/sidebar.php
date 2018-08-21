          <?php 
            // echo basename($_SERVER['PHP_SELF']); //menampilkan file yg sedang dijalankan
          echo $current_page;
           ?>

          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="uploads/<?php echo $avatar; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $data['full_name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form -->
          
          
          <!-- /.search form -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <!-- Navigation -->
          <div >
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview <?php if ($current_page == "profile") {echo"active"; }?>">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Profile Dashboard</span>
              </a>
            </li>
            <li class="treeview <?php if($current_page=='document'){echo 'active'; }?>"  >
              <a href="./document.php">
              <!-- <a <?php if ($current_page == "document") { ?>class="active"<?php } ?> href="./document.php"> -->
                <i class="fa fa-files-o"></i>
                <span>Document</span>
                <span class="label label-primary pull-right">4</span>
              </a>
            </li>
            <li class="treeview <?php if ($current_page == "members") {echo"active"; }?>">
              <a href="./member_index.php">
              <!-- <a <?php if ($current_page == "members") { ?>class="active"<?php } ?> href="./member_index.php"> -->
                <i class="fa fa-th"></i> <span>Members</span> 
                <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview <?php if ($current_page == "project") {echo"active"; }?>">
              <a href="./project.php">
             <!--  <a <?php if ($current_page == "project") { ?>class="active"<?php } ?> href="./project.php"> -->
                <i class="fa fa-pie-chart"></i>
                <span>Projects</span>
              </a>
            </li>
            <li class="treeview <?php if ($current_page == "brainstorming") {echo"active"; }?>">
              <a href="./brainstorming.php">
              <!-- <a <?php if ($current_page == "brainstorming") { ?>class="active"<?php } ?>href="./brainstorming.php"> -->
                <i class="fa fa-laptop"></i>
                <span>Brainstorming</span>
              </a>
            </li>
            <li class="treeview <?php if ($current_page == "form_document" OR $current_page == "form_brainstorming" OR  $current_page == "form_project") {echo"active"; }?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($current_page == "form_document") {echo"active"; }?>"><a href="./forms_document_index.php"><i class="fa fa-circle-o"></i> Document</a></li>
                <li class="<?php if ($current_page == "form_brainstorming") {echo"active"; }?>"><a href="./forms_brainstorming_index.php"> <i class="fa fa-circle-o"></i> Brainstorming</a></li>
                <li class="<?php if ($current_page == "form_project") {echo"active"; }?>"><a href="./forms_project_index.php"><i class="fa fa-circle-o"></i> Project</a></li>
              </ul>
            </li>
            <li class="treeview <?php if ($current_page == "news_events") echo"active"; ?>">
              <a href="./news_events_index.php">
                <i class="fa fa-calendar"></i> <span>News and Events</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
          </ul>