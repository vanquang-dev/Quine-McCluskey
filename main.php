<?php

include "QM.php";
echo "<hr>";


$qm = new QM($number_of_variables);

$minterms = [];

//  ===============================   MAIN LOGIC   ===============================

foreach ($array_of_minterms as $minterm) {
    $minterms[] = $qm->ma_hoa(decbin($minterm));
}

sort($minterms); // Sắp xếp các mã nhị phân từ bé đến lớn

do {
    $minterms = controller($minterms);
} while ( !array_equal($minterms, controller($minterms) )); // nếu mảng minterms và mew_minterms sau n lần lặp === nhau thì dừng

echo "Biểu thức đã được rút gọn: <br><br> F = ";
for ($i = 0; $i < count($minterms)-1; $i++)
    echo $qm->result($minterms[$i]) . "+";

    echo $qm->result($minterms[$i]);

?>
