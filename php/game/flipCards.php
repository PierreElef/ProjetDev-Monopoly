<?php
function flipCards(){
    $numbers = range(1, 16);
    return shuffle($numbers);
}

?>