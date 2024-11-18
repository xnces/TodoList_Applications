<?php
include 'db.php';
$id = $_GET['id'];

$sqlupdate = "SELECT * FROM tasks WHERE id = :id";
$stmtupdate = $pdo->prepare($sqlupdate);
$stmtupdate->execute(['id'=>$id]);
$updates = $stmtupdate->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    

    // Update the task in the database
    $stmt = $pdo->prepare("UPDATE tasks SET task = ? WHERE id = ?");
    $stmt->execute([$task,$id]);

    // Redirect back to index.php after update
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <style>
      * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f5efe4; /* Light brown background */
    color: #5c3d2e; /* Brown text */
    line-height: 1.6;
}

/* Header Styling */
h1 {
    text-align: center;
    padding: 20px;
    background-color: #a67c52; /* Medium brown */
    color: white;
}

/* Form Styling */
form {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

form input[type="text"] {
    padding: 10px;
    width: 60%;
    border: 1px solid #d2b48c; /* Tan border */
    border-radius: 5px;
    font-size: 16px;
}

form button {
    padding: 10px 15px;
    margin-left: 10px;
    background-color: #a67c52; /* Medium brown */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color: #8b5e34; /* Darker brown on hover */
}

/* Task List Styling */
ul {
    list-style-type: none;
    padding: 0;
    margin-top: 20px;
}

li {
    background-color: #fffaf0; /* Light cream */
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Link Styling */
a {
    color: #a67c52; /* Medium brown */
    text-decoration: none;
    margin-left: 10px;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Styling */
@media screen and (max-width: 600px) {
    form input[type="text"] {
        width: 70%;
    }

    form button {
        width: 30%;
        margin-left: 5px;
    }
}
    </style>
    
</head>
<body>
    <h1 style="font-size:70px;margin-left:270px">TODO LIST </h1>
    

<form method="post">
        <input type="text" name="task" placeholder="" value="<?php echo htmlspecialchars($updates['task']?? ''); ?>"><br><br>

        <button type="submit" class="btn-submit">Update Task</button>
    </form>
        
</body>
</html>