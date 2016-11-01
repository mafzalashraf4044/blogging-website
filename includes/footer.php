          <div class="col-md-4 right-panel">
            <div id="sub-container1">
              <p>Recent Posts<p>
                    <?php
                    $conn = open_db_conn();
                    $sql = 'SELECT post_id, title, post, likes, comments, date, username FROM blog_post ORDER BY post_id DESC LIMIT 2';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row

                        while($row = $result->fetch_assoc()):

                                if(strlen($row['post']) > 102){
                                  $post_summary = substr($row['post'],0,100) . '...';
                                }else{
                                  $post_summary = $row['post'];
                                }

                                echo "<div class='recen-post'>";
                                echo "<a href='' class='post-title'><h1>{$row['title']}</h1></a>";
                                echo "<p class='post-content post'>$post_summary</p>";
                                echo "<a href='post.php?post={$row['post_id']}' class='read-more'>Read More</a>";
                                echo "<br><br>";
                                echo "</div>";

                      endwhile;
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
            </div>

            <div id="sub-container2">
              <p>Categories</p>
              <ul>
                <?php
                $conn = open_db_conn();
                $sql = 'SELECT category_id, category FROM categories';
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()):
                      $url = "post.php" . "?category={$row['category_id']}";
                      echo "<li><a href='$url'>{$row['category']}</a></li>";
                    endwhile;
                  } else {
                      echo "0 results";
                  }
                  $conn->close();

                ?>
              </ul>
            </div>

            <div id="sub-container3">
              <p>Blog Archive<p>

              <form action="post.php" method="GET" class="form archive-form">
                  <select name="date" class="form-control">

                    <?php
                    $today = strtotime('today');
                    $months = [
                      "01" => "Jan",
                      "02" => "Feb",
                      "03" => "Mar",
                      "04" => "Apr",
                      "05" => "May",
                      "06" => "Jun",
                      "07" => "Jul",
                      "08" => "Aug",
                      "09" => "Sep",
                      "10" => "Oct",
                      "11" => "Nov",
                      "12" => "Dec"
                    ];

                    for ($i=0; $i < 10 ; $i++) {
                      $timestamp = date('d-m-Y',$today);
                      $date = date('d-m', $today);
                      $day = date('l', $today);
                      $dash_pos = strpos($date, '-');

                      //Mapping Numeric value of month to Actual value in the $months Array
                      if($dash_pos!==FALSE){
                        $month = substr($date, $dash_pos + 1);
                        $date = substr($date, 0, $dash_pos + 1);
                        $date = $date . $months[$month];
                      }
                      echo "<option value='$timestamp'>$date $day</option>";

                      $today = strtotime("-1 day", $today);
                    }
                     ?>
                  </select>

                  <input type="submit" value="View Posts">
              </form>
            </div>

            <div id="sub-container4">

            </div>
          </div>
        </div>
      </div>


      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 footer">
          <p>Designed &amp; Developed by <a href="http://mafzalashraf-portfolio.firebaseapp.com" target="_blank">Afzal Ashraf</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="jquery-2.2.3.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="scripts/script.js"></script>

<?php if(isset($show_modal)):?>

<script type="text/javascript">
        $('#log-in').modal('show');
</script>
<?php endif; ?>

</body>
</html>
