<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Community</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js.php') ?>
		
	</head>
	<body>
	
		<div class="container-lg">
		
		<!-- Navbar: START -->
		
		<!-- Navbar: END -->
		
		<!-- Body: START -->
		
			<?php view('header.php') ?>
			
			<div style="height: 65px;"></div> <!-- Header Spacer -->
		
			<?php view('username.php') ?>
			
			<?php view('top-banner.php') ?>
			
			<div class="row mt-3">
			
				<?php view('sidebar.php') ?>
				<div class="col-md-9">

					<div class="card col-md-12 mb-3 box-shadow">
						<div class="card-body pb-0">
							
							<h5 class="card-title text-primary mb-3">Community Service</h5>
							
							<div class="row">
								<div class="col-md-6 mb-3">
									<div class="card h-100">
										<img src="../img/cservice_01.jpg" class="card-img-top  w-100" alt="..." style="height: 200px;" />
										<div class="card-body">
											<h6 class="card-title">Building the Local Church</h6>
											<div class="row">
												<div class="col-12">
													<small class="text-dark">
														Building a strong and vibrant local church requires a commitment to serving the needs of the community.
														In many areas, the local church is a critical resource for those who are facing difficult times, providing not just a place of worship, but also essential supplies and shelter.
														<br><br>
														At our church, we are dedicated to supporting those who are socially and economically challenged.
														We do this in a number of ways, including offering free apparel and church gifts to those in need.
														Our goal is to provide a tangible expression of care and support, and to help ease the burden of those who are struggling.
														<br><br>
														In addition to providing supplies, we also strive to be a source of hope and inspiration for the community.
														We offer a safe and welcoming environment where people can gather, find support, and build relationships.
														Whether you are looking for a place to worship, a supportive community, or assistance in overcoming difficult circumstances, our church is here for you.
														<br><br>
														We are committed to building a strong and resilient community, and we believe that the local church has a critical role to play in this effort. 
														Whether you are a member of our church or simply looking for support and guidance, we invite you to join us in this important work.
														<br><br>
														Together, we can make a positive and lasting impact in the lives of those who need it most.
													</small>
												</div>
											
												<hr class="my-1 mx-0" style="opacity: 10%;">
												<br>
											</div>
										
											<a href="communityservice01.php" class="btn btn-sm btn-outline-primary w-50 py-0">Donate</a>
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="card h-100">
										<img src="../img/cservice_02.jpg" class="card-img-top  w-100" alt="..." style="height: 200px;" />
										<div class="card-body">
											<h6 class="card-title">Finishing the Community School</h6>
											<div class="row">
												<div class="col-12">
													<small class="text-dark">
														Building a school based on charity donations is a noble and important endeavor.
														At our organization, we understand that creating a quality learning environment is essential to helping students reach their full potential.
														That's why we are committed to building classrooms in partnership with public school systems and communities in Nairobi.
														<br><br>
														We believe that access to a safe and well-equipped physical space can have a profound impact on the learning experience.
														With your support, we can help to provide students with the resources and support they need to succeed.
														Our goal is to finish the community school, providing a space where students can learn, grow, and thrive.
														We are working closely with public school systems and community leaders to ensure that the school meets the needs of the local community and provides an inclusive and supportive learning environment for all students.
														<br><br>
														By donating to our cause, you can help make a real difference in the lives of students in Nairobi.
														Your contributions will go directly towards building classrooms, purchasing supplies and equipment, and supporting the school's programs and activities.
														<br><br>
														We believe that education is the key to unlocking a bright future, and we are committed to providing students with the best possible learning experience.
														We invite you to join us in our mission to finish the community school and provide students with the resources and support they need to succeed.
													</small>
												</div>
											
												<hr class="my-1 mx-0" style="opacity: 10%;">
												<br>
											</div>
											
											<a href="communityservice02.php" class="btn btn-sm btn-outline-primary w-50 py-0">Donate</a>
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="card h-100">
										<img src="../img/cservice_03.jpg" class="card-img-top  w-100" alt="..." style="height: 200px;" />
										<div class="card-body">
											<h6 class="card-title">Providing Medicine for the Local Community</h6>
											<div class="row">
												<div class="col-12">
													<small class="text-dark">
														Providing access to quality healthcare is an essential component of building a healthy and thriving community.
														In many parts of the world, including Kenya, people are faced with significant barriers to accessing the care they need, including limited access to medical facilities and services, a shortage of healthcare providers, and the high cost of treatments.
														<br><br>
														That's why our organization is dedicated to addressing the poor health and nutritional status of the people, particularly children and women, of the sugar belt region by providing medicine and doctors in collaboration with the local government. 
														Our mission is to ensure that everyone has access to the care they need to stay healthy and live a fulfilling life.
														<br><br>
														We believe that working in collaboration with the local government is key to our success.
														By partnering with local authorities, we can leverage their expertise and resources to deliver effective and sustainable health services to the community.
														Our goal is to provide comprehensive and accessible health services, including preventive care, treatment, and follow-up care, to help improve the health and well-being of the people in the sugar belt region.
														<br><br>
														By providing medicine and medical care, we aim to improve the health and nutritional status of the people in the community, particularly those who are most vulnerable.
														We believe that with your support, we can make a real difference in the lives of those who need it most.
														<br><br>
														We invite you to join us in our mission to provide health care for the people of Kenya.
														Your contributions will help us to deliver essential medical services and treatments, and make a positive impact in the lives of those in need.
														Together, we can help to build a healthier and more vibrant community for all.
													</small>
												</div>
											
												<hr class="my-1 mx-0" style="opacity: 10%;">
												<br>
											</div>
											
											<a href="communityservice03.php" class="btn btn-sm btn-outline-primary w-50 py-0">Donate</a>
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="card h-100">
										<img src="../img/cservice_04.jpg" class="card-img-top  w-100" alt="..." style="height: 200px;" />
										<div class="card-body">
											<h6 class="card-title">Donate & Support a Local Child</h6>
											<div class="row">
												<div class="col-12">
													<small class="text-dark">
														Donating and supporting a local child can have a profound impact on their future and their community. 
														At our organization, we believe that every child deserves the opportunity to reach their full potential, regardless of their background or circumstances.
														That's why we are dedicated to transforming the lives of impoverished children by raising up servant leaders and providing life's basic necessities including nutrition, medical care, and education.
														<br><br>
														Our goal is to break the cycle of poverty and empower children to become agents of change in their communities.
														By providing essential services such as nutrition, medical care, and education, we aim to give children the tools and resources they need to succeed and thrive.
														<br><br>
														In addition to meeting immediate needs, we are also focused on developing the next generation of servant leaders.
														Through mentorship and leadership training programs, we aim to equip children with the skills and knowledge they need to become positive and productive members of their communities.
														<br><br>
														Your support can make a real difference in the life of a child in need.
														By donating to our organization, you can help us provide life's basic necessities, including nutrition, medical care, and education, to children who would otherwise go without.
														<br><br>
														We believe that every child has the potential to make a positive impact in the world, and we are committed to doing everything in our power to help them reach their full potential.
														<br><br>
														Join us in our mission to support a local child and make a lasting difference in their life and their community.
													</small>
												</div>
											
												<hr class="my-1 mx-0" style="opacity: 10%;">
												<br>
											</div>
											<a href="communityservice04.php" class="btn btn-sm btn-outline-primary w-50 py-0">Donate</a>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					
					<?php view('bottom-tos.php') ?>
					
				</div>
				
			</div>
			
			<div style="height: 45px;"></div> <!-- Footer Spacer -->
			
			<?php view('footer.php') ?>
		
		<!-- Body: END -->
		
		</div>
		
		<?php view('bottom-js.php'); ?>
		
	</body>
</html>