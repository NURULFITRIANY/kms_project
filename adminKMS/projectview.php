<?php 
session_start();
include 'koneksi.php';
$id_project=$_GET['idproject']; //deklarasi variabel
  $sql = 'SELECT project.*, group_project.idgroup_project, group_project.idemployees,  employees.full_name, employees.pict_employees  FROM project
          -- join employees on(project.idemployees = employees.idemployees)
          join group_project on(project.id_project = group_project.id_project)
          join employees on(project.idemployees = employees.idemployees)
          WHERE project.id_project = '.$id_project.'
          ORDER BY id_project DESC'; //only show user project progress
   // mysql_select_db('test_db');
   $retval_project = mysql_query($sql) or die(mysql_error());
?>

<?php include "inc/header.php" ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
<?php $current_page = " "; include "inc/sidebar.php" ?>        
        </section>
        <!-- /.sidebar -->
      </aside>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Project
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Project</li>
            <li class="active">Project View</li>
          </ol>
        </section>

        <!-- Project progress that user join it -->
        <section class="content">

        <!-- MAIN CONTENT -->
          <div class="row">
            <div class="col-lg-12">
              <?php
                    if (mysql_num_rows($retval_project)==0) {
                        echo "<tr><td colspan='9'>Not available</td></tr>"; //check if database isnt available
                      } else {
                        $data=mysql_fetch_array($retval_project); 
                          $bar='progress-bar-success';
                          if($data['project_progress']<=5){
                            $bar='progress-bar-danger';
                          }
                          elseif($data['project_progress']<95 && $data['project_progress']>5){
                            $bar='progress-bar-primary';
                          }

                          $file='fa-file-archive-o';
                          if($data['file_type']=='application/picture'){
                            $file='fa-file-picture-o';
                          }
                          elseif($data['file_type']=='application/word'){
                            $file='fa-file-word-o';
                          }
                          elseif($data['file_type']=='application/pdf') {
                            $file='fa-file-pdf-o';
                          }
                          elseif ($data['file_type']=='application/powerpoint') {
                            $file='fa-file-powerpoint-o';
                          }
                          elseif ($data['file_type']=='application/excel') {
                            $file='fa-file-excel-o';
                          }
                           $statusproject="Open";
                          if($data['statusproject']==2){
                            $statusproject="In Progress";
                          }
                          elseif($data['statusproject']==3){
                            $statusproject="Pending";
                          }

                          $avatar="default.png";
                          if ($data['pict_employees']!=null) {
                            $avatar = $data['pict_employees'];
                          }

                          if($data['idemployees']==$_SESSION['login']){
                            $edit="<button class='btn btn-box-tool' data-toggle='tooltip' title='Edit'><a data-toggle='modal' href='detail_project.php?id_project=".$data['id_project']."' data-target='#editModal'><i class='fa fa-cog'></i></a></button>";
                          }

                          echo "
                          <div class='box box-widget'>

                            <div class='box-header with-border'>
                              <div class='user-block'>
                                <img class='img-circle' src='uploads/".$avatar."' alt='user image'>
                                <span class='username'><a href='#'>".$data['title_project']."</a></span>
                                <span class='description'>".$data['start_date']." - ".$data['due_date']."</span>
                              </div>
                              
                              <div class='box-tools'>
                                <small class='label label-default'> ".$statusproject." </small>
                                ".$edit."
                              </div>
                            </div>

                            <div class='attachment-block clearfix'>
                              You are member of group 
                              ".$data['idemployees']."         
                            </div>


                            <div class='box-body'>
                              <p> ".$data['description_project']." </p>
                            </div>
                            
                            <div class='row'>
                              <div class='col-xs-12'>
                               <div class='box'>
                               <div class='box-body table-responsive no-padding'>
                                <table class='table table-hover'>
                                  <tr>
                                    <th>File Type</th>
                                    <th>File Name</th>
                                    <th>Progress</th>
                                    <th>Download</th>
                                  </tr>
                                  <tr>
                                    <td><i class='fa ".$file." '></i></td>
                                    <td>".$data['file_project']."</td>
                                    <td> <small class='label label-default'> ".$data['project_progress']." % </small>  </td> 
                                    <td> <a href='uploads/".$data['file_project']."'><i class='fa fa-download'></i></a> </td>
                                  </tr>
                                </table>
                               </div>
                               </div>
                              </div>
                            </div> 

                            <h3>SWOT's Analaysis</h3>
                            <div class='row'>
                              <div class='col-xs-12'>
                               <div class='box'>
                               <div class='box-body table-responsive no-padding'>
                                <table class='table table-hover'>
                                  <tr>
                                    <th>Strength</th>
                                    <th>Weakness</th>
                                    <th>Opportunity</th>
                                    <th>Threat</th>
                                  </tr>
                                  <tr>
                                    <td>".$data['swot_strengthanalysis']."</td>
                                    <td>".$data['swot_weaknessanalysis']."</td>
                                    <td>".$data['swot_opportunityanalysis']."</td>
                                    <td>".$data['swot_threatanalysis']."</td>
                                  </tr>
                                </table>
                               </div>
                               </div>
                              </div>
                            </div> 

                          </div>";
                      
                    }
              ?>

<!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

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

<!-- i keep this -->
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
<!-- i keep this -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- Modal -->
    <div class='modal fade' id='editModal' action='updateproject.php' method='post'>
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
  </body>
</html>

