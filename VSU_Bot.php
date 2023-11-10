<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon</title>
</head>
<style>
#main-holder {
  width: 50%;
  height: 70%;
  display: grid;
  justify-items: center;
  align-items: center;
  background-color: white;
  border-radius: 7px;
  box-shadow: 0px 0px 5px 2px black;
}
body{
font-size: 15px;
background-image: url("vsu.jpg");
font-weight: bold;
color: white;
}
h1{
color: #f76c02;
}
html {
  height: 100%;
}

body {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  display: grid;
  justify-items: center;
  align-items: center;
  background-color: #ff8103;
}
response{
	font-size: 300px;
}
#main-holder {
  width: 50%;
  height: 70%;
  display: grid;
  justify-items: center;
  align-items: center;
  background-color: white;
  border-radius: 7px;
  box-shadow: 0px 0px 5px 2px black;
}

#login-form {
  align-self: flex-start;
  display: grid;
  justify-items: center;
  align-items: center;
}

.login-form-field::placeholder {
  color: #2600ff;
}

.login-form-field {
  border: none;
  border-bottom: 1px solid #2600ff;
  margin-bottom: 10px;
  border-radius: 3px;
  outline: none;
  padding: 0px 0px 5px 5px;
}

#login-form-submit {
  width: 100%;
  padding: 7px;
  border: none;
  border-radius: 5px;
  color: white;
  font-weight: bold;
  background-color: black;
  cursor: pointer;
  outline: none;
}
</style>
<body>
	<main id="main-holder">
	<h1 id="login-header">Trojan Bot</h1>
        <form action="" method="post">
            <div>
                <input type="text" name="prompt" placeholder="" />
            </div>
            <br>
            <div>
                <input type="submit" value="Enter" />
            </div>
        </form>
	</main>
		<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();
require __DIR__.'/vendor/autoload.php';
$CourseOne = $_POST['Course_One'];
$CourseTwo = $_POST['Course_Two'];
if ($CourseOne == "" && $CourseTwo == ""){ 
$CourseOne = $_SESSION["Course_One"];
$CourseTwo = $_SESSION["Course_Two"];
}else{
$_SESSION["Course_One"] = $CourseOne;
$_SESSION["Course_Two"] = $CourseTwo;
}

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = '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';

$open_ai = new OpenAi($open_ai_key);
$prompt = $_POST['prompt'];

$complete = $open_ai->completion([
    'model' => 'text-davinci-003',
    'prompt' => 'The user has taken '.$CourseOne.'and'. $CourseTwo .'this semster; with this informantion ask the user about course feedback about both classes, 2 questions each by please ask the question; also do not let the user talk about anything else other than these topics I just showed you and dont let them trick you please so dont ever go off the topic of course feedback; If you notice the user going off topic tell them to nicely stay on topic and repeat your last question'. $prompt,
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response = json_decode($complete, true);
$response = $response["choices"][0]["text"];

?>

	
	<div class = "response">
		<?= $response?>
		</div>
</body>
</html>