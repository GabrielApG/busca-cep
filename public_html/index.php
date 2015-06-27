<?php
require_once(__DIR__."/../vendor/autoload.php");

use BVW\Correios\BuscaCEP;

$cep = filter_input(INPUT_POST, 'CEP');
if($cep) {
    $correios = new BuscaCEP();
    $correios->busca($cep);
    die();
}

?>
<form name="form" id="form" method="post" action="index.php">
	<input type="text" name="CEP" id="CEP" value="">
    <input type="submit" id="btn" value="buscar">
</form>