<?php
session_start();
require 'db/connection.php';



if (isset($_POST['AJAXLocator']) || isset($_GET['AJAXLocator'])) {
  if (isset($_POST['AJAXLocator'])) {
    $locator = $_POST['AJAXLocator'];
  } else {
    $locator = $_GET['AJAXLocator'];
  }
  if ($locator == "columnTrials") {
    $BSx = $_POST['data'];

    $sql = "SELECT * FROM `beam_aisc` WHERE `A` > " . $BSx . " AND `Type` = 'W' ORDER BY `A` ASC LIMIT 3";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {
      $emparray[] = $row;
    }

    echo json_encode($emparray);
    exit;
  }
}
?>
<style>
  .settings {
    position: fixed;
    /* bottom: 0px; */
    top: 50%;
    right: 5px;
  }
</style>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ECES - Column</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="https://i.pinimg.com/564x/68/d1/fe/68d1fedb9f6e107b5e6dd68396870a54.jpg" />
  <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <link href="dist/css/style.min.css" rel="stylesheet" />
</head>

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
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items afdsa-->
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
            <h4 class="page-title">Column</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Column
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
                    <h3 class="mt-3 mt-3 mb-3 d-inline">Long Column</h3>
                    <!-- <button type="button" id="LocalStorage">Test local storage</button> -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">End Condition:</label>
                    <div class="input-group mb-3">
                      <select name="" id="EnC" class="form-control">
                        <option value="">Select End Condition...</option>
                        <option value="0.65">0.65</option>
                        <option value="0.80">0.80</option>
                        <option value="1.2">1.2</option>
                        <option value="1.0">1.0</option>
                        <option value="2.1">2.1</option>
                        <option value="2.0">2.0</option>
                      </select>
                      <!-- <span class="input-group-text">Kn/m</span> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">PLL:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="PLL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">PDL:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="PDL">
                      <span class="input-group-text">Kn/m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Pu:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="Pu" disabled>
                      <span class="input-group-text">Kn</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">KL/r:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="Klr">
                    </div>
                    <label for="" class="text-info"> Note: Recommended value for KL/r is (40- 60) <200 </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Fy:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="CFy">
                      <span class="input-group-text">MPa</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Length:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="Length">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="" class="font-weight-bold"><b> Result:</b></label>
                    <div class="input-group mb-3">
                      <span class="input-group-text bg-dark text-light">EDI</span>
                      <input type="text" class="form-control bg-dark text-light" id="Result">
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
                    </ul>
                  </div>
                  <div class="col-12 bg-light py-2 overflow-auto" style="min-height:70vh; max-height:70vh; ">
                    <div class="row">
                      <!-- Visuals Tab -->
                      <div class="col-12" id="visuals" style="max-height:70vh;">
                        <img src="assets/images/7.jpg" width="100%" alt="">
                        <img src="assets/images/8.jpg" width="100%" alt="">
                        <img src="assets/images/9.jpg" width="100%" alt="">
                        <img src="assets/images/10.jpg" width="100%" alt="">
                        <img src="assets/images/11.jpg" width="100%" alt="">
                        <img src="assets/images/12.jpg" width="100%" alt="">
                      </div>
                      <!-- Other Results Tab -->
                      <div class="col-12 d-none" id="otherResults">
                        <div class="row">
                          <div class="col-12">
                            <div class="accordion" id="accordionExample">
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingOne">
                                  <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Critical Buckling Stress
                                  </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Fe</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="Fe">
                                          <span class="input-group-text">Kn</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingTwo">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Flexural Buckling Stress
                                  </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Fcr</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="Fcr">
                                          <span class="input-group-text">Kn</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingThree">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Gross Area(Ag)
                                  </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Ag</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="Ag">
                                          <span class="input-group-text">Kn</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingFour">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Trial Section
                                  </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
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
                                              <input type="text" class="form-control" readonly id="Edi1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ag</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="TAg1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ry1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Rx1">
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
                                              <input type="text" class="form-control" readonly id="Edi2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ag</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="TAg2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ry2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Rx2">
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
                                              <input type="text" class="form-control" readonly id="Edi3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ag</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="TAg3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ry3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Rx3">
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
                                            <label for="">EDI</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Edi4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ag</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="TAg4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Ry</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Ry4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="">Rx</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Rx4">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingFive">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Check For Adequacy
                                  </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial A</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">X-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="XAx1">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Y-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="YAx1">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">X-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="XAx2">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Y-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="YAx2">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">X-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="XAx3">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Y-Axis</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="YAx3">
                                              <!-- <span class="input-group-text">Kn</span> -->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingSix">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Critical Buckling Stress
                                  </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial A</h5>
                                          </div>
                                        </div>
                                        <div class="row">

                                          <div class="col form-group">
                                            <label for="Wu">Fe</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fe1">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Fe</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fe2">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Fe</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fe3">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingSeven">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Flexural Buckling Stress
                                  </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial A</h5>
                                          </div>
                                        </div>
                                        <div class="row">

                                          <div class="col form-group">
                                            <label for="Wu">Fcr</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fcr1">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Fcr</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fcr2">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Fcr</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Fcr3">
                                              <span class="input-group-text">Kn</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingEight">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Nominal Compressive Strength
                                  </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial A</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Pn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Pn1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">ØPn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="OPn1">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Result</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Res1">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial B</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Pn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Pn2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">ØPn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="OPn2">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Result</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Res2">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="row">
                                          <div class="col text-center">
                                            <h5>Trial C</h5>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Pn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="Pn3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">ØPn</label>
                                            <div class="input-group mb-3">
                                              <input type="number" class="form-control" readonly id="OPn3">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col form-group">
                                            <label for="Wu">Result</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" readonly id="Res3">
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
                    <button type="button" class="btn btn-danger form-control mt-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" id="ind">
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



    // manual and select option in FY
    $('#manual, #selections').on('click', function() {
      let active = this.id;

      if (active == 'manual') {
        $('#manual').removeClass('btn-secondary').addClass('btn-info');
        $('#selections').removeClass('btn-info').addClass('btn-secondary');
        $('#select-designation').prop('disabled', true);
        $('#CFy').prop('disabled', false);
        $('#select-designation option[value="0"]').prop('selected', true);
        $('#CFy').val('');
        $('#ASTM-Column').hide();
      } else {
        $('#manual').removeClass('btn-info').addClass('btn-secondary');
        $('#selections').removeClass('btn-secondary').addClass('btn-info');
        $('#select-designation').prop('disabled', false);
        $('#CFy').prop('disabled', true);
        $('#select-designation option[value="0"]').prop('selected', true);
        $('#CFy').val('');
        $('#ASTM-Column').show();
      }

    });

    // selecting ASTM
    $('#select-designation').on('change', function() {
      let ksi = $('#select-designation').val();
      ksi = ksi * 6.895;
      $('#CFy').val(ksi.toFixed(0));
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


    //Global Variable


    $('#PLL, #PDL, #Klr, #CFy, #Length, #EnC').on('keydown change', function() {
      var PLL = $('#PLL').val();
      var PDL = $('#PDL').val();
      var Klr = $('#Klr').val();
      var CFy = $('#CFy').val();
      var MFe = Fe(Klr).toFixed(2);
      var MFcr = Fcr(CFy, Klr).toFixed(2);

      PU(PLL, PDL);
      // Fcr(CFy, Klr);
      Ag();

      $('#Fe').val(MFe);
      $('#Fcr').val(MFcr);
    });

    function PU(PLL, PDL) {
      // Solving Pu
      var PU = (1.2 * PDL) + (1.6 * PLL);
      $('#Pu').val(PU.toFixed(2));
    }

    function Fe(Klr) {
      // Solving Fe
      var Fe = (3.141592654 ** 2) * 200000 / (Klr ** 2);

      return Fe;
    }

    function Fcr(CFy, Klr) {
      // Solving Fcr
      let condition = 4.71 * (Math.sqrt(200000 / CFy));
      let Fe = $('#Fe').val();


      if (Klr < condition) {
        let Cond1 = (0.658 ** (CFy / Fe)) * CFy;
        return Cond1;
      } else {
        let Cond2 = 0.877 * Fe;
        return Cond2;
      }
    }

    function Ag() {
      let Pu = $('#Pu').val();
      let Fcr = $('#Fcr').val();

      let Ag = (Pu * 1000) / (0.90 * Fcr);
      $('#Ag').val(Ag.toFixed(2));

      Trial(Ag);
    }

    function Trial(Ag) {

      $.ajax({
        url: "column.php",
        type: "POST",
        data: {
          data: Ag,
          AJAXLocator: "columnTrials",
        },
        dataType: 'json',
        success: function(result) {
          var EnC = $('#EnC').val();
          var Length = $('#Length').val() * 1000;


          for (x = 0; x < 3; x++) {
            $('#Edi' + (x + 1)).val(result[x]["EDI_Std_Nomenclature"]);
            $('#TAg' + (x + 1)).val(result[x]["A"]);
            $('#Ry' + (x + 1)).val(result[x]["ry"]);
            $('#Rx' + (x + 1)).val(result[x]["rx"]);
          }

          CkAdequancy(EnC, Length);
          ECBS();
          FBS();
          NCS();
        }
      });

      let Ry = [];
      let Rx = [];
      let xAxis = [];
      let yAxis = [];

      function CkAdequancy(EnC, Length) {
        for (x = 0; x < 3; x++) {
          Rx[x] = $('#Rx' + (x + 1)).val();
          Ry[x] = $('#Ry' + (x + 1)).val();

          xAxis[x] = (EnC * Length) / Rx[x];
          yAxis[x] = (EnC * Length) / Ry[x];

          // console.log('x',xAxis[x], ' y',yAxis[x]);
          $('#XAx' + (x + 1)).val(xAxis[x].toFixed(2));
          $('#YAx' + (x + 1)).val(yAxis[x].toFixed(2));
        }
      }

      // Elastic Critical Buckling Stress
      let Xax = [];
      let Yax = [];
      let Fex = [];
      let Fey = [];

      function ECBS() {
        for (x = 0; x < 3; x++) {
          Xax[x] = $('#XAx' + (x + 1)).val();
          Yax[x] = $('#YAx' + (x + 1)).val();
          Fex[x] = Fe(Xax[x]);
          Fey[x] = Fe(Yax[x]);

          if (Xax[x] > Yax[x]) {
            $('#Fe' + (x + 1)).val(Fex[x]);
          } else {
            $('#Fe' + (x + 1)).val(Fey[x]);
          }
        }


      }

      let FeFBS = [];
      let FcrF = [];


      function FBS() {
        for (x = 0; x < 3; x++) {
          let CFyFBS = $('#CFy').val();
          FeFBS[x] = $('#Fe' + (x + 1)).val();
          var Klr = $('#Klr').val();
          // Solving Fcr
          let condition = 4.71 * (Math.sqrt(200000 / CFyFBS));

          let Cond1 = [];
          let Cond2 = [];

          if (Klr < condition) {
            Cond1[x] = (0.658 ** (CFyFBS / FeFBS[x])) * CFyFBS;
            $('#Fcr' + (x + 1)).val(Cond1[x]);
          } else {
            Cond2[x] = 0.877 * FeFBS[x];
            $('#Fcr' + (x + 1)).val(Cond2[x]);
          }
        }
      }
      let FcrNCS = [];
      let PnNCS = [];
      let OPnNCS = [];
      let OPn = [];
      let AgN = [];
      let ResNCS = [];

      function NCS() {
        for (x = 0; x < 3; x++) {
          FcrNCS[x] = $('#Fcr' + (x + 1)).val();
          AgN[x] = $('#TAg' + (x + 1)).val();

          PnNCS[x] = (FcrNCS[x] * AgN[x]) / 1000;
          $('#Pn' + (x + 1)).val(PnNCS[x]);

          OPn[x] = $('#Pn' + (x + 1)).val();
          OPnNCS[x] = 0.9 * OPn[x];
          $('#OPn' + (x + 1)).val(OPnNCS[x]);

          let PuNCS = $('#Pu').val();

          if (parseInt(OPnNCS[x]) > parseInt(PuNCS)) {
            $('#Res' + (x + 1)).val('Adequate').removeClass('bg-danger').addClass('bg-success text-light');
          } else {
            $('#Res' + (x + 1)).val('Inadequate').removeClass('bg-success').addClass('bg-danger text-light');
          }


          ResNCS[x] = $('#Res' + (x + 1)).val();

          if (ResNCS[0] == 'Adequate') {

            $('#Result').val($('#Edi1').val());

          } else {

            if (ResNCS[1] == 'Adequate') {

              $('#Result').val($('#Edi2').val());

            } else {
              if (ResNCS[2] == 'Adequate') {

                $('#Result').val($('#Edi3').val());

              }
            }
          }
        }
      }

    }
  </script>

</body>

</html>