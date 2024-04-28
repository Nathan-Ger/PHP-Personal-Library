<?php
//I certify that this submission is my own original work
//@author Nathanael Germain
?>

<html>
<head>
    <title> BCS350 Captsone Project -- Nathanael Germain </title>
    <style>

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
        }

        .form-group label {
            flex-basis: 75px;
            flex-shrink: 0;
        }

        .form-group input {
            flex-grow: 1;
            max-width: 200px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 20px;
            display: inline-block;
        }

    </style>

    </head>

    <body>

        <div class="box">
        <?php echo "BCS350 Captsone Project -- Nathanael Germain"; ?>
        </div>

        <form action="signin.php" method="POST">
            <div class="form-group">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username:</label>
                <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="form-group">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Log In</button>
            </div>
        </form>
            
    </body>

</html>