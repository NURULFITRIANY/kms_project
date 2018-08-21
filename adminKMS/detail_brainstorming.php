<?php
include("koneksi.php");
$idbrainstorming=$_GET['idbrainstorming'];
$retval_detail_brainstorming=mysql_query("SELECT * FROM brainstorming WHERE idbrainstorming='".$idbrainstorming."'");

              if(mysql_num_rows($retval_detail_brainstorming)==0){
                    echo "Not available"; //check if database isnt available
              } else{
                $data=mysql_fetch_array($retval_detail_brainstorming);

                              if ($data['statusbrainstorming']==1) {
                                $data['statusbrainstorming']="Solved";
                              } elseif($data['statusbrainstorming']==2) {
                                $data['statusbrainstorming']='Unsolved';
                              }
                              elseif($data['statusbrainstorming']==3){
                                $data['statusbrainstorming']="Pending";
                              }

                                echo "<form action='updatebrainstorming.php' method='post'>
                                        <input type='hidden' name='idbrainstorming' value='".$idbrainstorming."'/>
                                        <div class='modal-header'>
                                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                          <h4 class='modal-title'>".$data['title_bs']."</h4>
                                        </div>
                                        <div class='modal-body'>
                                          <div>
                                            <label for='job'>Status</label>
                                            <select id='job' name='statusbrainstorming'>
                                              <option value='1'>Solved</option>
                                              <option value='2'>Unsolved</option>
                                              <option value='3'>Pending</option>
                                            </select>
                                           </div>
                                        </div>
                                        <div class='modal-footer'>
                                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                          <button type='submit' class='btn btn-primary' name='update'>Save changes</button>
                                        </div>
                                      </form>
                                ";

              }
      ?>
