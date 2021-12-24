
<div class="col-md-4" style="margin-top:15rem">
            <div class="card bg-dark px-4 my-2">
                   <div class="card-body ">
                   <h4 class="text-white">Most Posted by Users</h4>
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
            </div>

            </div>