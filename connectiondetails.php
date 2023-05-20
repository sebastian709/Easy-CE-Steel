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
            <h4 class="page-title">Connection Details</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Connection Details
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
                  <div class="col-lg-12 mb-3">
                    <h3 class="mt-3 mt-3 mb-3 d-inline">Connection Details</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Electrode:</label>
                    <div class="input-group mb-3">
                      <!-- 6.895 -->
                      <select name="" id="electrode" class="form-control">
                        <option value="">Select Electrode...</option>
                        <option value="60">E60XX</option>
                        <option value="70">E70XX</option>
                        <option value="80">E80XX</option>
                        <option value="100">E100XX</option>
                        <option value="110">E110XX</option>
                      </select>
                      <!-- <span class="input-group-text">Kn/m</span> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Size of Weld:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="sizeOfWeld">
                      <span class="input-group-text">mm</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Length of Welded Area:</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="lengthOfWeldedArea">
                      <span class="input-group-text">mm</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Connecting Members:</label>
                    <div class="input-group mb-3">
                      <select name="" class="form-control" id="conmem">
                        <option value="0" selected>Select Designation ...</option>
                        <?php
                        $sql1 = "SELECT `astm_name`, `ksi` FROM `astm_welded`";
                        $result = mysqli_query($conn, $sql1);

                        while ($row = mysqli_fetch_assoc($result)) {
                          $astm[] = $row;
                        }

                        foreach ($astm as $value) {
                          echo "<option value='" . $value['ksi'] . "'>" . $value['astm_name'] . " - " . $value['ksi'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Welded Category:</label>
                    <div class="input-group mb-3">
                      <!-- 6.895 -->
                      <select name="" id="weldCategory" class="form-control">
                        <option value="0">Select Category...</option>
                        <option value="1">Longitudinal Fillet Weld</option>
                        <option value="2">Transverse fillet Weld</option>
                        <option value="3">Transverse and Longitudinal Welds</option>
                      </select>
                      <!-- <span class="input-group-text">Kn/m</span> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Welded Figure:</label>
                    <img src="assets/images/weldedFigure.PNG" width="100%" alt="">
                  </div>
                </div>
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
                  <div class="col-12 bg-light py-2 overflow-auto" style="max-height:70vh; min-height:70vh;">
                    <div class="row">
                      <!-- Visuals Tab -->
                      <div class="col-12" id="visuals" style="max-height:70vh;">
                        <img src="assets/images/13.jpg" width="100%" alt="">
                        <img src="assets/images/14.jpg" width="100%" alt="">
                        <img src="assets/images/15.jpg" width="100%" alt="">
                      </div>
                      <!-- Other Results Tab -->
                      <div class="col-12 d-none" id="otherResults">
                        <div class="row">
                          <div class="col-12">
                            <div class="accordion" id="accordionExample">
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingOne">
                                  <button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Longitudinal
                                  </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Fw</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="fwl">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Aw</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="awl">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Pu</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="pul">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingTwo">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Transverse
                                  </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Fw</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="fwt">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Aw</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="awt">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Pu</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="put">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingThree">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Transverse and Longitudinal
                                  </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Rn 1</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="rn1">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Rn 2</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="rn2">
                                          <!-- <span class="input-group-text">Kn</span> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <label for="Wu">Pu</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" readonly id="putl">
                                          <!-- <span class="input-group-text">Kn</span> -->
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
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <select name="" id="select-designation" class="form-control" disabled>
                        <option value="0" selected>Select Designation ...</option>
                        <?php
                        //$sql1 = "SELECT `astm_name`, `ksi` FROM `astm`";
                        //$result = mysqli_query($conn, $sql1);

                        //while ($row = mysqli_fetch_assoc($result)) {
                        //$astm[] = $row;
                        //}

                        //foreach ($astm as $value) {
                        //echo "<option value='" . $value['ksi'] . "'>" . $value['astm_name'] . " - " . $value['ksi'] . "</option>";
                        //}
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
        </div> -->
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


    $('#electrode, #sizeOfWeld, #lengthOfWeldedArea, #conmem, #weldCategory').on('keydown change', function() {
      let el = $('#electrode').val();
      let si = $('#sizeOfWeld').val();
      let le = $('#lengthOfWeldedArea').val();
      let co = $('#conmem').val();
      let we = $('#weldCategory').val();

      if (we == 1) {
        //Longitudinal
        let fexx = el * 6.895;
        let fw = .60 * fexx;
        $('#fwl').val(fw);

        let aw = le * .707 * si * 2;
        $('#awl').val(aw);

        let rnwl = (fw * aw) / 1000;
        let lpu = 0.75 * rnwl;
        $('#pul').val(lpu);

      } else if (we == 2) {
        //Transverse

        let fexx = el * 6.895;
        let fw = .60 * fexx;
        $('#fwt').val(fw);

        let aw = le * .707 * si * 1;
        $('#awt').val(aw);

        let rnwt = (fw * aw) / 1000;
        let tpu = 0.75 * rnwt;
        $('#put').val(tpu);

      } else if (we == 3) {
        //Longitudinal + Transverse

        //Longitudinal
        let lfexx = el * 6.895;
        let ltfw = .60 * lfexx;

        let law = le * .707 * si * 2;
        let lrnwl = (ltfw * law) / 1000;

        //Transverse

        let tfexx = el * 6.895;
        let tfw = .60 * tfexx;

        let taw = le * .707 * si * 1;
        let trnwt = (tfw * taw) / 1000;

        let rn1 = lrnwl + trnwt;
        $('#rn1').val(rn1);
        let rn2 = (0.85 * lrnwl) + (1.5 * trnwt);
        $('#rn2').val(rn2);

        if (rn1 < rn2) {
          let tlpu = 0.75 * rn1;
          $('#putl').val(tlpu);
        } else {
          let tlpu = 0.75 * rn2;
          $('#putl').val(tlpu);
        }

      }


    });
  </script>

</body>

</html>