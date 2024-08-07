<?php
require '../vendor/autoload.php';

use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topic = $_POST['topic'];
    $startTime = $_POST['start_time'];
    $duration = $_POST['duration'];
    $timezone = $_POST['timezone'];
    $agenda = $_POST['agenda'];

    // Replace these with your actual Zoom API credentials
    $clientId = 'DShRCM1XRGWEskL_Qssjg';
    $clientSecret = 'RCJymYBUTu1UHV4PW4Hi6jcviqcOKecg';
    $accountId = '5hnnytc8T1aZyrpObJeQRw';

    // Get the access token
    $client = new Client();
    $response = $client->request('POST', 'https://zoom.us/oauth/token', [
        'auth' => [$clientId, $clientSecret],
        'form_params' => [
            'grant_type' => 'account_credentials',
            'account_id' => $accountId
        ]
    ]);

    $data = json_decode($response->getBody(), true);
    $accessToken = $data['access_token'];

    // Create the meeting
    $response = $client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ],
        'json' => [
            'topic' => $topic,
            'type' => 2, // Scheduled meeting
            'start_time' => $startTime,
            'duration' => $duration,
            'timezone' => $timezone,
            'agenda' => $agenda,
            'settings' => [
                'host_video' => true,
                'participant_video' => true,
                'join_before_host' => false,
                'mute_upon_entry' => true,
                'waiting_room' => true,
            ]
        ]
    ]);

    $meetingData = json_decode($response->getBody(), true);

    echo "<h1>Meeting Created</h1>";
    echo "<p>Meeting ID: " . $meetingData['id'] . "</p>";
    echo "<p>Join URL: <a href=\"" . $meetingData['join_url'] . "\">" . $meetingData['join_url'] . "</a></p>";
    echo "<p>Start URL: <a href=\"" . $meetingData['start_url'] . "\">" . $meetingData['start_url'] . "</a></p>";
}
?>
