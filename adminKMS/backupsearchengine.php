                                      <?php

                                      /* Set current, prev and next page */
                                      $page = (!isset($_GET['page']))? 1 : $_GET['page']; 
                                      $prev = ($page - 1);
                                      $next = ($page + 1);

                                      /* Max results per page */
                                      $max_results = 2;

                                      /* Calculate the offset */
                                      $from = (($page * $max_results) - $max_results);

                                      /* Query the db for total results. 
                                         You need to edit the sql to fit your needs */
                                      $result = mysql_query($sql_news_event);
                                      $total_results = mysql_num_rows($result);
                                      $total_pages = ceil($total_results / $max_results);
                                      $pagination = '';

                                      /* Create a PREV link if there is one */
                                      if($page > 1)
                                      {
                                          $pagination .= '< a href="?page='.$prev.'">Previous</a> ';
                                      }

                                      /* Loop through the total pages */
                                      for($data = 1; $data <= $total_pages; $data++)
                                      {
                                          if(($page) == $data)
                                          {
                                              $pagination .= $data;
                                          }
                                          else
                                          {
                                              $pagination .= '< a href="searchengine.php?page='.$data.'">'.$data.'</a>';
                                          }
                                      }

                                      /* Print NEXT link if there is one */
                                      if($page < $total_pages)
                                      {
                                          $pagination .= '< a hr_ef="?page='.$next.'"> Next</a>';
                                      }

                                      /* Now we have our pagination links in a variable($pagination) ready to
                                         print to the page. I pu it in a variable because you may want to
                                         show them at the top and bottom of the page */

                                      /* Below is how you query the db for ONLY the results for the current page */
                                      // $result=mysql_query("select * from topics LIMIT $from, $max_results ");

                                      // while ($i = mysql_fetch_array($result))
                                      // {
                                      //     echo $i['title'].'<br />';
                                      // }
                                      // echo $pagination;

                                      ?>

                                      <?php
                                      if (mysql_num_rows($query)==0) { 
                                        echo "Not available"; //check if database isnt available
                                      } else {
                                        while($data=mysql_fetch_array($query)){
                                        echo "
                                          <div class='panel panel-default'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>".$data['title_news_event']."</h3>
                                            </div>
                                            <div class='panel-body'>
                                                  ".$data['description_news_event']."
                                            </div>
                                          </div>
                                         ";
                                        }
                                      }
                                      ?>
                                     
                                      <?php
                                      if (mysql_num_rows($query)==0) { 
                                        echo "Not available"; //check if database isnt available
                                      } else {
                                        while($data=mysql_fetch_array($query)){
                                        echo "
                                          <div class='panel panel-default'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>".$data['title_bs']."</h3>
                                            </div>
                                            <div class='panel-body'>
                                                  ".$data['description_bs']."
                                            </div>
                                          </div>
                                         ";
                                        }
                                      }
                                      ?>

                                      <?php
                                      if (mysql_num_rows($query)==0) { 
                                        echo "Not available"; //check if database isnt available
                                      } else {
                                        while($data=mysql_fetch_array($query)){
                                        echo "
                                          <div class='panel panel-default'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>".$data['title_project']."</h3>
                                            </div>
                                            <div class='panel-body'>
                                               ".$data['description_project']."
                                            </div>
                                          </div>
                                         ";
                                        }
                                      }
                                      ?>

                                      <?php
                                      if (mysql_num_rows($query)==0) { 
                                        echo "Not available"; //check if database isnt available
                                      } else {
                                        while($data=mysql_fetch_array($query)){
                                        echo "
                                          <div class='panel panel-default'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>".$data['title_document']."</h3>
                                            </div>
                                            <div class='panel-body'>
                                              ".$data['description_document']."
                                            </div>
                                          </div>
                                         ";
                                        }
                                      }
                                      ?>

                                      <?php
                                      if (mysql_num_rows($query)==0) { 
                                        echo "Not available"; //check if database isnt available
                                      } else {
                                        while($data=mysql_fetch_array($query)){
                                        echo "
                                            
                                          <div class='panel panel-default'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>".$data['full_name']."</h3>
                                            </div>
                                            <div class='panel-body'>
                                              ".$data['iddepartment']."
                                            </div>
                                          </div>

                                         ";
                                        }
                                      }
                                      ?> 