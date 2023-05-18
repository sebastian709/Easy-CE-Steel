<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ECES - Home</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="https://i.pinimg.com/564x/68/d1/fe/68d1fedb9f6e107b5e6dd68396870a54.jpg" />
  <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <link href="dist/css/style.min.css" rel="stylesheet" />
</head>

<style>
  @media (max-width: 767px) {
    .carousel-inner .carousel-item>div {
      display: none;
    }

    .carousel-inner .carousel-item>div:first-child {
      display: block;
    }
  }

  .carousel-inner .carousel-item.active,
  .carousel-inner .carousel-item-next,
  .carousel-inner .carousel-item-prev {
    display: flex;
  }

  /* medium and up screens */
  @media (min-width: 768px) {

    .carousel-inner .carousel-item-end.active,
    .carousel-inner .carousel-item-next {
      transform: translateX(25%);
    }

    .carousel-inner .carousel-item-start.active,
    .carousel-inner .carousel-item-prev {
      transform: translateX(-25%);
    }
  }

  .carousel-inner .carousel-item-end,
  .carousel-inner .carousel-item-start {
    transform: translateX(0);
  }
</style>

<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <a class="navbar-brand" href="index.html">
            <b class="logo-icon ps-2">
              <img src="assets/images/ECS.png" alt="homepage" class="light-logo" width="40" />
            </b>
            <span class="logo-text ms-2">
              EASY CE-STEEL
            </span>
          </a><a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <ul class="navbar-nav float-start me-auto">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-end">
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-account me-1 ms-1"></i> My
                  Profile</a>
                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-wallet me-1 ms-1"></i> My
                  Balance</a>
                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-email me-1 ms-1"></i> Inbox</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-settings me-1 ms-1"></i> Account
                  Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                <div class="dropdown-divider"></div>
                <div class="ps-4 p-10">
                  <a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded text-white">View Profile</a>
                </div> -->
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin5">
      <div class="scroll-sidebar">
        <!-- Sidebar navigation Test-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="pt-4">
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                <img src="assets/images/icon/home.png" alt="" class="px-2"><span class="hide-menu">Home</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="beam.php" aria-expanded="false">
                <img src="assets/images/icon/steel.png" alt="" class="px-2"><span class="hide-menu">Beam</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="column.php" aria-expanded="false">
                <img src="assets/images/icon/columnss.png" alt="" class="px-2"><span class="hide-menu">Column</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="connectiondetails.php" aria-expanded="false">
                <img src="assets/images/icon/deck.png" alt="" class="px-2"><span class="hide-menu">Connection Details</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
      <!-- Bread crumb and right sidebar toggle -->
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Home</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <!-- <li class="breadcrumb-item active" aria-current="page">
                    Library
                  </li> -->
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Container fluid  -->
      <div class="container-fluid">
        <div class="row">
          <div class="col card">
            <div class="row">
              <div class="col mt-3">
                <h3>Beam</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="container text-center my-3">
                  <div class="row mx-auto my-auto justify-content-center">
                    <div id="beam" class="carousel slide beam-carousel" data-bs-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/1.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/2.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/3.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/4.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/5.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item beam-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/6.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev bg-transparent w-aut" href="#beam" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      </a>
                      <a class="carousel-control-next bg-transparent w-aut" href="#beam" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h3>Column</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="container text-center my-3">
                  <div class="row mx-auto my-auto justify-content-center">
                    <div id="column" class="carousel slide column-carousel" data-bs-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/7.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/8.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/9.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/10.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/11.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item column-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/12.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev bg-transparent w-aut" href="#column" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      </a>
                      <a class="carousel-control-next bg-transparent w-aut" href="#column" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h3>Connection Details</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="container text-center my-3">
                  <div class="row mx-auto my-auto justify-content-center">
                    <div id="condi" class="carousel slide condi-carousel" data-bs-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active condi-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/13.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item condi-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/14.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item condi-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/15.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev bg-transparent w-aut" href="#condi" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      </a>
                      <a class="carousel-control-next bg-transparent w-aut" href="#condi" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h3>Nscp 2015</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="container-fluid text-center my-3"">
                  <div class="row mx-auto my-auto justify-content-center">
                    <div id="nscp" class="carousel slide nscp-carousel" data-bs-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U1.jpg" class="img-fluid" style="display:cover;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U2.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U3.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U4.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U5.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U6.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U7.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U8.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U9.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item nscp-item">
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-img">
                                <img src="assets/images/U10.jpg" class="img-fluid">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev bg-transparent w-aut" href="#nscp" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      </a>
                      <a class="carousel-control-next bg-transparent w-aut" href="#nscp" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer text-center">
        © 2023 — <b>Easy CE-Steel</b>
      </footer>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/extra-libs/sparkline/sparkline.js"></script>
  <script src="dist/js/waves.js"></script>
  <script src="dist/js/sidebarmenu.js"></script>
  <script src="dist/js/custom.min.js"></script>
  <script src="assets/libs/flot/excanvas.js"></script>
  <script src="assets/libs/flot/jquery.flot.js"></script>
  <script src="assets/libs/flot/jquery.flot.pie.js"></script>
  <script src="assets/libs/flot/jquery.flot.time.js"></script>
  <script src="assets/libs/flot/jquery.flot.stack.js"></script>
  <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
  <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
  <script src="dist/js/pages/chart/chart-page-init.js"></script>

  <script>
    let beam = document.querySelectorAll('.beam-carousel .beam-item')

    beam.forEach((el) => {
      const minPerSlide = 4
      let next = el.nextElementSibling
      for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
          // wrap carousel by using first child
          next = beam[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
      }
    })

    let column = document.querySelectorAll('.column-carousel .column-item')

    column.forEach((el) => {
      const minPerSlide = 4
      let next = el.nextElementSibling
      for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
          // wrap carousel by using first child
          next = column[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
      }
    })

    let condi = document.querySelectorAll('.condi-carousel .condi-item')

    condi.forEach((el) => {
      const minPerSlide = 3
      let next = el.nextElementSibling
      for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
          // wrap carousel by using first child
          next = condi[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
      }
    })

    let nscp = document.querySelectorAll('.nscp-carousel .nscp-item')

    nscp.forEach((el) => {
      const minPerSlide = 3
      let next = el.nextElementSibling
      for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
          // wrap carousel by using first child
          next = nscp[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
      }
    })
    $(document).ready(function() {
      $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').parent().closest('a').closest('div').remove();
    });
    $(document).ready(function() {

      $('.carousel-control-next.bg-transparent.w-aut').css({
        'background-image': 'linear-gradient(to right, rgba(40,40,40,0) , rgba(40,40,40,0.5))'
      });
      $('.carousel-control-prev.bg-transparent.w-aut').css('background-image', 'linear-gradient(to left, rgba(40,40,40,0) , rgba(40,40,40,0.5))');
      var data = localStorage.getItem("palette");
      var parse = JSON.parse(data);
      var array = $.map(parse, function(value, index) {
        return [value];
      });


      if (data != null) {
        console.log('OK!');
      } else {
        const lightmode = {
          info: "lightmode",
          used: [{
              name: "Black",
              color: "Angular"
            },
            {
              name: "1st Light",
              color: "Angular"
            },
            {
              name: "2nd Light",
              color: "Angular"
            },
            {
              name: "3rd Light",
              color: "Angular"
            },
          ],
        };
        localStorage.setItem("palette", JSON.stringify(lightmode));
      }
    });
  </script>


</body>

</html>