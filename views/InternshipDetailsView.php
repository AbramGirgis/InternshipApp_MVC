<?php

class InternshipDetailsView
{
    private int $internshipId;

    public function __construct($internshipId)
    {
        $this->internshipId = $internshipId;
        $this->render($this->internshipId);
    }

    private function render($var){
        echo $var;
        echo "<br>";
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
    <title>Internship Details</title>
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
</label></span
                >
            </form>
        </div>
    </div>

    <nav
            class="navbar navbar-expand-sm navbar-dark"
            style="background-color: #db1123; height: 90px">
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
                        <a class="nav-link" href="<?php echo ROOTURL."/student/home/"?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL."/student/internship/"?>">Internship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL."/student/myapplications/"?>">My Applications</a>
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

        <p>
            <?php
            $department = new Internship();
            $result = $department->getDepartment();
            ?>
            <b><?php echo $result[0]->name; ?> Department</b>
            <br>
        </p>
        <?php
        $internshipsDetails = new Internship();
        $details = $internshipsDetails->getInternshipDetails(3);
        ?>

        <table class="table table-striped">
            <tbody>
            <?php
            foreach ($details as $obj) { ?>
            <tr>
                <td>Internship Title</td>
                <td><?php echo $obj->internshipTitle; ?></td>
            </tr>
            <tr>
                <td> Company Name:</td>
                <td> <?php echo $obj->companyName; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><a href="mailto: <?php echo $obj->email; ?>">Send Email</a></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><a href="tel:<?php echo $obj->phoneNumber; ?>">Call Number</a></td>
            </tr>
            <tr>
                <td> Long Description:</td>
                <td> <?php echo $obj->longDescription; ?></td>
            </tr>
            <tr>
                <td>Skills required</td>
                <td><?php echo $obj->skillsRequired; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <form method="POST" action="status.php">
                        <?php $internshipID= $obj->internshipID ?>
                        <!-- <button class ="btn btn-danger" name ="apply"> <?php echo '<a href="viewDetail.php?detailId=' . $internshipID . '"style ="color:white;" >Apply</a>'; ?></button> -->
                        <input type="submit" value="Apply" name="Apply" class="btn btn-primary btn-block"
                               style="background-color: #9c000d; width: 175px">
                    </form>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <?php } ?>
            </tbody>
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
