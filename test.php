<?php 
echo "bonjour \r\n";
echo password_hash("bonjour", PASSWORD_DEFAULT). "\r\n";

if (password_verify("bonjour", '$2y$10$Shl3q15HfAy8UhJ7shH4bO2N7LsytKrb7o5fsHPNeqvlrl0w4.4oO')) {
    echo "ok";
}

else {echo "KO";}
?>