<?php
// Secret token from GitHub webhook (set this in your GitHub webhook settings)
$secret = 'your-secret-token-here';

// Get the payload from GitHub
$payload = file_get_contents('php://input');

// Check if the signature header is set
if (!isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
    http_response_code(400);
    exit('Missing signature header');
}

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

// Verify the payload signature
if ($signature !== 'sha1=' . hash_hmac('sha1', $payload, $secret)) {
    http_response_code(403);
    exit('Invalid signature');
}

// Pull the latest changes from the repository
$output = shell_exec('cd ~/public_html/wp-content/plugins/syccase-addon && git reset --hard && git pull origin main 2>&1');

// Log the deployment and output
file_put_contents('deploy.log', date('Y-m-d H:i:s') . " - Deployment triggered\n$output\n", FILE_APPEND);

echo 'Deployment successful!';
?>
