<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Sportify</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Exo:400,600,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
 <div id="wrapper" class="wrapper toggled">
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top sidebar-wrapper" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <button class="hamburger is-open" data-toggle="offcanvas" ><?php include('img/menu.svg'); ?></button>
            </li>
            <li class="my-profile">
                <a class="profile-picture" href="#">
                    <img src="img/profile_pic.jpg" alt="" />
                </a>
                <p class="user-name">Botzi Dimitrova</p>
            </li>
            <li>
                <a class="tournaments" href="#">Tournaments</a>
            </li>
            <li class="active">
                <a class="matches" href="#">Matches</a>
            </li>
            <li>
                <a class="standings" href="#">Standings</a>
            </li>
            <li>
                <a class="history" href="#">History</a>
            </li>
            <li>
                <a class="rules" href="#">Rules</a>
            </li>
        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper" class="page-content-wrapper">
        <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="pull-left navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <?php include('img/menu.svg'); ?>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse mobile-menu" id="mobile-menu">
              <ul class="nav navbar-nav">
                <li class="my-profile">
                    <a href="#">My Profile</a>
                </li>
                <li>
                    <a class="tournaments" href="#">Tournaments</a>
                </li>
                <li class="active">
                    <a class="matches" href="#">Matches</a>
                </li>
                <li>
                    <a class="standings" href="#">Standings</a>
                </li>
                <li>
                    <a class="history" href="#">History</a>
                </li>
                <li>
                    <a class="rules" href="#">Rules</a>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
            <h1 class="text-center">Matches</h1>
          </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid content">
            <div class="matches-filters row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form id="matches-form" method="GET">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="tournament_id" id="tournament-id" class="form-control">
                                    <option value="ALL">All joined</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input name="date_from" id="date-from" class="form-control" type="text" />
                            </div>
                            <div class="col-sm-3">
                                <input name="date_to" id="date-to" class="form-control" type="text" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                 <a class="c-btn c-datepicker-btn">
                    <span class="material-icon">calender</span>
                  </a>

                  <pre id="output"></pre>


                  
            </div>
        </div>
    </div>
    <div id="results-slider" class="results-slider">
        <div class="container-fluid">
            <div class="current-results-slider owl-carousel">
                <div class="slider-item-holder">
                    <div class="slider-item">
                        <div class="logo">
                            <img src="img/barclays-premier-league.png" alt="Barclays Premier League" />
                        </div>
                        <div class="result-info">
                            <div class="title">Barclays Premier League</div>
                            <div class="points">3p. <span class="position-up"></span></div>
                        </div>
                    </div>
                </div>
                <div class="slider-item-holder">
                <div class="slider-item">
                    <div class="logo">
                        <img src="img/la-liga-logo.png" alt="La Liga" />
                    </div>
                    <div class="result-info">
                        <div class="title">La Liga</div>
                        <div class="points">1p. <span class="position-down"></span></div>
                    </div>
                    </div>
                </div>
                <div class="slider-item-holder">
                <div class="slider-item">
                    <div class="logo">
                        <img src="img/UEFA-champions-league-logo.png" alt="UEFA Champions League" />
                    </div>
                    <div class="result-info">
                        <div class="title">UEFA Champions League</div>
                        <div class="points">3p. <span class="position-same"></span></div>
                    </div>
                    </div>
                </div>
                <div class="slider-item-holder">
                <div class="slider-item">
                    <div class="logo">
                        <img src="img/bundesliga.png" alt="bundesliga" />
                    </div>
                    <div class="result-info">
                        <div class="title">Bundesliga</div>
                        <div class="points">3p. <span class="position-up"></span></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /#page-content-wrapper -->
<script src="../lib/jquery/dist/jquery.min.js"></script>
<script src="../lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
<script src="../lib/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="../lib/chosen/chosen.jquery.js"></script>
<script src="js/script.js"></script>
</body>
</html>