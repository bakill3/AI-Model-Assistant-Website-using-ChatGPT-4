<?php
include 'ligar_db.php';

$query = mysqli_query($link, "SELECT * FROM mensagens");

$messages = array();

if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $sender = $row['role'] == 0 ? 'Gabriel Brandão' : 'Jarvis Assistant';
        $status = $row['role'] == 0 ? 'blue' : 'green';

        $message = array(
            'sender' => $sender,
            'content' => $row['mensagem'],
            'timestamp' => date('h:i A, F d, Y'), // Set the current timestamp as an example
            'status' => $status
        );
        $messages[] = $message;
    }
} else {
    die("Erro ao executar a consulta: " . mysqli_error($link));
}

// Close the database connection
mysqli_close($link);

// Return the messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>