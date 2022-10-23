<?php

class ProfileStudent
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
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Style/styleStudent.css"/>
    <title>Student Profile</title>
</head>

<body>
<main>
    <div class="upNav">
        <div class="login-container">
            <form action="">
                <button type="button" onclick="location.href='<?php echo ROOTURL . '/logout/'; ?>';">Logout</button>
                <span
                >Welcome
                 <?php
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
                        <a class="nav-link" href="updateProfile.php">Settings</a>
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
//                $sqlImg = "SELECT * FROM filesuser WHERE userid = '$uid' AND type = 'image' ";
//                $query = mysqli_query($connection, $sqlImg);
//                $resultImg = mysqli_query($connection, $sqlImg);
//                $rowImg = mysqli_fetch_assoc($resultImg);
//                echo "<div>";
//                $fileImg = str_replace("'", "", "uploads/images/profileImg'.$uid'");
//                $fileImg = str_replace(".", "", $fileImg);
//                $fileImg = $fileImg . '.jpg';
                //profileImg2203102jpg
                //echo $fileImg;
                //if ($rowImg['status']==0){echo "<img src = 'uploads/profileImg'.$uid.'jpg'>";}
//                if ($rowImg['status'] == 1) {
//                    echo "<img src='$fileImg'>";
//                } else {
//                    echo "<img src ='uploads/images/profiledefault.jpg'>";
//                }
//                echo "<br>" . $fullName;

                $student = new Student();
                $studentDetails = $student->getUserDetails();

                ?>
                <form name="f" action="#" method="POST">
                    <table style="border:1; width:50%;height:90%;">
                        <?php
                        foreach ($studentDetails

                        as $obj) { ?>
                        <tr>
                            <td><label>First Name:</label></td>
                            <td><input type="text" size="50" name="firstName"
                                       value= <?php echo $obj->firstName; ?> disabled></td>
                        </tr>
                        <tr>
                            <td><label>Last Name:</label></td>
                            <td><input type="text" size="50" name="lastName"
                                       value= <?php echo $obj->lastName; ?> disabled></td>
                        </tr>
                        <tr>
                            <td><label>Date of birth:</label></td>
                            <td><input type="text" size="50" name="dob"
                                       value= <?php echo $obj->dateOfBirth; ?> disabled></td>
                        </tr>
                        <tr>
                            <td><label>E-mail:</label></td>
                            <td><input type="email" size="50" name="email"
                                       value= <?php echo $obj->email; ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Password:</label></td>
                            <td><input type="text" size="50" name="password"
                                       value= <?php echo $obj->password; ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Phone Number:</label></td>
                            <td><input type="tel" size="50" name="phone"
                                       value= <?php echo $obj->phoneNumber; ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>CollegeID:</label></td>
                            <td><input type="number" size="50" name="stdID"
                                       value= <?php echo $obj->studentID; ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>R-Score:</label></td>
                            <td><input type="text" size="50" name="rscore"
                                       value= <?php echo $obj->RScore; ?> disabled></td>
                        </tr>
                        <tr>
                            <td><label>Cohort:</label></td>
                            <td>
                                <?php
//                                $sql1 = "SELECT programTitle FROM cohort INNER JOIN student ON student.cohortID = cohort.cohortID ;";
//                                $query1 = mysqli_query($connection, $sql1);
//                                $row1 = mysqli_fetch_assoc($query1); ?>
                                <input type="text" size="50" name="programTitle"
                                       value= <?php //echo $row1['programTitle']; ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Department:</label></td>
                            <td><input type="text" size="50" name="deptId"
                                       value= <?php echo $obj->depID; ?> disabled></td>
                        </tr>
                    </table>
                </form>

                <td></td>
            </tr>
            <tr>
                <td>jkhsdk</td>
                <td></td>
                <td>

                </td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="container mt-3">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><h3>Portfolio:</h3></td>

                <table>
                    <tr>
                        <th>File Type</th>
                        <th>Description</th>
                        <th>Last Update</th>
                    </tr>
                    <?php
//                    $sql = "SELECT * FROM filesuser WHERE userID =$uid AND type != 'image'";
//                    $result = mysqli_query($connection, $sql);
//                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><a href="uploads/documents/<?php //echo $uid . $row['type'] . "." . $row['extension'] ?>"
                                   target="_blank" "="" ><?php //echo $row['type'] ?></a></td>
                            <td><?php //echo $row['description']; ?></td>
                            <td><?php //echo $row ['lastUpdate'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
                </form>
                <?php //mysqli_close($connection); ?>
                </td>
                <td></td>
            </tr>

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
