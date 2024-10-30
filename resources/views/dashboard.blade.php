<x-app-layout>
    <div class="div">
                <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sidebar Dropdown Menu</title>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f9;
            }

            .dashboard-header {
                background-color: #fff;
                padding: 20px;
                margin-left: 250px; /* Adjust to match the sidebar width */
                border-bottom: 1px solid #ddd;
            }

            .sidebar {
                background-color: #2d2f3e;
                width: 250px;
                height: 100vh;
                position: relative;
                margin-top: 0px; /* Adds space below the dashboard */
                float: left;
            }

            .menu {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .menu-item {
                position: relative;
            }

            .menu-link {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                color: #fff;
                text-decoration: none;
                font-size: 16px;
                background-color: #2d2f3e;
                border-bottom: 1px solid #404357;
                cursor: pointer;
            }

            .menu-link i {
                margin-right: 10px;
            }

            .submenu {
                list-style: none;
                padding: 0;
                margin: 0;
                display: none;
                background-color: #1c1e29;
            }

            .submenu li a {
                padding: 10px 20px;
                display: block;
                color: #bbb;
                text-decoration: none;
                font-size: 14px;
            }

            .submenu li a:hover {
                background-color: #373949;
                color: #fff;
            }

            .menu-item.active .submenu {
                display: block;
            }

            .dropdown-icon {
                font-size: 12px;
            }

            .menu-item:hover > .menu-link {
                background-color: #404357;
            }

            .content {
                margin-left: 250px; /* Adjust to match the sidebar width */
                padding: 20px;
                background-color: #fff;
            }
            </style>
        </head>
        
        <body>

            <div class="sidebar">
                <ul class="menu">

                <!--LINK FOR CLIENTS MODULES-->

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Clients <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a class="dropdown-item" href="{{ route('clients.create') }}">Add Client</a></li>
                            <li><a class="dropdown-item" href="{{ route('clients.index') }}">View Clients</a></li>
                            <li><a class="dropdown-item" href="{{ route('clients.inactive') }}">Inactive Clients</a></li>
                        </ul>
                    </li>


                    

                <!--LINK FOR PERMISSIONS MODULES-->

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Permissions <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">Create Permission</a></li>
                            <li><a href="#">View Permissions</a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Roles <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">Create Role</a></li>
                            <li><a href="#">View Roles</a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Invoices <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">No Client Selected</a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Reports <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">General Report</a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link" onclick="toggleDropdown(this)">
                            Users <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">Create user</a></li>
                            <li><a href="#">View users</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <script>
                function toggleDropdown(element) {
                    var menuItem = element.parentElement;
                    menuItem.classList.toggle('active');
                }
            </script>

        </body>
        </html>

    </div>

</x-app-layout>







