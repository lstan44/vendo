<?php
session_start();

if(isset($_SESSION['id'])){
	header('Location: index.php');
}
else{
	include 'views/header1.php';
}
?>



<!--login-->

	<div class="login">
		<div class="main-agileits">
				<div class="form-w3agile form1">
					<h3>Register</h3>
                    <form action="api/user/create.php" method="post">
                    
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" value="Firstname" name="firstname" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Firstname';}" required="">
							<div class="clearfix"></div>
                        </div>
                        
                        <div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" value="Lastname" name="lastname" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Lastname';}" required="">
							<div class="clearfix"></div>
						</div>

						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" value="Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
							<div class="clearfix"></div>
                        </div>
                        
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="Password" name="pwd" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
							<div class="clearfix"></div>
                        </div>
                        
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="Confirm Password" name="Confirm Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Confirm Password';}" required="">
							<div class="clearfix"></div>
                        </div>
                        
						<input type="submit" value="Submit">
					</form>
				</div>
				
			</div>
		</div>

		<?php include 'footer.php'; ?>