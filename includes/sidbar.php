<style type="text/css">
  body{
    background-color: aliceblue;
  }
  .box-container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 55vh;
  }
  .box{
    width:400px;
    height:300px;
    border-radius: 15px;
    background-color: bisque;
    box-shadow:3px 10px 15px #abc;
    display: flex;
      align-items: center;
      text-align: center;
      font-size: 20px;
      padding: 50px;
      color: #555;
      font-family: monospace;
      font-weight: bold;
      position: relative;
  }
  .tag{
    position: absolute;
    top: 0;
    left: 0;
    font-size: 15px;
    background: #666;
    color:#fff;
    padding: 5px 10px;
  }
</style>    




     <div class="col-md-4" style="margin-top:15rem">
            <div class="card bg-dark px-4 my-2">
                   <div class="card-body ">
                   <h4 class="text-white">Most Posted by  Users</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                
                                <?php
                                $str = "";
                                 $data_query = mysqli_query($con, "SELECT MAX(num_posts) FROM users");
                                 $result_data_query = mysqli_fetch_array($data_query);
                                 $maxium_post = mysqli_query($con, "SELECT * FROM users WHERE num_posts BETWEEN $result_data_query[0]-2 AND $result_data_query[0] LIMIT 8");
                                 while($row = mysqli_fetch_array($maxium_post)) {
                                     $userName = $row['name'];
                                     $str.="
                                     <li><a class='text-info' style='text-decoration:none' href='$userName'>$userName</a></li>
                                    ";
                                 }
                                
                                ?>

                               <?php echo $str; ?>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                   </div>
                </div>

                <div class="box-container">
                    <div class="box">
                        <div class="box-content">
                        <?php
                        $api_url = "https://v2.jokeapi.dev/joke/Any";
                        $joke = json_decode(file_get_contents($api_url));
                        if($joke->type=='single'){?>
                        <div class="tag">
                            <p><?php echo  $joke->joke; ?></p>
                        </div>
                        <?php }else{?>
                        <div class="joke">
                           <div class="setup">
                            <?php echo $joke->setup;?>
                           </div>
                           <hr>
                           <div class="delivery">
                           <?php echo $joke->delivery;?>
                           </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
        </div>

            

        