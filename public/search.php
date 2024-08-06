<?php include './session.php'; ?>
<?php

        //sanitize form data
        function sanitize($data) {
            global $conn;
            $data = @trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return mysqli_real_escape_string($conn,$data);
        }

      if (isset($_POST['search'])) { 
        //isset($_POST['search']) && $_POST['search']!=""

        if(!empty($_POST['search'])) {
        $search = sanitize($_POST['search']);


        if (strtolower($search) == sanitize('all')) {
            $selectSongs = "SELECT * FROM `songs`";
          $results = mysqli_query($conn,$selectSongs);
  
              if(!$results){
                 echo mysqli_error($conn);
              }
                else{
                  $row = mysqli_num_rows($results);
                  $no = 1;
  
                  if($row<1){
                    echo "No Songs in database";
                  }
                  else{
                    echo '<tr>
                        <th>No.</th>
                        <th>Song Title</th>
                        <th>Genre</th>
                        <th>Release Date</th>
                        <th class="operation">Operation</th>
                    </tr>';
                  while($row = mysqli_fetch_assoc($results)){ 
                      echo '
                      <tr>
                        <td>'.$no.'</td>
                        <td>'.$row['song_title'].'</td>
                        <td>'.$row['song_genre'].'</td>
                        <td>'.$row['release_date'].'</td>
                        <td class="operation">
                            <a href="adminDashboard.php?id='.$row['song_id'].'&table=songs&id_name=song_id" class="delete_btn table_btn">
                              <i class="fa fa-delete"></i>
                              Delete Song
                            </a>
                        </td>
                      </tr>
                      ';
                    $no++;
                  }
            }
          }
          } else{
            
            if (strlen($search) > 1) {
          
            $selectSongs = "SELECT * FROM `songs` WHERE `song_genre` LIKE '{$search}%'";
            $results = mysqli_query($conn,$selectSongs);

            if(!$results){
               echo mysqli_error($conn);
            }
              else{
                $row = mysqli_num_rows($results);
                $no = 1;

                if($row<1){
                  echo "No Songs of that genre in database";
                }
                else{
                    echo '<tr>
                        <th>No.</th>
                        <th>Song Title</th>
                        <th>Genre</th>
                        <th>Release Date</th>
                        <th class="operation">Operation</th>
                    </tr>';
                while($row = mysqli_fetch_assoc($results)){ 
                    echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td>'.$row['song_title'].'</td>
                      <td>'.$row['song_genre'].'</td>
                      <td>'.$row['release_date'].'</td>
                      <td class="operation">
                          <a href="adminDashboard.php?id='.$row['song_id'].'&table=songs&id_name=song_id" class="delete_btn table_btn">
                            <i class="fa fa-delete"></i>
                            Delete Song
                          </a>
                      </td>
                    </tr>
                    ';
                  $no++;
                }
          }
        }
      }
    }
    }
    }
      ?>