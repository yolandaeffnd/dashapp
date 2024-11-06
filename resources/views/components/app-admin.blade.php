<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Satu Data Unand</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/admin/images/logo/unand.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="assets/admin/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="assets/admin/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <!-- jquery Ui -->
    <link rel="stylesheet" href="assets/admin/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="assets/admin/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="assets/admin/css/apexcharts.css">
    <!-- calendar Css -->
    <!-- jvector map Css -->
    <link rel="stylesheet" href="assets/admin/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="assets/admin/css/main.css">

    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<style type="text/css">
.modal {
        display: none;
        position: fixed;
        z-index: 1100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%; 
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        width: 30%;
        margin: 15% 35% 35%;
        padding: 15px;
        border: 1px solid #888;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    #menus-table {
        color: black;
    }

    #menus-table th,
    #menus-table td {
        color: black;
    }
    .card-margin{
        margin-top: 2%;
    }
</style>
<body>

<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <div class="loader"></div>
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->


    <!-- ============================ Sidebar Start ============================ -->

    <x-layouts-admin.sidebar/>
<!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">

        <x-layouts-admin.navbar/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
        <div class="dashboard-body">
            <div class='content-detail'>
            @yield('content')
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <x-layouts-admin.footer/>
    </div>

        <!-- Jquery js -->
    <script src="assets/admin/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="assets/admin/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="assets/admin/js/phosphor-icon.js"></script>
    <!-- file upload -->
    <script src="assets/admin/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="assets/admin/js/plyr.js"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- full calendar -->
    <!-- jQuery UI -->
    <script src="assets/admin/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="assets/admin/js/editor-quill.js"></script>
    <!-- apex charts -->
    <script src="assets/admin/js/apexcharts.min.js"></script>
    <!-- Calendar Js -->
    <script src="assets/admin/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="assets/admin/js/jquery-jvectormap-world-mill-en.js"></script>

    <!-- main js -->
    <script src="assets/admin/js/main.js"></script>

    </body>
</html>
