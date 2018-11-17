<!-- Main Header -->
<header class="main-header">
<!-- Logo -->
<a href="{{ url('api/admin/home') }}" class="logo">
   <!-- mini logo for sidebar mini 50x50 pixels -->
   <span class="logo-mini"> Admin</span>
   <!-- logo for regular state and mobile devices -->
   
   <span class="logo-lg" style="font-size: 14px;"><b> Admin</b></span>
</a>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
   <!-- Sidebar toggle button-->
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
   <span class="sr-only">Toggle navigation</span>
   </a>
   <!-- Navbar Right Menu -->
   <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
         <!-- User Account Menu -->
          
         <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <!-- The user image in the navbar-->
               <img src="{{ asset('/images/user2-160x160.jpg') }}" class="user-image" alt="User Image"/>
               <!-- hidden-xs hides the username on small devices so only the image appears. -->
               <span class="hidden-xs">Welcome <?php echo Auth::user()->name ?></span>
            </a>
         </li>
         <!-- Control Sidebar Toggle Button -->
         <li><a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form></li>
      </ul>
   </div>
</nav>
</header>

<script src="<?php echo asset('js/common.js?v='.time()); ?>"></script>