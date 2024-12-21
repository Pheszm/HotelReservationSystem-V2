<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HMS | Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/logos/HMS_LOGO.png" />
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="CSS/all.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="CSS/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'Dashboard/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include 'Dashboard/topbar.php'; ?>
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                        <?php include 'Dashboard/Content.php'; ?>
                        <?php include 'Dashboard/Logout_modal.php'; ?>
                        <?php include 'Dashboard/chart.php'; ?>
                        <?php include 'Dashboard/request.php'; ?>
                    </div>
                </div>
                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.js"></script>
                <script src="vendor/jquery/bootstrap.bundle.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery/jquery.easing.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="vendor/jquery/sb-admin-2.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="JS/demo/chart-area-demo.js"></script>

</body>
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
</html>