<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrphaCare - Slip</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Toastr CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .body {
            /* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); */
            background-color: var(--white);
            background-size: 400% 400%;
            /* animation: gradient 15s ease infinite; */
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .card {
            border: none;
            border-radius: 1rem;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.7);
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

        .social-btn {
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
        }

        .bg-login-image {
            background-position: center;
            background-size: cover;
            background-image: url(./assets/images/login/login.jpg);
            overflow: hidden;
        }

        .inp {
            height: 100%;
        }

        .bt {
            height: 100%;
        }

        .form-container {
            background-color: white;
            padding-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 100px auto;
            /* This centers the form and adds top margin */
            margin-top: 17%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include "./assets/include/header.php" ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Print Orphan Care Slip</h2>
                        <form>
                            <div class="mb-4">
                                <label for="key" class="form-label">Orphan ID or Guardian's Phone Number</label>
                                <input type="text" id="key" class="form-control form-control-lg"
                                    placeholder="Enter ID or Phone Number">
                            </div>
                            <p class="text-muted mb-4">Please allow popups for this site from your browser</p>
                            <div class="d-grid gap-2">
                                <button id="downloadBtn" class="btn btn-success btn-lg">
                                    <i class="fas fa-download me-2"></i> Download Slip
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "./assets/include/footer.php" ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const keyInput = document.getElementById('key');
            const downloadBtn = document.getElementById('downloadBtn');

            keyInput.addEventListener('input', function () {
                const isInputFilled = this.value.trim() !== '';
                downloadBtn.disabled = !isInputFilled;
            });

            downloadBtn.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent form submission
                const key = keyInput.value;
                fetchUserDetails(key, downloadSlip);
            });
        });

        function fetchUserDetails(key, callback) {
            $.ajax({
                url: './admin/get_user_details.php',
                type: 'GET',
                data: {
                    key: key
                },
                success: function (response) {
                    console.log('Raw response:', response); // Debug log

                    // Check if the response is already an object
                    if (typeof response === 'object' && response !== null) {
                        userDetails = response;
                        // console.log('User details (already an object):', userDetails);
                        if (validateUserDetails(userDetails)) {
                            callback();
                        } else {
                            alert('Invalid user details structure received from server.');
                        }
                    } else {
                        try {
                            // Attempt to parse the response as JSON
                            userDetails = JSON.parse(response);
                            // console.log('Parsed user details:', userDetails);
                            if (validateUserDetails(userDetails)) {
                                callback();
                            } else {
                                alert('Invalid user details structure received from server.');
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            console.error('Raw response causing the error:', response);
                            alert('Error processing user details. Please check the console for more information.');
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    console.error('Full error object:', jqXHR);
                    alert('Error fetching user details. Please check the console for more information.');
                }
            });
        }

        function validateUserDetails(details) {
            const requiredFields = ['id_number', 'full_name_b', 'ward', 'address', 'op_number', 'benefit_type', 'collection_point_id'];
            for (const field of requiredFields) {
                if (!(field in details)) {
                    console.error(`Missing required field: ${field}`);
                    return false;
                }
            }
            return true;
        }

        function getCollectionPointDetails(collectionPointId) {
            return new Promise((resolve, reject) => {
                if (!collectionPointId) {
                    reject(new Error('Collection Point ID is required'));
                    return;
                }

                $.ajax({
                    url: './admin/get_collection_point_details.php',
                    type: 'GET',
                    data: {
                        id: collectionPointId
                    },
                    dataType: 'text', // Change this to 'text' instead of 'json'
                    success: function (response) {
                        try {
                            const parsedResponse = JSON.parse(response);
                            if (parsedResponse && typeof parsedResponse === 'object' && Object.keys(parsedResponse).length > 0) {
                                resolve(parsedResponse);
                            } else {
                                reject(new Error('No collection point details found'));
                            }
                        } catch (error) {
                            console.error('Raw server response:', response);
                            reject(new Error(`Failed to parse server response: ${error.message}`));
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error details:', {
                            status: jqXHR.status,
                            statusText: jqXHR.statusText,
                            responseText: jqXHR.responseText
                        });
                        reject(new Error(`Failed to fetch collection point details: ${textStatus} - ${errorThrown}`));
                    }
                });
            });
        }

        function getCollectionPointByWard(ward) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: './admin/get_collection_point_by_ward.php',
                    type: 'GET',
                    data: {
                        ward: ward
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response && typeof response === 'object' && !response.error) {
                            resolve(response);
                        } else {
                            reject(new Error(response.error || 'No collection point found for the given ward'));
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error details:', {
                            status: jqXHR.status,
                            statusText: jqXHR.statusText,
                            responseText: jqXHR.responseText
                        });
                        reject(new Error(`Failed to fetch collection point details: ${textStatus} - ${errorThrown}`));
                    }
                });
            });
        }

        function downloadSlip() {
            if (!userDetails || !validateUserDetails(userDetails)) {
                console.error('Invalid or missing user details');
                alert('Unable to download slip. Invalid or missing user details.');
                return;
            }

            let collectionPointPromise;

            if (userDetails.collection_point_id) {
                collectionPointPromise = getCollectionPointDetails(userDetails.collection_point_id);
            } else if (userDetails.ward) {
                collectionPointPromise = getCollectionPointByWard(userDetails.ward);
            } else {
                console.error('No collection point ID or ward available');
                alert('Unable to determine collection point. Please contact support.');
                return;
            }

            collectionPointPromise.then(collectionPointDetails => {
                const {
                    jsPDF
                } = window.jspdf;

                // Create new document in landscape A5 size
                const doc = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a5'
                });

                // Set document properties
                doc.setProperties({
                    title: 'XYZORPHANS ORGANIZATION AND CENTER Distribution Card',
                    subject: 'Orphan Distribution Card',
                    author: 'XYZORPHANS ORGANIZATION AND CENTER',
                    keywords: 'orphan, distribution, card',
                    creator: 'XYZORPHANS ORGANIZATION AND CENTER'
                });

                // Add border to the page
                doc.setDrawColor(0);
                doc.setLineWidth(0.5);
                doc.rect(5, 5, 200, 138);

                // Add header
                doc.setFontSize(16);
                doc.setFont("helvetica", "bold");
                doc.text('XYZORPHANS ORGANIZATION AND CENTER', 105, 15, null, null, 'center');

                doc.setFontSize(8);
                doc.setFont("helvetica", "normal");
                doc.text('No.11 Kasuwar Shanu GRA, Bauchi Azare Nigeria 0803872992', 105, 22, null, null, 'center');

                // Add title
                doc.setFontSize(14);
                doc.setFont("helvetica", "bold");
                doc.text('DISTRIBUTIONS CARD', 105, 30, null, null, 'center');

                // Add content
                doc.setFontSize(10);
                doc.setFont("helvetica", "normal");

                const contentStart = 40;
                const lineHeight = 8;

                doc.text(`Id. Number: ${userDetails.id_number}`, 20, contentStart);
                doc.text(`Name: ${userDetails.full_name_b}`, 20, contentStart + lineHeight);
                doc.text(`Address: ${userDetails.address}`, 20, contentStart + 2 * lineHeight);
                doc.text(`Number of Orphans: ${userDetails.op_number}`, 20, contentStart + 3 * lineHeight);
                doc.text(`Donation Requested: ${userDetails.benefit_type}`, 20, contentStart + 4 * lineHeight);
                const collectionDate = new Date();
                const formattedDate = `${collectionDate.getDate().toString().padStart(2, '0')}-${(collectionDate.getMonth() + 1).toString().padStart(2, '0')}-${collectionDate.getFullYear()} (${collectionDate.getHours().toString().padStart(2, '0')}:${collectionDate.getMinutes().toString().padStart(2, '0')}${collectionDate.getHours() >= 12 ? 'pm' : 'am'})`;
                doc.text(`Date and Time of Collection: ${formattedDate}`, 20, contentStart + 5 * lineHeight);
                doc.text(`Collection Point: ${collectionPointDetails.name}`, 20, contentStart + 6 * lineHeight);

                // Add placeholders for profile picture and QR code
                doc.rect(10, 95, 30, 30); // Profile picture placeholder
                doc.rect(165, 95, 30, 30); // QR code placeholder

                // Add footer
                doc.setFillColor(0);
                doc.rect(5, 130, 200, 10, 'F');
                doc.setTextColor(255);
                doc.setFontSize(8);
                doc.text('www.xyzorphans.com.ng', 105, 136, null, null, 'center');

                // Save the PDF
                const pdfFileName = `${userDetails.id_number}_OrphanDistributionCard.pdf`;
                doc.save(pdfFileName);
            })
                .catch(error => {
                    console.error('Error:', error.message);
                    alert('Failed to fetch collection point details. Please try again or contact support.');
                });

        }
        console.log('jsPDF availability:', typeof window.jspdf !== 'undefined');
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>