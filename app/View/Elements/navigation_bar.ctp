<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> 
        </a><a class="brand" href="/" style="padding: 0px 20px 5px;"> <?php echo $this->Html->image('medifix_dashboard.png'); ?> </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
<!--          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">FAQ</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>-->
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user-md"></i> <?php echo ucwords($current_user['username']); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                  <?php
                    echo $this->Html->link('<i class="icon-user"></i> Profile', array('controller' => 'accounts', 'action' => 'view', $current_user['id']), array('escape' => false));
                    ?>
              </li>
              <li>
                  <?php
                    echo $this->Html->link('<i class="icon-off"></i> Logout', array('controller' => 'accounts', 'action' => 'logout'), array('escape' => false));
                    ?>
              </li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>