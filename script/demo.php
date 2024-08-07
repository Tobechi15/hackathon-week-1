<?php
function firebaseRequest($url, $data = null, $method = 'GET') {
    $ch = curl_init();
    $headers = ['Content-Type: application/json'];

    if ($data) {
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $headers[] = 'Content-Length: ' . strlen($data);
    }

    if ($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
    } else if ($method == 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    } else if ($method == 'PATCH') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    } else if ($method == 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function writeToFirebase($path, $data, $method = 'PUT') {
    $url = FIREBASE_URL . $path . '.json';
    return firebaseRequest($url, $data, $method);
}

function readFromFirebase($path) {
    $url = FIREBASE_URL . $path . '.json';
    return firebaseRequest($url);
}
function deleteFromFirebase($path) {
    $url = FIREBASE_URL . $path . '.json';
    return firebaseRequest($url, null, 'DELETE');
}
?>
