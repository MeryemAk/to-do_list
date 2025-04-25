<?php
// Start the session to store tasks temporarily
session_start();

// Check if the task has been submitted and is not empty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task']) && !empty($_POST['task'])) {
    // Add the new task to the session array
    $_SESSION['tasks'][] = $_POST['task'];
}

// Check if a task should be deleted
if (isset($_GET['delete'])) {
    $taskIndex = $_GET['delete']; // Get the task index to delete
    // Remove the task from the array
    if (isset($_SESSION['tasks'][$taskIndex])) {
        unset($_SESSION['tasks'][$taskIndex]);
        // Re-index the array to fix gaps after deletion
        $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    }
    // Redirect to the same page after deletion to clear the query string
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>To-do list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-do list</h1>
    <form method="POST" id="form" action="">
        <input type="text" name="task" id="task" placeholder="Add a new task">
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php
        // Check if there are tasks in the session
        if (isset($_SESSION['tasks'])) {
            foreach ($_SESSION['tasks'] as $index => $task) {
                echo "<li>" . htmlspecialchars($task) . "<a href='?delete=$index' class='delete-btn'>X</a></li>";
            }
        } else {
            echo "<li>No tasks available yet.</li>";
        }
        ?>
    </ul>

    <div class="pomodoro">
    <script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
    <div class="commonninja_component pid-38a72caa-2b4a-49f0-8cf1-43a7e6eabb86"></div>
    </div>
</body> 
</html>