<?php
session_start();
require 'db/connection.php';



if (isset($_POST['AJAXLocator']) || isset($_GET['AJAXLocator'])) {
  if (isset($_POST['AJAXLocator'])) {
    $locator = $_POST['AJAXLocator'];
  } else {
    $locator = $_GET['AJAXLocator'];
  }
  if ($locator == "searchBeam") {
    $BSx = $_POST['data'];

    $sql = "SELECT * FROM
            (SELECT * FROM `beam_aisc` WHERE `Sx` > " . $BSx . " AND `Type` = 'w' ORDER BY `Sx` ASC LIMIT 4) b 
             ORDER BY `ID` ASC  LIMIT 3";


    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {
      $emparray[] = $row;
    }

    echo json_encode($emparray);
    exit;
  }
}


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png" />
  <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <link href="dist/css/style.min.css" rel="stylesheet" />
</head>

<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <a class="navbar-brand" href="index.html">
            <b class="logo-icon ps-2">
              <img src="assets/images/LightLogo.png" alt="homepage" class="light-logo" width="25" />
            </b>
            <span class="logo-text ms-2">
              Easy CE-Steel
            </span>
          </a><a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
              class="ti-menu ti-close"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <ul class="navbar-nav float-start me-auto">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
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
              <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/images/icon/gear.png" alt="user" class="rounded-circle" width="31" />
              </a>
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
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="pt-4">
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                <i class="fas fa-home"></i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="beam.php" aria-expanded="false">
                <img src="assets/images/icon/beam.png" alt="" class="px-2"><span class="hide-menu">Beam</span></a>
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
            <h4 class="page-title">Beam</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Beam
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Container fluid  -->
      <div class="container-fluid">
        <div class="row card">
          <div class="col-lg-12 p-5">
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-12">
                    <h3 class="mt-3 ps-4 mt-3 mb-3">Simply Supported</h3>
                    <!-- <button type="button" id="LocalStorage">Test local storage</button> -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 form-group ps-lg-5">
                    <label for="">Dead Load:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BDL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 form-group ps-lg-5">
                    <label for="">Live Load:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BLL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 form-group ps-lg-5">
                    <label for="">Length:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BLength">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 form-group ps-lg-5">
                    <label for="">Fy:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BFy">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-10 form-group ps-lg-5">
                    <label for="">Final result</label>
                    <div class="input-group mb-3">
                      <select name="" id="" class="form-control">
                        <option value="" Selected>Click to see suggestions...</option>
                      </select>
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row" style="border:1px solid #DEE2E6; border-radius: 5px 5px 0px 0px;">
                  <div class="col-12" style="border-bottom:1px solid #DEE2E6;">
                    <ul class="nav nav-tabs pt-2">
                      <li class="nav-item">
                        <a class="nav-link text-dark active" href="#" id="bvisuals">Visuals</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#" id="bother">Other Results</a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                      </li> -->
                    </ul>
                  </div>
                  <div class="col-12 bg-light py-2" style="min-height:500px;">
                    <div class="row">
                      <!-- Visuals Tab -->
                      <div class="col-12" id="visuals">
                        Comming Soon!
                      </div>
                      <!-- Other Results Tab -->
                      <div class="col-12 d-none" id="otherResults">
                        <div class="row">
                          <div class="col-12">
                            <div class="accordion" id="accordionExample">
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingThree">
                                  <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    SX
                                  </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                  aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <h5>Getting Sx:</h5>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Wu</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="BWu">
                                          <span class="input-group-text">Kn/m</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">V</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="BV">
                                          <span class="input-group-text">Kn/m</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">M</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="BM">
                                          <span class="input-group-text">Kn/m</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Fb</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="BFb">
                                          <span class="input-group-text">MPa</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Sx</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="BSx">
                                          <!-- <span class="input-group-text">MPa</span> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="heading2">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Trial Section
                                  </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <!-- Check 1 -->
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial A</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">EDI</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BEdi1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">D</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bd1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btw1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Bf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bbf1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btf1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">k1</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bk11">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Zx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzx1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">J</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bj1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Iy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Biy1">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Check 2 -->
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">EDI</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BEdi2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">D</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bd2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btw2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Bf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bbf2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btf2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">k1</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bk12">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Zx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzx2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">J</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bj2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Iy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Biy2">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Check 3 -->
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">EDI</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BEdi3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">D</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bd3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btw3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Bf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bbf3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btf3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">k1</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bk13">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Zx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzx3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">J</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bj3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Iy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Biy3">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="heading3">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Width Thickness ratio for Flange
                                  </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5 class="font-weight-light">For Flange:</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">λp</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="LambFlangeP1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">λr</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="LambFlangeR1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <h5 class="font-weight-light">For Web:</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">λp</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="LambWebP1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">λr</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="LambWebR1">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="heading4">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Analysis of Compactness
                                  </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section A</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlange1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeAns1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWeb1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebAns1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Yielding</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtYielding1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Check Resisting Moment</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResisting1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingComp1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingAns1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Bending Moment Capacity</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBending1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingComp1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingAns1">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlange2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeAns2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWeb2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebAns2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Yielding</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtYielding2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Check Resisting Moment</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResisting2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingComp2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingAns2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Bending Moment Capacity</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBending2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingComp2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingAns2">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlange3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeAns3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWeb3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebAns3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Yielding</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtYielding3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Check Resisting Moment</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResisting3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingComp3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingAns3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Bending Moment Capacity</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBending3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingComp3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingAns3">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 d-none" id="">
                        Comming Soon!
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
        <input type="hidden" id="ind">
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
        // button

        // bvisuals
        // bother

        // content

        // visuals
        // otherResults

        $('#bvisuals, #bother').on('click', function () {
          let Tab = this.id

          if (Tab == null || Tab =='bvisuals') {
            $('#bvisuals').addClass('active');
            $('#bother').removeClass('active');

            $('#visuals').removeClass('d-none');
            $('#otherResults').addClass('d-none');
          } else if (Tab == 'bother') {
            $('#bvisuals').removeClass('active');
            $('#bother').addClass('active');

            $('#visuals').addClass('d-none');
            $('#otherResults').removeClass('d-none');
          }
        });

        var BSx;
        $('#BDL, #BLL, #BLength, #BFy').on('keyup', function () {
          BSx();
        });

        function BSx() {
          // Solving Wu
          var BDL = $('#BDL').val();
          var BLL = $('#BLL').val();

          var BWu = 1.2 * BDL + 1.6 * BLL;
          var new_Bwu = BWu.toFixed(2);
          $('#BWu').val(new_Bwu);

          // Solving V 
          var BLength = $('#BLength').val();
          var BV = (BWu * BLength) / 2;
          var new_BV = BV.toFixed(2);
          $('#BV').val(new_BV);

          // Solving M
          var BLengthEx = Math.pow(BLength, 2);
          var BM = (BWu * BLengthEx) / 8;
          var new_Bm = BM.toFixed(3);
          $('#BM').val(new_Bm);

          // Solving Fb
          var BFy = $('#BFy').val();
          var BFb = 0.60 * BFy;
          var new_BFb = BFb.toFixed(3);

          $('#BFb').val(new_BFb);

          var sixqrt = Math.pow(10, 6);
          var cuberoot = Math.pow(10, 3);
          var BSx = (BM * sixqrt) / BFb;
          var FBSx = BSx / cuberoot;
          var new_FBSx = FBSx.toFixed(3);

          $('#BSx').val(new_FBSx);

          getTrialSec(new_FBSx);
        }

        // producing tester
        function getTrialSec(DBSx) {
          var FBSx = DBSx;
          $.ajax({
            url: "beam.php",
            type: "POST",
            data: {
              data: FBSx,
              AJAXLocator: "searchBeam",
            },
            dataType: 'json',
            success: function (result) {
              // Fetching EDI
              for (i = 0; i < 3; i++) {
                $('#BEdi' + (i + 1)).val(result[i]["EDI_Std_Nomenclature"]);
                $('#Bd' + (i + 1)).val(result[i]["d"]);
                $('#Btw' + (i + 1)).val(result[i]["tw"]);
                $('#Bbf' + (i + 1)).val(result[i]["bf"]);
                $('#Btf' + (i + 1)).val(result[i]["tf"]);
                $('#BTsx' + (i + 1)).val(result[i]["Sx"]);
                $('#Bk1' + (i + 1)).val(result[i]["k1"]);
                $('#Bzx' + (i + 1)).val(result[i]["Zx"]);
                $('#Bry' + (i + 1)).val(result[i]["ry"]);
                $('#Bj' + (i + 1)).val(result[i]["j"]);
                $('#Biy' + (i + 1)).val(result[i]["iy"]);
              }

              var BFy = $('#BFy').val();

              // For Flange
              var LambFlangeP1 = 0.38 * (Math.sqrt(200000 / BFy));
              $('#LambFlangeP1').val(LambFlangeP1.toFixed(3));

              var LambFlangeR1 = 1.0 * (Math.sqrt(200000 / BFy));
              $('#LambFlangeR1').val(LambFlangeR1.toFixed(3));

              // For Web
              var LambWebP1 = 3.76 * (Math.sqrt(200000 / BFy));
              $('#LambWebP1').val(LambWebP1.toFixed(3));

              var LambWebR1 = 5.70 * (Math.sqrt(200000 / BFy));
              $('#LambWebR1').val(LambWebR1.toFixed(3));

              // Analysis of Contact
              var Tbf = [];
              var Ttf = [];
              var Ttw = [];
              var Td = [];
              var Tk = [];
              var Tzx = [];
              var Ttsx = [];
              var atFlange = [];
              var AtWeb = [];
              var AtYielding = [];
              var AtResisting = [];
              var AtBending = [];

              for (var i = 0; i < 3; i++) {
                Tbf[i] = result[i]["bf"];
                Ttf[i] = result[i]["tf"];
                Ttw[i] = result[i]["tw"];
                Td[i] = result[i]["d"];
                Tk[i] = result[i]["k1"];
                Tzx[i] = result[i]["Zx"];
                Ttsx[i] = result[i]["Sx"];


                // Flange Analysis
                atFlange[i] = Tbf[i] / (2 * Ttf[i]);

                $('#AtFlange' + (i + 1)).val(atFlange[i].toFixed(3));
                $('#AtFlangeComp' + (i + 1)).val(atFlange[i].toFixed(3) + " < " + LambFlangeP1.toFixed(3));

                if (atFlange[i].toFixed(3) < LambFlangeP1.toFixed(3)) {
                  $('#AtFlangeAns' + (i + 1)).val("COMPACT").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtFlangeAns' + (i + 1)).val("NON-COMPACT").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }

                // Web Analysis
                AtWeb[i] = (Td[i] - 2 * (Tk[i])) / Ttw[i];
                $('#AtWeb' + (i + 1)).val(AtWeb[i].toFixed(3))
                $('#AtWebComp' + (i + 1)).val(AtWeb[i].toFixed(3) + " < " + LambWebP1.toFixed(3))

                if (AtWeb[i].toFixed(3) < LambWebP1.toFixed(3)) {
                  $('#AtWebAns' + (i + 1)).val("COMPACT").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtWebAns' + (i + 1)).val("NON-COMPACT").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }

                // Yielding
                AtYielding[i] = (BFy * (Tzx[i] * (Math.pow(10, 3)))) / 1000000;
                $('#AtYielding' + (i + 1)).val(AtYielding[i].toFixed(3));

                // Check Resisting Moment
                AtResisting[i] = (Ttsx[i] * 1000) * (BFy * 0.66) / 1000000;
                $('#AtResisting' + (i + 1)).val(AtResisting[i].toFixed(3));
                $('#AtResistingComp' + (i + 1)).val(AtResisting[i].toFixed(3) + " > " + $('#BM').val());

                if (AtResisting[i].toFixed(3) > $('#BM').val()) {
                  $('#AtResistingAns' + (i + 1)).val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtResistingAns' + (i + 1)).val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }

                // Bending Moment Capacity
                AtBending[i] = 0.90 * AtYielding[i].toFixed(3);
                $('#AtBending' + (i + 1)).val(AtBending[i].toFixed(3));
                $('#AtBendingComp' + (i + 1)).val(AtBending[i].toFixed(3) + " > " + $('#BM').val());

                if (AtBending[i].toFixed(3) > $('#BM').val()) {
                  $('#AtBendingAns' + (i + 1)).val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtBendingAns' + (i + 1)).val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }
              }

            }
          });
        }



        $('#LocalStorage').on('click', function () {
          var data = localStorage.getItem("palette");
          var parse = JSON.parse(data);
          var array = $.map(parse, function (value, index) {
            return [value];
          });
          console.log(array[0]);

          const darkmode = {
            info: "darkmode",
            used: [
              { name: "Black", color: "Angular" },
              { name: "1st Light", color: "Angular" },
              { name: "2nd Light", color: "Angular" },
              { name: "3rd Light", color: "Angular" },
            ],
          };
          const lightmode = {
            info: "lightmode",
            used: [
              { name: "Black", color: "Angular" },
              { name: "1st Light", color: "Angular" },
              { name: "2nd Light", color: "Angular" },
              { name: "3rd Light", color: "Angular" },
            ],
          };
          localStorage.setItem("palette", JSON.stringify(darkmode));
        });


      </script>

</body>

</html>