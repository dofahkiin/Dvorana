<div class="terms home">
<?php

if($userData == null){
    echo "<a href=\"/users/add\">Registracija</a>";
    echo $this->element('login');
}
else {
    echo "<h1>Dobrodošli na stranicu sportske dvorane.</h1>";
}

?>
</div>