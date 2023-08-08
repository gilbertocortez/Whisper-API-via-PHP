<?php
// ------------------------------------------------------------------------------------------------------------------------
//
//  Description:    Whisper API Connection via PHP and cURL
//  Author:         Gilberto Cortez
//  Company:        Interactive Utopia
//  Website:        InteractiveUtopia.com
//
// ------------------------------------------------------------------------------------------------------------------------

// Start Server Session
session_start();

// Require Global Variables
require '../_private/global.inc.php';
// Path to the directory you want to save the files
$target_dir = "./temp/";

// Check if file is uploaded
if(isset($_FILES["audio"]["name"])) {
    // Prepare the file path
    $target_file = $target_dir . basename($_FILES["audio"]["name"]);

    // Move the uploaded file to your target directory
    if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["audio"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }

    // Prepare the headers
    $headers = [
        'Authorization: Bearer ' . OPENAI_API_KEY,
    ];

    // Create a CURLFile object / preparing the image for upload
    $cfile = new CURLFile($target_file);

    // Initialize the cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/audio/transcriptions');

    // Set the request method to POST
    curl_setopt($ch, CURLOPT_POST, 1);

    // Set the headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Prepare the request body with the file and model
    $data = [
        'file' => $cfile,
        'model' => 'whisper-1',
    ];

    // Set the request body
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Set option to return the result instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request and get the response
    $response = curl_exec($ch);

    // Check if any error occurred during the request
    if(curl_errno($ch)){
        echo 'Request Error:' . curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    // Output the response
    $_SESSION['whisper_response'] = $response;
    echo $response;
} else {
    echo "No file was uploaded.";
}