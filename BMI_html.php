<?php
include("BMI_style.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>BMI CALCULATOR</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script></head>

<body>
    <div class="container">
        <h1>BMI CALCULATOR</h1>
        <h4>Body Mass Index</h4>

        <div class="calculator">
            <form onsubmit="return validate(event)">
                <div class="BMI">

                    <label class="text">Gender:</label>
                    <div class="gender">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="option1" checked>
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="option2">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="text">Age:</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="age" min="2" max="100" required>
                            <span class="input-group-text text" id="basic-addon2">years</span>
                        </div>
                        <div id="ageerror" style="color: red;"></div>
                    </div>
                    <div class="col-12">
                        <label class="text">Height:</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control col-5" id="feet" placeholder="FT" min="2" max="9" required>
                            <input type="number" class="form-control col-5" id="inches" placeholder="IN" min="0"
                                max="11">
                        </div>
                    </div>
                    <div id="heighterror" style="color: red;"></div>
                    <div class="col-12">
                        <label class="text">Weight:</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control col-2" id="weight" placeholder="in Kgs" min="2"
                                max="200" required>
                        </div>
                    </div>
                    <div id="weighterror" style="color: red;"></div>

                    <input type="submit" class="btn btn-outline-success " style="margin:0 35%;" value="Calculate">

                </div>
            </form>
            <div class="chart">
                <input type="text" class="form-control col-2" id="result" placeholder="Your BMI is:">
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <?php
    include("BMI_script.php");
    ?>
</body>

</html>