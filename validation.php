<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $email = $subject = $message = "";
    $errors = [];

    if (empty($_POST["name"])) {
        $errors[] = "Name is required.";
    } else {
        $name = clean_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email is required.";
    } else {
        $email = clean_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
    }

    if (empty($_POST["subject"])) {
        $errors[] = "Subject is required.";
    } else {
        $subject = clean_input($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $errors[] = "Message is required.";
    } else {
        $message = clean_input($_POST["message"]);
    }

    if (empty($errors)) {
        echo "<div style='padding: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;'>
                <strong>Success!</strong> Thank you, $name. Your message has been submitted successfully.
              </div>";
    } else {
        // Display errors
        echo "<ul style='color: red;'>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
