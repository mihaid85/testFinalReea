<!DOCTYPE html>
<?php 
    include("mysql.php");
?>
<html>
	<head>
		<title>test</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="description" content="Demo project">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-md">

		    <!-- Modal content-->
		    <div class="modal-content">
			    <form class="register" method="POST">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Sign up</h4>
			      </div>
			      <div class="modal-body">
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="firstname">First Name</label>
		        		<div class="controls col-sm-9">
		        			<input id="firstname" class="form-control" name="username" placeholder="Enter First Name" type="text" required>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="lastname">Last Name</label>
		        		<div class="controls col-sm-9">
		        			<input id="lastname" class="form-control" name="lastname" placeholder="Enter Last Name" type="text" required>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="birthday">Date of birth</label>
		        		<div class="controls col-sm-9">
			        		<?php
			        			echo '<select name="month" required>';
									echo '<option></option>';
									$months =['January' => '01', 'Febrary' => '02', 'March' => '03', 'April' => '04', 'May' => '05', 'June' => '06', 'July' => '07', 'August' => '08', 'September' => '09', 'October' => '10', 'November' => '11', 'December' => '12'];
									foreach ($months as $month=>$value) {
									  
										echo "<option value='$value'>$month</option>";
									}
								echo '</select>';
								
								echo '<select name="day" required>';
								  echo '<option></option>';
									for($i = 1; $i <= 31; $i++){
									  $i = str_pad($i, 2, 0, STR_PAD_LEFT);
										echo "<option value='$i'>$i</option>";
									}
								echo '</select>';

								echo '<select name="year" required>';
								  echo '<option></option>';
									for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--){
									  echo "<option value='$i'>$i</option>";
									} 
								echo '</select>';
							?>
						</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="gender">Gender</label>
		        		<div class="controls col-sm-9">
		        			<label>
					            <input type="radio" name="male" value="m" checked="checked">Male
					        </label>
					        <label>
					            <input type="radio" name="female" value="f">Female
					        </label>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="country">Country</label>
		        		<div class="controls col-sm-9">
		        			<select id="country" class="form-control" name="country" required>
		        				<?php 
		        					$query = "SELECT * FROM countries" ;
		        					$result = $mysql->query($query);
		        					if ($result->num_rows > 0){
		        						while ($row = $result->fetch_assoc()) {
								    		echo '<option value='.$row['name']. '>' .$row['name'] .'</option>';
								  		}
								  }
		        				?>
		        			</select>
		        		</div>
		        	</div>
					<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="email">Email</label>
		        		<div class="controls col-sm-9">
		        			<input id="email" class="form-control" name="email" placeholder="Email" type="email" required>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="phone">Phone</label>
		        		<div class="controls col-sm-9">
		        			<input id="phone" class="form-control" name="phone" placeholder="Phone" type="number" required>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="password">Password</label>
		        		<div class="controls col-sm-9">
		        			<input id="password" class="form-control" name="password" type="password" required>
		        		</div>
		        	</div>
		        	<div class="row control-group">
		        		<label class="col-sm-3 control-label text-right" for="confirmPassword">Confirm password</label>
                        <div class="controls col-sm-9">
                            <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>
		        
			      </div>
			      <div class="modal-footer">
			      	<button id="cancel" class="btn btn-lg btn-block">Cancel</button>
			        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
		        </form>
		      </div>
		    </div>

		  </div>
		</div>


		<script type="text/javascript">
		    $(document).ready(function(){
		    	//show modal
		        $('#myModal').modal('show');

		        //cancel button
		        $('#cancel').click(function(){
		        	$('#myModal').modal('hide');
		        })
		    });
		</script>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $('#register').click(function(){
		        	<?php 
		        		//get variables from form
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];

						//create date from string
						$day = $_POST['day'];
						$month = $_POST['month'];
						$year = $_POST['year'];

						$time = strtotime('10/16/2003');
						$birthday = date('Y-m-d',$time);
						echo $birthday;

						$gender = $_POST['gender'];
						$country = $_POST['country'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$password = $_POST['password'];
						$confirmPassword = $_POST['confirmPassword'];

						//insert into db
						if ($password==$confirmPassword) {
							$query = "INSERT INTO `user` (id, firstname, lastname, birthday, gender, country, email, phone, password) VALUES ('$id', '$firstname', '$lastname', '$birthday', '$gender', '$country', '$email', '$phone', '$password')";
					        $result = mysqli_query($mysql, $query);
					        if($result){
					            $msg = "User Created Successfully.";
					        }else{
					            $msg ="User Registration Failed";
					        }
						}
						else echo "Password do not match";

					?>
		        })
		    });
		</script>
	</body>
</html>