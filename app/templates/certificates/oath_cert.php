<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OATH OF UNDERTAKING CERTIFICATE</title>
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
        <u><h2>OATH OF UNDERTAKING CERTIFICATE</h2></u>
        </div>

        <div class="content justify-content">

            <p class="indented-paragraph mb-0">I, <?php echo strtoupper($docRequestUserData['firstname'] .' '. $docRequestUserData['firstname'].' '.$docRequestUserData['lastname']);?>, 
            <?php echo $docRequestUserData['age'];?> years of age, resident of <?php echo strtoupper($docRequestUserData['address']);?> 
            BARANGAY 95 ZONE 8, TONDO MANILA for  <?php echo strtoupper($docRequestUserData['message']);?>, availing the benefits of <strong>Republic Acts 11261</strong>, otherwise known as the <strong>First Time Jobseeker Act of 2019</strong>   , do hereby declare, agree, and undertake to abide and be bound by the following:</p>
                <ol class="mt-3">
                    <li>That this is the first time that I will actively look for a job, and therefore requesting that a Barangay Certification be issued in my favor to avail the benefits of the law.</li>
                    <li>That I am aware that the benefit and privilege/s under the said law shall be valid only for one (1) year from the date that the Barangay Certification is issued.</li>
                    <li>That I can avail the benefits of the law only once.</li>
                    <li>That I understand that my personal information shall be included in the roster/list of First Time Jobseekers and will not be used for unlawful purposes.</li>
                    <li>That I will inform and/or report to the Barangay personally, through text or other means, or through my family/relative once I get employed.</li>
                    <li>That I am not a beneficiary of the Jobstart Program under R.A No. 10869 and other laws that give similar exemptions for the documents or transactions exempted under R.A No. 11261.</li>
                    <li>That if issued the requested Certification, I will not use the same in any fraud, neither falsify nor help and/or assist in the fabrication of the said certification.</li>
                    <li>That this undertaking is made solely for the purpose of obtaining a Barangay Certification consistent with the objective of R.A No. 11261 and not for any other purpose.</li>
                    <li>That I consent to the use of my personal information pursuant to the Data Privacy Act and other applicable laws, rules, and regulations.</li>
                </ol>            
            <p>Signed this <?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("jS \d\a\y \of F, Y", strtotime($datetime));
            echo $date . ", ";
            ?>
            in the City/Municipality of Manila.</p>
        </div>        
        <div class="footer">
            <p><strong>Signed by:</strong></p>
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
