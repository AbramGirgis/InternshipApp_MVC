<?php

class Settings
{

    public function __construct()
    {
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous"/>
    <link rel="stylesheet" href="Style/styleStudent.css"/>
    <title>Student Settings</title>
</head>

<body>
<main>
    <div class="upNav">
        <div class="login-container">
            <form action="">
                <button type="button" onclick="location.href='<?php echo ROOTURL . '/logout/'; ?>';"/>
                Logout</button>
                <span
                ><?php
                    $name = new Student();
                    $fullName = $name->getUserName();
                    $userName = $fullName[0]->fullName;
                    ?>
              <label id="student_username" name="student_username"><?php echo "<b>" . $userName . "</b>"; ?>
</label
></span>
            </form>
        </div>
    </div>

    <nav
            class="navbar navbar-expand-sm navbar-dark" style="background-color: #db1123; height: 90px">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><span
                        style="padding-left: 40px; padding-right: 50px; font-size: 30px"
                >Vanier College</span
                ></a>
            <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/home/" ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/profile/" ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/internship/" ?>">Internship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/myapplications/" ?>">My
                            Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/settings/" ?>">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="underNav">
        <p style="padding: 18px">
            <label id="percent" name="percent">60%</label>&nbsp; Complete your
            profile to have a higher chance of securing an internship!
        </p>
    </div>
    <div class="container mt-3">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td>
                    <h3>Profile<h3>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>

                <?php
                $imgStudent = new Student();
                $profilePic = $imgStudent->getProfilePic();
                // var_dump($profilePic);

                if (!empty($profilePic)) {
                    $fileImg = __DIR__ . "/images/profilePic" . $_SESSION['username'];
                    $fileImg = $fileImg . "." . $profilePic[0]->extension;
                    if ($profilePic[0]->status == 1) {
                        //echo "<img src='$fileImg' alt='Profile Picture!'>";
                    }
                } else {
                    //echo "<img src ='./images/profiledefault.jpg'>";
                }
                //echo "<br>" . $userName;
                echo "<br>";

                $student = new Student();
                $studentDetails = $student->getUserDetails();
                ?>

<!--                Upload Profile Picture-->
<!--                <form action='--><?php //echo ROOTURL . "/upload/picture/" ?><!--' method='POST' enctype='multipart/form-data'>-->
<!--                    <p><input type='file' name='file'></p>-->
<!--                    <p>-->
<!--                        <button type="submit" name="submit">Upload</button>-->
<!--                    </p>-->
<!--                </form>-->


                <form name="f" action="<?php echo ROOTURL."/student/update/"?>" method="POST">
                    <table style="border:1; width:50%;height:90%;">
                        <?php
                        foreach ($studentDetails

                        as $obj) { ?>
                        <tr>
                            <td><label>First Name:</label></td>
                            <td><input type="text" size="50" name="firstName" value= <?php echo $obj->firstName; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Last Name:</label></td>
                            <td><input type="text" size="50" name="lastName" value= <?php echo $obj->lastName; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Date of birth:</label></td>
                            <td><input type="text" size="50" name="dob" value= <?php echo $obj->dateOfBirth; ?>></td>
                        </tr>
                        <tr>
                            <td><label>E-mail:</label></td>
                            <td><input type="email" size="50" name="email" value= <?php echo $obj->email; ?>></td>
                        </tr>
                        <tr>
                            <td><label>Password:</label></td>
                            <td><input type="text" size="50" name="password" value= <?php echo $obj->password; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Phone Number:</label></td>
                            <td><input type="tel" size="50" name="phone" value= <?php echo $obj->phoneNumber; ?>></td>
                        </tr>
                        <tr>
                            <td><label>CollegeID:</label></td>
<!--                            <td><input type="number" size="50" name="stdID"-->
<!--                                       value= --><?php //echo $obj->studentID; ?><!-- disabled></td>-->
                            <td>
                                <label size="50">&nbsp;<?php echo $obj->studentID; ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>R-Score:</label></td>
                            <td><input type="text" size="50" name="rscore" value= <?php echo $obj->RScore; ?>></td>
                        </tr>
                        <tr>
                            <td><label>Cohort:</label></td>
                            <td>
                                <input type="text" size="50" name="cohortId"
                                       value= <?php echo $obj->cohortID; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Department:</label></td>
                            <?php
                            $department = new Internship();
                            $result = $department->getDepartment();
                            ?>
                            <td>
                                <label size="50">&nbsp;<?php echo $result[0]->name; ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" value="Update Profile" name="update" class="btn btn-primary btn-block"
                                       style="background-color: #9c000d; width: 175px">
                            </td>
                            <td>
                                <form action="<?php echo ROOTURL . "/student/deactivate/" ?>">
                                    <input type="submit" value="Deactivate Account" name="deactivate" class="btn btn-primary btn-block"
                                           style="width: 175px">
                                </form>
                            </td>
                        </tr>
                    </table>
                </form>

                <td></td>
            </tr>

            </tbody>
        </table>
    </div>


    <!--    Portfolio-->
    <div class="container mt-3">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><h3>Portfolio:</h3></td>

                <table class="table table-striped">
                    <tr>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>Description</th>
                        <th>Last Update</th>
                    </tr>
                    <?php
                    $studentDoc = new Student();
                    $stdDocuments = $studentDoc->getStudentDocuments();

                    foreach ($stdDocuments as $obj) {
                        ?>
                        <tr>
                            <td><?php echo $obj->fileName; ?></td>
                            <td><?php echo $obj->type; ?></td>
                            <td><?php echo $obj->description; ?></td>
                            <td><?php echo $obj->lastUpdate; ?></td>
                        </tr>
                    <?php } ?>
                    <script> function check() {
                            // if ((document.getElementsByName('filType').value=="") || (document.getElementsByName('descrip').value=="")){
                            if ((document.form1.filType.value == "") || (document.form1.descrip.value == "")) {
                                alert('Please input the file type and the file description');
                                event.preventDefault();
                            }
                        }
                    </script>

                    <tr>
                        <form name='form1' action='<?php echo ROOTURL . "/upload/file/" ?>' method='POST'
                              enctype='multipart/form-data'>
                            <td></td>
                            <td><input type="text" name="filType" placeholder="Enter the file Type"></td>
                            <td><input type="text" name="descrip" placeholder="Enter the file Description"></td>
                            <td>
                                <input type='file' name='file'>
                                <button type='submit' onClick='check();' name='uploadDoc'
                                        value='Upload'>Click To Upload</button>
                            </td>
                        </form>
                    </tr>

                    <?php } ?>
                </table>


    </div>


    <br><br><br><br><br>
    <footer class="foot">
        <p style="padding: 10px">
            @ IMS. Montreal, QC, CA <br/>
            Privacy | Terms
        </p>
    </footer>
</main>
</body>
</html>
