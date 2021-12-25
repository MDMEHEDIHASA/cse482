<style type="text/css">
  body{
    background-color: aliceblue;
  }
  .box-container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 41vh;
    width: 54vh;
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

  .adjust{
    margin-top:-1.2rem;
  }
</style>    







<style type="text/css">


*
{
  margin: 0;
  padding: 0;
  outline: none;
}

body
{
}

div.widget
{
  background-color: #fcfdfd;
  border-radius: 9px;
  padding: 25px;
  padding-right: 30px;
  box-shadow: 0px 31px 35px -26px #080c21;
  text-align: center;
  width:400px;
}

div.left-panel
{
}

div.date
{
  font-size: 14px;
  font-weight: bold;
  color: rgba(0,0,0,0.5);
}

div.city
{
  font-size: 21px;
  font-weight: bold;
  text-transform: uppercase;
  padding-top: 5px;
  color: rgba(0,0,0,0.7);
}

div.temp
{
  font-size: 81px;
  color: rgba(0,0,0,0.9);
  font-weight: 100;
}

div.panel
{
  display: inline-block;
}

div.right-panel
{
  /* position: absolute;
  float: right;
  top: 0;
  margin-top: 35px;
  padding-left: 10px; */
}
</style>  



     <div class="col-md-4" style="margin-top:5rem">



      <div class="widget">
              <?php
                $city_name='Dhaka,BD';
                $api_key='6ffb6bf3b8f6dac4808253608fe47bf7';
                $api_url='http://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$api_key;
                $weather_data = json_decode(file_get_contents($api_url),true);
                $tempature = $weather_data['main']['temp'];
                $tempature_in_celcius= $tempature-273.15;
                $exactTempature= round($tempature_in_celcius)
                
              ?>
                <div class="left-panel panel">
                  <div class="date">
                   Today's Weather
                  </div>
                  <div class="city">
                    Dhaka,BD
                  </div>
                  <div class="temp">
                   <img src="https://s5.postimg.cc/yzcm7htyb/image.png" alt="" width="60">
                   <?php echo $exactTempature?>&deg;
                   </div>
                </div>
                <div class="right-panel panel">
                <img src="https://s5.postimg.cc/lifnombwz/mumbai1.png" alt="" width="160">
                </div>
        </div>


            <div class="card box bg-dark px-4 my-5">
                   <div class="card-body ">
                   <h4 class="text-white adjust">Most Posted by  Users</h4>
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

            

        