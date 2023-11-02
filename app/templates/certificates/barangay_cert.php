<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BARANGAY CERTIFICATION</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px; 

        }
        .container {
            width: 80%;
            margin-top: 0 auto;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-top: 100px;

        }
        .header2 {
            text-align: center;
            margin-top: 60px;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
        .printable {
            display: block;
        }
        @media print {
             .non-printable {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>City of Manila</p>
            <p class="fw-bold">REPUBLIC OF THE PHILIPPINES</p>
            <p>OFFICE OF THE BARANGAY CHAIRMAN</p>
            <p>BARANGAY 95 - ZONE 8</p>
            <p>DISTRICT 1</p>
            <p>TELEPHONE NO. 8-294-47-66</p>
        </div>
        <div class="header2">
        <u><h2>BARANGAY CERTIFICATION</h2></u>
            <p>(First Time Jobseekers Assistance Act - RA 11261)</p>
        </div>
        <div class="content">
            <p>This is to certify that Mr./Ms. <input type="text" id="full-name" placeholder="Full Name">, a resident of</p>
            <p><input type="text" id="address" placeholder="Address">, for 18 years 7 months, is a qualified availee of <strong>RA 11261</strong> or the <strong>First Time Jobseekers Assistance Act of 2019</strong>.</p>
            <p>I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath of Undertaking he/she has signed and executed in the presence of Barangay Official/s.</p>
            <p>Signed this <input type="text" id="cert-date" placeholder="Certification Date">, in the City/Municipality of <input type="text" id="city" placeholder="City/Municipality"></p>
        </div>
        <div class="footer">
            <p>This certification is valid only until <input type="text" id="valid-until" placeholder="Valid Until">, one (1) year from the issuance.</p>
            <br>
            <div><strong>RONALD M. LEE</strong></div>
            <div>Punong Barangay</div>
            <br>
            <p><input type="text" id="punong-barangay-date" placeholder="Punong Barangay Date"></p>
        </div>
        <div class="footer">
            <p>Witnessed by:</p>
            <p><strong>ELJUN C. SAYO</strong></p>
            <p>Barangay Secretary</p>
            <p><input type="text" id="secretary-date" placeholder="Secretary Date"></p>
        </div>
      
    </div>

    <div class="text-center">
        <button id="generatePdf" class="btn btn-secondary non-printable">Print</button>
    </div>
    <script>
    document.getElementById("generatePdf").addEventListener("click", function () {
        // Get all input elements
        var inputElements = document.querySelectorAll("input");

        // Loop through the input elements and replace them with their values as text nodes
        inputElements.forEach(function(input) {
            var textNode = document.createTextNode(input.value);
            input.parentNode.replaceChild(textNode, input);
        });

        // Print the page
        window.print();

        // After printing, restore the input fields
        inputElements.forEach(function(input) {
            var textNode = input.previousSibling;
            if (textNode && textNode.nodeType === 3) {
                input.parentNode.replaceChild(input, textNode);
            }
        });
    });
</script>



</body>
</html>
