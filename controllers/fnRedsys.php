<?php
// PREPARAR ENVIO A REDSYS
function setRedsysValues($price){
	include_once './API_PHP/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
	$miObj = new RedsysAPI;
	// $url="http://sis-t.redsys.es:25443/sis/realizarPago";
  $urlOKKO="http://localhost/apps/iesmusica/controllers/cdownload.php";
  $url="http://localhost/apps/iesmusica/controllers/cdownload.php";
  // total a pagar
	$amount=floatval($price)*100;
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	// $url="";
	// $urlOKKO="http://localhost/ApiPhpRedsys/ApiRedireccion/redsysHMAC256_API_PHP_7.0.0/ejemploRecepcionaPet.php";
	$id=time();
	
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
	$miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);
	$miObj->setParameter("DS_MERCHANT_PAYMENTMETHOD",'C');
  
	//Datos de configuración
	$version="HMAC_SHA256_V1";
  $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
	// Se generan los parámetros de la petición
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($kc);

  return array('version' => $version, 'params' => $params, 'signature' => $signature);
}
// TRATAR RESPUESTA DE REDSYS
function redsysHandle($version,$datos,$signatureRecibida){
  $pagoOK = false;
    include_once './API_PHP/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
    $miObj = new RedsysAPI;
    $decodec = $miObj->decodeMerchantParameters($datos);
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
    $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
    if ($firma === $signatureRecibida){
      // codigo de respuesta:
      $responseCode = $miObj->getParameter("Ds_Response");
      $date = $miObj->getParameter("Ds_Date");
      $hour = $miObj->getParameter("Ds_Hour");
      $cardNumber = $miObj->getParameter("Ds_Card_Number");
    }
  return ($responseCode === "0000") ? array($responseCode,$date,$hour,$cardNumber) : $responseCode;
}
function pagar($redsysData){
  echo '<form id="redsysForm" name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">';
  if(isset($redsysData)){
  echo '  <input type="hidden" name="Ds_SignatureVersion" value="'. $redsysData['version'] .'"/>';
  echo '  <input type="hidden" name="Ds_MerchantParameters" value="'. $redsysData['params'] .'"/>';
  echo '  <input type="hidden" name="Ds_Signature" value="'. $redsysData['signature'] .'"/> ';
  }
  echo '  <input type="submit" name="pay" value="Finalizar Compra" class="btn btn-warning">';
  echo '</form>';
  echo '<script>document.getElementById("redsysForm").submit()</script>';
}
