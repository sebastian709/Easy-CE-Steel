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
      $Sx[] = $row;
    }

    echo json_encode($Sx);
    exit;
  } else if ($locator == "manualsearchBeam") {
    $Medi = $_POST['data'];

    $sql = "SELECT * FROM `beam_aisc` WHERE id = " . $Medi;


    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {
      $Edi[] = $row;
    }
    echo json_encode($Edi);
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
  <title>ECES - Beam</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="https://i.pinimg.com/564x/68/d1/fe/68d1fedb9f6e107b5e6dd68396870a54.jpg" />
  <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <link href="dist/css/style.min.css" rel="stylesheet" />
</head>

<style>
  .settings {
    position: fixed;
    /* bottom: 0px; */
    top: 50%;
    right: 5px;
  }
</style>

<body>
  <script src="https://kit.fontawesome.com/4dde1986c6.js" crossorigin="anonymous"></script>
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
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="column.php" aria-expanded="false">
                <img src="assets/images/icon/deck.png" alt="" class="px-2"><span class="hide-menu">Steel Decking</span>
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
            <button type="button" class="btn btn-info settings" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height:90px; border-radius:20px 0px 0px 20px;">
              <i class="fas fa-wrench fa-xl"></i>
            </button>
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-12">
                    <h3 class="mt-3 mt-3 mb-3 d-inline">Simply Supported</h3>
                    <!-- <button type="button" id="LocalStorage">Test local storage</button> -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Dead Load:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BDL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Live Load:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BLL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Length:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BLength">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Fy:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BFy">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Final result:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="BFy">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <button class="btn btn-info form-control">Save</button>
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
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#" id="bhistory">History</a>
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
                        <img src="assets/images/beamphoto.png" width="100%" alt="">
                      </div>
                      <!-- Other Results Tab -->
                      <div class="col-12 d-none" id="otherResults">
                        <div class="row">
                          <div class="col-12">
                            <div class="accordion" id="accordionExample">
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingThree">
                                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    SX
                                  </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Trial Section
                                  </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row" id="suggestions_trial">
                                      <div class="col-12">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Suggestions</h5>
                                          </div>
                                        </div>
                                      </div>
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
                                            <label for="">W</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bw1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">A</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ba1">
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
                                            <label for="">kdes</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bkdes1">
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
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rts</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brts1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ho</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bho1">
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
                                            <label for="">ix</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bix1">
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
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brx1">
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
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">zy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzy1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">sy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bsy1">
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
                                            <label for="">cw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bcw1">
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
                                            <label for="">W</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bw2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">A</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ba2">
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
                                            <label for="">kdes</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bkdes2">
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
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rts</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brts2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ho</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bho2">
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
                                            <label for="">ix</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bix2">
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
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brx2">
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
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">zy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzy2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">sy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bsy2">
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
                                            <label for="">cw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bcw2">
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
                                            <label for="">W</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bw3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">A</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ba3">
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
                                            <label for="">kdes</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bkdes3">
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
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rts</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brts3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ho</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bho3">
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
                                            <label for="">ix</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bix3">
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
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brx3">
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
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">zy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzy3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">sy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bsy3">
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
                                            <label for="">cw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bcw3">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row" id="manual_trial">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Manual Selection</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial D</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">W</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bw4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">A</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ba4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">D</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bd4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Bf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bbf4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tf</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btf4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">kdes</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bkdes4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">k1</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bk14">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bry4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rts</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brts4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ho</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bho4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">tw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Btw4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">ix</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bix4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Zx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzx4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Sx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="BTsx4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Brx4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Iy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Biy4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">zy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bzy4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">sy</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bsy4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">J</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bj4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">cw</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Bcw4">
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
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Width Thickness ratio for Flange
                                  </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
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
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Analysis of Compactness
                                  </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row" id="suggestions_trial2">
                                      <div class="col-md-4">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section A</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtFlange1">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp1">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeP2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeR2">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" readonly id="AtFlangeAns1">
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtWeb1">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp1">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambWebP2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambWebR2">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
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
                                        <!-- <div class="row">
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
                                        </div> -->
                                      </div>
                                      <div class="col-md-4">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtFlange2">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp2">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeP3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeR3">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" readonly id="AtFlangeAns2">
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtWeb2">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp2">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambWebP3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambWebR3">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
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
                                        <!-- <div class="row">
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
                                        </div> -->
                                      </div>
                                      <div class="col-md-4">
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtFlange3">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp3">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeP4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeR4">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" readonly id="AtFlangeAns3">
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtWeb3">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp3">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambWebP4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambWebR4">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
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
                                        <!-- <div class="row">
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
                                        </div> -->
                                      </div>
                                    </div>
                                    <div class="row" id="manual_trial2">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Manual Selection</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <h5>Trial Section D</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Flange</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtFlange4">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtFlangeComp4">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeP5">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambFlangeR5">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" readonly id="AtFlangeAns4">
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Web</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λ</span>
                                              <input type="text" class="form-control" readonly id="AtWeb4">
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtWebComp4">
                                            </div> -->
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λp</span>
                                              <input type="text" class="form-control" readonly id="LambWebP5">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">λr</span>
                                              <input type="text" class="form-control" readonly id="LambWebR5">
                                            </div>
                                            <label for="" class="text-center">λ < λp</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" readonly id="AtWebAns4">
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Yielding</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Mn</span>
                                              <input type="text" class="form-control" readonly id="AtYielding4">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">LTB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lb</span>
                                              <input type="text" class="form-control" readonly id="lb4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lp</span>
                                              <input type="text" class="form-control" readonly id="lp4">
                                            </div>
                                            <label for="" class="text-center" id="ltbcondition4"></label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="lblp4">
                                            </div>
                                          </div>
                                        </div>

                                        <!-- <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Check Resisting Moment</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResisting4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingComp4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtResistingAns4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">@Bending Moment Capacity</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBending4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingComp4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="AtBendingAns4">
                                            </div>
                                          </div>
                                        </div> -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- History Tab -->
                      <div class="col-12" id="history">
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Simply Supported Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Fy Option:</label>
                    <div class="input-group mb-3">
                      <button type="button" class="btn form-control" id="manual">Manual Typing</button>
                      <button type="button" class="btn form-control" id="selections">Select ASTM</button>
                    </div>
                  </div>
                </div>
                <div class="row" id="ASTM-Column">
                  <div class="col-12 form-group">
                    <label for="">ASTM Designation:</label>
                    <div class="input-group mb-3">
                      <!-- <input type="number" class="form-control" id="BFy"> -->
                      <select name="" id="select-designation" class="form-control" disabled>
                        <option value="0" selected>Select Designation ...</option>
                        <?php
                        $sql1 = "SELECT `astm_name`, `ksi` FROM `astm`";
                        $result = mysqli_query($conn, $sql1);

                        while ($row = mysqli_fetch_assoc($result)) {
                          $astm[] = $row;
                        }

                        foreach ($astm as $value) {
                          echo "<option value='" . $value['ksi'] . "'>" . $value['astm_name'] . " - " . $value['ksi'] . "</option>";
                        }
                        ?>
                      </select>
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Case:</label>
                    <div class="input-group mb-3">
                      <button type="button" class="btn form-control" id="continous">Continous Lateral Bracing</button>
                      <button type="button" class="btn form-control" id="unbraced">Unbraced Length</button>
                    </div>
                  </div>
                </div>
                <div class="row" id="Lb-Column">
                  <div class="col-12 form-group">
                    <label for="">Lb:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="unLength">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                    <label for="" class="text-info">Note: Lb must be less than or equal to length you input above.</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Final result options</label>
                    <div class="input-group mb-3">
                      <button type="button" class="btn form-control" id="suggestions-tab">Suggestions</button>
                      <button type="button" class="btn form-control" id="manual-tab">Manually Selection</button>
                    </div>
                  </div>
                </div>
                <div class="row" id="EDI-Column">
                  <div class="col-12 form-group">
                    <label for="">EDI (Click to Select EDI)</label>
                    <select name="" id="EDISelect" class="form-control">
                      <option value="0" selected>Select EDI ...</option>
                      <?php
                      $sql2 = "SELECT *	FROM `beam_aisc` WHERE EDI_Std_Nomenclature IS NOT NULL AND ID IS NOT NULL ORDER BY ID;";
                      $result = mysqli_query($conn, $sql2);

                      while ($row = mysqli_fetch_assoc($result)) {
                        $mann[] = $row;
                      }

                      foreach ($mann as $value) {
                        echo "<option value='" . $value['ID'] . "'>" . $value['EDI_Std_Nomenclature'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row" id="sugg-Column">
                  <div class="col-12 form-group">
                    <label for="">EDI Suggestions</label>
                    <div class="input-group">
                      <select name="" id="" class="form-control">
                        <option value="" Selected>Choose ...</option>
                      </select>
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <button type="button" class="btn btn-danger form-control mt-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                  </div>
                </div>
              </div>
              <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                  </div> -->
            </div>
          </div>
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
        $(document).ready(function() {
          $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').parent().closest('a').closest('div').remove();
          // Make the DIV element draggable:

        });

        //Default value
        $('#manual').addClass('btn-info');
        $('#selections').addClass('btn-secondary');
        $('#select-designation').prop('disabled', true);
        $('#manual_trial').hide();
        $('#manual_trial2').hide();
        $('#unLength').prop('disabled', true);
        $('#continous').addClass('btn-info');
        $('#unbraced').addClass('btn-secondary');
        $('#suggestions-tab').addClass('btn-info');
        $('#manual-tab').addClass('btn-secondary');
        $('#EDISelect').prop('disabled', true);
        $('#ASTM-Column').hide();
        $('#Lb-Column').hide();
        $('#EDI-Column').hide();
        $('#unLength').val(0);
        $('#history').addClass('d-none');

        // unbraced Length Selection
        $('#unLength').on('keyup change', function() {
          let UL = $('#unLength').val();

          $('#lb4').val(UL);
        });

        // manual and select option in FY
        $('#manual, #selections').on('click', function() {
          let active = this.id;

          if (active == 'manual') {
            $('#manual').removeClass('btn-secondary').addClass('btn-info');
            $('#selections').removeClass('btn-info').addClass('btn-secondary');
            $('#select-designation').prop('disabled', true);
            $('#BFy').prop('disabled', false);
            $('#select-designation option[value="0"]').prop('selected', true);
            $('#BFy').val('');
            $('#ASTM-Column').hide();
          } else {
            $('#manual').removeClass('btn-info').addClass('btn-secondary');
            $('#selections').removeClass('btn-secondary').addClass('btn-info');
            $('#select-designation').prop('disabled', false);
            $('#BFy').prop('disabled', true);
            $('#select-designation option[value="0"]').prop('selected', true);
            $('#BFy').val('');
            $('#ASTM-Column').show();
          }

        });

        // selecting ASTM
        $('#select-designation').on('change', function() {
          let ksi = $('#select-designation').val();
          ksi = ksi * 6.895;
          $('#BFy').val(ksi.toFixed(0));
        });

        // Case Button for unbraced and continous
        $('#continous, #unbraced').on('click', function() {
          let cases = this.id;

          if (cases == 'continous') {
            $('#unLength').val(0).prop('disabled', true);
            $('#continous').removeClass('btn-secondary').addClass('btn-info');
            $('#unbraced').removeClass('btn-info').addClass('btn-secondary');
            $('#Lb-Column').hide();
            $('#lb4').val(0);


          } else {
            $('#unLength').val(0).prop('disabled', false);
            $('#continous').removeClass('btn-info').addClass('btn-secondary');
            $('#unbraced').removeClass('btn-secondary').addClass('btn-info');
            $('#Lb-Column').show();
            $('#lb4').val(0);

          }

        });

        // Trial manual and suggestions tab event
        $('#suggestions-tab, #manual-tab').on('click', function() {
          let Tab = this.id;

          if (Tab == 'suggestions-tab') {
            $('#suggestions-tab').removeClass('btn-secondary').addClass('btn-info');
            $('#manual-tab').removeClass('btn-info').addClass('btn-secondary');
            $('#suggestions_trial').show();
            $('#manual_trial').hide();
            $('#suggestions_trial2').show();
            $('#manual_trial2').hide();
            $('#EDISelect').prop('disabled', true);
            $('#EDI-Column').hide();
            $('#sugg-Column').show();
            $('#EDISelect option[value="0"]').prop('selected', true);
          } else {
            $('#suggestions-tab').removeClass('btn-info').addClass('btn-secondary');
            $('#manual-tab').removeClass('btn-secondary').addClass('btn-info');
            $('#suggestions_trial').hide();
            $('#manual_trial').show();
            $('#suggestions_trial2').hide();
            $('#manual_trial2').show();
            $('#EDISelect').prop('disabled', false);
            $('#EDI-Column').show();
            $('#sugg-Column').hide();
            $('#EDISelect option[value="0"]').prop('selected', true);
          }
        });

        // Main Tabs
        $('#bvisuals, #bother, #bhistory').on('click', function() {
          let Tab = this.id

          if (Tab == null || Tab == 'bvisuals') {
            $('#bvisuals').addClass('active');
            $('#bother').removeClass('active');
            $('#bhistory').removeClass('active');

            $('#visuals').removeClass('d-none');
            $('#otherResults').addClass('d-none');
            $('#history').addClass('d-none');
          } else if (Tab == 'bother') {
            $('#bvisuals').removeClass('active');
            $('#bother').addClass('active');
            $('#bhistory').removeClass('active');

            $('#visuals').addClass('d-none');
            $('#otherResults').removeClass('d-none');
            $('#history').addClass('d-none');
          } else if (Tab == 'bhistory') {
            $('#bvisuals').removeClass('active');
            $('#bother').removeClass('active');
            $('#bhistory').addClass('active');

            $('#visuals').addClass('d-none');
            $('#otherResults').addClass('d-none');
            $('#history').removeClass('d-none');
          }
        });



        // Getting SX Events
        var BSx;
        $('#BDL, #BLL, #BLength, #BFy').on('keyup', function() {
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
            success: function(result) {
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

                // additionals
                $('#Bw' + (i + 1)).val(result[i]["w"]);
                $('#Ba' + (i + 1)).val(result[i]["A"]);
                $('#Bkdes' + (i + 1)).val(result[i]["kdes"]);
                $('#Brts' + (i + 1)).val(result[i]["rts"]);
                $('#Bho' + (i + 1)).val(result[i]["ho"]);
                $('#Bix' + (i + 1)).val(result[i]["ix"]);
                $('#Brx' + (i + 1)).val(result[i]["rx"]);
                $('#Bzy' + (i + 1)).val(result[i]["zy"]);
                $('#Bsy' + (i + 1)).val(result[i]["sy"]);
                $('#Bcw' + (i + 1)).val(result[i]["cw"]);
              }

              var BFy = $('#BFy').val();

              // For Flange
              for (i = 0; i < 5; i++) {
                var LambFlangeP1 = 0.38 * (Math.sqrt(200000 / BFy));
                $('#LambFlangeP' + (i + 1)).val(LambFlangeP1.toFixed(3));

                var LambFlangeR1 = 1.0 * (Math.sqrt(200000 / BFy));
                $('#LambFlangeR' + (i + 1)).val(LambFlangeR1.toFixed(3));

                // For Web
                var LambWebP1 = 3.76 * (Math.sqrt(200000 / BFy));
                $('#LambWebP' + (i + 1)).val(LambWebP1.toFixed(3));

                var LambWebR1 = 5.70 * (Math.sqrt(200000 / BFy));
                $('#LambWebR' + (i + 1)).val(LambWebR1.toFixed(3));

              }
              // Analysis of Compact
              var Tbf = [];
              var Ttf = [];
              var Ttw = [];
              var Td = [];
              var Tk = [];
              var Tzx = [];
              var Ttsx = [];
              var Tkdes = [];

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
                Tkdes[i] = result[i]["kdes"];


                // Flange Analysis
                atFlange[i] = Tbf[i] / (2 * Ttf[i]);

                $('#AtFlange' + (i + 1)).val(atFlange[i].toFixed(3));
                $('#AtFlangeComp' + (i + 1)).val(atFlange[i].toFixed(3) + " < " + LambFlangeP1.toFixed(3));

                if (parseFloat(atFlange[i].toFixed(3)) < parseFloat(LambFlangeP1.toFixed(3))) {
                  $('#AtFlangeAns' + (i + 1)).val("COMPACT").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtFlangeAns' + (i + 1)).val("NON-COMPACT").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }

                // Web Analysis
                AtWeb[i] = (Td[i] - 2 * (Tk[i])) / Ttw[i];
                $('#AtWeb' + (i + 1)).val(AtWeb[i].toFixed(3))
                $('#AtWebComp' + (i + 1)).val(AtWeb[i].toFixed(3) + " < " + LambWebP1.toFixed(3))

                if (parseFloat(AtWeb[i].toFixed(3)) < parseFloat(LambWebP1.toFixed(3))) {
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

                if (parseFloat(AtResisting[i].toFixed(3)) > parseFloat($('#BM').val())) {
                  $('#AtResistingAns' + (i + 1)).val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtResistingAns' + (i + 1)).val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }

                // Bending Moment Capacity
                AtBending[i] = 0.90 * AtYielding[i].toFixed(3);
                $('#AtBending' + (i + 1)).val(AtBending[i].toFixed(3));
                $('#AtBendingComp' + (i + 1)).val(AtBending[i].toFixed(3) + " > " + $('#BM').val());

                if (parseFloat(AtBending[i].toFixed(3)) > parseFloat($('#BM').val())) {
                  $('#AtBendingAns' + (i + 1)).val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
                } else {
                  $('#AtBendingAns' + (i + 1)).val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
                }
              }

            }
          });
        }

        // Manual Selection Events
        $('#EDISelect').on('change', function() {
          let edid = $('#EDISelect').val();
          getmanualtrial(edid);
        });

        // Fetching manual Selection of Trial D
        function getmanualtrial(Medi) {
          let Fmedi = Medi;

          $.ajax({
            url: "beam.php",
            type: "POST",
            data: {
              data: Fmedi,
              AJAXLocator: "manualsearchBeam",
            },
            dataType: 'json',
            success: function(result) {
              // Fetching Manual EDI Trial D

              $('#Bd4').val(result[0]["d"]);
              $('#Btw4').val(result[0]["tw"]);
              $('#Bbf4').val(result[0]["bf"]);
              $('#Btf4').val(result[0]["tf"]);
              $('#BTsx4').val(result[0]["Sx"]);
              $('#Bk14').val(result[0]["k1"]);
              $('#Bzx4').val(result[0]["Zx"]);
              $('#Bry4').val(result[0]["ry"]);
              $('#Bj4').val(result[0]["j"]);
              $('#Biy4').val(result[0]["iy"]);

              // additionals
              $('#Bw4').val(result[0]["w"]);
              $('#Ba4').val(result[0]["A"]);
              $('#Bkdes4').val(result[0]["kdes"]);
              $('#Brts4').val(result[0]["rts"]);
              $('#Bho4').val(result[0]["ho"]);
              $('#Bix4').val(result[0]["ix"]);
              $('#Brx4').val(result[0]["rx"]);
              $('#Bzy4').val(result[0]["zy"]);
              $('#Bsy4').val(result[0]["sy"]);
              $('#Bcw4').val(result[0]["cw"]);

              var BFy = $('#BFy').val();

              // For Flange
              var LambFlangeP1 = 0.38 * (Math.sqrt(200000 / BFy));

              var LambFlangeR1 = 1.0 * (Math.sqrt(200000 / BFy));

              // For Web
              var LambWebP1 = 3.76 * (Math.sqrt(200000 / BFy));

              var LambWebR1 = 5.70 * (Math.sqrt(200000 / BFy));

              let mTbf = result[0]["bf"];
              let mTtf = result[0]["tf"];
              let mTtw = result[0]["tw"];
              let mTd = result[0]["d"];
              let mTk = result[0]["k1"];
              let mTzx = result[0]["Zx"];
              let mTtsx = result[0]["Sx"];
              let mTkdes = result[0]["kdes"];


              // Flange Analysis
              let matFlange = mTbf / (2 * mTtf);

              $('#AtFlange4').val(matFlange.toFixed(3));
              $('#AtFlangeComp4').val(matFlange.toFixed(3) + " < " + LambFlangeP1.toFixed(3));

              if (parseFloat(matFlange.toFixed(3)) < parseFloat(LambFlangeP1.toFixed(3))) {
                $('#AtFlangeAns4').val("COMPACT").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
              } else {
                $('#AtFlangeAns4').val("NON-COMPACT").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
              }

              // Web Analysis
              let mAtWeb = (mTd - 2 * (mTkdes)) / mTtw;
              $('#AtWeb4').val(mAtWeb.toFixed(3))
              $('#AtWebComp4').val(mAtWeb.toFixed(3) + " < " + LambWebP1.toFixed(3))

              if (parseFloat(mAtWeb.toFixed(3)) < parseFloat(LambWebP1.toFixed(3))) {
                $('#AtWebAns4').val("COMPACT").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
              } else {
                $('#AtWebAns4').val("NON-COMPACT").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
              }

              // Yielding
              let mAtYielding = (BFy * (mTzx * (Math.pow(10, 3)))) / 1000000;
              $('#AtYielding4').val(mAtYielding.toFixed(3));

              // Check Resisting Moment
              let mAtResisting = (mTtsx * 1000) * (BFy * 0.66) / 1000000;
              $('#AtResisting4').val(mAtResisting.toFixed(3));
              $('#AtResistingComp4').val(mAtResisting.toFixed(3) + " > " + $('#BM').val());

              if (parseFloat(mAtResisting.toFixed(3)) > parseFloat($('#BM').val())) {
                $('#AtResistingAns4').val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
              } else {
                $('#AtResistingAns4').val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
              }

              // Bending Moment Capacity
              let mAtBending = 0.90 * mAtYielding.toFixed(3);
              $('#AtBending4').val(mAtBending.toFixed(3));
              $('#AtBendingComp4').val(mAtBending.toFixed(3) + " > " + $('#BM').val());

              if (parseFloat(mAtBending.toFixed(3)) > parseFloat($('#BM').val())) {
                $('#AtBendingAns4').val("SAFE").removeClass('bg-danger text-light border border-secondary').addClass('bg-success text-light border border-secondary');
              } else {
                $('#AtBendingAns4').val("NOT-SAFE").removeClass('bg-success text-light border border-secondary').addClass('bg-danger text-light border border-secondary');
              }
            }
          });
        };



        $('#LocalStorage').on('click', function() {
          var data = localStorage.getItem("palette");
          var parse = JSON.parse(data);
          var array = $.map(parse, function(value, index) {
            return [value];
          });
          console.log(array[0]);

          const darkmode = {
            info: "darkmode",
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
          localStorage.setItem("palette", JSON.stringify(darkmode));
        });
        $(document).ready(function() {
          $('#btn').draggable();
        });
      </script>

</body>

</html>