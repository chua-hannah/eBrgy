<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CERTIFICATE OF INDIGENCY</title>
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
            margin-top: 60px;
        }
        .header2 {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;

        }
        .content {
            margin-top: 40px;
            display: flex;
            border-top: 1px solid #000; /* Add a 1px solid black top border */
        }

        .content1 {
           width: 30%;
           justify-content: center;
           border-right: 1px solid #000; /* Add a 1px solid black top border */
        }
        .content2 {
           width: 70%;
           margin-left: 16px;
           margin-top: 16px;
        }
        .footer {
            margin-top: 60px;
            text-align: right;
        }
        .printable {
            display: block;
        }
        @media print {
             .non-printable {
                display: none;
            }
            input[type="checkbox"]:checked {
            background-color: red; /* Change the background color to black when checked */
        }
        }
        .logo {
            position: absolute;
            right: 100px;
            top: 100px;
            height: 200px;
            width: 200px;
        }
        .logo0 {
            position: absolute;
            left: 100px;
            top: 100px;
            height: 200px;
            width: 200px;
        }
        .logo1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top: 0px;
            height: 800px;
            width: 800px;
            opacity: 0.2;
        }
        .kap {
         
            height: 200px;
            width: 200px;
           
        }

        .checkbox-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            margin-left: 16px;
            margin-top: 16px;
        }
        input[type="checkbox"] {
            border: 2px solid #000; 
            width: 20px; 
            height: 20px; 
            border-radius: 0; 
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
            <p class="fw-bold">REPUBLIC OF THE PHILIPPINES</p>
            <p>City of Manila</p>
            <p>OFFICE OF THE BARANGAY CHAIRMAN</p>
            <p>BARANGAY 95 - ZONE 8 DISTRICT 1</p>
            <p>TELEPHONE NO. 08-294-47-66</p>
            <img src="./templates/certificates/brgy_cert_logo.png" alt="brgy logo" class="logo">
            <img src="./templates/certificates/brgy_logo2.jpg" alt="brgy logo" class="logo0">
            <img src="./templates/certificates/brgy_cert_logo1.svg" alt="brgy logo" class="logo1">
        </div>

        <div class="header2">
        <u><h2>BARANGAY CERTIFICATE</h2></u>
           
        </div>

        <div class="content">
            <div class="content1 text-center">
                <div>
                <img src="./templates/certificates/brgycap.png" class="kap" >
                <div><strong>RONALD M. LEE</strong></div>
                <div>Punong Barangay</div>
                </div>

                <div class="mt-3">
                <div><strong>ARMAN CHRISTOPHER A. BUZETA</strong></div>
                <div>Com. Clean and Green/Appropriation</div>
                </div>

                <div class="mt-3">
                <div><strong>ESTELA M. FLORES</strong></div>
                <div>Com. Health and Livelihood</div>
                </div>

                <div class="mt-3">
                <div><strong>JOEL T. MENDOZA</strong></div>
                <div>Com. Sports</div>
                </div>

                <div class="mt-3">
                <div><strong>FRANCISCO E.TAYLO</strong></div>
                <div>Com. Ways and Means</div>
                </div>

                <div class="mt-3">
                <div><strong>EDGARDO J. FELICIANO</strong></div>
                <div>Com. Livelihood and Peace and Order</div>
                </div>

                <div class="mt-3">
                <div><strong>REYNALDO L. REYES</strong></div>
                <div>Com. Clean and Green</div>
                </div>

                <div class="mt-3">
                <div><strong>ERNESTO B. DE CASTRO</strong></div>
                <div>Com. Peace and Order/Housing</div>
                </div>

                <div class="mt-3">
                <div><strong>JASMIN D. CORBITO</strong></div>
                <div>SK Chairman</div>
                </div>

                <div class="mt-3">
                <div><strong>ELJUN C. SAYO</strong></div>
                <div>Brgy. Secretary</div>
                </div>

                <div class="mt-3">
                <div><strong>ANTONIO P. GARRA</strong></div>
                <div>Brgy. Treasurer</div>
                <br>
                <div>ECS 2018</div>
                </div>
            </div>
            <div class="content2 justify-content">
                <div>
                <p><strong>TO WHOM IT MAY CONCERN</strong></p>
                <p class="indented-paragraph mb-0" style="text-indent: 20px;">This is to certify that <?php echo $docRequestUserData['sex'] = " male" ? "Mr." : "Ms./Mrs."; ?> <?php echo strtoupper($docRequestUserData['firstname'] .' '. $docRequestUserData['firstname'].' '.$docRequestUserData['lastname']);?>, <?php echo $docRequestUserData['age'];?> years old with a postal address at
                <?php echo strtoupper($docRequestUserData['address']); ?> Tondo, Manila is a bonafide resident of this Barangay, Barangay 95 Zone 8 District 1, Manila.</p>

                <p class="indented-paragraph mt-2 mb-0" style="text-indent: 20px;">This further certifies that the subject person concerned is known to us that belong to
             the INDIGENT FAMILY of this Barangay. Their family has no sufficient income and barely enough to meet their day-to-day needs as well as their <?php echo strtoupper($docRequestUserData['message']);?>.</p>

                <p class="indented-paragraph mt-2 mb-0" style="text-indent: 20px;">This Certification was issued upon the request of the above-mentioned person for
                <?php echo strtoupper($docRequestUserData['message']);?>.</p>

                <p class="indented-paragraph mt-3 mb-0">IN WITNESS WHEREOF I have hereunto set my hand and affixed the official seal of this office.</p>

                <p class="indented-paragraph mt-2">This <?php
                $datetime = $docRequestUserData['process_at'];
                $date = date("jS \d\a\y \of F, Y", strtotime($datetime));
                echo $date . ", ";
                ?> in the City of Manila.</p>
            </div>
       <div>
       <div class="footer">
                <p>Issued by:</p>
                <div><strong>ELJUN C. SAYO</strong></div>
                <div>Barangay Secretary</div>
                <div><?php
                $datetime = $docRequestUserData['process_at'];
                $date = date("F j, Y", strtotime($datetime));
                echo $date;
                ?>
                </div>        
            </div>
            <div class="footer">
     
            <br>
            <p>Certified by:</p>
            <div><strong>Hon. RONALD M. LEE</strong></div>
            <div>Punong Barangay</div>
            <p><?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("F j, Y", strtotime($datetime));
            echo $date;
            ?>
            </p>
            </div>
       </div>
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
