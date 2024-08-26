<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrphaCare - Slip</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                                <label for="orphanId" class="form-label">Orphan ID or Guardian's Phone Number</label>
                                <input type="text" id="orphanId" class="form-control form-control-lg" placeholder="Enter ID or Phone Number">
                            </div>
                            <p class="text-muted mb-4">Please allow popups for this site from your browser</p>
                            <div class="d-grid gap-2">
                                <button id="printBtn" class="btn btn-primary btn-lg" disabled>
                                    <i class="fas fa-print me-2"></i> Print Orphan Care Slip
                                </button>
                                <button id="downloadBtn" class="btn btn-success btn-lg" disabled>
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
    <script>
        const orphanIdInput = document.getElementById('orphanId');
        const printBtn = document.getElementById('printBtn');
        const downloadBtn = document.getElementById('downloadBtn');

        // ... rest of your JavaScript remains the same
        orphanIdInput.addEventListener('input', function() {
            const isInputFilled = this.value.trim() !== '';
            printBtn.disabled = !isInputFilled;
            downloadBtn.disabled = !isInputFilled;
        });

        printBtn.addEventListener('click', function() {
            const orphanId = orphanIdInput.value;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Orphan Care Slip</title>
                        <style>
                            body { font-family: Arial, sans-serif; }
                            .slip { border: 1px solid #000; padding: 20px; max-width: 500px; margin: 20px auto; }
                            h1 { text-align: center; }
                        </style>
                    </head>
                    <body>
                        <div class="slip">
                            <h1>Orphan Care Slip</h1>
                            <p><strong>Orphan ID / Guardian's Phone:</strong> ${orphanId}</p>
                            <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
                            <p>This slip confirms the registration of the orphan with the provided ID/Phone number in our care program.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        });

        downloadBtn.addEventListener('click', function() {
            const orphanId = orphanIdInput.value;
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

            doc.text(`Id. Number: ${orphanId}`, 20, contentStart);
            doc.text(`Name: Jafar Muhammad Tanko`, 20, contentStart + lineHeight);
            doc.text(`Address: Kasuwar Shanu Azare`, 20, contentStart + 2 * lineHeight);
            doc.text(`Number of Orphans: 8`, 20, contentStart + 3 * lineHeight);
            doc.text(`Donation Requested: Food`, 20, contentStart + 4 * lineHeight);
            doc.text(`Date and Time of Collection: 10-09-2029 (11:00am)`, 20, contentStart + 5 * lineHeight);
            doc.text(`Collection Point: Azare`, 20, contentStart + 6 * lineHeight);
            doc.text(`Collection Agent: Mudi Salga`, 20, contentStart + 7 * lineHeight);

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
            doc.save('OrphanDistributionCard.pdf');
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>