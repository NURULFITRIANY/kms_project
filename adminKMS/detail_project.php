<?php
include("koneksi.php");
$id_project=$_GET['id_project'];
$retval_detail_project=mysql_query("SELECT * FROM project WHERE id_project='".$id_project."'");

    if (mysql_num_rows($retval_detail_project)==0) {
        echo "<tr><td colspan='9'>Not available</td></tr>"; //check if database isnt available
    } else {
      while($data=mysql_fetch_array($retval_detail_project)){
                          
                          $bar='progress-bar-success';
                          if($data['project_progress']<=5){
                            $bar='progress-bar-danger';
                          }
                          elseif($data['project_progress']<95 && $data['project_progress']>5){
                            $bar='progress-bar-primary';
                          }

                          if ($data['statusproject']==1) {
                                $data['statusproject']="Open";
                              } elseif($data['statusproject']==2) {
                                $data['statusproject']='In Progress';
                              }
                              elseif($data['statusproject']==3){
                                $data['statusproject']="Success";
                              }
        echo "
              <form action='updateproject.php' method='post'>
                <input type='hidden' name='id_project' value='".$id_project."'/>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h4 class='modal-title'>".$data['title_project']."</h4>
                  </div>
                  <div class='modal-body'>
                    <div class='form-group col-sm-12'>
                      <label for='job'>Status</label>
                        <select id='job' name='statusproject' value=' ".$data['statusproject']." '>  
                          <option value='1'>Open</option>
                          <option value='2'>In Progress</option>
                          <option value='3'>Success</option>
                        </select>
                    </div> 
                    <div class='form-group col-sm-12'>
                        <label for='inputprogress' class='col-sm-2 control-label'>Progress</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' id='inputprogress' name='project_progress' value=' ".$data['project_progress']." %'>
                        </div>
                    </div>
                    <div class='form-group box-body'>
                        <h3>SWOT Analysis </h3></br>
                        <label>Stength Analysis</label>
                        <textarea class='textarea' name='swot_strengthanalysis' value=' ".$data['swot_strengthanalysis']." ' style='width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>                  
                        <label>Weakness Analysis</label>
                        <textarea class='textarea' name='swot_weaknessanalysis' value=' ".$data['swot_weaknessanalysis']." ' style='width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
                        <label>Opportunity Analysis</label>
                        <textarea class='textarea' name='swot_opportunityanalysis' value=' ".$data['swot_opportunityanalysis']." ' style='width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
                        <label>Threat Analysis</label>
                        <textarea class='textarea' name='swot_threatanalysis' value=' ".$data['swot_threatanalysis']." ' style='width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    <button type='submit' class='btn btn-primary' name='update'>Save changes</button>
                  </div>
              </form>
            ";
      }
    }
    ?>