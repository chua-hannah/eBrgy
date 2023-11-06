<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FIRST JOB CERTIFICATION</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
             

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
            font-weight: bold;

        }
        .content {
            margin-top: 100px;
        }
        .footer {
            margin-top: 100px;
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
        .logo {
            position: absolute;
            right: 100px;
            top: 100px;
            height: 200px;
            weight: 200px;
        }
        .logo0 {
            position: absolute;
            left: 100px;
            top: 100px;
            height: 200px;
            width: 200px;
        }
        /* styles.css */
        .indented-paragraph {
            margin-left: 20px; /* Adjust the margin value as needed for your desired indentation. */
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
            <img src="./templates/certificates/brgy_cert_logo.png" alt="Description of the image" class="logo">
            <img src="./templates/certificates/brgy_logo2.jpg" alt="brgy logo" class="logo0">

        </div>

        <div class="header2">
        <u><h2>BARANGAY CERTIFICATION</h2></u>
            <p>(First Time Jobseekers Assistance Act - RA 11261)</p>
        </div>

        <div class="content">
            <p class="indented-paragraph mb-0">This is to certify that <?php echo $docRequestUserData['sex'] = " male" ? "Mr." : "Ms./Mrs."; ?> <?php echo strtoupper($docRequestUserData['firstname'] .' '. $docRequestUserData['firstname'].' '.$docRequestUserData['lastname']);?>, a resident of
            <?php echo strtoupper($docRequestUserData['address']);?>, for 18 years 7 months, is a qualified availee of <strong>RA 11261</strong> </p>
            <p class="mb-0">or the <strong>First Time Jobseekers Assistance Act of 2019</strong>.</p>
            <p class="indented-paragraph mt-3 mb-0">I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath of</p><p> Undertaking he/she has signed and executed in the presence of Barangay Official/s.</p>
            <p>Signed this <?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("jS \d\a\y \of F, Y", strtotime($datetime));
            echo $date . ", ";
            ?>
            in the City/Municipality of Manila.</p>
            <p>This certification is valid only until <?php
                $datetime = $docRequestUserData['process_at'];
                $newDate = date("Y-m-d", strtotime($datetime . ' +1 year'));
                $formattedDate = date("jS \d\a\y \of F, Y", strtotime($newDate));
                echo $formattedDate;
                ?>
            , one (1) year from the issuance.</p>
        </div>
        <div class="footer">
            <br>
            <div><strong>RONALD M. LEE</strong></div>
            <div>Punong Barangay</div>
            <br>
            <p><?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("F j, Y", strtotime($datetime));
            echo $date;
            ?>
            </p>
        </div>
        <div class="footer">
            <p><strong>Witnessed by:</strong></p>
            <p><strong>ELJUN C. SAYO</strong></p>
            <p>Barangay Secretary</p>
            <p><?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("F j, Y", strtotime($datetime));
            echo $date;
            ?>
            </p>        </div>
      
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
