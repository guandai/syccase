<?php
// filepath: public_html/deploy.php

// Secret token from GitHub webhook (set this in your GitHub webhook settings)
$secret = 'your-secret-token-here';

// Get the payload from GitHub
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

error_log("Signature from GitHub: $signature");
error_log("Computed hash: sha1=" . hash_hmac('sha1', $payload, $secret));

// Verify the payload signature
if ($signature !== 'sha1=' . hash_hmac('sha1', $payload, $secret)) {
    http_response_code(403);
    exit('Invalid signature');
}

// Pull the latest changes from the repository
shell_exec('cd /home2/yywqfyte/public_html && git reset --hard && git pull origin main');

// Log the deployment
file_put_contents('deploy.log', date('Y-m-d H:i:s') . " - Deployment triggered\n", FILE_APPEND);

echo 'Deployment successful!';
?>
