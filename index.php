<?php
//connection to database
  session_start();
  $connect = mysqli_connect('localhost','root','','mrsecom');

    if(isset($_POST["add_to_cart"]))
    {
      if(isset($_SESSION["shopping_cart"]))
      {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
          $count = count($_SESSION["shopping_cart"]);
    //get all item detail
            $item_array = array(
                      'item_id'       =>   $_GET["id"],
                      'product_img'     =>   $_POST["hidden_image"],
                      'item_name'     =>   $_POST["hidden_name"],
                      'item_price'    =>   $_POST['hidden_price'],
                      'item_quantity' =>   $_POST["quantity"]

            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
          //product added then this block 
          echo '<script>alert("Item allready added ")</script>';
          echo '<script>window.location = "index.php"</script>';
        }
      }
      else
      {
        //cart is empty excute this block
         $item_array = array(
                      'item_id'       =>   $_GET["id"],
                      'product_img'     =>   $_POST["hidden_image"],
                      'item_name'     =>   $_POST["hidden_name"],
                      'item_price'    =>   $_POST['hidden_price'],
                      'item_quantity' =>   $_POST["quantity"]

            );
           $_SESSION["shopping_cart"][0] = $item_array;
      }
    }
//Remove item in cart 
    if(isset($_GET["action"]))
    {
      if($_GET["action"] == "delete")
      {
        foreach($_SESSION["shopping_cart"] as $key=>$value)
            {
              if($value["item_id"] == $_GET["id"])
              {
                unset($_SESSION["shopping_cart"][$key]);
                echo '<script>alert("Item removed")</script>';
                echo '<script>window.location="indax.php</script>';
              }
            }
      }
    }





?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>PHP Webslesson Tutorial | Simple PHP Mysql Shopping Cart</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Simple PHP Mysql Shopping Cart</h3><br />  
                  <?php
                    $qury = "SELECT * FROM headphone ORDER BY id ASC";
                    $result = mysqli_query($connect,$qury);
                    if(mysqli_num_rows($result) >0)
                    {
                      while($row = mysqli_fetch_array($result))
                      {

                  ?>
                <div class="col-md-4">  
                     <form method="post" action="index.php?action=add&id=<?php echo $row["id"];?>">  
                          <div class="card" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px;" align="center">  
                               <img src="<?php echo $row['productimg'];?>" class="img-responsive" style="    width: 100px;" /><br />  
                               <h4 class="text-info"><?php echo $row['newprice'];?></h4>  
                               <h4 class="text-danger">$<?php echo $row['newprice'];?></h4>  
                               <input type="hidden" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="hidden_name" value="<?php echo $row['productname'] ?>" />
                           <input type="hidden" name="hidden_image" value="<?php echo $row['productimg'];?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row['newprice'];?>">


                               
							   <button type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="">Add to Cart</button>
                          </div>  
                     </form>  
                </div>  
                  <?php } } ?>

           </div>  
           <br />  
		   
		   
		   
		   
		   
		   
		   <div class="contaner-fluid mapp2">
	<div class="row">

 <?php
                    $qury = "SELECT * FROM headphone ORDER BY id ASC";
                    $result = mysqli_query($connect,$qury);
                    if(mysqli_num_rows($result) >0)
                    {
                      while($row = mysqli_fetch_array($result))
                      {

                  ?>

       
<div class="col-md-3 col-4" >
 <form method="post" action="index.php?action=add&id=<?php echo $row["id"];?>"> 
			<div class="card card-product-grid example hoverable">
				<div class="img-wrap view overlay">
					
					<img class="card-img-top img-fiexd" src="images/<?php echo $row['productimg'];?>"
					alt="Card image cap">
			    </div>
			<div class="info-wrap border-top" style="margin:0px 20px 10px 20px;">
			<br>
				    <a href="<?php echo $row['productlink']; ?>"class="title"><?php echo $row['productname'];?>  </a>
				<div class="price-wrap" >
					<strong class="price">$<?php echo $row['newprice'];?></strong>
					<del class="price-old">$<?php echo $row['oldprice'];?></del>
					<small>/price</small><br>
					 <small>  <?php echo $row['stock'];?> </small>
					 
					 <input type="hidden" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="hidden_name" value="<?php echo $row['productname'] ?>" />
                           <input type="hidden" name="hidden_image" value="<?php echo $row['productimg'];?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row['newprice'];?>">
					 
				
				</div>   
			
				
				
		  <button type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="">Add to Cart</button>

				</div>
				</form>  
			</div> 		
     	</div>
     	<?php
				
			}
					}
		?>




	</div>
</div>
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
      </body>  
 </html>