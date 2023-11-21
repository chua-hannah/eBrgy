<div class="container-fluid">
    <h3>List of Inquiries</h3>
    <?php
    echo '<span class="badge badge-primary">Total Inquiries: ' . $messages['total_count'] . '</span>';
    echo '<ul class="list-group custom-list-group mt-2">';
    if ($messages !== false) {
        $counter = 1;
        foreach ($messages['messages'] as $message) {
            echo '<li class="list-group-item custom-list-group-item">';
            echo '<div class="custom-list-number">' . $counter . '</div>';
            echo '<div class="mb-2">';
            echo '<strong>From:</strong> ' . $message['firstname'] . ' ' . $message['lastname'];
            echo '</div>';
            echo '<div class="mb-2">';
            echo '<strong>Email:</strong> ' . ($message['email'] ? $message['email'] : '-');
            echo '</div>';
            echo '<div class="mb-2">';
            echo '<strong>Mobile:</strong> ' . ($message['mobile'] ? $message['mobile'] : '-');
            echo '</div>';
            echo '<div class="mb-2">';
            echo '<strong>Created At:</strong> ' . $message['created_at'];
            echo '</div>';
            echo '<div>';
            echo '<strong>Message:</strong> ' . $message['contact_message'];
            echo '</div>';
            echo '</li>';
            $counter++;
        }
    } else {
        echo 'Failed to retrieve messages.';
    }
    echo '</ul>';
    ?>
</div>