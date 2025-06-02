<?php
function addToCart($cancion){
  $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array('track' => array(), 'cantidad' => array());

    $trackIndex = array_search( $cancion, $cart['track']);
    if ($trackIndex === false) {
      array_push($cart['track'],$cancion);
    }
    $cantidad = isset($cart['cantidad'][$cancion]) ? $cart['cantidad'][$cancion] : 0;
    $cart['cantidad'][$cancion] = 1 + $cantidad;

  return $cart;
}
function saveCart($cart){
  $_SESSION['cart'] = $cart;
}
function cleanCart(){
  unset($_SESSION['cart']);
}
function calcPrice($tracks,$cart){
  $price = 0;
  foreach($cart['track'] as $trackId){
    foreach($tracks as $trackInfo){
      if($trackId == $trackInfo['TrackId']){
        for($i = 0; $i < $cart['cantidad'][$trackId]; $i++){
          $price += $trackInfo['UnitPrice'];
        }
      }
    }
  }
  return round($price,2);
}
function getPrice($trackId,$tracks){
    foreach($tracks as $trackInfo){
      if($trackId == $trackInfo['TrackId']){
        $price = $trackInfo['UnitPrice'];
        break;
      }
    }
  return $price;
}
