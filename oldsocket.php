<?php
$context = stream_context_create();
$pem_passphrase = "";
// local_cert must be in PEM format
stream_context_set_option($context, 'ssl', 'local_cert', './server.pem');
stream_context_set_option($context, 'ssl', 'passphrase', $pem_passphrase);
stream_context_set_option($context, 'ssl', 'allow_self_signed', true);
stream_context_set_option($context, 'ssl', 'verify_peer', false);

// Create the server socket
$server = stream_socket_server('ssl://new.texnomart.uz:1212', $errno, $errstr, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN, $context);

while (true) {
    $buffer = '';
    $client = stream_socket_accept($server);
    if ($client) {
        // Read until double CRLF
        while (!preg_match('/\r?\n\r?\n/', $buffer))
            $buffer .= fread($client, 2046);
        // Respond to client
        fwrite($client, "200 OK HTTP/1.1\r\n"
            . "Connection: close\r\n"
            . "Content-Type: text/html\r\n"
            . "\r\n"
            . "Hello World! " . microtime(true)
            . "\n<pre>{$buffer}</pre>");
        fclose($client);
    }
}
?>