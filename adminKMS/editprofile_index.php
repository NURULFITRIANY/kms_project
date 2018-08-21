<?php 
session_start();
include 'koneksi.php';

  $sql = 'SELECT * FROM employees ORDER BY idemployees DESC';
   // mysql_select_db('test_db');
   $retval_employees = mysql_query($sql);
?>

<?php include "inc/header.php" ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
<?php 
$current_page = " ";
include "inc/sidebar.php" ?> 
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Profile
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit profile</li>
          </ol>
        </section>

      <!-- Project progress that user join it -->
      <section class='content'>
        <div class='row'>
          <div class='col-md-12'>
        
      <?php
      if (mysql_num_rows($retval_employees)==0){
          echo "<tr><td colspan='9'>Not available</td></tr>"; //check if database isnt available
      } else { 
        // var_dump($retval_employees);
        // enctype="multipart/form-data" //untuk upload
      echo "
              <div class='nav-tabs-custom'>
                <ul class='nav nav-tabs'>
                  <li><a href='' data-toggle='tab'>Settings</a></li>
                </ul>
                <div class='content'>
                 <div class='tab-pane' id='settings'>
                    <form class='form-horizontal' action='updateprofile.php' method='post'  enctype='multipart/form-data'>
                      <input type='hidden' name='old_pict' value='".$data['pict_employees']."'/>
                      <div class='form-group'>
                        <label for='inputName' class='col-sm-2 control-label'>Name</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputName' value='".$data['full_name']."' name='full_name' placeholder=''>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label for='inputdateofbirth' class='col-sm-2 control-label'>Date of Birth</label>
                        <div class='col-sm-10'>
                          <input type='date' class='form-control' id='inputdateofbirth' value='".$data['date_birth']."' name='date_birth' placeholder=''>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label for='inputlocation' class='col-sm-2 control-label'>Location</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputlocation' value='".$data['location']."' name='location' placeholder=''>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label for='inputEmail' class='col-sm-2 control-label'>Email</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputEmail' value='".$data['email']."' name='email' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputPhone' class='col-sm-2 control-label'>Phone</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputPhone' value='".$data['phone_number']."' name='phone_number' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputGoogleplus' class='col-sm-2 control-label'>Google+</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputGoogleplus' value='".$data['google_plus']."' name='google_plus' placeholder=''>
                        </div>
                      </div>
                     
                      <div class='form-group'>
                        <label for='inputTwitter' class='col-sm-2 control-label'>Twitter</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputTwitter' value='".$data['twitter']."' name='twitter' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputFacebook' class='col-sm-2 control-label'>Facebook</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputFacebook' value='".$data['facebook']."' name='facebook' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputBlog' class='col-sm-2 control-label'>Private Site</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputBlog' value='".$data['blog']."' name='blog' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputInstagram' class='col-sm-2 control-label'>Instagram</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputInstagram' value='".$data['instagram']."' name='instagram' placeholder=''>
                        </div>
                      </div>
                      
                      <div class='form-group'>
                        <label for='inputLinkendin' class='col-sm-2 control-label'>Linkedin</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputLinkendin' value='".$data['linkendin']."' name='linkendin' placeholder=''>
                        </div>
                      </div>
                    
                      <div class='form-group'>
                        <label for='inputDepartment' class='col-sm-2 control-label'>Department</label>
                        <div class='col-sm-10'>
                          <select id='inputDepartment' name='iddepartment'>  
                             <option value='1'>Finance and Accounting</option>
                             <option value='2'>Information Technology</option>
                             <option value='3'>Information System</option>
                             <option value='4'>Administration</option>
                             <option value='5'>Business Development</option>
                             <option value='6'>General affairs</option>
                             <option value='7'>CSR</option>
                             <option value='8'>Marketing</option>
                             <option value='9'>Learning</option>
                          </select>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label for='inputJob' class='col-sm-2 control-label'>Job Title</label>
                        <div class='col-sm-10'>
                          <input type='text' class='form-control' id='inputJob' value='".$data['job_title']."' name='job_title' placeholder=''>
                        </div>
                      </div>
                    
                      <div class='form-group'>
                        <label for='inputSkill' class='col-sm-2 control-label'>Skill</label>
                        <div class='col-sm-10'>
                          <select id='inputSkill'  value='".$data['idskill']."' name='idskill'>  
                             <option value='1'>Finance and Accounting</option>
                             <option value='2'>Information Technology</option>
                             <option value='3'>Information System</option>
                             <option value='4'>Administration</option>
                             <option value='5'>Business Development</option>
                             <option value='6'>General affairs</option>
                             <option value='7'>CSR</option>
                             <option value='8'>Marketing</option>
                             <option value='9'>Learning</option>
                          </select>
                        </div>
                      </div>
                      
                      
                      <div class='form-group'>
                        <label for='inputExperience' class='col-sm-2 control-label'>Bio</label>
                        <div class='col-sm-10'>
                          <textarea class='form-control' id='inputExperience' value='' name='employees_background' placeholder=''>".$data['employees_background']."</textarea>
                        </div>
                      </div>

                      
               ";
       }        
      ?>
    
                        <div class='form-group'>
                                  <label for='inputExperience' class='col-sm-2 control-label'>Select Files</label>
                                  <div class='col-sm-10'>
                                    <input type="file" name="pict_employees" multiple class='form-control'>
                                  </div>  
                        </div>
                        <div class='form-group'>
                          <div action='updateprofile.php' class='col-sm-offset-2 col-sm-10'>
                            <button type='submit' class='btn btn-success' name='update'>Save the changes</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>        
          </div>
        </div>
      </section>
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
