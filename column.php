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
    $BSx = $_POST['data']; //AG

   $sql = "SELECT * FROM `column_aisc` WHERE `A` > " . $BSx . " AND `Type` = 'W' ORDER BY `A` ASC LIMIT 3";

    /*$sql = " SELECT * FROM
    (SELECT * FROM `column_aisc` WHERE `A` > " . $BSx . " AND `Type` = 'w'  ORDER BY `A`  ASC LIMIT 100) b 
    ORDER BY 'ID'  ASC  LIMIT 100"; */

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
          <!-- Right side toggle and nav items afdsa-->
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
                <img src="assets/images/icon/beam.png" alt="" class="px-2"><span class="hide-menu">Beam</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="column.php" aria-expanded="false">
                <img src="assets/images/icon/" alt="" class="px-2"><span class="hide-menu">Column</span>
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
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <h3 class="mt-3 ps-4 mt-5 mb-3">Title</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">PLL:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="PLL">
                  <span class="input-group-text">Kn</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">PDL:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="PDL">
                  <span class="input-group-text">Kn</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">Length:</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="Length">
                  <span class="input-group-text">m</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">K:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="K">
                  <span class="input-group-text"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">K/lr:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="assume_KL">
                  <span class="input-group-text"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">LRFD:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="lrfd" readonly> 
                  <span class="input-group-text">kN</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 form-group ps-5">
                <label for="">Steel:</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="steel" readonly> 
                  <span class="input-group-text">MPa</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 mb-5 ps-5">
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       Critical Buckling Stress
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                      data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="row">
                          <div class="col">
                            <h5></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col form-group">
                            <label for="Wu">Fe</label>
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" readonly id="Fe">
                              <span class="input-group-text">MPa</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col form-group">
                            <label for="Wu">Fcr</label>
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" readonly id="Fcr">
                              <span class="input-group-text">MPa</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col form-group">
                            <label for="Wu">Ag</label>
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" readonly id="Ag">
                              <span class="input-group-text">Kn/m</span>
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
                                <label for="">Ag</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ag1">
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
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Ry</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ry1">
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
                                <label for="">Ag</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ag2">
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
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Ry</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ry2">
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
                                <label for="">Ag</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ag3">
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
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Ry</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Ry3">
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
                        Check Adequency
                      </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading2"
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
                              <div class="col">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Slenderness ratio</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="sr1">
                                </div>
                              </div>
                            </div>   
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="fe1">
                                </div>
                              </div>
                            </div> 
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fcr</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Afcr1">
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
                              <div class="col">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Slenderness ratio</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="sr2">
                                </div>
                              </div>
                            </div>   
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="fe2">
                                </div>
                              </div>
                            </div> 
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fcr</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Afcr2">
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
                              <div class="col">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Slenderness ratio</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="sr3">
                                </div>
                              </div>
                            </div>   
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="fe3">
                                </div>
                              </div>
                            </div> 
                            <div class="row">
                              <div class="col form-group">
                                <label for="">Fcr</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="Afcr3">
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
                        Limiting Factor
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
                              <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lf1">
                                </div>
                                <label for="">Pn</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="pn1">
                                </div>
                                <label for="">LRFD</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lrfd_1">
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
                              <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lf2">
                                </div>
                                <label for="">Pn</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="pn2">
                                </div>
                                <label for="">LRFD</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lrfd_2">
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
                              <label for="">Fe</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lf3">
                                </div>
                                <label for="">Pn</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="pn3">
                                </div>
                                <label for="">LRFD</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="lrfd_3">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="heading5">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        Analysis
                      </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
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
                              <label for="">Stress of Section</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="stress1">
                                </div>
                                <label for="">Load Combination</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="analysis1">
                                </div>
                                <label for="">Result</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="result1">
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
                              <label for="">Stress of Section</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="stress2">
                                </div>
                                <label for="">Load Combination</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="analysis2">
                                </div>
                                <label for="">Result</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="result2">
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
                              <label for="">Stress of Section</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="stress3">
                                </div>
                                <label for="">Load Combination</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="analysis3">
                                </div>
                                <label for="">Result</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" readonly id="result3">
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
          <div class="col-lg-6">
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
    var BSx;
    $('#BDL, #BLL, #Length, #BFy, #PLL, #PDL, #assume_KL, #Fe, #Ag, #lrfd, #K, #sr1, #sr2, #fe1, #Afcr1, #lf1').on('keyup', function () {
      BSx();
    });

    function BSx() {
      

      //solving LRFD
      var PLL = $('#PLL').val();
      var PDL = $('#PDL').val();
      var RS = 1.2 * PDL + 1.6 * PLL;

      $('#lrfd').val(RS);

      //solving A992 steel
      var Steel = $('#assume_KL').val();
      var MPa = Steel * 6.895;
      var newMPa = Math.round(MPa);
      $('#steel').val(newMPa); 

      //solving fe for critical buckling stress
      var Fe =9.86960440109 * 200000 / Steel**2 ;
      var new_Fe = Fe.toFixed(2);
      $('#Fe').val(new_Fe);

      //solving Fcr for critical buckling stress
      var Fcr = 0.658 ** (newMPa / new_Fe) * newMPa;
      var newFcr = Fcr.toFixed(2);
      $('#Fcr').val(newFcr);
      

      //solving for slenderness ratio (sr1)
      var K = $('#K').val(); // value of k = 0.8 in tthe example
      var L = $('#Length').val(); // value ng length
      var NL = L * 1000; //convert t0 mm 4500

      var RY = $('#Ry1').val(); // value ng ry1 /trial a
      var S = K * NL / RY;
      var newS = S.toFixed(3);
      $('#sr1').val(newS);

      var RY2 = $('#Ry2').val(); // value ng ry2 /trial b
      var S2 = K * NL / RY2;
      var newS2 = S2.toFixed(3);
      $('#sr2').val(newS2);

      var RY3 = $('#Ry3').val(); // value ng ry3 /trial c
      var S3 = K * NL / RY3;
      var newS3 = S3.toFixed(3);
      $('#sr3').val(newS3);

      //solve for fe
      var ratio = $('#sr1').val();
      var pisquare = 9.86960440109;
      var KL = pisquare * 200000;
      var KL2 = ratio**2;
      var FE = KL / KL2;
      var newFE = FE.toFixed(3);

      $('#fe1').val(newFE);

      //solve for fe
      var ratio2 = $('#sr2').val();
      var KL2 = pisquare * 200000;
      var KL22 = ratio2**2;
      var FE2 = KL2 / KL22;
      var newFE2 = FE2.toFixed(3);

      $('#fe2').val(newFE2);
      //solve for fe
      var ratio3 = $('#sr3').val();
      var KL3 = pisquare * 200000;
      var KL33 = ratio3**2;
      var FE3 = KL3 / KL33;
      var newFE3 = FE3.toFixed(3);

      $('#fe3').val(newFE3);

      //solve the fcr
      var steel =  $('#steel').val();
      var Afe1 = $('#fe1').val();
      var SA = steel / Afe1;
      var AFCR = (0.658**SA) * steel;
      var newAFCR = AFCR.toFixed(3);

      $('#Afcr1').val(newAFCR);

      //solve the fcr
      var Afe2 = $('#fe2').val();
      var SA2 = steel / Afe2;
      var AFCR2 = (0.658**SA2) * steel;
      var newAFCR2 = AFCR2.toFixed(3);

      $('#Afcr2').val(newAFCR2);

      //solve the fcr
      var Afe3 = $('#fe3').val();
      var SA3 = steel / Afe3;
      var AFCR3 = (0.658**SA3) * steel;
      var newAFCR3 = AFCR3.toFixed(3);

      $('#Afcr3').val(newAFCR3);

      //Limiting Factor fe
      
      var r = 200000 / steel;
      var result = 4.71 * Math.sqrt(r);
      var Nresult = result.toFixed(3);
      $('#lf1').val(Nresult);
      $('#lf2').val(Nresult);
      $('#lf3').val(Nresult);


      //For PN
      var AG_1 = $('#Ag1').val();
      var PN1 = AG_1 * AFCR / 1000;
      var newPN1 = PN1.toFixed(3);

      $('#pn1').val(newPN1);

      var AG_2 = $('#Ag2').val();
      var PN2 = AG_2 * AFCR2 / 1000;
      var newPN2 = PN2.toFixed(3);

      $('#pn2').val(newPN2);

      var AG_3 = $('#Ag3').val();
      var PN3 = AG_3 * AFCR3 / 1000;
      var newPN3 = PN3.toFixed(3);

      $('#pn3').val(newPN3);

      //LRFD
      var LPN1 = $('#pn1').val();
      var lrfd_1 = 0.9 * LPN1;
      var newlrfd1 = lrfd_1.toFixed(3);

      $('#lrfd_1').val(newlrfd1);

      var LPN2 = $('#pn2').val();
      var lrfd_2 = 0.9 * LPN2;
      var newlrfd2 = lrfd_2.toFixed(3);

      $('#lrfd_2').val(newlrfd2);

      var LPN3 = $('#pn3').val();
      var lrfd_3 = 0.9 * LPN3;
      var newlrfd3 = lrfd_3.toFixed(3);

      $('#lrfd_3').val(newlrfd3);

      //Stress of section
      var vlrfd1 = $('#lrfd_1').val();
      var vlrfd2 = $('#lrfd_2').val();
      var vlrfd3 = $('#lrfd_3').val();

      $('#stress1').val(vlrfd1);
      $('#stress2').val(vlrfd3);
      $('#stress3').val(vlrfd3);

      //load combination trial A
        var a = $("#lrfd").val();
				var b = $("#lrfd_1").val();
				var result;

				if (a > b) {
					result = ">";
				} else if (a < b) {
					result = "<";
				} else {
					result = "=";
				}

				$("#analysis1").val(a + " " + result + " " + b);

        //load combination trial B
        var a2 = $("#lrfd").val();
				var b2 = $("#lrfd_2").val();
				var result2;

				if (a2 > b2) {
					result2 = ">";
				} else if (a2 < b2) {
					result2 = "<";
				} else {
					result2 = "=";
				}

				$("#analysis2").val(a2 + " " + result2 + " " + b2);

         //load combination trial C
         var a3 = $("#lrfd").val();
				var b3 = $("#lrfd_3").val();
				var result3;

				if (a3 > b3) {
					result3 = ">";
				} else if (a3 < b3) {
					result3 = "<";
				} else {
					result3 = "=";
				}

				$("#analysis3").val(a3 + " " + result3 + " " + b3);

        //final result
        var x = parseInt($("#lrf_1").val());
				var y = parseInt($("#lrfd").val());
        var Pass = "ADEQUATE";
        var Fail = "INADEQUATE";

				var Fresult;

				if (x > y) {
					Fresult =  $('#result1').val(Pass);
          $('#result1').css('background-color','green');
          $('#result1').css('color','white');
				} else {
					Fresult =  $('#result1').val(Fail);
          $('#result1').css('background-color','red');
          $('#result1').css('color','white');
				}

        //final result trial B
        var x2 = parseInt($("#lrf_2").val());
				var y2 = parseInt($("#lrfd").val());
        var Pass2 = "ADEQUATE";
        var Fail2 = "INADEQUATE";

				var Fresult2;

				if (x2 > y2) {
					Fresult2 =  $('#result2').val(Pass2);
          $('#result2').css('background-color','green');
          $('#result2').css('color','white');
				} else {
					Fresult2 =  $('#result2').val(Fail2);
          $('#result2').css('background-color','red');
          $('#result2').css('color','white');
				}
        
        //final result trial C
        var x3 = parseInt($("#lrf_3").val());
				var y3 = parseInt($("#lrfd").val());
        var Pass3 = "ADEQUATE";
        var Fail3 = "INADEQUATE";

				var Fresult3;

				if (x3 > y3) {
					Fresult3 =  $('#result3').val(Pass3);
          $('#result3').css('background-color','green');
          $('#result3').css('color','white');
				} else {
					Fresult3 =  $('#result3').val(Fail3);
          $('#result3').css('background-color','red');
          $('#result3').css('color','white');
				}
      //solving Ag for critical buckling stress
      
      var numerator = RS * 1000;
      var denominator = 0.9 * newFcr;
      var Ag = numerator / denominator;
      var newAg = Ag.toFixed(2)
      $('#Ag').val(newAg);

      getTrialSec(newAg);


    }

    // producing tester
    function getTrialSec(DBSx) {
      var Ag = DBSx;
      $.ajax({
        url: "column.php",
        type: "POST",
        data: {
          data: Ag,
          AJAXLocator: "searchBeam",
        },
        dataType: 'json',
        success: function (result) {
          console.log(result);
          // Fetching EDI
          $('#BEdi1').val(result[0]["EDI_Std_Nomenclature"]);
          $('#BEdi2').val(result[1]["EDI_Std_Nomenclature"]);
          $('#BEdi3').val(result[2]["EDI_Std_Nomenclature"]);

          //Ag
          $('#Ag1').val(result[0]["A"]);
          $('#Ag2').val(result[1]["A"]);
          $('#Ag3').val(result[2]["A"]);
          //rx
          $('#Rx1').val(result[0]["rx"]);
          $('#Rx2').val(result[1]["rx"]);
          $('#Rx3').val(result[2]["rx"]);
          //ry
          $('#Ry1').val(result[0]["ry"]);
          $('#Ry2').val(result[1]["ry"]);
          $('#Ry3').val(result[2]["ry"]);

        }
      });
    }
  </script>

</body>

</html>