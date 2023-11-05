<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BARANGAY CERTIFICATION</title>
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
            <div class="content2">
                <div>
                <p><strong>TO WHOM IT MAY CONCERN</strong></p>
                <p class="indented-paragraph">This is to certify that <?php echo $docRequestUserData['sex'] = " male" ? "Mr." : "Ms./Mrs."; ?> <?php echo $docRequestUserData['firstname'] .' '. $docRequestUserData['firstname'].' '.$docRequestUserData['lastname'] ;?>, <?php echo $docRequestUserData['age'];?> years old with a postal address at</p>
            <p><?php echo $docRequestUserData['address'];?> Tondo, Manila is a bonafide resident of this Barangay, Barangay 95 Zone 8 District 1, Manila.</p>
            <p class="indented-paragraph">This Certification was issued upon the request of the above mentioned
            name for legal purpose that may serve him/her best, That he/she has No
            Deragatory Record or pending case filed against him/her in his barangay.</p>
            <div class="indented-paragraph mt-5"><strong><u>REQUIREMENT IN SUPPORT OF HIS/HER DOCUMENT:</u></strong></div>
            <div class="checkbox-container mt-2">
                <label>
                    <input type="checkbox" name="option" id="option1" <?php if ($docRequestUserData['message'] === 'Requirement for Employment') echo ' checked '; ?> > Requirement for Employment
                </label>
                <label>
                    <input type="checkbox" name="option" id="option2"  <?php if ($docRequestUserData['message'] === 'Medical Purpose') echo ' checked '; ?> > Medical Purpose <?php if ($docRequestUserData['message'] === 'Medical Purpose') echo '<u>' . $docRequestUserData['purpose'] . '</u>'; ?>
                </label>
                <label>
                    <input type="checkbox" name="option" id="option3"  <?php if ($docRequestUserData['message'] === 'School Requirement') echo ' checked '; ?> > School Requirement <u>ADMISSION</u>
                </label>
                <label>
                    <input type="checkbox" name="option" id="option4" <?php if ($docRequestUserData['message'] === 'Vending Permit') echo ' checked '; ?> > Vending Permit <?php if ($docRequestUserData['message'] === 'Vending Permit') echo '<u>' . $docRequestUserData['purpose'] . '</u>'; ?>
                </label>
                <label>
                    <input type="checkbox" name="option" id="option5"  <?php if ($docRequestUserData['message'] === 'Hospital Purposes') echo ' checked '; ?> > Hospital Purposes
                </label>
                <label>
                    <input type="checkbox" name="option" id="option6" <?php if ($docRequestUserData['message'] === 'Bank Requirements') echo ' checked '; ?>> Bank Requirements <?php if ($docRequestUserData['message'] === 'Bank Requirements') echo '<u>' . $docRequestUserData['purpose'] . '</u>'; ?>
                </label>
                
                <label>
                    <input type="checkbox" name="option" id="option7" <?php if ($docRequestUserData['message'] === 'SSS/GSIS Requirement') echo ' checked '; ?>> SSS/GSIS Requirement
                </label>
                <label>
                    <input type="checkbox" name="option" id="option8" <?php if ($docRequestUserData['message'] === 'Transfer of Resident') echo ' checked '; ?>> Transfer of Resident
                </label>
                <label>
                    <input type="checkbox" name="option" id="option9" <?php if ($docRequestUserData['message'] === 'Calamity / Livelihood Loan') echo ' checked '; ?>> Calamity / Livelihood Loan
                </label>
                <label>
                    <input type="checkbox" name="option" id="option10" <?php if ($docRequestUserData['message'] === 'ID for') echo ' checked '; ?>> ID for <?php if ($docRequestUserData['message'] === 'ID for') echo '<u>' . $docRequestUserData['purpose'] . '</u>'; ?>
                </label>
                <label>
                    <input type="checkbox" name="option" id="option11" <?php if ($docRequestUserData['message'] === 'Others') echo ' checked '; ?>> Others: <?php if ($docRequestUserData['message'] === 'Others') echo '<u>' . $docRequestUserData['purpose'] . '</u>'; ?>
                </label>
            </div>
            <div class="indented-paragraph mt-2">IN WITNESS WHEREOF I have hereunto set my hand and affixed the official seal of
            this office.</div> <?php
            $datetime = $docRequestUserData['process_at'];
            $date = date("jS \d\a\y \of F, Y", strtotime($datetime));
            echo $date;
            ?>
            , in the City/Municipality of Manila</p>
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
            <div>Certified by:</div>
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
        

    <div class="text-center" style="margin-bottom: 40px;">
        <button id="generatePdf" class="btn btn-secondary non-printable">Print</button>
    </div>
    <script>
    document.getElementById("generatePdf").addEventListener("click", function () {

        window.print();

    });
    var checkboxes = document.querySelectorAll('.checkbox-container input[type="checkbox"]');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default click action
        });
    });
    
</script>



</body>
</html>
