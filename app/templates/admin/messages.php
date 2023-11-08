<div id="messages-container">
    <h1>Messages</h1>
</div>

<?php
 echo '<span class="badge badge-primary">Total Messages: ' . $messages['total_count'] . '</span>';
if ($messages !== false) {
    echo '<ul class="list-group">';
    foreach ($messages['messages'] as $message) {
        echo '<li class="list-group-item">';
        echo '<div class="mb-2">';
        echo '<strong>From:</strong> ' . $message['firstname'] . ' ' . $message['lastname'];
        echo '</div>';
        echo '<div class="mb-2">';
        echo '<strong>Mobile:</strong> ' . $message['mobile'];
        echo '</div>';
        echo '<div class="mb-2">';
        echo '<strong>Created At:</strong> ' . $message['created_at'];
        echo '</div>';
        echo '<div>';
        echo '<strong>Message:</strong> ' . $message['contact_message'];
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
    
    // Display total message count
   
} else {
    echo 'Failed to retrieve messages.';
}
?>

