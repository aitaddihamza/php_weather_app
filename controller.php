<?php 

session_start();

// Api key
const API_KEY = "d1845658f92b31c64bd94f06f7188c9c";

function clean_data($data):string {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}


function fetchWeatherInfo($city) {
    $response = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid=".API_KEY."&units=metric");
    // decode json to php array
    $weather_info = json_decode($response);
    if(!isset($weather_info)) {
        $_SESSION['error'] = 'City Not Found !';
        return null;
    }
    $result = [
        'cityName' => $city,
        'description' => $weather_info->weather[0]->description,
        'temp' => $weather_info->main->temp,
        'humidity' => $weather_info->main->humidity,
        'windSpeed' => $weather_info->wind->speed,
        'flag' => strtolower($weather_info->sys->country), 
        'icon' => $weather_info->weather[0]->icon
    ];
    return $result;
}

#foreach($_SERVER as $key => $value)
    #echo "$key: $value <br />";


if(isset($_POST['location'])) {
   $lat = $_POST['lat'];
   $long = $_POST['long'];
   echo "yes";
   return ;
}

if(isset($_POST['submit'])) {
   unset($_SESSION['weather_info']);
   $cityName = clean_data($_POST['city']);
   if(strlen($cityName) < 1) {
    $_SESSION['error'] = "Please enter the city's name ";
    return header('location:index.php');
   }

   //fetchWeatherInfo($cityName);
   $_SESSION['weather_info'] = fetchWeatherInfo($cityName);
   return header('location:index.php');
}
