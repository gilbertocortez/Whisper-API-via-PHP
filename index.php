<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenAI Whisper API</title>
    <style>
        .recording-controls {
            background-color: #2b2b3a;
            border-radius: 10px;
            padding: 15px;
            color: #1ed2f4;
            margin-bottom: 20px;
        }

        .recording-controls button {
            background-color: #eafc40;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin-right: 10px;
            color: #254558;
        }

        .recording-controls audio {
            display: block;
            margin-top: 10px;
        }

        .row {
            display: flex;
        }

        .col-4 {
            flex: 1;
        }

        .col-8 {
            flex: 2;
            padding-left: 20px;
        }

        .whisper_response_display_area {
            padding: 15px;
            border: 1px solid #1ed2f4;
            border-radius: 5px;
            color: #f4f5f6;
            background-color: #254558;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>OpenAI Whisper API</h1>
        <p>This tool allows you to:</p>
        <ul>
            <li>Record voice from the user</li>
            <li>Send recorded speech file to the Whisper API for translation</li>
            <li>Process response from API and display user speech to text conversion</li>
        </ul>

        <div class="recording-controls">
            <div class="row">
                <div class="col-4">
                    <button id="start">Start recording</button>
                    <button id="stop" disabled>Stop recording</button>
                    <audio id="audio" controls></audio>
                </div>
                <div class="col-8">
                    <p class="whisper_response_display_area" id="whisper_response_display_area"></p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lamejs/1.2.0/lame.min.js"></script>
    <script src="input.js"></script>
</body>

</html>