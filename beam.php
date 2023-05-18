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
                  <div class="col-lg-12 mb-3">
                    <h3 class="mt-3 mt-3 mb-3 d-inline">Simply Supported</h3>
                    <!-- <button type="button" id="LocalStorage">Test local storage</button> -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Type of Beam:</label>
                    <div class="input-group mb-3">
                      <select name="" class="form-control" id="TOB">
                        <option value="0" disabled selected>Select Type of Beam...</option>
                        <option value="1">Both Ends are supported by hinged and roller</option>
                        <option value="2">Fixed on both ends</option>
                        <option value="3">Fixed at one end</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row variations">
                  <div class="col-12 form-group">
                    <label for="">Variation:</label>
                    <div class="input-group mb-3">
                      <select name="" class="form-control" id="Types">
                        <option value="0" disabled selected>Select Variation...</option>

                        <option value="1" class="BE">Uniform distributed load</option>
                        <option value="2" class="BE">Concentrated load at the center</option>
                        <option value="3" class="BE">Uniform distributed load and Concentrated load at the center</option>

                        <option value="4" class="FB">Uniform Distributed Load</option>
                        <option value="5" class="FB">Concentrated load at the center</option>

                        <option value="6" class="FO">Uniform distributed load</option>
                        <option value="7" class="FO">Concentrated load at the free end</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Pu:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="Pu">
                      <span class="input-group-text">Kn/m</span>
                    </div>
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
                    <label for=""><b> Final result:</b></label>
                    <div class="input-group mb-3">
                      <span class="input-group-text bg-dark text-light">EDI</span>
                      <input type="text" class="form-control bg-dark text-light" id="FinalApp">
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-12 form-group">
                    <button class="btn btn-info form-control">Save</button>
                  </div>
                </div> -->
              </div>
              <div class="col-lg-6">
                <div class="row" style="border:1px solid #DEE2E6; border-radius: 5px 5px 0px 0px;">
                  <div class="col-12" style="border-bottom:1px solid #DEE2E6;">
                    <ul class="nav nav-tabs pt-2">
                      <li class="nav-item">
                        <a class="nav-link text-dark active" href="#" id="bvisuals">Figures</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#" id="bother">Outcome</a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link text-dark" href="#" id="bhistory">History</a>
                      </li> -->
                      <!-- <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                      </li> -->
                    </ul>
                  </div>
                  <div class="col-12 bg-light py-2 overflow-auto" style="min-height:70vh; max-height:70vh;">
                    <div class="row">
                      <!-- Visuals Tab -->
                      <div class="col-12" id="visuals" style="max-height:70vh;">
                        <img src="assets/images/1.jpg" width="100%" alt="">
                        <img src="assets/images/2.jpg" width="100%" alt="">
                        <img src="assets/images/3.jpg" width="100%" alt="">
                        <img src="assets/images/4.jpg" width="100%" alt="">
                        <img src="assets/images/5.jpg" width="100%" alt="">
                        <img src="assets/images/6.jpg" width="100%" alt="">
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
                                        <label for="Wu">Mu</label>
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
                                        <div class="row" id="flb-col">
                                          <div class="col form-group">
                                            <label for="">FLB</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="mn1">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">LTB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lb</span>
                                              <input type="text" class="form-control" value="0" readonly id="lb1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lp</span>
                                              <input type="text" class="form-control" readonly id="lp1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lr</span>
                                              <input type="text" class="form-control" value="0" readonly id="lr1">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">LTB</span>
                                              <input type="text" class="form-control" value="0" readonly id="ltb1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">∅Mn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmall1">
                                            </div>
                                            <label for="">Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmu1">
                                            </div>
                                            <label for="">∅Mn > Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="FinRes1">
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
                                        <div class="row" id="flb-col">
                                          <div class="col form-group">
                                            <label for="">FLB</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="mn2">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">LTB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lb</span>
                                              <input type="text" class="form-control" value="0" readonly id="lb2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lp</span>
                                              <input type="text" class="form-control" readonly id="lp2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lr</span>
                                              <input type="text" class="form-control" value="0" readonly id="lr2">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">LTB</span>
                                              <input type="text" class="form-control" value="0" readonly id="ltb2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">∅Mn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmall2">
                                            </div>
                                            <label for="">Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmu2">
                                            </div>
                                            <label for="">∅Mn > Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="FinRes2">
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
                                        <div class="row" id="flb-col">
                                          <div class="col form-group">
                                            <label for="">FLB</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="mn3">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">LTB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lb</span>
                                              <input type="text" class="form-control" value="0" readonly id="lb3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lp</span>
                                              <input type="text" class="form-control" readonly id="lp3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lr</span>
                                              <input type="text" class="form-control" value="0" readonly id="lr3">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">LTB</span>
                                              <input type="text" class="form-control" value="0" readonly id="ltb3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">∅Mn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmall3">
                                            </div>
                                            <label for="">Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmu3">
                                            </div>
                                            <label for="">∅Mn > Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="FinRes3">
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
                                              <span class="input-group-text">Mp</span>
                                              <input type="text" class="form-control" readonly id="AtYielding4">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row" id="flb-col">
                                          <div class="col form-group">
                                            <label for="">FLB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Mn</span>
                                              <input type="text" class="form-control" readonly id="mn4">
                                              <span class="input-group-text">kNm</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">LTB</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lb</span>
                                              <input type="text" class="form-control" value="0" readonly id="lb4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lp</span>
                                              <input type="text" class="form-control" readonly id="lp4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">Lr</span>
                                              <input type="text" class="form-control" value="0" readonly id="lr4">
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text">LTB</span>
                                              <input type="text" class="form-control" value="0" readonly id="ltb4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">∅Mn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmall4">
                                            </div>
                                            <label for="">Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Finmu4">
                                            </div>
                                            <label for="">∅Mn > Mu</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="FinRes4">
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
        $('.BE').addClass('d-none');
        $('.FB').addClass('d-none');
        $('.FO').addClass('d-none');
        $('.variations').addClass('d-none');

        // Types of Beam
        $('#TOB').on('change', function() {
          let TOB = $('#TOB').val();

          if (TOB > 0) {
            $('.variations').removeClass('d-none');
            if (TOB == 1) {
              $('.BE').removeClass('d-none');
              $('.FB').addClass('d-none');
              $('.FO').addClass('d-none');
            } else if (TOB == 2) {
              $('.BE').addClass('d-none');
              $('.FB').removeClass('d-none');
              $('.FO').addClass('d-none');
            } else if (TOB == 3) {
              $('.BE').addClass('d-none');
              $('.FB').addClass('d-none');
              $('.FO').removeClass('d-none');
            }
          } else {
            $('.variations').addClass('d-none');
          }
        });

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

            for (x = 1; x < 4; x++) {
              $('#lb' + x).val(0);
            }


          } else {
            $('#unLength').val(0).prop('disabled', false);
            $('#continous').removeClass('btn-info').addClass('btn-secondary');
            $('#unbraced').removeClass('btn-secondary').addClass('btn-info');
            $('#Lb-Column').show();
            $('#lb4').val(0);

          }

        });


        //LB
        $('#unLength').on('keyup', function() {
          for (x = 1; x < 4; x++) {
            $('#lb' + x).val($('#unLength').val());
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
        $('#BDL, #BLL, #BLength, #BFy, #Types, #EDISelect').on('keyup change', function() {
          BSx();
          let edid = $('#EDISelect').val();
          getmanualtrial(edid);
        });

        function BSx() {
          // Solving Wu
          var BDL = $('#BDL').val();
          var BLL = $('#BLL').val();
          var BLength = $('#BLength').val();


          // Solving Mu
          let beamTypes = $('#Types').val();
          let bPu = $('#Pu').val();



          if (beamTypes == 1) {
            $('#Pu').prop('disabled', true).val('');
            $('#BDL').prop('disabled', false);
            $('#BLL').prop('disabled', false);

            var BWu = 1.2 * BDL + 1.6 * BLL;
            var new_Bwu = BWu.toFixed(2);
            $('#BWu').val(new_Bwu);

            var BV = (BWu * BLength) / 2;
            var new_BV = BV.toFixed(2);
            $('#BV').val(new_BV);

            let Mu = (BWu * (BLength ** 2)) / 8;
            $('#BM').val(Mu.toFixed(3));

          } else if (beamTypes == 2) {
            $('#Pu').prop('disabled', false);
            $('#BDL').prop('disabled', true).val('');
            $('#BLL').prop('disabled', true).val('');

            var BWu = 1.2 * BDL + 1.6 * BLL;
            var new_Bwu = BWu.toFixed(2);
            $('#BWu').val(new_Bwu);

            var BV = bPu / 2;
            var new_BV = BV.toFixed(2);
            $('#BV').val(new_BV);

            let Mu2 = (bPu * BLength) / 4;

            $('#BM').val(Mu2);

          } else if (beamTypes == 3) {
            $('#Pu').prop('disabled', false);
            $('#BDL').prop('disabled', false);
            $('#BLL').prop('disabled', false);

            var BWu = 1.2 * BDL + 1.6 * BLL;
            var new_Bwu = BWu.toFixed(2);
            $('#BWu').val(new_Bwu);

            var BV = (BWu * BLength) / 2;
            var new_BV = BV.toFixed(2);
            $('#BV').val(new_BV);

            let Mu3 = ((BWu * (BLength ** 2)) / 8) + ((bPu * BLength) / 4);
            $('#BM').val(Mu3.toFixed(3));

          } else if (beamTypes == 4) {
            $('#Pu').prop('disabled', true).val('');
            $('#BDL').prop('disabled', false);
            $('#BLL').prop('disabled', false);

            var BWu = 1.2 * BDL + 1.6 * BLL;
            var new_Bwu = BWu.toFixed(2);
            $('#BWu').val(new_Bwu);

            var BV = (BWu * BLength) / 2;
            $('#BV').val(BV.toFixed(3));

            let Mu4 = (BWu * (BLength ** 2)) / 8;
            $('#BM').val(Mu4);

          } else if (beamTypes == 5) {
            $('#Pu').prop('disabled', true).val('');
            $('#BDL').prop('disabled', false);
            $('#BLL').prop('disabled', false);

            let cPu = 1.2 * BDL + 1.6 * BLL;
            $('#BWu').val(cPu.toFixed(3));

            var BV = cPu / 2;
            $('#BV').val(BV.toFixed(3));

            let Mu5 = (cPu * BLength) / 8;
            $('#BM').val(Mu5.toFixed(2));

          } else if (beamTypes == 6) {
            $('#Pu').prop('disabled', true).val('');
            $('#BDL').prop('disabled', false);
            $('#BLL').prop('disabled', false);

            var BWu = 1.2 * BDL + 1.6 * BLL;
            var new_Bwu = BWu.toFixed(2);
            $('#BWu').val(new_Bwu);

            var BV = BWu * BLength;
            $('#BV').val(BV.toFixed(3));

            let Mu6 = (BWu * (BLength ** 2)) / 2;
            $('#BM').val(Mu6);

          } else if (beamTypes == 7) {
            $('#Pu').prop('disabled', false);
            $('#BDL').prop('disabled', true).val('');
            $('#BLL').prop('disabled', true).val('');


            $('#BV').val(bPu);

            let Mu7 = bPu * BLength;
            $('#BM').val(Mu7);

          }



          // Solving Fb
          var BFy = $('#BFy').val();
          var BFb = 0.60 * BFy;
          var new_BFb = BFb.toFixed(3);

          $('#BFb').val(new_BFb);

          let BSx = ($('#BM').val() * 1000) / (0.90 * (BFy));

          $('#BSx').val(BSx.toFixed(3));

          getTrialSec(BSx);
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

              let fa1 = [];
              let fap1 = [];
              let far1 = [];
              let fmp1 = [];
              let fbsx1 = [];
              let fbfy1 = [];
              let ffysx = [];
              let fmn = [];
              let flpp = [];
              let fvry = [];



              let flrts = [];
              let flfy = [];
              let fljc = [];
              let flsx = [];
              let flho = [];

              let flla = [];
              let fllb = [];
              let fllc = [];
              let flld = [];
              let ftotal = [];
              let fvalflange = [];

              let flayiel = [];
              let flaflb = [];
              let flaltb = [];
              let flamu = [];

              let flalp = [];
              let flalb = [];
              let flalr = [];
              let fmall = [];

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

                fa1[i] = $('#AtFlange' + (i + 1)).val();
                fap1[i] = $('#LambFlangeP' + (i + 1)).val();
                far1[i] = $('#LambFlangeR' + (i + 1)).val();
                fmp1[i] = $('#AtYielding' + (i + 1)).val();
                fbsx1[i] = $('#BSx').val();
                fbfy1[i] = $('#BFy').val();
                ffysx[i] = (fbfy1[i] * (fbsx1[i] * 1000)) / 1000000;
                fvry[i] = result[i]["ry"];

                flrts[i] = result[i]["rts"];
                flfy[i] = $('#BFy').val();
                fljc[i] = result[i]["j"];
                flsx[i] = $('#BSx').val();
                flho[i] = result[i]["ho"];

                fvalflange[i] = $('#AtFlangeAns' + (i + 1)).val();

                flayiel[i] = $('#AtYielding' + (i + 1)).val();
                flaflb[i] = $('#mn' + (i + 1)).val();
                flaltb[i] = $('#ltb' + (i + 1)).val();
                flamu[i] = $('#BM').val();

                flalp[i] = parseFloat($('#lp' + (i + 1)).val());
                flalb[i] = parseFloat($('#lb' + (i + 1)).val());
                flalr[i] = parseFloat($('#lr' + (i + 1)).val());





                if (fvalflange[i] == 'COMPACT') {
                  $('#mn' + (i + 1)).val(0);
                  // lp
                  flpp[i] = (1.76 * (fvry[i])) * Math.sqrt(200000 / fbfy1[i]);
                  $('#lp' + (i + 1)).val(flpp[i]);
                  // lr
                  flla[i] = (1.95 * flrts[i]);
                  fllb[i] = (200000) / (0.7 * flfy[i]);
                  fllc[i] = Math.sqrt(((fljc[i] * (10 ** 3)) * 1) / ((flsx[i] * (10 ** 3)) * flho[i]));
                  flld[i] = Math.sqrt(1 + (Math.sqrt(1 + (6.76 * (((0.7 * flfy[i]) / 200000) * (((flsx[i] * 1000) * flho[i]) / ((fljc[i] * 1000) * 1)) ** 2)))));

                  ftotal[i] = flla[i] * fllb[i] * fllc[i] * flld[i];
                  $('#lr' + (i + 1)).val(ftotal[i].toFixed(3));

                  if (flalp[i] > flalb[i]) {
                    fmall[i] = 0.90 * flayiel[i];

                    $('#Finmall' + (i + 1)).val(fmall[i]);
                    $('#Finmu' + (i + 1)).val(flamu[i]);
                    if (fmall[i] > flamu[i]) {
                      $('#FinRes' + (i + 1)).val('SAFE').removeClass('bg-danger text-light').addClass('bg-success text-light');
                    } else {
                      $('#FinRes' + (i + 1)).val('NOT-SAFE').removeClass('bg-success text-light').addClass('bg-danger text-light');
                    }
                  } else if (flalp[i] < flalb[i] && flalb[i] < flalr[i]) {
                    console.log('b');
                  } else if (flalp[i] < flalb[i] && flalb[i] > flalr[i]) {
                    console.log('c');
                  }

                } else if (fvalflange[i] == 'NON-COMPACT') {
                  // flb
                  fmn[i] = fmp1[i] - (fmp1[i] - (0.7 * (ffysx[i]))) * ((fa1[i] - fap1[i]) / (far1[i] - fap1[i]));
                  $('#mn' + (i + 1)).val(fmn[i].toFixed(3));

                  // lp
                  flpp[i] = (1.76 * (fvry[i])) * Math.sqrt(200000 / fbfy1[i]);
                  $('#lp' + (i + 1)).val(flpp[i]);

                  // lr
                  flla[i] = (1.95 * flrts[i]);
                  fllb[i] = (200000) / (0.7 * flfy[i]);
                  fllc[i] = Math.sqrt(((fljc[i] * (10 ** 3)) * 1) / ((flsx[i] * (10 ** 3)) * flho[i]));
                  flld[i] = Math.sqrt(1 + (Math.sqrt(1 + (6.76 * (((0.7 * flfy[i]) / 200000) * (((flsx[i] * 1000) * flho[i]) / ((fljc[i] * 1000) * 1)) ** 2)))));

                  ftotal[i] = flla[i] * fllb[i] * fllc[i] * flld[i];
                  $('#lr' + (i + 1)).val(ftotal[i].toFixed(3));

                }
              }

              let bdi1 = $('#BEdi1').val();
              let bdi2 = $('#BEdi2').val();
              let bdi3 = $('#BEdi3').val();

              let tr1 = $('#FinRes1').val();
              let tr2 = $('#FinRes2').val();
              let tr3 = $('#FinRes3').val();

              if (tr1 == 'SAFE') {
                // here
                $('#FinalApp').val(bdi1);
              } else {

                if (tr2 == 'SAFE') {
                  // here
                  $('#FinalApp').val(bdi2);
                } else {

                  if (tr3 == 'SAFE') {
                    // here
                    $('#FinalApp').val(bdi2);
                  } else {
                    $('#FinalApp').val('Not in range of our suggestions!');
                  }
                }
              }
            }
          });
        }

        // Manual Selection Events
        // $('#EDISelect').on('change', function() {
        //   let edid = $('#EDISelect').val();
        //   getmanualtrial(edid);
        // });

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

              var BFy3 = $('#BFy').val();

              // For Flange
              var LambFlangeP12 = 0.38 * (Math.sqrt(200000 / BFy3));

              var LambFlangeR1 = 1.0 * (Math.sqrt(200000 / BFy3));

              // For Web
              var LambWebP1 = 3.76 * (Math.sqrt(200000 / BFy3));

              var LambWebR1 = 5.70 * (Math.sqrt(200000 / BFy3));

              let mTbf = result[0]["bf"];
              let mTtf = result[0]["tf"];
              let mTtw = result[0]["tw"];
              let mTd = result[0]["d"];
              let mTk = result[0]["k1"];
              let mTzx = result[0]["Zx"];
              let mTtsx = result[0]["Sx"];
              let mTkdes = result[0]["kdes"];
              let vry = result[0]["ry"];


              // Flange Analysis
              let matFlange = mTbf / (2 * mTtf);


              $('#AtFlange4').val(matFlange.toFixed(3));
              $('#AtFlangeComp4').val(matFlange.toFixed(3) + " < " + LambFlangeP12.toFixed(3));

              if (parseFloat(matFlange.toFixed(3)) < parseFloat(LambFlangeP12.toFixed(3))) {
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
              let mAtYielding = (BFy3 * (mTzx * 1000)) / 1000000;
              $('#AtYielding4').val(mAtYielding.toFixed(3));

              // AtFlange4 = λ
              // LambFlangeP5 = λp
              // LambFlangeR5 = λr
              // AtYielding4 = Mp  = mAtYielding
              // BSx = SX
              // BFy = Fy

              let fa1 = $('#AtFlange4').val();
              let fap1 = $('#LambFlangeP5').val();
              let far1 = $('#LambFlangeR5').val();
              let fmp1 = $('#AtYielding4').val();
              let fbsx1 = $('#BSx').val();
              let fbfy1 = $('#BFy').val();
              let ffysx = (fbfy1 * (fbsx1 * 1000)) / 1000000;

              let valflange = $('#AtFlangeAns4').val();

              if (valflange == 'COMPACT') {
                $('#mn4').val(0);
                //lp
                let lpp = (1.76 * (vry)) * Math.sqrt(200000 / fbfy1);
                $('#lp4').val(lpp.toFixed(3));
                //lr
                let lrts = result[0]["rts"];
                let lfy = $('#BFy').val();
                let ljc = result[0]["j"];
                let lsx = $('#BSx').val();
                let lho = result[0]["ho"];

                let lla = (1.95 * lrts);
                let llb = (200000) / (0.7 * lfy);
                let llc = Math.sqrt(((ljc * (10 ** 3)) * 1) / ((lsx * (10 ** 3)) * lho));
                let lld = Math.sqrt(1 + (Math.sqrt(1 + (6.76 * (((0.7 * lfy) / 200000) * (((lsx * 1000) * lho) / ((ljc * 1000) * 1)) ** 2)))));

                let total = lla * llb * llc * lld;
                $('#lr4').val(total.toFixed(3));

                // lp > lb
                // lp < lb && lb < lr
                // lp < lb && lb > lr

                let layiel = $('#AtYielding4').val();
                let laflb = $('#mn4').val();
                let laltb = $('#ltb4').val();
                let lamu = $('#BM').val();

                let lalp = parseFloat($('#lp4').val());
                let lalb = parseFloat($('#lb4').val());
                let lalr = parseFloat($('#lr4').val());

                if (lalp > lalb) {
                  let mall = 0.90 * layiel;

                  $('#Finmall4').val(mall);
                  $('#Finmu4').val(lamu);
                  if (mall > lamu) {
                    $('#FinRes4').val('SAFE').removeClass('bg-danger text-light').addClass('bg-success text-light');
                  } else {
                    $('#FinRes4').val('NOT-SAFE').removeClass('bg-success text-light').addClass('bg-danger text-light');
                  }
                } else if (lalp < lalb && lalb < lalr) {
                  console.log('b');
                } else if (lalp < lalb && lalb > lalr) {
                  console.log('c');
                }

                // for non compact
                // Yielding = Mn 
                // FLB = Mn 
                // LTB = Mn 

                // for compact
                // Yielding 
                // LTB = Mn 

                // least will governs

                // Proceed on ∅Mn should  be > Mu


              } else if (valflange == 'NON-COMPACT') {
                // flb
                let mn2 = fmp1 - (fmp1 - (0.7 * (ffysx))) * ((fa1 - fap1) / (far1 - fap1));
                $('#mn4').val(mn2.toFixed(3));

                //lp
                let lpp = (1.76 * (vry)) * Math.sqrt(200000 / fbfy1);
                $('#lp4').val(lpp.toFixed(3));

                //lr
                let lrts = result[0]["rts"];
                let lfy = $('#BFy').val();
                let ljc = result[0]["j"];
                let lsx = $('#BSx').val();
                let lho = result[0]["ho"];

                let lla = (1.95 * lrts);
                let llb = (200000) / (0.7 * lfy);
                let llc = Math.sqrt(((ljc * (10 ** 3)) * 1) / ((lsx * (10 ** 3)) * lho));
                let lld = Math.sqrt(1 + (Math.sqrt(1 + (6.76 * (((0.7 * lfy) / 200000) * (((lsx * 1000) * lho) / ((ljc * 1000) * 1)) ** 2)))));

                let total = lla * llb * llc * lld;
                $('#lr4').val(total.toFixed(3));





              }
            }
          });
        };
      </script>

</body>

</html>