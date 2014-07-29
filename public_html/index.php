<?php
require_once(__DIR__."/../src/BVW/Helper/BuscaCEP.php");

if (isset($_POST["CEP"])) {
    die(var_dump(BuscaCEP::busca($_POST["CEP"])));
}

?>
<form name="form" id="form" method="post" action="index.php">
	<input type="text" name="CEP" id="CEP" value="">
    <input type="submit" id="btn" value="buscar">
</form>