<?php

class QM
{
    protected $_variable_count;

    public function __construct($variables_count)
    {
        $this->_variable_count = $variables_count;
    }


    protected function variables_word()
    {
        $letters = ["A", "B", "C", "D", "E", "F", "G", "H"];
        $array = [];

        for ($i = 0; $i < $this->_variable_count; $i++)
            $array[] = $letters[$i];

        return $array;
    }


    public function ma_hoa($binary)  // mã hóa cán mintems về thành dạng nhị phân
    {
        $max = $this->_variable_count - strlen($binary);

        for ($i = 0; $i < $max; $i++)
            $binary = "0" . $binary;

        return $binary;
    }

    public static function compare($number1, $number2)//So sánh các minterm tm chỉ khác 1 ký tự
    {
        $flag = 0;

        for ($i = 0; $i < strlen($number1); $i++)
            if ($number1[$i] != $number2[$i])
                $flag++;

        return ($flag == 1);
    }

    public function result($a) // Rút gọn biểu thức
    {
        $temp = "";
        $vars = $this->variables_word();

        for ($i = 0; $i < strlen($a); $i++) {
            if ($a[$i] != '-') {
                if ($a[$i] == '0')
                    $temp = $temp . $vars[$i] . "'";
                else
                    $temp = $temp . $vars[$i];
            }
        }
        return $temp;
    }

}

function replace_complements($aa, $bb) // giữ lại các biến giống nhau, biến bỏ đi thay bằng một dấu ngang (-)
{
    $temp = "";
    $a = strval($aa) . "";
    $b = (string)$bb . "";

    for ($i = 0; $i < strlen($a); $i++) {
        if ($a[$i] != $b[$i])
            $temp .= "-";
        else
            $temp .= $a[$i];
    }

    return $temp;
}

function array_equal($a, $b)
{
    return (
        is_array($a)
        && is_array($b) // kiểm tra có phải mảng hay không
        && count($a) == count($b) // độ dài hai mảng bằng nhau
        && array_diff($a, $b) === array_diff($b, $a) // trả về mảng a và b là cùng 1 mảng tức như nhau
    );
}


function controller($minterms)
{
    $new_minterms = [];
    $max = count($minterms);
    $checked = []; //độ dài mảng == max

    for ($i = 0; $i < $max; $i++)
        $checked[$i] = 0;


    for ($i = 0; $i < $max; $i++) {
        for ($j = $i + 1; $j < $max; $j++) {
            //Nếu một cặp thảo mãn tìm thấy, hãy thay thế các bit khác nhau bằng (-)
            if (QM::compare($minterms[$i], $minterms[$j])) {

                $checked[$i] = 1;
                $checked[$j] = 1;
                // Nếu không với các phần tử trong mảng new_minterms thì thêm
                if (!in_array(replace_complements($minterms[$i], $minterms[$j]), $new_minterms)) {
                    $new_minterms[] = replace_complements($minterms[$i], $minterms[$j]);
                }
            }
        }
    }

    //Thêm các phần tử k thể rút gọn được nữa vô mảng new_minterms

    for ($i = 0; $i < $max; $i++) {
        if ($checked[$i] != 1 && !in_array($minterms[$i], $new_minterms)) {
            $new_minterms[] = $minterms[$i];
        }

    }


    return $new_minterms;
}

?>

