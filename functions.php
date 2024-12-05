<?php
    function checkRequiredField($index){
        if (isset($_POST[$index]) && !empty($_POST[$index]) && trim($_POST[$index]) && htmlspecialchars($index)) {
            return true;
        } else {
            return false;
        }
    }
    
    function displayErrorMessage($error,$index){
        if (array_key_exists($index,$error)) {
            return "<span class='err'>" . $error[$index] . " </span>";
        }
        return false;
    }
    function displaySuccessMessage($error,$index){
        if (array_key_exists($index,$error)) {
            return "<span class='success'>" . $error[$index] . " </span>";
        }
        return false;
    }
    
    function matchPattern($var,$pattern){
        if (preg_match($pattern,$var)) {
            return true;
        }
        return false;
    }

    function addUser($username,$email,$mobile_no,$pwd){
        try{
            $connection = mysqli_connect('localhost','root','','bridge_courier');
            $insertsql = "INSERT INTO user_credentials(username, email,mobile, password) VALUES('$username', '$email' ,$mobile_no, '$pwd')";
            mysqli_query($connection,$insertsql);
        if ($connection->insert_id > 0 && $connection->affected_rows == 1) {
            return true;
        } else {
            return false;

        }
        }catch(Exception $ex){
            if (str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'username'")) {
                echo "Error: The username '{$username}' already exists.";
            }
            elseif(str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'email'")) {
                echo "Error: The email '{$email}' already exists.";
            } 
            elseif(str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'mobile'")) {
                echo "Error: The mobile no '{$mobile_no}' already exists.";
            } 
            else {
        echo "Database error: " . $ex->getMessage();
    }
        }
    }
    function addSeller($username,$address,$email,$mobile_no,$pwd){
        try{
            $connection = mysqli_connect('localhost','root','','bridge_courier');
            $insertsql = "INSERT INTO seller_credentials(username,address, email,phone_number, password) VALUES('$username','$address', '$email' ,$mobile_no, '$pwd')";
            mysqli_query($connection,$insertsql);
        if ($connection->insert_id > 0 && $connection->affected_rows == 1) {
            return true;
        } else {
            return false;

        }
        }catch(Exception $ex){
            if (str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'username'")) {
                echo "Error: The username '{$username}' already exists.";
            }
            elseif(str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'email'")) {
                echo "Error: The email '{$email}' already exists.";
            } 
            elseif(str_contains($ex->getMessage(), "Duplicate entry") && str_contains($ex->getMessage(), "for key 'mobile'")) {
                echo "Error: The mobile no '{$mobile_no}' already exists.";
            } 
            else {
        echo "Database error: " . $ex->getMessage();
    }
        }
    }
    function addProduct($product_name,$proddesc,$price,$quantity,$image,$f_stat,$na_stat){
        try{
            $connection = mysqli_connect('localhost','root','','bridge_courier');          
            $created_by= $_SESSION['user_id'];
            $cdate = date('Y-m-d H:i:s');
            $insertsql = "INSERT INTO productdetails(prodname,prod_desc, image,price, quantity,f_stat,na_stat,created_by,created_at) VALUES('$product_name','$proddesc','$image',$price,$quantity,$f_stat,$na_stat,$created_by,'$cdate')";
            mysqli_query($connection,$insertsql);
                if ($connection->insert_id > 0 && $connection->affected_rows == 1) {
                    return true;
                } else {
                    return false;
                }
        }catch(Exception $ex){
            echo "Database error: " . $ex->getMessage();
        }
    }

    
    function checkData($email_login,$pwd_login,$form_origin){
        try {
            $connect = new mysqli('localhost','root','','bridge_courier');
            //select query
            if($form_origin=='user_form'){
                $sql = sprintf(
                    "SELECT * FROM user_credentials WHERE email='%s' limit 1", 
                    $connect->real_escape_string($email_login)
                );
            }
            else if($form_origin=='seller_form'){
                $sql = sprintf(
                    "SELECT * FROM seller_credentials WHERE email='%s' limit 1", 
                    $connect->real_escape_string($email_login)
                );
            }
            $result = $connect->query($sql);
            if ($result->num_rows > 0) {
                //fetch data
                $user= $result->fetch_assoc();
                if($user){
                    if(password_verify($pwd_login,$user['password'])){
                        session_start();
                        session_regenerate_id();
                        $_SESSION['user_id']=$user['id'];
                        $_SESSION['status']=$user['status'];
                        if($form_origin=='user_form'){
                            header('location:cart.php');
                            exit;
                        }
                        else if($form_origin=='seller_form'){
                            if($user['status']=='active'){
                                header('location:sellerdashboard.php');
                                exit;
                            }else{
                                die("Your account is not active. Please contact the admin.");   
                            }
                        }

                    }
                    else {
                        return false;
                    }
                }
            }
            else{
                return false;
            }
            return true;
        } catch (\Throwable $th) {
           die('Error: ' . $th->getMessage());
        }
    }

    function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user_id'])){
            if($_SESSION['user_id']){
                try {
                    $connect = new mysqli('localhost','root','','bridge_courier');
                    if(!$_SESSION['status']){
                        $sql="SELECT * FROM user_credentials WHERE id={$_SESSION['user_id']} ";
                        $result=$connect->query($sql);
                        $user=$result ->fetch_assoc();
                        return $user;
                    }
                    else  if($_SESSION['status']=='active'){
                        $sql="SELECT * FROM seller_credentials WHERE id={$_SESSION['user_id']} AND status='active'";
                        $result=$connect->query($sql);
                        $user=$result ->fetch_assoc();
                        return $user;
                    }
                }
                catch (\Throwable $th) {
                   die('Error: ' . $th->getMessage());
                }
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    function printStatus($status)  {
        if ($status == 1) {
            return 'Active';
        } else {
            return 'Pending';
        }
    }
    function getAllProducts(){
        try {
            $connect = new mysqli('localhost','root','','bridge_courier');
            $sql = "select * from productdetails";
            $result = $connect->query($sql);
            $products = [];
            if ($result->num_rows > 0) {
                //fetch products
                while ($record= $result->fetch_assoc()) {
                    array_push($products,$record);
                }
            }
            return $products;
        } catch (\Throwable $th) {
           die('Error: ' . $th->getMessage());
        }
    }
    
    
    function getProductById($id){
        try {
            $connect = new mysqli('localhost','root','','bridge_courier');
            $sql = "select * from productdetails where prod_id=$id";
            $result = $connect->query($sql);
            if ($result->num_rows == 1) {
                $recordById= $result->fetch_assoc();
                return $recordById;
            }
            return false;
        } catch (\Throwable $th) {
           die('Error: ' . $th->getMessage());
        }
    }
    
    
    function deleteProduct($del_id){
        try {
            $connect = new mysqli('localhost','root','','bridge_courier');
            $sql = "delete from productdetails where prod_id=$del_id";
            $connect->query($sql);
            if ($connect->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
           die('Error: ' . $th->getMessage());
        }
    }
    
    function updateProduct($product_name,$proddesc,$price,$quantity,$image,$f_stat,$na_stat,$edtid){
        try {
            $connect = new mysqli('localhost','root','','bridge_courier');
            $updated_at = date('Y-m-d H:i:s');
            $updated_by= $_SESSION['user_id'];
            $sql = "update productdetails set prodname='$product_name', prod_desc='$proddesc',price=$price,quantity=$quantity,image='$image',f_stat=$f_stat,na_stat=$na_stat,updated_by=$updated_by,updated_at=$updated_at where prod_id=$edtid";
            $connect->query($sql);
            if ($connect->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
           die('Error: ' . $th->getMessage());
        }
    }

    function  checkLoginStatus(){
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['user_id'] )) {
            header('location:user_signuplogin.php');
            if (!isset($_SESSION['status'])) {
                header('location:seller_signuplogin.php');
            }
        }
    }

?>