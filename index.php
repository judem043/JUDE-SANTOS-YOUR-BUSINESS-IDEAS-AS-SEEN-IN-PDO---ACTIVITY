<?php

require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $car_model = $_POST['car_model'] ?? null;
    $rental_price = $_POST['rental_price'] ?? null;

    if ($car_model && $rental_price) {
        insertCar($pdo, $car_model, $rental_price);    
        echo "<p style='color: white;'><strong>Car inserted successfully.</strong></p>";
    } else {
        echo "<p style='color: red;'><strong>Please fill in all required fields.</strong></p>";
    }
}

$cars = getAllCars($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/a6/a2/a1/a6a2a1da32e7c2a5ea6901e29161bded.gif') no-repeat center center fixed;
            background-size: cover;
        }

        @-webkit-keyframes glow {
            from {
                text-shadow: 0 0 10px rgb(243, 133, 7), 0 0 20px rgb(245, 4, 145), 0 0 30px #e6008e, 0 0 40px #e60073, 0 0 50px #ec07a0, 0 0 60px #e600ad, 0 0 70px #f508cd;
            }
            to {
                text-shadow: 0 0 20px rgb(241, 97, 14), 0 0 30px #f73504, 0 0 40px #faa506, 0 0 50px #ff9102, 0 0 60px #ee9d08, 0 0 70px #f7b708, 0 0 80px #fd5d00;
            }
        }

        h1 {
            text-align: center;
            color: #e60073;
            animation: glow 1s ease-in-out infinite alternate;
        }

        h2 {
            text-align: center;
            color: #f73dcd;
            animation: glow 1s ease-in-out infinite alternate;
        }

        .container {
            width: 60%;
            margin: auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 
                        0vw 0vw 1.5vw 0vw #ff04de, 
                        0vw 0vw 1.5vw 0vw #d422cc;
            margin-top: 50px;
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.3);
}


        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            animation: glow 1s ease-in-out infinite alternate;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            box-shadow: inset 0vw 0vw 0vw .1vw #d422cc, 0vw 0vw 1.5vw 0vw #ff04de, 0vw 0vw 1.5vw 0vw #d422cc;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>WELCOME TO MY EXPENSIVE CAR RENTALS</h1>

    <h2>Insert Car</h2>
    <form action="index.php" method="POST">
        <input type="text" name="car_model" placeholder="Car Model" required>
        <input type="text" name="rental_price" placeholder="Rental Price" required>
        <button type="submit">Submit</button>
    </form>

    <h2>Car List</h2>
    <table>
        <thead>
            <tr>
                <th>Car ID</th>
                <th>Car Model</th>
                <th>Rental Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                    <td><?php echo htmlspecialchars($car['car_model']); ?></td>
                    <td><?php echo htmlspecialchars($car['rental_price']); ?></td>
                    <td class="action-buttons">    
                        <a href="viewcars.php?id=<?php echo $car['car_id']; ?>">Car Rent INFO</a>
                        <a href="update.php?id=<?php echo $car['car_id']; ?>">Update Car INFO</a>
                        <a href="delete.php?id=<?php echo $car['car_id']; ?>" onclick="return confirm('Are you sure you want to delete this car?');">Delete Car INFO</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
