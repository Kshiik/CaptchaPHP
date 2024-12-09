<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha</title>
</head>
<style>
*{
    margin: 0;
    padding: 0;
}
body{
    display: grid;
    align-items: center;
    justify-items: center;
    width: 100%;
    height: 100%;

    background: #ac8585;
}
p, input{
    font-size: 32px;
}
#container{
    margin: 5px;
    width:min-content;
    padding: 20px 40px;
    background-color: #f7eeee;
    border-radius: 20px;
}
#captcha{
    display: flex;
    padding-bottom: 10px;
}
#container-captcha{
    background: #fff;
    width: 100%;
    margin: 10px;
    border-radius: 10px;
    text-align: center;
    font-size: 40px;
    font-weight: bolder;
    color: #e0dede;
    transform: scale(1, -1);
}
#container-captcha p{
    font-size: 50px;
    text-decoration: line-through;

    -ms-user-select: none; 
	-moz-user-select: none; 
	-webkit-user-select: none; 
	user-select: none; 
}
#form-reset-captcha{
    margin: auto 0;
}
#form-captcha{
    display: flex;
}
#message{
    display: flex;
}
#text-message{
    padding-left: 10px;
}
</style>
<body>
<?php 
    session_start();

    // Функция str_shuffle() — встроенная функция в PHP,
    //  которая используется для случайного перемешивания всех символов строки,
    //  переданной функции в качестве параметра. 
    //  Когда передается число, 
    //  она обрабатывает число как строку и перемешивает ее.
    function random_str($length_of_str)
    {
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str), 0, $length_of_str);
    }

    $text_message = '';

    if (isset($_POST['reset-captcha']) && $_POST['reset-captcha'] == '1') {
        $_SESSION['str_captch'] = random_str(5); 
        $text_message = '';
    }

    if (!isset($_SESSION['str_captch'])) {
        $_SESSION['str_captch'] = random_str(5);
        $text_message = '';
    }

    if (isset($_POST['submit-btn'])) {
        if ($_POST['text-captcha'] == $_SESSION['str_captch']) {
            $text_message = "YAAaaaaeeeey :DDDDD";
            $_SESSION['str_captch'] = random_str(5); 
        }
        else{
            $text_message = "Noooooo :(((";
        }
    }
    else{
        $text_message = "";
    }
?>
    <div id="container">
        <p>Captcha</p>
        <div id="captcha">
            <div id="container-captcha">
                <p> <?php echo $_SESSION['str_captch']; ?> </p>
            </div>
            <form action="" method="POST" id="form-reset-captcha">
                <!-- скрытое поле для сброса капчи -->
                <input type="hidden" name="reset-captcha" value="1">
                <input type="submit" value=" Reset " id="reset-btn">
            </form>
            
        </div>
        <form action="" method="POST" id="form-captcha">
            <input type="text" name="text-captcha" id="text-captcha">
            <input type="submit" value="Submit" name="submit-btn" id="submit-btn">
        </form>
        <div id="message">
            <p>Message:</p>
            <p id="text-message"> <?php echo $text_message; ?> </p>
        </div>
    </div>
</body>
</html>