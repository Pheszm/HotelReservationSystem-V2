<?php
session_start(); // Start the session
include 'db.php'; // Include your database configuration file
// Check if the user is logged in and the username is set

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']); // Escape HTML characters
} else {
    // Redirect to login/signup form if not logged in
    header("Location: Login_SignUp_Form.php");
    exit;
}
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="messageCounter">0</span>
            </a>

            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifications
                </h6>
                <?php
                $user_id = $_SESSION['user_id'];

                try {
                    // Prepare the SQL query
                    $sql = "SELECT NotificationID, Title, Message, CreatedAt, IsRead 
            FROM notifications 
            WHERE UserID = :user_id 
            ORDER BY CreatedAt DESC";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();

                    // Check if there are any notifications
                    if ($stmt->rowCount() > 0) {
                        // Fetch and display notifications
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $notification_id = $row['NotificationID'];
                            $title = htmlspecialchars($row['Title']);
                            $message = htmlspecialchars($row['Message']);
                            $created_at = $row['CreatedAt'];
                            $is_read = $row['IsRead'] ? "text-gray-500" : "font-weight-bold"; // Styling for unread messages
                
                            echo "
            <a class='dropdown-item d-flex align-items-center notification-item' href='#' data-id='$notification_id' data-toggle='modal' data-target='#notificationModal'>
                <div class='mr-3'>
                    <div class='icon-circle bg-primary'>
                        <i class='fas fa-file-alt text-white'></i>
                    </div>
                </div>
                <div>
                    <div class='small text-gray-500'>$created_at</div>
                    <span class='$is_read'>$title</span>
                    <div class='text-truncate'>$message</div>
                </div>
            </a>";
                        }
                    } else {
                        // No notifications message
                        echo "<a class='dropdown-item text-center small text-gray-500'>No notifications available</a>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>


            </div>
        </li>

        <!-- Notification Modal -->
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog"
            aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Content will be dynamically loaded -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">2</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Messages
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Halloooo. I try lang sa ni nako as a comment example.</div>
                        <div class="small text-gray-500">Mechaela Abecia · 32m</div>
                    </div>
                    
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Halloooo. I try lang sa ni nako as a comment example.</div>
                        <div class="small text-gray-500">Mechaela Abecia · 32m</div>
                    </div>
                    
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username; ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="index.html" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.notification-item').forEach(function (item) {
            item.addEventListener('click', function () {
                const notificationId = this.getAttribute('data-id');

                // Fetch notification details
                fetch('Dashboard/get_notification.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notificationId })
                })
                    .then(response => response.json())
                    .then(data => {
                        // Update modal content
                        document.querySelector('#notificationModal .modal-body').innerHTML = `
                    <h5>${data.title}</h5>
                    <p>${data.message}</p>
                    <small class="text-muted">${data.created_at}</small>
                `;

                        // Optionally mark the notification as read visually
                        this.querySelector('span').classList.remove('font-weight-bold');
                        this.querySelector('span').classList.add('text-gray-500');

                        // Update the notification count
                        fetch('Dashboard/count_notifications.php') // Change to the correct path to count notifications
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('messageCounter').textContent = data.unread_count;
                                }
                            });
                    });

                // Mark notification as read
                fetch('Dashboard/mark_as_read.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notificationId })
                });
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch unread message count when the page loads
        fetch('Dashboard/count_unread_messages.php') // Adjust this to your PHP script path
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('#alertsDropdown .badge-counter').textContent = data.unread_count;
                }
            });

        document.querySelectorAll('.notification-item').forEach(function (item) {
            item.addEventListener('click', function () {
                const notificationId = this.getAttribute('data-id');

                // Fetch notification details
                fetch('Dashboard/get_notification.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notificationId })
                })
                    .then(response => response.json())
                    .then(data => {
                        // Update modal content
                        document.querySelector('#notificationModal .modal-body').innerHTML = `
                    <h5>${data.title}</h5>
                    <p>${data.message}</p>
                    <small class="text-muted">${data.created_at}</small>
                `;

                        // Optionally mark the notification as read visually
                        this.querySelector('span').classList.remove('font-weight-bold');
                        this.querySelector('span').classList.add('text-gray-500');

                        // Update the notification count
                        fetch('Dashboard/count_notifications.php') // Adjust this to the correct path to count notifications
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('messageCounter').textContent = data.unread_count;
                                }
                            });
                    });

                // Mark notification as read
                fetch('Dashboard/mark_as_read.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notificationId })
                });
            });
        });
    });

</script>