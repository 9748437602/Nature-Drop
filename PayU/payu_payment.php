<?php
$MERCHANT_KEY = "gtKFFx"; // Test key
$SALT = "eCwWELxi"; // Test salt
$PAYU_BASE_URL = "https://test.payu.in/_payment"; // Test URL

$posted = array();
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}

$formError = 0;
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$amount = $_POST['amount'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$productinfo = "Test Product";
$success_url = "success.php";
$failure_url = "failure.php";

$hash_string = $MERCHANT_KEY."|".$txnid."|".$amount."|".$productinfo."|".$firstname."|".$email."|||||||||||".$SALT;
$hash = strtolower(hash('sha512', $hash_string));
?>

<html>
  <body onload="document.forms.payuForm.submit()">
    <h3>Redirecting to PayU...</h3>
    <form action="<?php echo $PAYU_BASE_URL; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="amount" value="<?php echo $amount ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
      <input type="hidden" name="firstname" value="<?php echo $firstname ?>" />
      <input type="hidden" name="email" value="<?php echo $email ?>" />
      <input type="hidden" name="phone" value="<?php echo $phone ?>" />
      <input type="hidden" name="surl" value="<?php echo $success_url ?>" />
      <input type="hidden" name="furl" value="<?php echo $failure_url ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    </form>
  </body>
</html>