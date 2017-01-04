<?php

if ($_POST)
{
$num1 = $_POST['numero1'];
$num2 = $_POST['numero2'];
$resnum1 = '0';
$resnum2 = '0';

function numero1_ingles($a, $b)
{
    if(strlen($a) > strlen($b))
    {
        return -1;
    }
    else if(strlen($a) < strlen($b))
    {
        return 1;
    }
    return 0;
}

$keys = array(
    'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9',
    'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 'nineteen' => '19',
    'twenty' => '20', 'thirty' => '30', 'forty' => '40', 'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90',
    'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000'
);

preg_match_all('#((?:^|and|,| |-)*(\b' . implode('\b|\b', array_keys($keys)) . '\b))+#i', $num1, $tokens);
//print_r($tokens);
$tokens = $tokens[0];
usort($tokens, 'numero1_ingles');

foreach($tokens as $token)
{
    $token = trim(strtolower($token));
    preg_match_all('#(?:(?:and|,| |-)*\b' . implode('\b|\b', array_keys($keys)) . '\b)+#', $token, $palabras);
    $palabras = $palabras[0];
    //print_r($palabras);
    $total = 0;
    foreach($palabras as $palabra)
    {
        $palabra = trim($palabra);
        $val = $keys[$palabra];
        //echo "$val\n";
        if(bccomp($val, 100) == -1)
        {
            $resnum1 = bcadd($resnum1, $val);
            continue;
        }
        else if(bccomp($val, 100) == 0)
        {
            $resnum1 = bcmul($resnum1, $val);
            continue;
        }
        $resnum1 = bcmul($resnum1, $val);
        $total = bcadd($total, $resnum1);
        $resnum1 = '0';
    }
    $total = bcadd($total, $resnum1);
   // echo "$total:$token\n";
    $resnum1 = preg_replace("#\b$token\b#i", number_format($total), $resnum1);
}
//echo "\n$resnum1\n";


//función para convertir el segundo número
function numero2_ingles($a, $b)
{
    if(strlen($a) > strlen($b))
    {
        return -1;
    }
    else if(strlen($a) < strlen($b))
    {
        return 1;
    }
    return 0;
}

$keys = array(
    'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9',
    'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 'nineteen' => '19',
    'twenty' => '20', 'thirty' => '30', 'forty' => '40', 'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90',
    'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000'
);

preg_match_all('#((?:^|and|,| |-)*(\b' . implode('\b|\b', array_keys($keys)) . '\b))+#i', $num2, $tokens);
//print_r($tokens);
$tokens = $tokens[0];
usort($tokens, 'numero2_ingles');

foreach($tokens as $token)
{
    $token = trim(strtolower($token));
    preg_match_all('#(?:(?:and|,| |-)*\b' . implode('\b|\b', array_keys($keys)) . '\b)+#', $token, $palabras);
    $palabras = $palabras[0];
    //print_r($palabras);
    $total = 0;
    foreach($palabras as $palabra)
    {
        $palabra = trim($palabra);
        $val = $keys[$palabra];
        //echo "$val\n";
        if(bccomp($val, 100) == -1)
        {
            $resnum2 = bcadd($resnum2, $val);
            continue;
        }
        else if(bccomp($val, 100) == 0)
        {
            $resnum2 = bcmul($resnum2, $val);
            continue;
        }
        $resnum2 = bcmul($resnum2, $val);
        $total = bcadd($total, $resnum2);
        $resnum2 = '0';
    }
    $total = bcadd($total, $resnum2);
   // echo "$total:$token\n";
    $resnum2 = preg_replace("#\b$token\b#i", number_format($total), $resnum2);
}
//echo "\n$resnum2\n";


$sumar = $resnum1 + $resnum2;

if( ($sumar == 0 and $num1 != 'zero') or ($sumar == 0 and $num2 != 'zero'))
{
	$sumar = 'zero';
	//print_r($sumar);
	$resul = $sumar;
}
 else
 {
	//echo "$sumar";
	$resul = $sumar;
 }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
#apDiv1 {
	position: absolute;
	width: 388px;
	height: 197px;
	z-index: 1;
	left: 511px;
	top: 153px;
}
</style>
</head>
<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="index.php">
    <p>
      <label for="numero1"></label>
    </p>
    <p>
      <label id="form1">Número 1: </label>
      <input type="text" name="numero1" id="numero1" />
    </p>
    <p>
      <label for="numero2"></label>
      <label>Número 2: </label>
      <input type="text" name="numero2" id="numero2" />
      <input type="submit" name="sumar" id="sumar" value="  +  " />
      <label>___________________________________</label>
    </p>
    <p>
      <label>Resultado: </label>
      <input name="" type="text" readonly="readonly" value="<?php if($_POST){ echo "$resul";} ?>"  />
    </p>
  </form>
</div>
</body>
</html>