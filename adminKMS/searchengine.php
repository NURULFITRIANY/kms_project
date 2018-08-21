          
          <?php 
          session_start();
          include 'koneksi.php';

            // $sql = 'SELECT * FROM employees ORDER BY idemployees DESC'; //only show user's bookmark
             // mysql_select_db('test_db');
             // $retval_employees = mysql_query($sql);
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

          <?PHP
          // The following code is the core of our search engine.
          // Calculate the search time using a function, make a database connection with another function, 
          // and finally we will check for matches with an appropriate algorithm running a query to select a table to look for matches.
            function getmicrotime()
            {
                list($usec, $sec) = explode(" ", microtime()); 
                //initialize function to calculate the time for the search
                return ((float)$usec + (float)$sec);
            }
            //initializing connection to the database
            $connection_string = dirname(__FILE__) . "/koneksi.php";
            require_once($connection_string);

            $search_term=$_GET['search_term'];
            $tipe=$_GET['type_search'];

            $sql_employees="SELECT * FROM employees WHERE full_name LIKE '%".$search_term."%' order by idemployees DESC";
            $sql_project="SELECT * FROM project WHERE title_project LIKE '%".$search_term."%' order by id_project DESC";
            $sql_brainstorming="SELECT * FROM brainstorming WHERE title_bs LIKE '%".$search_term."%' order by idbrainstorming DESC";
            $sql_news_event="SELECT * FROM news_event WHERE title_news_event LIKE '%".$search_term."%' order by idnews_event DESC";
            $sql_document="SELECT * FROM document WHERE title_document LIKE '%".$search_term."%' order by iddocument DESC";

            $query=null;

            if ($tipe=="employ"){
              $query=mysql_query($sql_employees);
            } elseif($tipe=="project"){
              $query=mysql_query($sql_project);
            } elseif($tipe=="brainstorming"){
              $query=mysql_query($sql_brainstorming);
            } elseif ($tipe=="news_event") {
              $query=mysql_query($sql_news_event);
            } elseif ($tipe=="document") {
              $query=mysql_query($sql_document);
            }

            $num_rec_per_page=mysql_num_rows($query);
          ?>
          
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Search results
                <small>Control panel</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Search results</li>
              </ol>
            </section>

            <!-- MAIN CONTENT -->
            <section class="content">
                <!-- Member widget 1 -->
                        <div class="row">
                          <div class="col-lg-12">                                      
                                      <h2>
                                          <?php echo $num_rec_per_page ?> results found for: <span class="text-navy">" <?php echo $search_term; ?> "</span>
                                      </h2>
                                      
                                      
                                      
                                        <div class="box">
                                          <div class="box-header"></div>
                                          <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover">
                                              <?php
                                              if($tipe=='employ'){

                                              }else{
                                                ?>
                                                <thead>
                                                  <td>No.</td>
                                                  <td>Title.</td>
                                                </thead>
                                                <tbody>
                                                  <?php
                                        
                                                    // $data=mysql_fetch_array($query) or die(mysql_error());
                                                  $i=1;
                                                    while($data=mysql_fetch_array($query)){
                                                      ?>
                                                      <tr>
                                                      <td><?php echo $i?></td>
                                                      <?php if($tipe=='brainstorming'){
                                                        echo "<td>".$data['title_bs']."</td>";
                                                      }elseif($tipe=='project'){
                                                        echo "<td><a href='projectview.php?idproject=".$data['id_project']."'>".$data['title_project']."</a></td>";
                                                      }
                                                      elseif($tipe=='document'){
                                                        echo "<td><a href='documentview.php?iddocument=".$data['iddocument']."'>".$data['title_document']."</a></td>";
                                                      }
                                                      elseif($tipe=='news_event'){
                                                        echo "<td>".$data['title_news_event']."</td>";
                                                      }
                                                       ?>
                                                      </tr>
                                                      <?php
                                                      $i++;
                                                    }


                                                  ?>
                                                </tbody>
                                                <?php
                                              } ?>
                                              
                                            </table>
                                          </div>
                                          <div class="box-footer"></div>
                                        </div>
                                      
                                      


                                    <nav>
                                      <ul class="pagination" name="pagination">
                                        <li>
                                          <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li>
                                          <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>
                </div>
              </div><!-- /.row -->
            </section><!-- /.Left col -->
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
    <script src="../js/raphael-min.js"></script>
    <!-- // <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
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
