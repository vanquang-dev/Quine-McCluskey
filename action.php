<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            * {
                box-sizing: border-box;
            }
        
            body {
                background-color: #f1f1f1;
            }
        
            #regForm {
                background-color: #ffffff;
                margin: 100px auto;
                padding: 40px;
                width: 70%;
                min-width: 300px;
            }
        
            h1 {
                text-align: center;
            }
        
            button {
                background-color: darkslategray;
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                font-size: 17px;
                cursor: pointer;
            }
        
            button:hover {
                opacity: 0.8;
            }
        
            #prevBtn {
                background-color: #bbbbbb;
            }
        
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
            }
        
            .step.active {
                opacity: 1;
            }
        
            .step.finish {
                background-color: #4CAF50;
            }
        </style>
    </head>
    
    <body>
    
    <div id="regForm">
        <h1>Online Quine–McCluskey</h1>
        <div class="tab">
            <hr>
            <p style="font-family: Arial">
                Số biến là :
                <?php
                $number_of_variables = $_POST["variable"];
                echo $number_of_variables;
                ?>
                <br>
                Minterms đã nhập:
                <?php
                $minterms = $_POST["minterms"];
                echo $minterms
                ?>
            </p>
            <hr>
            <?php
            $array_of_minterms = [];
            $check_minterm = false;
            $array_of_minterms = explode(",", $minterms);
            $check_type_minterm = true;
            foreach ($array_of_minterms as $key) {
                if (!(is_numeric($key))) { // Kiểm tra xem các minterm đã nhập có phải số hay không
                    $check_type_minterm = false;
                    break;
                }
            }
            foreach ($array_of_minterms as $key) { //Kiểm tra cá minterm có nhập đúng giới hạn không
                if ($key >= pow(2, $number_of_variables)) {
                    $check_minterm = true;
                    break;
                }
            }
            if (ctype_digit($number_of_variables) && $number_of_variables <= 8 && $number_of_variables >= 0
                && $check_type_minterm && !$check_minterm) { //check the validate of inputs
                ?>
                <p>
    
                    <?php
                    @include 'main.php';
                    ?>
                </p>
            <?php } else { ?>
                <p> Đầu vào không hợp lệ!</p>
            <?php } ?>
        </div>
        <hr>
    
        <div style="overflow:auto;">
            <div style="float:right;">
                <a href="index.php" type="button" id="nextBtn" class="btn btn-success">Trở lại</a>
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
        </div>
    </div>
    
    
    </body>
</html>
