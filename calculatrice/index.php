<?php

$operators = ['+', '-', '*', '**', '/', '%'];

$nb1 = readline('Please enter the first number here : ');
while (!(is_numeric($nb1))) {
    $nb1 = readline('Please RE ENTER the first number here : ');
}

$nb2 = readline('Please enter the second number here : ');
while (!(is_numeric($nb2))) {
    $nb2 = readline('Please RE ENTER the second number here : ');
}

$op = readline('Please enter the operator here (+,-,/,*,**,%) : ');
while (!(in_array($op, $operators))) {
    $op = readline('Please enter the operator here (+,-,/,*,**,%) : ');
}

function calculator ($user_nb1, $user_nb2, $user_operator) {
    if ($user_operator == '+') {
        return $user_nb1 + $user_nb2;
    }
    elseif ($user_operator == '-') {
        return $user_nb1 - $user_nb2;
    }
    elseif ($user_operator == '*') {
        return $user_nb1 * $user_nb2;
    }
    elseif ($user_operator == '/') {
        return $user_nb1 / $user_nb2;
    }
    elseif ($user_operator == '**') {
        return $user_nb1 ** $user_nb2;
    }
    elseif ($user_operator == '%') {
        return $user_nb1 % $user_nb2;
    }
    else {
        return "";
    }
}

$result = calculator($nb1, $nb2, $op);

echo "The result of $nb1 $op $nb2 = $result\n";