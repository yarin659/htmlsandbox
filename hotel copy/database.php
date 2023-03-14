<?php
/*
    functions section
*/
function createTable($db)
{
    //Create the users table
    $db->exec("CREATE TABLE IF NOT EXISTS reservations (
    username TEXT NOT NULL,
    email TEXT NOT NULL,
    room TEXT NOT NULL,
    reserved_date DATE,
    user_message TEXT
    )");
}

function isFull($room)
{
    //build the query
    $sql = "SELECT * FROM reservations WHERE room = '$room'";

    //Execute a query to retrieve data
    $result = $db->query();

    //Loop through the results and display count them
    //The data don't really matter, the count is
    $rooms_taken = 0 
    while ($row = $result->fetchArray())
    {
        i = i+1;
    }

    return($rooms_taken >= 5);
}

function addRoom($username, $email, $room, $date, $message)
{
    // Prepare a statement to insert data into the users table
    $stmt = $db->prepare("INSERT INTO reservations (username, email, room, reserved_date, user_message)
    VALUES (:username, :email, :room, :reserved_date, :user_message)");
  
    // Bind the data to the statement
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':room', $room);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':message', $message);
    
    // Execute the statement to insert the data
    $stmt->execute();
}

// Connect to the SQLite database
$db = new SQLite3('sqlite.db');

//getting the user input
$username = $_POST['name'];
$email = $_POST['email'];
$room = $_POST['room'];
$date = $_POST['date'];
$message = $_POST['message'];

//creating the table
createTable($db);

//checking if the room reservation is full
if(!isFull($room))  
{
    addRoom($username, $email, $room, $date, $message)
}
else
{
    echo "Sorry, but all the room of the specified type have been taken."
}

// Close the database connection
$db->close();
?>