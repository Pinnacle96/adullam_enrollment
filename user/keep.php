<?php 
$stuid = $_SESSION['SESSION_EMAIL'];
$query = mysqli_query($con, "SELECT tbladmission.*, tbluser.*, tbladmission.email as appid FROM tbladmission 
                             JOIN tbluser ON tbluser.email = tbladmission.email WHERE tbladmission.email = '$stuid'");
$rw = mysqli_num_rows($query);

if($rw > 0) {
    while($row = mysqli_fetch_array($query)) {
        // Debugging: Check the contents of $row
        // echo '<pre>';
        // var_dump($row);
        // echo '</pre>';
?>

    <p style="font-size:16px; color:red" align="center">Your Admission Form already submitted.</p>
    <div id="exampl">  
        <div class="table-responsive">
            <table class="table table-bordered border-0 mb-0">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img src="userimages/<?php echo $row['userpic']; ?>" width="150" height="150"></td>
                </tr>
                <tr>
                    <?php if($row['AdminStatus'] != ""): ?>
                        <th>Admin Status</th>
                        <td>
                            <?php 
                            if($row['AdminStatus'] == "") {
                                echo "Admin remark is pending";
                            } 
                            if($row['AdminStatus'] == "1") {
                                echo "Admitted";
                            }
                            if($row['AdminStatus'] == "2") {
                                echo "Not Admitted";
                            }
                            ?>
                        </td>
                        <th>Date Admitted</th>
                        <td><?php echo $row['AdminRemarkDate']; ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th>Applicant Name</th>
                    <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                </tr>
                <tr>
                    <th>Program Applied</th>
                    <td><?php echo $row['programApplied']; ?></td>
                    <th>Registration Date</th>
                    <td><?php echo $row['programApplieddate']; ?></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><?php echo $row['gender']; ?></td>
                    <th>Country of Residence</th>
                    <td><?php echo $row['country']; ?></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><?php echo $row['dob']; ?></td>
                    <th>Nationality</th>
                    <td><?php echo $row['Nationality']; ?></td>
                </tr>
                <tr>
                    <th>Contact Address</th>
                    <td><?php echo $row['contadd']; ?></td>
                    <th>Learning Option</th>
                    <td><?php echo $row['learningOption']; ?></td>
                </tr>
                <tr>
                    <th>Emergency Name</th>
                    <td><?php echo $row['emergencyName']; ?></td>
                    <th>Emergency Contact</th>
                    <td><?php echo $row['emergencyPhone']; ?></td>
                </tr>
                <tr>
                    <th>Birth Certificate</th>
                    <td><a href="userdocs/<?php echo $row['birthCert']; ?>" target="_blank">View File</a></td>
                    <th>LGA Certificate</th>
                    <td><a href="userdocs/<?php echo $row['lgaCert']; ?>" target="_blank">View File</a></td>
                </tr>
                <tr>
                    <th>Academic Certificate</th>
                    <td><a href="userdocs/<?php echo $row['acadCert']; ?>" target="_blank">View File</a></td>
                    <th>Reference Letter</th>
                    <td>
                        <?php if($row['refLetter'] == ""): ?>
                            NA
                        <?php else: ?>
                            <a href="userdocs/<?php echo $row['refLetter']; ?>" target="_blank">View File</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Application Fees</th>
                    <td>
                        <?php if($row['receipt'] == ""): ?>
                            NA
                        <?php else: ?>
                            <a href="userdocs/<?php echo $row['receipt']; ?>" target="_blank">View File</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="float:right;">
    <a href="Adullam Medical Forms.pdf" ><button class="btn btn-primary" style="cursor: pointer;"  OnClick="CallPrint(this.value)" >Download Medical Form</button></a></div>
    
    </div>
    <?php if($row['AdminStatus'] == ""): ?>
        <p style="text-align: center; font-size: 20px;"><a href="edit-appform.php?editid=<?php echo $row['appid']; ?>">Edit Details</a></p>
    <?php endif; ?>
<?php 
   }  // End while loop
} else { 

if (isset($_POST['submit'])) {
        // Initialize variables
        $uid = $_SESSION['SESSION_EMAIL'];
        $title = $_POST['title'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contadd = $_POST['contadd'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $postalcode = $_POST['postalcode'];
        $phone = $_POST['phone'];
        $nationality = $_POST['Nationality'];
        $salvation = $_POST['salvation'];    
        $conversion = $_POST['conversion'];
        $ministry = $_POST['ministry'];
        $calltoministry = $_POST['calltoministry'];
        $spiritual = $_POST['spiritual'];
        $reasons = $_POST['reasons'];
        $churchName = $_POST['churchName'];
        $churchAddress = $_POST['churchAddress'];
        $ministerName = $_POST['ministerName'];
        $ministerEmail = $_POST['ministerEmail'];
        $ministerPhone = $_POST['ministerPhone'];
        $churchActivities = $_POST['churchActivities'];
        $bwater = $_POST['bwater'];
        $bwaterDate = $_POST['bwaterDate'];
        $tongues = $_POST['tongues'];
        $programApplied = $_POST['programApplied'];
        $learningOption = $_POST['learningOption'];
        $disability = $_POST['disability'];
        $mentalIllness = $_POST['mentalIllness'];
        $eatingDisorder = $_POST['eatingDisorder'];
        $medicalProblem = $_POST['medicalProblem'];
        $prescribedMed = $_POST['prescribedMed'];
        $specialDiet = $_POST['specialDiet'];
        $learningDisability = $_POST['learningDisability'];
        $hobbies = $_POST['hobbies'];
        $workExperience = $_POST['workExperience'];
        $emergencyName = $_POST['emergencyName'];
        $emergencyPhone = $_POST['emergencyPhone'];
        $emergencyEmail = $_POST['emergencyEmail'];
        $ref1Name = $_POST['ref1Name'];
        $ref1Phone = $_POST['ref1Phone'];
        $ref1Email = $_POST['ref1Email'];
        $ref2Name = $_POST['ref2Name'];
        $ref2Phone = $_POST['ref2Phone'];
        $ref2Email = $_POST['ref2Email'];
        $accommodation = $_POST['accommodation'];
        $agreement = $_POST['agreement'];
        $userpic = $_FILES["userpic"]["name"];
        $birthCert = $_FILES["birthCert"]["name"];
        $lgaCert = $_FILES["lgaCert"]["name"];
        $acadCert = $_FILES["acadCert"]["name"];
        $refLetter = $_FILES["refLetter"]["name"];
        $receipt = $_FILES["receipt"]["name"];
        
        // File extensions
        $extension = strtolower(substr($userpic, strrpos($userpic, '.')));
        $extensiontc = strtolower(substr($birthCert, strrpos($birthCert, '.')));
        $extensiontm = strtolower(substr($lgaCert, strrpos($lgaCert, '.')));
        $extensiontwm = strtolower(substr($acadCert, strrpos($acadCert, '.')));
        $extensionref = strtolower(substr($refLetter, strrpos($refLetter, '.')));
        $extensionrec = strtolower(substr($receipt, strrpos($receipt, '.')));

        // Allowed extensions
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".pdf");

        // Validation for allowed extensions
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } elseif (!in_array($extensiontc, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensiontm, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensiontwm, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensionref, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensionrec, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } else {
            // Rename files
            $userpic = md5($userpic) . $extension;
            $birthCert = md5($birthCert) . $extensiontc;
            $lgaCert = md5($lgaCert) . $extensiontm;
            $acadCert = md5($acadCert) . $extensiontwm;
            if (!empty($refLetter)) {
                $refLetter = md5($refLetter) . $extensionref;
            } else {
                $refLetter = "";
            }
            if (!empty($receipt)) {
                $receipt = md5($receipt) . $extensionrec;
            } else {
                $receipt = "";
            }

            // Move uploaded files to destination folder
            move_uploaded_file($_FILES["birthCert"]["tmp_name"], "userdocs/" . $birthCert);
            move_uploaded_file($_FILES["lgaCert"]["tmp_name"], "userdocs/" . $lgaCert);
            move_uploaded_file($_FILES["acadCert"]["tmp_name"], "userdocs/" . $acadCert);
            move_uploaded_file($_FILES["refLetter"]["tmp_name"], "userdocs/" . $refLetter);
            move_uploaded_file($_FILES["receipt"]["tmp_name"], "userdocs/" . $receipt);
            move_uploaded_file($_FILES["userpic"]["tmp_name"], "userimages/" . $userpic);

            //  // Generate ADM No (e.g., ADM/2024/UND/00001)
            // $prefix = "ADM/2024/UND/";
            // $query_count = mysqli_query($con, "SELECT COUNT(ID) as total FROM tbladmapplications");
            // $row_count = mysqli_fetch_assoc($query_count);
            // $count = $row_count['total'] + 1;
            // $adm_no = $prefix . sprintf('%05d', $count);

            // Prepare SQL statement
            $query = mysqli_prepare($con, "INSERT INTO tbladmapplications (UserId, title, dob, gender, contadd, city, state, country, postalcode, phone, Nationality, salvation, conversion, ministry, calltoministry, spiritual, reasons, churchName, churchAddress, ministerName, ministerEmail, ministerPhone, churchActivities, bwater, bwaterDate, tongues, programApplied, learningOption, disability, mentalIllness, eatingDisorder, medicalProblem, prescribedMed, specialDiet, learningDisability, hobbies, workExperience, emergencyName, emergencyPhone, emergencyEmail, ref1Name, ref1Phone, ref1Email, ref2Name, ref2Phone, ref2Email, accommodation, agreement, userpic, birthCert, lgaCert, refLetter, acadCert, receipt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

            if ($query === false) {
                trigger_error('Statement prepare failed!', E_USER_ERROR);
            }

            // Bind parameters
            mysqli_stmt_bind_param($query, "ssssssssssssssssssssssssssssssssssssssssssssssssssssss", $uid, $title, $dob, $gender, $contadd, $city, $state, $country, $postalcode, $phone, $nationality, $salvation, $conversion, $ministry, $calltoministry, $spiritual, $reasons, $churchName, $churchAddress, $ministerName, $ministerEmail, $ministerPhone, $churchActivities, $bwater, $bwaterDate, $tongues, $programApplied, $learningOption, $disability, $mentalIllness, $eatingDisorder, $medicalProblem, $prescribedMed, $specialDiet, $learningDisability, $hobbies, $workExperience, $emergencyName, $emergencyPhone, $emergencyEmail, $ref1Name, $ref1Phone, $ref1Email, $ref2Name, $ref2Phone, $ref2Email, $accommodation, $agreement, $userpic, $birthCert, $lgaCert, $refLetter, $acadCert, $receipt);

            // Execute statement
            mysqli_stmt_execute($query);

            // Check if query executed successfully
            if (mysqli_stmt_affected_rows($query) > 0) {
                echo '<script>alert("Data has been added successfully.")</script>';
            } else {
                echo '<script>alert("Error: Unable to add data. Please try again.")</script>';
            }

            // Close statement
            mysqli_stmt_close($query);
        }
    }
}
?> 