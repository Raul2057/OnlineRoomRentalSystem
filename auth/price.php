<?php
$too = include 'userprice.php';
echo $too;

$conn = mysqli_connect("localhost","root","","newrent");

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the session variable
$user_name = $_SESSION['fullname'];
$user_id = $_SESSION['user_id'];

// Prepare the SQL query to retrieve the maximum value of the 'maxp' column for the user with the given ID
$sql = "SELECT MAX(maxp) AS maxp, MIN(minp) AS minp FROM users WHERE user_id = $user_id";

// Execute the SQL query and retrieve the result
$result = $conn->query($sql);

// Check if the query returned any result
if ($result->num_rows > 0) {
    // Fetch the row as an associative array
    $row = $result->fetch_assoc();
    
    // Retrieve the maximum value of the 'maxp' column
    $maxp = $row["maxp"];
    $minp = $row["minp"];
    

    $get="SELECT * FROM room_rental_registrations";
    $run=mysqli_query($conn,$get);
    while ($row=mysqli_fetch_array($run)) {
        $id=$row['id'];
        $fullname=$row['fullname'];
		$mobile=$row['mobile'];
		$city=$row['city'];
		$alternat_mobile=$row['alternat_mobile'];
		$email=$row['email'];
		$country=$row['country'];
		$location=$row['location'];
		$state=$row['state'];
		$image=$row['image'];
		$landmark=$row['landmark'];
		$address=$row['address'];
		$price=$row['sale'];
		$deposit=$row['deposit'];
		$plot_number=$row['plot_number'];
		$rooms=$row['rooms'];
		$accommodation=$row['accommodation'];
		$description=$row['description'];
		$vacant=$row['vacant'];

    if($price <= $maxp && $price >= $minp){
	 
       echo '<div class="card card-inverse card-info mb-3" style="padding:1%;">					
        <div class="card-block">';
       
           echo 	'<div class="row" style="width:50%;margin-left:30%;">
                  <div class="col-4">
                  <h4 class="text-center">Owner Details</h4>';
                       echo '<p><b>Owner Name: </b>'.$fullname.'</p>';
                       echo '<p><b>Mobile Number: </b>'.$mobile.'</p>';
                       echo '<p><b>Alternate Number: </b>'.$alternat_mobile.'</p>';
                       echo '<p><b>Email: </b>'.$email.'</p>';
                       echo '<p><b>Location: </b>'.$location.'</p>';
                       echo '<p><b>Country: </b>'.$country.'</p><p><b> State: </b>'.$state.'</p><p><b> City: </b>'.$city.'</p>';
                       if ($image !== 'uploads/') {
                           # code...
                           echo '<img src="'.$image.'" width="100">';
                       }

                       echo '<p><b>Address: </b>'.$address.'</p><p><b> Landmark: </b>'.$landmark.'</p>';

              echo '</div>
                  <div class="col-5">
                  <h4 class="text-center">Room Details</h4>';
                      // echo '<p><b>Country: </b>'.$value['country'].'<b> State: </b>'.$value['state'].'<b> City: </b>'.$value['city'].'</p>';
                      
                      echo '<p style="background:#000;color:#fff;"><b>Room Id: </b>'.$id.'</p>';
                      echo '<p><b>Plot Number: </b>'.$plot_number.'</p>';

                      if(isset($price)){
                          echo '<p><b>Sale: </b>'.$price.'</p>';
                      }		
                      if(isset($value['rent'])){
                        echo '<p><b>Rent: </b>'.$value['rent'].'</p>';
                      } 	
                      							
                      echo '<p><b>Available Rooms: </b>'.$rooms.'</p>';
                  
              echo '</div>
                  <div class="col-3">
                  <h4>Other Details</h4>';
                  echo '<p><b>Accommodation: </b>'.$accommodation.'</p>';
                  echo '<p><b>Description: </b>'.$description.'</p>';
                      if($vacant == 0){ 
                          echo '<div class="alert alert-danger" role="alert"><p><b>Occupied</b></p></div>';
                      }else{
                          echo '<div class="alert alert-success" role="alert"><p><b>Vacant</b></p></div>';
                      } 
                  echo '</div>
              </div>				      
         </div>
      </div>';
      echo '<br><br>';
       

/*Price filter out ends*/
     }	
    }


} else {
    echo "No result found for the current user.";
}



// Close the database connection
$conn->close();
        
	?>
				