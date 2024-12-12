<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insert Applicant</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Insert New Applicant!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name" required>
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="last_name" required>
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" required>
		</p>
		<p>
			<label for="gender">Gender</label> 
			<input type="text" name="gender" required>
		</p>
		<p>
			<label for="address">Address</label> 
			<input type="text" name="address" required>
		</p>
		<p>
			<label for="state">State</label> 
			<input type="text" name="state" required>
		</p>
		<p>
			<label for="nationality">Nationality</label> 
			<input type="text" name="nationality" required>
		</p>
		<p>
			<label for="jobTitle">Job Title</label> 
			<input type="text" name="job_title" required>
		</p>
		<p>
			<label for="qualifications">Qualifications</label> 
			<input type="text" name="qualifications" required>
		</p>
		<p>
			<label for="yearsOfExperience">Years of Experience</label> 
			<input type="number" name="years_of_experience" min="0" required>
		</p>
		<p>
			<input type="submit" name="insertApplicantBtn" value="Save">
		</p>
	</form>
</body>
</html>
