<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ROLES & PERMISSIONS')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #ffffff;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding-top: 20px;
            border-right: 1px solid #bdc3c7;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #ecf0f1;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px;
            margin: 5px;
            font-size: 16px;
            background-color: transparent;
        }

        .sidebar .nav-link.active {
            background-color: #2980b9;
            color: #ecf0f1;
            border-radius: 4px;
        }

        .sidebar .nav-link:hover {
            background-color: #34495e;
            color: #ecf0f1;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar Content -->
        <h3>Billing System</h3><br><br>
        <div class="nav flex-column">



                     <!--LINKS FOR CLIENTS-->

        <div class="dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="#" id="clientsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Clients
            </a>
            <div class="dropdown-menu" aria-labelledby="clientsDropdown">
                <a class="dropdown-item" href="{{ route('clients.create') }}">Add Client</a>
                <a class="dropdown-item" href="{{ route('clients.index') }}">View Clients</a>
                <a class="dropdown-item" href="{{ route('clients.inactive') }}">Inactive Clients</a>
            </div>
        </div>



            <!--LINKS FOR PERMISSIONS-->


            <div class="dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('permissions.*') ? 'active' : '' }}" href="#" id="permissionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Permissions
                </a>
                <div class="dropdown-menu" aria-labelledby="permissionsDropdown">
                    <a class="dropdown-item" href="{{ route('permissions.create') }}">Create Permission</a>
                    <a class="dropdown-item" href="{{ route('permissions.index') }}">View Permissions</a>
                </div>
            </div>
        </div>

        
        
         <!--CRUD OPERATIONS FOR ROLES-->
         <div class="dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="#" id="rolesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Roles
            </a>
            <div class="dropdown-menu" aria-labelledby="rolesDropdown">
                <a class="dropdown-item" href="{{ route('roles.create') }}">Create Role</a>
                <a class="dropdown-item" href="{{ route('roles.index') }}">View Roles</a>
            </div>
        </div>


                 <!--LINKS FOR INVOICES-->

                 <div class="dropdown">
    <a class="nav-link dropdown-toggle {{ request()->routeIs('invoices.*') ? 'active' : '' }}" href="#" id="invoicesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Invoices
    </a>
    <div class="dropdown-menu" aria-labelledby="invoicesDropdown">
        @isset($client)
            <a class="dropdown-item" href="{{ route('invoices.create', $client->id) }}">Create Invoice</a>
        @else
            <a class="dropdown-item disabled" href="#">No Client Selected</a>
        @endisset
    </div>
</div>


                 <!--LINKS FOR REPORTS-->

        <div class="dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="#" id="reportsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="reportsDropdown">
                <a class="dropdown-item" href="{{ route('reports.client') }}">General Report</a>
               
            </div>
        </div>




                 <!--LINKS FOR USERS-->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('users.*') ? 'active' : '' }}" href="#" id="usersDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Users
            </a>
            <div class="dropdown-menu" aria-labelledby="usersDropdown">
                <a class="dropdown-item" href="{{ route('users.create') }}">Create user</a>
                <a class="dropdown-item" href="{{ route('users.index') }}">View users</a>
            </div>
        </div>


       

    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
