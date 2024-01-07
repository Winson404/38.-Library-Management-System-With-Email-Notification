<title>LAKASA | Student records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <button class="btn btn-success float-sm-right m-1 btn-sm" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
                <a class="btn btn-dark float-sm-right m-1 btn-sm" href="students.php"><i class="fa-solid fa-backward"></i> Back</a>
            </div>
            <div class="card-body">
              <div class="container"id="printElement">
                <div class="row invoice-info d-flex p-0 m-0" style="line-height: 18px;">
                  <div class="col-sm-2">
                    <img src="../images/logo.png"  alt="" style="margin-left: 90px;"  width="75">
                  </div>
                  <div class="col-sm-8 invoice-col text-center">
                    <address class="mt-3">
                      <!-- Republic of the Philippines<br> -->
                      <strong>Saint Catherine's School</strong><br>
                      Bambang Nueva Vizcaya
                    </address>
                  </div>
                  <div class="col-sm-12">
                    <!-- <center>
                    <small>Multi-Purpose Barangay Hall Pildera II, Pasay City 1300, MM, Phil's, Telefax: 8853-6275; email:brgy193@gmail.com</small>
                    </center> -->
                    <div class="dropdown-divider"></div>
                    <br>
                  </div>
                  <div class="col-12">
                    <p class="text-center text-bold">Registered Students</p>
                    <p class="float-right" style="margin-top: -30px;"><?php echo date("d/m/Y"); ?></p>
                  </div>
                      <table id="" class="table table-bordered table-hover text-sm table-sm">
                        <thead>
                          <tr>
                            <th>NAME</th>
                            <th>GENDER</th>
                            <th>DEPARTMENT</th>
                            <th>YR LEVL</th>
                            <th>EMAIL/CONTACT</th>
                            <th>DATE REGISTERED</th>
                          </tr>
                        </thead>
                        <tbody id="users_data">
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Student' ");
                          while ($row = mysqli_fetch_array($sql)) {
                          ?>
                          <tr>
                            
                            <td><?php echo $row['firstname'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['dept']; ?></td>
                            <td><?php echo $row['yr_lvl']; ?></td>
                            <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                            <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['date_registered'])); ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <div class="col-md-12 d-flex">
                    <p class="text-sm ml-auto">Printed by: <br> <span class="text-muted"><?php echo ucwords($fullname); ?></span></p>
                  </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../includes/print.js"></script> 
  <?php require_once '../includes/footer.php'; ?>
  <script>
   $(window).on('load', function() {
    document.getElementById("printButton").click();
   })
 </script>