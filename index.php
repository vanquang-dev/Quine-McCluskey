<!DOCTYPE html>
<html>
    <head>
        <title> Thuật toán Quine–McCluskey | PHP </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

            input {
                padding: 10px;
                width: 100%;
                font-size: 17px;
                border: 1px solid #aaaaaa;
            }

            input.invalid {
                background-color: #ffdddd;
            }

            
            .tab {
                display: none;
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

        <form id="regForm" action="action.php" method="post">
            <h1>Online Quine–McCluskey</h1>
            <div class="tab"><b>Phần mềm viết bởi Nguyễn Văn Quang</b>
                <hr>
                <br>
                <p>
                    Mạch logic tổ hợp là một phần công cụ để chúng ta thiết kế các mạch điện tử. Bởi thế các phương pháp rút gọn mạch logic tổ hợp là một phần quan trọng trong kiến thức môn học Điện tử số. Nó có nhiều ứng dụng lớn trong nhiều lĩnh vực của điện tử.
                    Phương pháp Quine MC Cluskey là phương pháp rút gọn mạch logic tổ hợp có thể tối thiểu được hàm nhiều biến và có thể tiến hành rút gọn nhờ chương trình lập trình được trên máy tính.
                </p>
            </div>

            <div class="tab">
                <b>Nhập số biến (1-8):</b>
                <hr>
                <p><input placeholder="Số biến ..." name="variable"></p>
            </div>

            <div class="tab">
                <b>Nhập các minterms (từ 0 đến (2 ^(số biến) - 1) được phân tách bằng dấu phẩy:</b>
                <p style="font-family: Arial;" class="">Ví dụ : Số biến : 4 => minterms : 0, 1, 2, 13, 15</p>
                <hr>
                <p><input placeholder="Minterms ..."  name="minterms"></p>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Trở lại</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Tiếp tục</button>
                </div>
            </div>

            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>

        <script>
            var currentTab = 0; // Hiện tất cả các tab đầu tiên (currentTab = 0)
            showTab(currentTab);


            function showTab(n) {

                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                // nếu ở tab đầu tiên thì ẩn nút trở lại
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                // nếu ở tab cuối cùng thì ẩn nút tiếp tục
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Kết quả";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Tiếp tục";
                }
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                var x = document.getElementsByClassName("tab");
                if (n == 1 && !validateForm()) return false;
                x[currentTab].style.display = "none";
                currentTab = currentTab + n;
                if (currentTab >= x.length) {
                    document.getElementById("regForm").submit();
                    return false;
                }
                showTab(currentTab);
            }

            function validateForm() {
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                for (i = 0; i < y.length; i++) {
                    // nếu k điền số biến thì chuyển valid = false
                    if (y[i].value == "") {
                        y[i].className += " invalid";
                        valid = false;
                    }
                }
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                // trả về true hoặc false
                return valid;
            }

            function fixStepIndicator(n) {
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                x[n].className += " active";
            }
        </script>

    </body>
</html>
