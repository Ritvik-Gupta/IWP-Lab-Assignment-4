<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded File Page</title>

    <style>
        img {
            width: 500px;
            object-fit: cover;
            display: block;
        }

        .error-panel {
            margin: 10px auto;
            padding: 10px;
            background-color: #ff3333;
            color: white;
            border: 2px solid black;
            border-radius: 5px;
        }
    </style>

    <?php

    define("TARGET_DIRECTORY", "uploads/");
    define("SUPPORTED_FILE_TYPES", array("jpg", "jpeg", "png", "gif"));

    ?>
</head>

<body>

    <div class="error-panel">
        <?php

        if ($_SERVER['REQUEST_METHOD'] !== "POST")
            throw new Exception("Invalid Request Method Specified");

        if (!isset($_POST["submit"]))
            throw new Exception("Submit Post Request Event not detected");

        if ($_FILES["fileToUpload"]["error"] !== 0)
            throw new Exception("Unknown File Reading Error detected");
        ?>
    </div>
    <div>
        <?php

        $is_able_to_upload = true;
        $is_image_file = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if ($is_image_file !== false) {
            echo "File is an image - " . $is_image_file["mime"] . ".";
            $is_able_to_upload = true;
        } else {
            echo "File is not an image.";
            $is_able_to_upload = false;
        }

        ?>
    </div>

    <div>
        <?php

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500 * 1024) {
            echo "Sorry, your file is too large.\n";
            $is_able_to_upload = false;
        }

        $target_file_location = TARGET_DIRECTORY . basename($_FILES["fileToUpload"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file_location, PATHINFO_EXTENSION));

        // Allow certain file formats
        if (!in_array($image_file_type, SUPPORTED_FILE_TYPES)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
            $is_able_to_upload = false;
        }

        ?>
    </div>

    <div>
        <?php

        $file_has_been_uploaded = false;
        // Check if file already exists
        if (file_exists($target_file_location)) {
            echo "Sorry, file already exists.";
            $is_able_to_upload = false;
            $file_has_been_uploaded = true;
        }

        // Check if $is_able_to_upload is set to 0 by an error
        if (!$is_able_to_upload) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_location)) {
            echo "Sorry, there was an error uploading your file.";
            $file_has_been_uploaded = false;
        } else {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            $file_has_been_uploaded = true;
        }

        ?>
    </div>

    <img src="<?php
                if (!$file_has_been_uploaded)
                    echo "https://cdn4.vectorstock.com/i/1000x1000/55/63/error-404-file-not-found-web-icon-vector-21745563.jpg";
                else
                    echo $target_file_location;
                ?>">

</body>

</html>
