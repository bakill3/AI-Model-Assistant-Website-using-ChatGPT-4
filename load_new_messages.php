<?php
include 'ligar_db.php';

$query = mysqli_query($link, "SELECT * FROM mensagens ORDER BY id DESC LIMIT 1");

while ($info = mysqli_fetch_array($query)) {
    $mensagem = $info['mensagem'];
    $role = $info['role'];

    if ($role == '1') {
        $sender = "Jarvis Assistant";
        $status = "green";


        $message = array(
            'sender' => $sender,
            'content' => $info['mensagem'],
        'timestamp' => date('h:i A, F d, Y'), // Set the current timestamp as an example
        'status' => $status
        );
        $messages[] = $message;
    }
}

header('Content-Type: application/json');
echo json_encode($messages);
?>