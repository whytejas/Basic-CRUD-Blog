<?php 
PHPinfo();

echo password_hash("kangourou", PASSWORD_DEFAULT). "\r\n";

if (password_verify("kangourou", '$2y$10$3GdWxyFLn.5iP4EOZiEYVOv49eqbzX8SK6q6kSm9TCZPRinaVaLS2')) {
    echo "ok";
}

else {echo "KO";}
?>