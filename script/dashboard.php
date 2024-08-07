<?php
include 'demo.php';
include 'config.php';

require '../vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_POST['add'])) {
    $datetimeString = $_POST['appointmentDate'];

// Create a DateTime object from the string
   $datetime = new DateTime($datetimeString);

// Get the date part
   $datei = $datetime->format('Y-m-d');

// Get the time part
    $timei = $datetime->format('H:i');

    $title = $_POST['patientName'];
    $date = $datei;
    $time = $timei;
    $duration = $_POST['appointmentDuration'];
    $timezone = $_POST['appointmentTimezone'];
    $agenda = $_POST['appointmentAgenda'];
    $C_date = $_POST['create_date'];

    $startDateTime = new DateTime($datetimeString);
    $isoStartTime = $startDateTime->format('Y-m-d\TH:i:s\Z');

    $clientId = 'DShRCM1XRGWEskL_Qssjg';
    $clientSecret = 'RCJymYBUTu1UHV4PW4Hi6jcviqcOKecg';
    $accountId = '5hnnytc8T1aZyrpObJeQRw';

    $client = new Client();
    $responsei = $client->request('POST', 'https://zoom.us/oauth/token', [
        'auth' => [$clientId, $clientSecret],
        'form_params' => [
            'grant_type' => 'account_credentials',
            'account_id' => $accountId
        ]
    ]);

    $data = json_decode($responsei->getBody(), true);
    $accessToken = $data['access_token'];

        // Create the meeting
        $responsei = $client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'topic' => $title,
                'type' => 2, // Scheduled meeting
                'start_time' => $isoStartTime,
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
        $meetingData = json_decode($responsei->getBody(), true);
    $appointmentData = [
        'title' => $title,
        'date' => $date,
        'time' => $time,
        'agenda' => $agenda,
        'meeting_id' => $meetingData['id'],
        'Join_URL: ' => $meetingData['join_url'],
        'start_URL: ' => $meetingData['start_url'],
        'done' => 0,
        'create_date' => $C_date,

    ];
    // Debugging: Print JSON data to be sent to Firebase
    echo "Sending Data to Firebase:<br>";
    echo json_encode($appointmentData) . "<br>";
    
    $response = writeToFirebase('appointments', $appointmentData, 'POST');

    // Debugging: Print response from Firebase
    echo "Firebase Response:<br>";
    print_r($response);

    if ($response) {
        echo 'Appointment created successfully';
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo 'Error creating appointment';
        if (isset($response['error'])) {
            echo 'Error: ' . $response['error']['message'];
        }
    }
}

if (isset($_POST['done'])) {
    $id = $_POST['id'];

    $appointmentData = [
        'done' => 1,
    ];
    // Debugging: Print JSON data to be sent to Firebase
    echo "Sending Data to Firebase:<br>";
    echo json_encode($appointmentData) . "<br>";
    
    $response = writeToFirebase('appointments/'. $id, $appointmentData, 'PATCH');

    // Debugging: Print response from Firebase
    echo "Firebase Response:<br>";
    print_r($response);

    if ($response) {
        echo 'Appointment created successfully';
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo 'Error creating appointment';
        if (isset($response['error'])) {
            echo 'Error: ' . $response['error']['message'];
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    echo $id;
    
    $response = deleteFromFirebase('appointments/'. $id);

    // Debugging: Print response from Firebase
    echo "Firebase Response:<br>";
    print_r($response);

        echo 'deleted';
        header('Location: \hackathon-week-1\p_dashboard');
    }
?>