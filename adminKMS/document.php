<?php 
session_start(); //utk ngambil id dr sql database
include 'koneksi.php';

  $sql = 'SELECT document.*, employees.full_name FROM document
  join employees on(document.idemployees = employees.idemployees)
  ORDER BY date_posting ASC'; //only show user's bookmark
   // mysql_select_db('test_db');
   $retval_document = mysql_query( $sql) or die(mysql_error());
?>

<?php include "inc/header.php" ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
<?php 
$current_page = "document";
include "inc/sidebar.php" ?>     
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Document
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Document</li>
          </ol>
        </section>

        <!-- Project progress that user join it -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-header">
                  <h3 class="box-title"></h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Title Document</th>
                      <th>Type</th>
                      <th>Mark</th>
                      <th> </th>
                    </tr>

                    <?php
                    if (mysql_num_rows($retval_document)==0){
                        echo "<tr><td colspan='9'>Not available</td></tr>"; //check if database isnt available
                      } else {
                        while($data=mysql_fetch_array($retval_document)){
                        
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

                          $total_bookmark=mysql_num_rows(mysql_query("select * from bookmark where iddocument='".$data['iddocument']."' and idemployees='".$_SESSION['login']."'"));
                          
                          if($total_bookmark==0){
                            $bookmark="<a href='insertbookmark.php?iddocument=".$data['iddocument']."' name='mark'><i class='fa fa-bookmark-o'></i></a>";
                          }
                          else{
                            $bookmark="<i class='fa fa-bookmark'></i>";
                          }
                          
                          // insertbookmark.php?iddocument=".$data['iddocument']."
                          // sent file  use GET's method
                          
                          echo " <tr>
                                  <td>".$data['iddocument']."</td>
                                  <td>".$data['full_name']."</td>
                                  <td>".$data['date_posting']."</td>
                                  <td><a href='documentview.php?iddocument=".$data['iddocument']."'> ".$data['title_document']." </a></td>
                                  <td><i class='fa ".$file."'></i></td>
                                  <td>
                                    <div class='tools'>
                                      ".$bookmark."
                                    </div>
                                  </td>
                                  <td> <a href='uploads/".$data['filename_document']."'><i class='fa fa-download'></i></a> </td>
                                </tr> ";
                        }
                      }
                    ?>

                  </table>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- col xs 12 -->
          

            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <li><a href="#">&laquo;</a></li>
               <li><a href="#">1</a></li>
               <li><a href="#">2</a></li>
               <li><a href="#">3</a></li>
               <li><a href="#">&raquo;</a></li>
              </ul>
            </div>

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
<!-- i keep this -->

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
