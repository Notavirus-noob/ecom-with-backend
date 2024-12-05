<?php 
	require_once 'functions.php';
    checkLoginStatus();
    $err = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (checkRequiredField('product_name')) {
        
            if (matchPattern($_POST['product_name'],"/^[a-zA-Z0-9\s\-]+$/")){
                $product_name = $_POST['product_name'];
            }
            else{
                $err['product_name'] = 'Enter Valid product_name';    
            }
            
        } else {
            $err['product_name'] = 'Enter Product Name';
        }

        if (checkRequiredField('proddesc')) {
        
            if (matchPattern($_POST['proddesc'],"/^[a-zA-Z0-9\s\.\,\!\?\-\(\)\'\"]{1,500}$/")){
                $proddesc = $_POST['proddesc'];
            }
            else{
                $err['proddesc'] = 'Enter Valid proddesc';    
            }
            
        } else {
            $err['proddesc'] = 'Enter product description';
        }

        if (checkRequiredField('price')) {
        
            if (matchPattern($_POST['price'],"/^\d+(\.\d{1,2})?$/")){
                $price = $_POST['price'];
            }
            else{
                $err['price'] = 'Enter Valid price';    
            }
            
        } else {
            $err['price'] = 'Enter price';
        }

        if (checkRequiredField('quantity')) {
        
            if (matchPattern($_POST['quantity'],"/^[0-9]\d{0,2}$/")){
                $quantity = $_POST['quantity'];
            }
            else{
                $err['quantity'] = 'Enter Valid quantity';    
            }
            
        } else {
            $err['quantity'] = 'Enter quantity';
        }

        if (checkRequiredField('image')) {

            if (matchPattern($_POST['image'],"/^[a-zA-Z0-9_\-]+\.(jpg|jpeg|png|gif)$/i")){
                $image = $_POST['image'];
            }
            else{
                $err['image'] = 'Enter Valid image';
            }

        } else {
            $err['image'] = 'Enter image';
        }
        $f_stat= $_POST['f_stat'];
        $na_stat= $_POST['na_stat'];
        
        if(count($err) == 0){
            if (updateProduct($product_name,$proddesc,$price,$quantity,$image,$f_stat,$na_stat,$_GET['edtid'])) {
                $err['success'] = 'Add Product Success';   
            } else {
                $err['failed'] = 'Product add failed';
            }
            
        }  
    }
    if (isset($_GET['edtid']) && is_numeric($_GET['edtid'])) {
        $product = getProductById($_GET['edtid']);
        if (!$product) {
            die('Category not found');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/add_prod.css?v<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css?v=<?php echo time(); ?>">
</head>
<body>
    <section id="header">
        <?php require 'navbar.php'; ?>
    </section>
    <!--Product data add -->
    <div class="container">
        <div class="main">  	
            <?php if (isset($user)): ?>
                <h2 class="text-center">Welcome <?php echo htmlspecialchars($user['username']) ; ?>.</h2>
                <h3 class="text-center"> Lets get to work :&#41;</h3>
            <?php endif; ?>

				<div class="EditProduct">
                    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" id="edtProduct">
						<input type="text" name="product_name" id="product_name" placeholder="product name" value="<?php echo $product['prodname'] ?>">
						<?php  echo displayErrorMessage($err,'product_name')?>
						<input type="text" name="proddesc" id="proddesc" placeholder="product Description" value="<?php  echo $product['prod_desc']?>">
						<?php  echo displayErrorMessage($err,'proddesc')?>
						<input type="number" name="price" id="price" placeholder="price" value="<?php  echo $product['price'] ?>">
						<?php  echo displayErrorMessage($err,'price')?>
						<input type="number" name="quantity" id="quantity" placeholder="quantity" value="<?php echo $product['quantity']  ?>">
						<?php  echo displayErrorMessage($err,'quantity')?>
                        <div id="featured">
                            <span for="f_stat" id="fname" >featured product</span>
                            <?php if($product['f_stat'] == 0){ ?>
                            <input type="radio" name="f_stat" value="0" checked><span>Don't add</span>
                            <input type="radio" name="f_stat" value="1"><span>Add</span>
                            <?php }else{ ?>
                                <input type="radio" name="f_stat" value="0"><span>Don't add</span>
                                <input type="radio" name="f_stat" value="1"checked><span>Add</span>
                            <?php } ?>
                        </div>
                        <div id="New_arrival">
                            <span for="na_stat" id="na_name" value="<?php echo $product['na_stat'] ; ?>">New Arrival</span>
                            <?php if($product['na_stat'] == 0){ ?>
                            <input type="radio" name="na_stat" value="0" checked><span>Don't add</span>
                            <input type="radio" name="na_stat" value="1"><span>Add</span>
                            <?php }else{ ?>
                                <input type="radio" name="na_stat" value="0"><span>Don't add</span>
                                <input type="radio" name="na_stat" value="1" checked><span>Add</span>
                            <?php } ?>
                        </div>
                        <div id="image_div">
                            <span for="image" id="img_name">Image</span>
                            <input type="file" name="image" id="image" value="<?php echo $product['image'] ?>">
                        </div>

						<button type="submit" name="editProduct">Edit Product</button>
                        <div class="msg">
                            <?php  echo displaySuccessMessage($err,'success')?>
                            <?php  echo displayErrorMessage($err,'failed')?>
                        </div>
					</form>
				</div>
		</div>
	</div>
	<?php require "footer.php"; ?>

</body>
</html>