<?php 
session_start();
include('koneksi.php');
//Getting data from My SQL database 
  $sql = 'SELECT brainstorming.*, employees.pict_employees, employees.full_name  FROM brainstorming
          join employees on (brainstorming.idemployees = employees.idemployees)
          ORDER BY idbrainstorming DESC';
   // mysql_select_db('test_db');
  $retval_brainstorming = mysql_query($sql);
?>


<?php include "inc/header.php" ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
<?php $current_page = "brainstorming"; include "inc/sidebar.php" ?>     
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Brainstorming
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Brainstorming Forum</li>
          </ol>
        </section>

        <!-- Project progress that user join it -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">
             <div class="col-lg-12">

              <?php
              if(mysql_num_rows($retval_brainstorming)==0){
                          echo "Not available"; //check if database isnt available
                      }
                      else{
                        $edit=null;
                            while($data=mysql_fetch_array($retval_brainstorming)){ // pengualangan untuk menampilkan html
                              if ($data['statusbrainstorming']==1) {
                                $data['statusbrainstorming']="Solved";
                              } elseif($data['statusbrainstorming']==2) {
                                $data['statusbrainstorming']='Unsolved';
                              }
                              elseif($data['statusbrainstorming']==3){
                                $data['statusbrainstorming']="Pending";
                              }
                              if($data['idemployees']==$_SESSION['login']){
                                $edit="<button class='btn btn-box-tool' data-toggle='tooltip' title='Edit'><a data-toggle='modal' href='detail_brainstorming.php?idbrainstorming=".$data['idbrainstorming']."' data-target='#editModal'><i class='fa fa-cog'></i></a></button>";
                              }

                              $total_answer=mysql_num_rows(mysql_query("SELECT idcomment_forumbs FROM comment_forumbs WHERE idemployees = '".$data['idemployees']."'"));
                              $select_comment=mysql_query("select comment_forumbs.*, employees.full_name, employees.pict_employees from employees inner join comment_forumbs on(employees.idemployees=comment_forumbs.idemployees) where comment_forumbs.idbrainstorming= ".$data['idbrainstorming']." ");

                              $avatar="default.png";
                              if ($data['pict_employees']!=null) {
                                $avatar = $data['pict_employees'];
                              }

                              $comment=null;
                              if($total_answer!=0){
                                $comment_foto="uploads/default.png";
                                while($data_comment=mysql_fetch_array($select_comment)){

                                  if ($data_comment['pict_employees']!=null) {
                                    $comment_foto=$data_comment['pict_employees'];
                                  }

                                  $comment.="
                                  <div class='box-footer box-comments' style='display:none'>
                                                    <div class='box-comment'>
                                                      <img class='img-circle img-sm' src='".$comment_foto."' alt='user image'>
                                                      <div class='comment-text'>
                                                        <span class='username'>
                                                          ".$data_comment['full_name']."
                                                          
                                                        </span>
                                                        ".$data_comment['content_bs']."
                                                      </div>
                                                    </div>
                                  </div>
                                    ";
                                }
                              }
                              
                              
                                echo "<div class='box box-widget' class='collapsed-box'>
                                        <div class='box-header with-border'>
                                          <div class='user-block'>
                                           <img class='img-circle' src='uploads/".$avatar."' alt='user image'>
                                           <span class='username'><a href='#'>".$data['title_bs']."</a></span>
                                            <span class='description'>".$data['full_name']."-".$data['date_posting']."</span>
                                          </div>
                                          <div class='box-tools'>
                                            <small class='label label-default'><i class='fa fa-question-circle'></i> ".$data['statusbrainstorming']." </small>
                                            ".$edit."
                                            <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i></button>
                                          </div>
                                        </div>

                                        <div class='box-body' style='display:none'>
                                          <p> ".$data['description_bs']." </p>
                                        </div>
                                        <div class='attachment-block clearfix'>
                                            <img class='attachment-img' src='../dist/img/photo1.png' alt='attachment image'>
                                            <div class='attachment-pushed'>
                                              <h4 class='attachment-heading'><a href=''>  Title </a></h4>
                                             <div class='attachment-text'>
                                                Text ...
                                             </div>
                                            </div>
                                        </div>
                                        
                                        <div class='box-footer' style='display:none'>
                                          <form action='insert_comment.php' method='post'>
                                            <img class='img-responsive img-circle img-sm' src='images/".$avatar."' alt='alt text'>
                                            <div class='img-push'>
                                              <input type='text' class='form-control input-sm' name='comment' placeholder='Leave Comment...'>
                                            </div>
                                          </form>
                                          <span class='pull-right text-muted'>".$total_answer." answer</span>
                                          </div>
                                         
                                          
                                         
                                              
                                               ".$comment."
                                          


                                        


                                      </div>

                                      ";
                                  }
                                 }
              ?>
            </div><!-- /.col lg 12 -->
          </div><!-- row -->
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
    <!-- </div>./wrapper -->

    <!-- Modal -->
    <div class='modal fade' id='editModal'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          
        </div>
      </div>
    </div>
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
    <script type="text/javascript">
        
        // funtion for show sign up form
        // $("#edit").click(function(){
        //      $('#editModal').modal();
        // });
        // funtion for show sign in form
    </script> 
  </body>
</html>