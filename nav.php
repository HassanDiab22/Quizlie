<nav class="main-header navbar navbar-expand-md navbar-dark navbar-purple">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="media/logo.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="createquizpage.php" class="nav-link">Create Quiz</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      
      <!-- Right navbar links -->
      <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <?php
            session_start();
            if(isset($_SESSION["LoggedIN"])){
              if($_SESSION["LoggedIN"]){
                echo '<li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-user pr-2"></i> '.$_SESSION["Username"].'</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="#" class="dropdown-item">profile</a></li>
                  <li class="dropdown-divider"></li>
                  <li><a href="logout.php" class="dropdown-item"><i class="fas fa-open-door"></i>Logout</a></a></li>
                </ul>
          </li>';
                }
            }else{
              echo '<a href="login.php" class="nav-link"><li><button class="btn custom-btn">Sign in</button></li></a>';
            }
            
            	
            ?>
      
    
      
        
      </div>
    </div>
  </nav>