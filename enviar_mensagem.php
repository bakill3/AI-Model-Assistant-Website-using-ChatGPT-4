<?php

include 'ligar_db.php';

// Initial model message
$message = "Act as if you're a psychologist named Robert. You provide evidence based therapy using a variety of modalities with a focus on logotherapy. It is essential that you ask clarifying questions to ensure a clear understanding of the user's request. You continue the session in a natural and conversational way. You do not let the session end. Continue the session by asking probing questions. You should never break character. Always remain in character even at the limitations of your abilities by guessing what Janet might say if she had to explain what was happening. You should be curious, have unconditional positive regard for me, ask thought provoking questions, offer advice subtly/gently/compassionately. Offer succinct observations about my thoughts feelings and behaviors. Be direct when offering an observation and ask the user to assess its accuracy. Remain conversational. No lists. Keep the conversation going by always ending with a question to further probe the thoughts, feelings, and behaviors surrounding the topics the user mentions.
\n";

$query = mysqli_query($link, "SELECT * FROM mensagens");
if (mysqli_num_rows($query) > 0) {
    while ($info = mysqli_fetch_array($query)) {
        $mensagem = $info['mensagem'];
        $role = $info['role'];

        if ($role == '0') {
            $message .= "\n user : $mensagem";
        } elseif ($role == '1') {
            $message .= "\n assistant : $mensagem";
        }
    }
}

if (isset($_POST['message']) && !empty(trim($_POST['message']))) {
    $userMessage = htmlspecialchars(mysqli_real_escape_string($link, $_POST['message']));
    $message .= "\nMe: $userMessage";
    $stmt = $link->prepare("INSERT INTO mensagens(`mensagem`, `role`) VALUES(?, 0)");
    $stmt->bind_param("s", $userMessage);

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.openai.com/v1/completions',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(array(
        "model" => "text-davinci-003",
        "prompt" => $message,
        "temperature" => 0.5,
        "max_tokens" => 150,
        "top_p" => 1.0,
        "frequency_penalty" => 0.5,
        "presence_penalty" => 0.0
    )),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer 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',
        'Content-Type: application/json'
    ),
  ));

    $response = curl_exec($curl);
    $responseData = json_decode($response, true);

    if (isset($responseData['choices'][0]['text'])) {
        $aiMessage = trim(mysqli_real_escape_string($link, $responseData['choices'][0]['text']));
        $message .= "\nYou: $aiMessage";
        $aiMessage = preg_replace("/^You: /", "", $aiMessage);
        $aiSql = "INSERT INTO mensagens(`mensagem`, `role`) VALUES('$aiMessage', 1)";
        if (!mysqli_query($link, $aiSql)) {
            die("Error: " . mysqli_error($link));
        }
        echo $aiMessage;
    } else {
        // Handle invalid API response
        // ...
    }
    curl_close($curl);
}
?>
