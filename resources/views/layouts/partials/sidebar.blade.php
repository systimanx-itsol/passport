<!-- Author(Bala Devi) -->
     <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar"> 

    <section class="sidebar">
 <!-- Sidebar user panel -->
      <ul class="sidebar-menu" id="sildermenu_id">
       <li class="header">MAIN NAVIGATION</li>
     
              <!-- if have menu link for main menu  -->
            <!-- logout -->
            @if(Auth::user()->user_type == 'A')
            <li title="Logout">
              <a href="{{ url('/admin/home') }}"> 
                <i class="fa fa-home">                  
                </i> 
                <span>Home</span>
              </a>
            </li>
            @elseif(Auth::user()->user_type == 'U')
            <li title="Logout">
              <a href="{{ url('/home') }}"> 
                <i class="fa fa-home">                  
                </i> 
                <span>Home</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type == 'A')
            <li title="Logout">
              <a href="{{ url('/admin/feedback') }}"> 
                <i class="fa fa-pencil">                  
                </i> 
                <span>Feedback</span>
              </a>
            </li>
            @elseif(Auth::user()->user_type == 'U')
            <li title="Logout">
              <a href="{{ url('/feedback/create') }}"> 
                <i class="fa fa-pencil">                  
                </i> 
                <span>Feedback</span>
              </a>
            </li>
            @endif
            <li title="Logout">
            
            <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"><i class="fa fa-sign-out ">                  
                </i>Sign Out</a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            </li>

      </ul>
      <div style="height:70px;">&nbsp;</div>
   </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
   function fn_submenu(x)
   {
       window.location.href = app_url + '/api/admin/' + x;
   }
 function expressorder(){
alert(id)
 }
</script>
