<?php
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';
$page_title = ucwords(str_replace('-', ' ', $active_tab));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $page_title; ?></title>
    <link rel="icon" type="image/png" href="./image/home-log.png">
    <link rel="stylesheet" href="admin-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
            :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f94144;
            --sidebar-width: 250px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            color: white;
            height: 100vh;
            position: fixed;
            transition: var(--transition);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            margin-left: 10px;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-left: 4px solid var(--accent-color);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 20px;
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .header h2 {
            color: var(--dark-color);
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .card-icon.users {
            background-color: var(--primary-color);
        }

        .card-icon.orders {
            background-color: var(--success-color);
        }

        .card-icon.revenue {
            background-color: var(--warning-color);
        }

        .card-icon.products {
            background-color: var(--danger-color);
        }

        .card-title {
            font-size: 14px;
            color: #6c757d;
        }

        .card-value {
            font-size: 24px;
            font-weight: 600;
            margin: 5px 0;
        }

        .card-change {
            font-size: 12px;
            color: #28a745;
        }

        .card-change.negative {
            color: #dc3545;
        }

        .tab-content {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            min-height: 400px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-color);
        }

        .recent-orders {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .recent-orders th, .recent-orders td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .recent-orders th {
            background-color: #f8f9fa;
            font-weight: 500;
            color: #495057;
        }

        .recent-orders tr:hover {
            background-color: #f8f9fa;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.processing {
            background-color: #cce5ff;
            color: #004085;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }
            
            .sidebar-header h3, .menu-item span {
                display: none;
            }
            
            .menu-item {
                justify-content: center;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .main-content {
                margin-left: 80px;
                width: calc(100% - 80px);
            }
        }

        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 0;
                position: fixed;
                z-index: 1000;
            }
            
            .sidebar.active {
                width: 250px;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .menu-toggle {
                display: block !important;
            }
        }

        .menu-toggle {
            display: none;
            font-size: 20px;
            cursor: pointer;
            margin-right: 15px;
        }
</style>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fa fa-shield" aria-hidden="true"></i>
            <h3>Bing Chilling</h3>
        </div>
        <div class="sidebar-menu">
            <a href="?tab=dashboard" class="menu-item <?php echo $active_tab == 'dashboard' ? 'active' : ''; ?>">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
            <a href="?tab=users" class="menu-item <?php echo $active_tab == 'users' ? 'active' : ''; ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Users</span>
            </a>
            <a href="?tab=test-creation" class="menu-item <?php echo $active_tab == 'test-creation' ? 'active' : ''; ?>">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                <span>Test Creation</span>
            </a>
            <a href="?tab=learning-path" class="menu-item <?php echo $active_tab == 'learning-path' ? 'active' : ''; ?>">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>Learning Path</span>
            </a>
            <a href="?tab=college-course" class="menu-item <?php echo $active_tab == 'college-course' ? 'active' : ''; ?>">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <span>College Course</span>
            </a>
            <a href="?tab=points-edit" class="menu-item <?php echo $active_tab == 'points-edit' ? 'active' : ''; ?>">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <span>Points Edit</span>
            </a>
            <a href="?tab=logout" class="menu-item <?php echo $active_tab == 'logout' ? 'active' : ''; ?>">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>


    <div class="main-content">

        <div class="header">
            <div class="menu-toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <h2 id="tab-title"><?php echo $page_title; ?></h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                <span>Bing Chilling</span>
            </div>
        </div>


        <?php
     
        $content_file = "{$active_tab}.php";
        if (file_exists($content_file)) {
            include($content_file);
        } else {
            include("admin_dashboard.php");
        }
        ?>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

    
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 576 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>