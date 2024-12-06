<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather app using php</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body {
            font-family: monospace;
            font-size: 18px;
            height: 100vh;
        }
        .container {
            width: 800px;
            padding: 1rem;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            border: 2px solid black;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 4rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
            padding-bottom: 3rem;
        }
        form input,
        form button {
            height: 50px;
        }
        form input {
            padding: .5rem;
        }
        form input:focus,
        form button:focus {
            outline: none;
        }
        form button:focus {
            transform: scale(1.1);
        }
        form input:focus {
            transform: scale(1.01);
        }
        form button:hover {
            box-shadow: 5px 5px 1px black;
        }
        form input {
            border: 2px solid black;
        }
        form button {
            width: 200px;
            font-size: 1.2rem;
            margin: auto;
            background-color: black;
            color: white;
            border: none;
        }
        .result {
            padding: 1rem;
            padding-bottom: 2rem;
        }
        .result h2 {
            text-align: center;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        .result p {
            text-transform: capitalize;
        }
        .result h2 > img {
            width: 80px;
        } 
        .result ul {
            font-size: 1.6rem; 
            padding-left: 1rem;    
            line-height: 2;
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Weater App</h1>
        <form action="controller.php" method="POST">
            <input type="text" name="city" placeholder="Enter the city's name ">
            <input type="hidden" name="lat" id="lat" />
            <input type="hidden" name="long" id="long" />
            <button name="submit">submit</button>
        </form>
        <div class="result">
            <?php 
            $weather_info = $_SESSION['weather_info'];
            if(isset($weather_info)) { ?>
                <h2><p><?= $weather_info['cityName'] ?></p> <img src=<?php echo "https://flagcdn.com/144x108/".$weather_info['flag'].".png" ?> alt="" /></h2>
                <p style="text-align: center; margin-bottom: 1rem;"><?php echo $weather_info['description']; ?></p>
                <img src=<?php echo "http://openweathermap.org/img/w/{$weather_info['icon']}.png"; ?> alt="icon" style="display: block; margin: auto; width: 100px;" />
                <ul>
                    <li><b>Temperature: </b><?= $weather_info['temp'] . "°C" ?></li>
                    <li><b>Humidity: </b><?= $weather_info['humidity']."%"?></li>
                    <li><b>wind speed: </b><?= $weather_info['windSpeed']." m/s" ?></li>
                </ul>
           <?php } elseif(isset($_SESSION['error'])) { echo "<h2 style='text-align: center; color: red'> {$_SESSION['error']} </h2>"; }?>
        </div>
    </div>
    <script>
        const latInput = document.getElementById('lat');
        const longInput = document.getElementById('long');

        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(position => {
                longInput.value = position.coords.longitude;
                latInput.value = position.coords.latitude;
            })
        }
        else 
            console.log("it's not defined !")
        console.log(latInput)
        console.log(longInput)

    </script>
</body>
</html>
