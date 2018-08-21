             <?php
              if (mysql_num_rows($retval_news_event)==0) { 
                echo "Not available"; //check if database isnt available
              } else {
                while($data=mysql_fetch_array($retval_news_event)){
                
                $avatar="default1.png";
                if ($data['picture']!=null) {
                  $avatar = $data['picture'];
                }

                echo "<div class='panel panel-default'>
                        <div class='panel-heading'>".$data['type']."</div>
                        <div class='panel-body'>
                          <div class='media'>
                            <div class='media-left'>
                              <a href='#'>
                                <img class='img-circle' src='images/".$avatar."'  alt=' '>
                              </a>
                            </div>
                            <div class='media-body'>
                              <h4 class='media-heading'>".$data['description_news_event']."</h4>
                              ".$data['description_news_event']."
                            </div>
                          </div>
                        </div>
                        </div>
                      </div> ";
                }
              }
              ?>

              <!-- Panel Events -->
              <?php
              if (mysql_num_rows($retval_news_event)==0) { 
                echo "Not available"; //check if database isnt available
              } else {
                while($data=mysql_fetch_array($retval_news_event)){
                echo "<div class='panel panel-default'>
                        <div class='panel-heading'>".$data['type']."</div>
                        <div class='panel-body'>
                          <div class='media'>
                            <div class='media-left'>
                              <a href='#'>
                                <img class='media-object' src=' ' alt=' '>
                              </a>
                            </div>
                            <div class='media-body'>
                              <h4 class='media-heading'>".$data['description_news_event']."</h4>
                              ".$data['description_news_event']."
                            </div>
                          </div>
                        </div>
                        </div>
                      </div> ";
                }
              }
              ?>