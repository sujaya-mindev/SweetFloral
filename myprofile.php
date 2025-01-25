<?php
// Include database connection
include 'conn.php';

// Fetch products from the database
$query = "SELECT * FROM product";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="myprofile.css">
</head>
<body>
    <?php include 'navbar.html'; ?>

    
                <div class="" id="myprofile">
                <div class="card">
                    <div class="card-header">
                        <div id="myname">Sujaya Mindev</div>
                        <div id="myemail" style="display: inline-block; margin-right: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                        </svg>
                        test@test.com</div>
                        <div id="myphone" style="display: inline-block;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>    
                        0717016900</div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Account Details</h4>
                        <div class="container">

                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn rounded" for="btnradio1"><img src="images/profile_male.png" class="rounded"></label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn rounded" for="btnradio2"><img src="images/profile_female.png" class="rounded"></label>
                            </div>
                        </div>


                    <!-- Details -->
                    
                    <div class="input-group">
                        <div class="row">
                            <div class="col">
                                <h6>First Name</h6>
                                <input type="text" class="form-control" placeholder="First Name" aria-label="FirstName" aria-describedby="basic-addon1">
                            </div>
                            <div class="col">
                                <h6>Last Name</h6>
                                <input type="text" class="form-control" placeholder="Last Name" aria-label="LastName" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>

                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h6>Email</h6>
                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h6>Mobile Number (with Country Code +94xxxxxxxxx)</h6>
                                    <input type="tel" class="form-control" placeholder="Mobile Number" aria-label="tel" aria-describedby="basic-addon2">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h6>Address</h6>
                                    <textarea class="form-control" aria-label="Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h6>Birthday</h6>
                                    <input type="date" class="form-control" placeholder="" aria-label="dob" aria-describedby="basic-addon2">
                                </div>
                            </div>
                        </div>

                        <a href="#" class="btn btn-success">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>