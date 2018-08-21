<!-- This PHP used to restricted unauthorized user to get access to back-end site -->
<?php 
  session_start(); //function to check the session 
  if(empty($_SESSION['login'])){ //check if user is authorized or not
      header("Location:../new_index.php"); //redirect to homepage
  }
  include("koneksi.php");
?>

<?php 

//Getting data from My SQL database 
  $sql = 'SELECT brainstorming.*, employees.pict_employees, employees.full_name FROM brainstorming
    join employees on(brainstorming.idemployees=employees.idemployees)

    ORDER BY idbrainstorming DESC';
   // mysql_select_db('test_db');
   $retval_brainstorming = mysql_query( $sql);
?>

<?php 


  $sql = "SELECT * FROM project ORDER BY id_project DESC limit 0,4"; //only show user project progress
   // mysql_select_db('test_db');
   $retval_project = mysql_query($sql);
?>

<?php 


  $sql = 'SELECT * FROM news_event ORDER BY date_posting ASC';
   // mysql_select_db('test_db');
   $retval_news_event = mysql_query( $sql);
?>

<?php 


  $sql = 'SELECT * FROM document ORDER BY date_posting ASC'; //only show user's bookmark
  $retval_document = mysql_query( $sql);
?>

<?php 

// line 1 : select from 2 diff tables
// line 2 : script (join) 2 diff table where has same field (key)
// line 3 : show user's bookmark
  $sql = "SELECT bookmark.idemployees, document.* FROM bookmark 
    join document on(bookmark.iddocument = document.iddocument)
    where bookmark.idemployees = '".$_SESSION['login']."'
   ORDER BY idbookmark DESC"; //only show user's bookmark
  $retval_bookmark = mysql_query($sql);
?>

<?php 
  $sql = "SELECT employees.* , skill.idskill , skill.type_skill FROM employees
  join skill on(employees.idskill = skill.idskill) 
  WHERE idemployees = '".$_SESSION['login']."' ";
  $retval_employees = mysql_query($sql);

?>

<?php include "inc/header.php"; ?>
<!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
<?php $current_page = "profile"; include "inc/sidebar.php" ?>
      </section>
        <!-- /.sidebar -->
    </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

    <!-- Project progress that user join it -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

          <?php
          // var_dump($retval_project);
            if(mysql_num_rows($retval_project)==0){
              echo "Not available"; //check if database isnt available
            }
            else {

                while($data=mysql_fetch_array($retval_project)){
                  $icon='fa-hourglass-end';
                  $color="bg-green";

                  if($data['project_progress']<=5){
                    $icon='fa-hourglass-start';
                    $color="bg-red";
                  }
                  elseif($data['project_progress']<95 && $data['project_progress']>5){
                    $icon='fa-hourglass-half';
                    $color="bg-yellow";
                  }

                  $statusproject="Open";
                  if($data['statusproject']==2){
                    $statusproject="In Progress";
                  }
                  elseif($data['statusproject']==3){
                    $statusproject="Pending";
                  }

              echo "<div class='col-lg-3 col-xs-6'>
                      <div class='small-box ".$color."'>
                        <div class='inner'>
                          <h3>".$data['project_progress']."<sup style='font-size: 20px'>%</sup></h3>
                          <p>".$data['title_project']."</p>
                        </div>
                      <div class='icon'>
                        <i class='fa ".$icon."'></i>
                      </div>
                      <a href='#' class='small-box-footer'>".$statusproject." <i class='fa fa-arrow-circle-right'></i></a>
                      </div>
                    </div>";
              }

            }
          ?>
    </div><!-- /.row -->
    
    <!-- Main row -->
    <div class="row"><!-- Left col -->
    <section class="col-lg-7 connectedSortable">

              <!-- Profile dashboard widget (User) -->
              <?php 
                  $data=mysql_fetch_array($retval_employees);

                  $avatar="default.png";

                  if ($data['pict_employees']!=null) {
                    $avatar = $data['pict_employees'];
                  }
                  
                 ?>
              <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src='uploads/<?php echo $avatar; ?>' alt="user image" class="img-rounded img-responsive" />
                                </div>
                                  <?php 
                                  if (mysql_num_rows($retval_employees)==0){
                                      echo "<tr><td colspan='9'>Not available</td></tr>"; 
                                      //check if database isnt available
                                  } else { 
                                  // var_dump($retval_employees);
                                  // $data=mysql_fetch_array($retval_employees);
                                  echo"
                                    <div class='col-sm-6 col-md-8'>
                                        <h4>".$data['full_name']."</h4>
                                        <small><cite title='city, country'>".$data['location']."<i class='glyphicon glyphicon-map-marker'></i></cite></small> </br>
                                        <p>
                                            <i class='glyphicon glyphicon-gift'></i> ".$data['date_birth']."</br>
                                            <i class='glyphicon glyphicon-envelope'></i> ".$data['email']."</br>
                                            <i class='glyphicon glyphicon-globe'></i><a href=''></a> ".$data['blog']." </br>
                                            <i class='glyphicon glyphicon-education'></i> ".$data['type_skill']."<br>
                                            <i class='fa fa-users'></i> ".$data['job_title']."</br>
                                            <i class='fa fa-file-text'></i> Bio :<cite> ".$data['employees_background']."</cite>
                                          </p>
                                        
                                        <div class='btn-group'>
                                            <button type='button' class='btn btn-primary'>
                                                Social</button>
                                            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span><span class='sr-only'>Social</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='http://www.twitter.com/".$data['twitter']."'>Twitter</a></li>
                                                <li><a href='http://www.plus.google.com/".$data['google_plus']."''>Google +</a></li>
                                                <li><a href='http://www.facebook.com/".$data['facebook']."''>Facebook</a></li>
                                                <li><a href='http://www.instagram.com/".$data['instagram']."''>Instagram</a></li>
                                                <li><a href='".$data['blog']."''>Blog</a></li>
                                                <li class='divider'></li>
                                                <li><a href='http://www.linkendin.com/".$data['linkendin']."''>Linkendin</a></li>
                                            </ul>
                                        </div>
                                    </div>";
                                  }
                                  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
              <!-- Brainstorming (forum) box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Brainstorming</h3>
                  <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                    <div class="btn-group" data-toggle="btn-toggle" >
                      <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                    </div>
                  </div>
                </div>
                <div class="box-body chat" id="chat-box">

                    <?php 

                      if(mysql_num_rows($retval_brainstorming)==0){
                          echo "Not available"; //check if database isnt available
                      }
                      else{
                            while($data=mysql_fetch_array($retval_brainstorming)){ // pengualangan untuk menampilkan html
                              if ($data['statusbrainstorming']==1) {
                                $data['statusbrainstorming']="Solved";
                              } elseif($data['statusbrainstorming']==2) {
                                $data['statusbrainstorming']='Unsolved';
                              }
                              elseif($data['statusbrainstorming']==3){
                                $data['statusbrainstorming']="Pending";
                              }

                              if ($data ['pict_employees']!=null) {
                                $avatar = $data ['pict_employees'];
                              }
                              
                                echo "<div class='item'>
                                      <img src='images/".$avatar."' alt='user image' class='online'>
                              
                                      <div class='message'>
                                        <span><a href='brainstorming.php' class='name'>
                                          ".$data['title_bs']."</a></span> <span>by <strong> ".$data['full_name']."</strong></span>
                                          <small class='label label-default'><i class='fa fa-check-circle-o'></i> ".$data['statusbrainstorming']." </small>
                                          <small class='text-muted pull-right'><i class='fa fa-clock-o'></i> ".$data['date_posting']." </small> <span>
                                        
                                       <p>".substr($data['description_bs'], 0,100)."..</p>
                                      </div>
                                      
                                    </div>
                                    ";
                            //format html untuk pengulangan
                            // substr : retrieve value in description_bs in particular length
                            }
                          }

                    ?>
                  
                  <!-- list item -->
                  <div class="item">
                    <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">
                    <p class="message">
                      <a href="#" class="name">
                        Title <span> by <span><strong> user name</strong></span>
                        <small class="label label-default"><i class="fa fa-question-circle"></i> Unsolved </small>
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> Yesterday </small> <span>
                      </a>
                      I would like to meet you to discuss the latest news about
                      the arrival of the new theme. They say it is going to be one the
                      best themes on the market
                    </p>
                  </div><!-- /.item -->

                  <!-- list item -->
                  <div class="item">
                    <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">
                    <p class="message">
                      <a href="#" class="name">
                        Title <span> by <span><strong> user name</strong></span>
                        <small class="label label-default"><i class="fa fa-exclamation-circle"></i> Pending </small>
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 1 month </small> <span>
                      </a>
                      I would like to meet you to discuss the latest news about
                      the arrival of the new theme. They say it is going to be one the
                      best themes on the market
                    </p>
                  </div><!-- /.item -->
                </div><!-- /.chat -->
              </div><!-- /.box (chat box) -->

              <!-- BOOKMARK -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-android-folder"></i>
                  <h3 class="box-title">Bookmarks</h3>
                  <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                      <li><a href="#">&laquo;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                  <?php

                      if(mysql_num_rows($retval_bookmark)==0){
                          echo "Not available"; //check if database isnt available
                      }
                      else{
                          while($data=mysql_fetch_array($retval_bookmark)){ // pengualangan untuk menampilkan html
                          
                          $file='fa-file-archive-o';
                          if($data['file_type']=='picture'){
                            $file='fa-file-picture-o';
                          }
                          elseif($data['file_type']=='word'){
                            $file='fa-file-word-o';
                          }
                          elseif($data['file_type']=='pdf') {
                            $file='fa-file-pdf-o';
                          }
                          elseif ($data['file_type']=='powerpoint') {
                            $file='fa-file-powerpoint-o';
                          }
                          elseif ($data['file_type']=='excel') {
                            $file='fa-file-excel-o';
                          }

                          echo "  <li>
                                  <span class='handle'>
                                    <i class='fa ".$file."'></i>
                                  </span>
                                  <span class='text'>".$data['title_document']."</span>
                                  <small class='label label-danger'><i class='fa fa-clock-o'></i> ".$data['date_posting']."</small>
                                  <div class='tools'>
                                    <a href='uploads/".$data['filename_document']."'><i class='fa fa-download'></i></a>
                                  </div>
                                </li> ";
                      }
                    }
                  ?>
                    <li>
                      <span class="handle">
                        <i class="fa fa-file-archive-o"></i>
                      </span>
                      <span class="text">Make the theme responsive</span>
                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                      <div class="tools">
                        <i class="fa fa-download"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-file-word-o"></i>
                      </span>
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                      <div class="tools">
                        <i class="fa fa-download"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-file-powerpoint-o"></i>
                      </span>
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                      <div class="tools">
                        <i class="fa fa-download"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-file-pdf-o"></i>
                      </span>
                      <span class="text">Check your messages and notifications</span>
                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                      <div class="tools">
                        <i class="fa fa-download"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-file-excel-o"></i>
                      </span>
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                      <div class="tools">
                        <!-- <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i> -->
                        <i class="fa fa-download"></i>
                        <!-- <i class="fa fa-folder-open"></i> -->
                      </div>
                    </li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- form project widget -->
              <div class="box box-info" >
                
                <div class="box-header">
                  <i class="fa fa-pie-chart"></i>
                  <h3 class="box-title">Form Project</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->
                </div>

                <div class="box-body" style='display:none'>
                  <form action="insertproject.php" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control" name="title_project" placeholder="Title of the project...">
                    </div>
                    <div>
                      <textarea class="textarea" name="description_project" placeholder="Add project details..." style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div>
                      <label for="job">Choose the project's topic...</label>
                      <select id="job" name="id_skill">  
                         <option value="1">Finance and Accounting</option>
                         <option value="2">Information Technology</option>
                         <option value="3">Information System</option>
                         <option value="4">Administration</option>
                         <option value="5">Business Development</option>
                         <option value="6">General affairs</option>
                         <option value="7">CSR</option>
                         <option value="8">Marketing</option>
                         <option value="9">Learning</option>
                      </select>
                    </div>
                    <div>
                      <label for="job">Status</label>
                      <select id="job" name="statusproject">  
                        <option value="1">Open</option>
                         <option value="2">In Progress</option>
                         <option value="3">Success</option>
                      </select>
                    </div>
                    <div class="project">
                      Project start at:
                      <input type="date" name="start_date">
                      </br>
                      </br>   
                      Due date of project:
                      <input type="date" name="due_date">
                    </div>
                    <div>
                      <label for="swot">SWOT's Analysis </br>
                      <textarea class="textarea" name="swot_strengthanalysis" placeholder="Strength" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      <textarea class="textarea" name="swot_weaknessanalysis" placeholder="Weakness" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      <textarea class="textarea" name="swot_opportunityanalysis" placeholder="Opportunity" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      <textarea class="textarea" name="swot_threatanalysis" placeholder="Threat" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </label>
                    </div>
                    <div>
                      Select files: <input type="file" name="file_project" multiple class='form-control'>
                    </div>
                </div>
                <div class="box-footer clearfix" style='display:none'>
                  <button class="pull-right btn btn-default" id="sendEmail" type="submit" name="save">Save <i class="fa fa-arrow-circle-right"></i></button>
                </div>
                </form>
              </div>

              <!-- form brainstorming widget -->
              <div class="box box-info">

                <div class="box-header">
                  <i class="fa fa-pie-chart"></i>
                  <h3 class="box-title">Form Brainstorming</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->
                </div>

                <div class="box-body" style='display:none'>
                  <form action="insertbrainstorming.php" method="post">

                    <div class="form-group">
                      <input type="text" class="form-control" name="title_bs" placeholder="Title of your question...">
                    </div>
                    <div>
                      <textarea class="textarea" name="description_bs" placeholder="Add question details..." style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div>
                      <label for="job">Choose the discussion's topic...</label>
                      <select id="job" name="id_skill">  
                         <option value="1">Finance and Accounting</option>
                         <option value="2">Information Technology</option>
                         <option value="3">Information System</option>
                         <option value="4">Administration</option>
                         <option value="5">Business Development</option>
                         <option value="6">General affairs</option>
                         <option value="7">CSR</option>
                         <option value="8">Marketing</option>
                         <option value="9">Learning</option>
                      </select>
                    </div>
                    <div>
                      <label for="job">Status</label>
                      <select id="job" name="status">  
                        <option value="1">Solved</option>
                         <option value="2">Unsolved</option>
                         <option value="3">Pending</option>
                      </select>
                    </div>
                </div>
                <div class="box-footer clearfix" style='display:none'>
                  <button type="submit" class="pull-right btn btn-default" id="sendEmail" name="save">Save <i class="fa fa-arrow-circle-right"></i></button>
                  <!-- button save named as 'save' as code when we try to use method of POST in php file -->
                </div>
               </form>
              </div>
              

              <!-- form sharing document widget -->
              <div class="box box-info">

                <div class="box-header">
                  <i class="fa fa-pie-chart"></i>
                  <h3 class="box-title">Knowledge Sharing</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->
                </div>

                <div class="box-body" style='display:none'>
                  <!-- insert into db requires action="" & method="post" name="save" (preferable) -->
                  <form action="insertdocument.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" class="form-control" name="title_document" placeholder="Title of your knowledge...">
                    </div>
                    <div>
                      <textarea class="textarea" name="description_document" placeholder="A bit description..." style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div>
                      <label for="job">Choose the topic...</label>
                      <select id="job" name="id_skill">  
                         <option value="1">Finance and Accounting</option>
                         <option value="2">Information Technology</option>
                         <option value="3">Information System</option>
                         <option value="4">Administration</option>
                         <option value="5">Business Development</option>
                         <option value="6">General affairs</option>
                         <option value="7">CSR</option>
                         <option value="8">Marketing</option>
                         <option value="9">Learning</option>
                      </select>
                    </div>
                    <div>
                      Select files: <input type="file" name="filename_document" multiple class='form-control'>
                    </div>
                    <div class="box-footer clearfix">
                      <button type="submit" name="save" class="pull-right btn btn-default" id="sendEmail">Save <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                  </form>
                </div>

              </div>

    </section><!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Calender & News and Events -->
              <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">News and Events</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add news</a></li>
                        <li><a href="#">Clear news</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                      </ul>
                    </div>
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div><!-- /.box-body -->
                <div class="box-footer text-black">
                  <div class="row">
                    <div class="col-sm-12">
                      
                      <!-- Listing latest news and events -->
                      <div class="box-body">
                        <ul class="todo-list">
                      
                          <?php 
                            if (mysql_num_rows($retval_news_event)==0){
                              echo "Not available"; //check if database isnt available
                            } else {
                              echo "<li>
                                    <span class='handle'>
                                      <i class='fa fa-ellipsis-v'></i>
                                      <i class='fa fa-ellipsis-v'></i>
                                    </span>
                                    <span class='text'>".$data['title_news_event']."</span>
                                    <small class='label label-danger'><i class='fa fa-clock-o'></i>".$data['date_posting']."</small>
                                    <div class='tools'>
                                      <i class='fa fa-share'></i>
                                    </div>
                                    </li>";
                            }
                          ?>

                          <li>
                            <!-- drag handle -->
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Design a nice theme</span>
                            <!-- Emphasis label -->
                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>

                          <li>
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Make the theme responsive</span>
                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>

                          <li>
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>

                          <li>
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>

                          <li>
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Check your messages and notifications</span>
                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>

                          <li>
                            <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                            <div class="tools">
                              <i class="fa fa-share"></i>
                            </div>
                          </li>
                        </ul>
                      </div>
                  </div><!-- /.row -->
                </div>
              </div><!-- /.box -->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="http://almsaeedstudio.com">Nurul Eka Fitriany</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Brainstorming Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete forum history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Plugin photo holder member -->
    <script src="holder.js"></script>
  </body>
</html>
