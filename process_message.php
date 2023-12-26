<?php
// Start HTML output with styling
echo '<html>
        <head>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: \'Arial\', sans-serif;
                    background: url(\'airplane-wing\') center/cover no-repeat fixed;
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .message-container {
                    width: 60%;
                    margin: 0 auto; /* Center-align the container */
                }

                .message-box {
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Slight shadow */
                    border-radius: 10px; /* Rounded corners */
                    padding: 20px;
                    background-color: #fff; /* White background */
                    color: #001861; /* Black text */
                    text-align: center;
                }

                .message-box h2 {
                    margin: 0;
                }

                .submit-button {
                    background-color: #007BFF; /* Blue button color */
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                .submit-button:hover {
                    background-color: #0056b3; /* Darker blue on hover */
                }
            </style>
        </head>
        <body>
        <div class="message-container">
            <div class="message-box">
                <h2>Message Sent</h2>
            </div>
        </div>
        </body></html>';

// Delayed redirect after 5 seconds
header("refresh:5;url=passHomehtml.php");
?>
