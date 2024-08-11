<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrphaCare - Donation</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        .body {
            background-color: var(--white);
            height: 100%;
            margin-bottom: 10vh;
            padding: 0;
        }

        .card {
            border: none;
            border-radius: 1rem;
            background-color: rgba(255, 255, 255, 0.9);
            overflow: hidden;
        }

        .card-header {
            background-color: transparent;
            border-bottom: none;
            padding: 2rem 1rem 1rem;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }

        .payment-btn {
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
        }

        .bg-donation-image {
            background-position: center;
            background-size: cover;
            background-image: url(https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80);
            overflow: hidden;
        }

        .bank-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .bank-details h5 {
            color: #4e73df;
            margin-bottom: 15px;
        }

        .bank-details p {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qr-code {
            max-width: 200px;
            margin: 0 auto;
        }

        .copy-icon {
            cursor: pointer;
            color: #4e73df;
        }

        .copy-icon:hover {
            color: #2e59d9;
        }
    </style>
</head>

<body>
    <!-- Navbar (same as before) -->
    <?php include "./assets/include/header.php" ?>

    <!-- Main Section -->
    <div class="container-fluid body">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-donation-image">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Make a Donation</h1>
                                        </div>
                                        <div class="bank-details mb-4">
                                            <h5 class="text-center">BANK ACCOUNT DETAILS</h5>
                                            <p><strong>Account Name:</strong> OrphaCare Foundation <i class="fas fa-copy copy-icon" onclick="copyToClipboard('OrphaCare Foundation')"></i></p>
                                            <p><strong>Account Number:</strong> 1234567890 <i class="fas fa-copy copy-icon" onclick="copyToClipboard('1234567890')"></i></p>
                                            <p><strong>Bank Name:</strong> Example Bank <i class="fas fa-copy copy-icon" onclick="copyToClipboard('Example Bank')"></i></p>
                                            <p><strong>SWIFT Code:</strong> EXAMPLEBANKXXX <i class="fas fa-copy copy-icon" onclick="copyToClipboard('EXAMPLEBANKXXX')"></i></p>
                                        </div>
                                        <div class="text-center mb-4">
                                            <h5>Payment Options</h5>
                                            <a href="#" class="btn btn-outline-primary btn-user payment-btn w-100 mb-2">
                                                <i class="fas fa-money-bill-wave fa-fw"></i> Pay with Monify
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-user payment-btn w-100 mb-2">
                                                <i class="fas fa-credit-card fa-fw"></i> Pay with Remita
                                            </a>
                                            <a href="#" class="btn btn-outline-info btn-user payment-btn w-100 mb-2">
                                                <i class="fas fa-wallet fa-fw"></i> Pay with Paystack
                                            </a>
                                        </div>
                                        <div class="text-center mb-4">
                                            <h5>QR Pay</h5>
                                            <p>Scan the QR code to make a quick payment</p>
                                            <div class="qr-code">
                                                <img src="./assets/images/donate.png" alt="QR Code for payment" class="img-fluid">
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

    <!-- Footer (same as before) -->
    <?php include "./assets/include/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>