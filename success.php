<?php
// Include configuration file 
include 'connect.php';

    $pageview = $_GET['getID']; 
	$selectproduct =mysqli_query($db_conn, "select * from products where id = '$pageview' ");
    $rowproduct =mysqli_fetch_array($selectproduct,MYSQLI_ASSOC); 			
			
    $payment_id = $statusMsg = '';
    $ordStatus = 'error';

// Check whether stripe checkout session is not empty
if(!empty($_GET['session_id'])){
    $session_id = $_GET['session_id'];
    
    // Fetch transaction data from the database if already exists
    $sql = "SELECT * FROM orders WHERE checkout_session_id = '".$session_id."'";
    $result = $db_conn->query($sql);
	if ( !empty($result->num_rows) && $result->num_rows > 0) {
        $orderData = $result->fetch_assoc();
        
        $paymentID = $orderData['id'];
        $transactionID = $orderData['txn_id'];
        $paidAmount = $orderData['paid_amount'];
        $paidCurrency = $orderData['paid_amount_currency'];
        $paymentStatus = $orderData['payment_status'];
        
        $ordStatus = 'success';
        $statusMsg = 'Your Payment has been Successful!';
    }else{
        // Include Stripe PHP library 
        require_once 'stripe-php/init.php';
        
        // Set API key
        \Stripe\Stripe::setApiKey($secret_key);
        
        // Fetch the Checkout Session to display the JSON result on the success page
        try {
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        }catch(Exception $e) { 
            $api_error = $e->getMessage(); 
        }
        
        if(empty($api_error) && $checkout_session){
            // Retrieve the details of a PaymentIntent
            try {
                $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }
            
            // Retrieves the details of customer
            try {
                // Create the PaymentIntent
                $customer = \Stripe\Customer::retrieve($checkout_session->customer);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }
            
            if(empty($api_error) && $intent){ 
                // Check whether the charge is successful
                if($intent->status == 'succeeded'){
                    // Customer details
                    $name = $customer->name;
                    $email = $customer->email;
                    
                    // Transaction details 
                    $transactionID = $intent->id;
                    $paidAmount = $intent->amount;
                    $paidAmount = ($paidAmount/100);
                    $paidCurrency = $intent->currency;
                    $paymentStatus = $intent->status;
                    
					 // Insert transaction data into the database 
                    
					// $sql = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)";
                    // $insert = $db_conn->query($sql);

                    $insert = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
                    $insert ->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
           
                    $paymentID = $db_conn->insert_id;
                    
						$ordStatus = 'success';
						$statusMsg = 'Your Payment has been Successful!';
                   
                }else{
                    $statusMsg = "Transaction has been failed!";
                }
            }else{
                $statusMsg = "Unable to fetch the transaction details! $api_error"; 
            }
            
            $ordStatus = 'success';
        }else{
            $statusMsg = "Transaction has been failed! $api_error"; 
        }
    }
}else{
	$statusMsg = "Invalid Request!";
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Stripe Payment Status - codeat21 </title>
<meta charset="utf-8">
<!-- Stylesheet file -->
<link href="css/style.css" rel="stylesheet">
</head>
<body class="App">
	<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
	<div class="wrapper">
		<?php if(!empty($paymentID)){ ?>
			<h4>Payment Information</h4>
			<p><b>Reference Number:</b> <?php echo $paymentID; ?></p>
			<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
			<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
			<p><b>Payment Status:</b> <?php echo $paymentStatus; ?></p>
				
			<h4>Product Information</h4>
			<p><b>Name:</b> <?php echo $rowproduct['name']; ?></p>
			<p><b>Price:</b> <?php echo $rowproduct['price'].' '.$rowproduct['currency']; ?></p>
		<?php } ?>
		<a href="index.php" class="btn-link">Back to Product Page</a>
	</div>
</body>
</html>