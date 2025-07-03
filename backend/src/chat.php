<?php
function getMessages() {
    return json_decode(file_get_contents(__DIR__ . '/../database/messages.json'), true);
}

function saveMessage($sender, $text) {
    $messages = getMessages();
    $messages[] = ['sender' => $sender, 'text' => $text];
    file_put_contents(__DIR__ . '/../database/messages.json', json_encode($messages, JSON_PRETTY_PRINT));
}
