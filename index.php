<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/b1.png" alt="First slide" width="900px" height="300px">
		                  </div>
		                  <div class="item">
		                    <img src="images/b02.jpg" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/b3.jpg" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
					<br>
					
					
		            <h2>Monthly Top Sellers</h2>
					<div>
						<!-- <a href="gallery.php"></a>   -->
						<div class="container">
            
            <div class="gallery">
			<table border="1" width="600" height="150">
<tr>
<!-- <td><img src="images/img/digital_15.jpg" alt="Gallery image 4" class="gallery__img" width="250px" height="250px"></td> -->
<td><img src="images/img/digital_05.jpg" alt="Gallery image 2" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_08.jpg" alt="Gallery image 3" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_04.jpg" alt="Gallery image 1" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_21.jpg" alt="Gallery image 6" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_18.jpg" alt="Gallery image 5" class="gallery__img" width="230px" height="230px"></td>
</tr>
</table>

            </div>
        </div>
					</div>

					<!-- New line -->
					<h2>Deal Of Day</h2>
					<div>
						<!-- <a href="gallery.php"></a>   -->
						<div class="container">
            
            <div class="gallery">
			<table border="1" width="600" height="150">
<tr>
<!-- <td><img src="images/img/digital_15.jpg" alt="Gallery image 4" class="gallery__img" width="250px" height="250px"></td> -->
<td><img src="images/img/digital_01.jpg" alt="Gallery image 2" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_02.jpg" alt="Gallery image 3" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_03.jpg" alt="Gallery image 1" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_08.jpg" alt="Gallery image 6" class="gallery__img" width="230px" height="230px"></td>
<td><img src="images/img/digital_12.jpg" alt="Gallery image 5" class="gallery__img" width="230px" height="230px"></td>
</tr>
</table>

            </div>
        </div>
					</div>









		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>

</body>
</html>