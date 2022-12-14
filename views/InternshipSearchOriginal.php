<?php

class InternshipSearchOriginal
{
    private $keyWord;
    public function __construct($keyWord)
    {
        $this->keyWord=$keyWord;
        //echo $this->keyWord;

        $this->renderSearch($this->keyWord);

    }

    /**
     * @return mixed
     */
    public function getKeyWord()
    {
        return $this->keyWord;
    }

    public function renderSearch($key){
        $recentInternships = new Internship();
        foreach ($recentInternships->searchForInternships($key) as $obj) {
            echo $obj->internshipTitle;
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style/styleStudent.css"/>
    <title>Internships</title>
</head>

<body>
<main>
    <div class="upNav">
        <div class="login-container">
            <form action="">
                <button type="button" onclick="location.href='<?php echo ROOTURL . '/logout/'; ?>';">Logout</button><span>Welcome
                    <?php
                    $name = new Student();
                    $fullName = $name->getUserName();
                    $userName = $fullName[0]->fullName;
                    ?>
              <label id="student_username" name="student_username"><?php echo "<b>" . $userName . "</b>"; ?>
</label></span>
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
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/home/" ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL."/student/profile/"?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL . "/student/internship/" ?>">Internship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL."/student/myapplications/"?>">My Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOTURL."/student/settings/"?>">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="underNav">
        <!-- <p style="padding: 18px">
          <label id="percent" name="percent">60%</label>&nbsp; Complete your
          profile to have a higher chance of securing an internship!
        </p> -->

    </div>

    <div class="container mt-3">

        <h2>Internships</h2>
        <p>
            <?php
            $department = new Internship();
            $result = $department->getDepartment();
            ?>
            <b><?php echo $result[0]->name; ?> Department</b>
            <br>
            Here is a list of the availbale internship offers added to the department
        </p>
        <?php
        $recentInternships = new Internship();
        ?>
        <table class="table table-striped">
            <tbody>
            <?php
            foreach ($recentInternships->searchForInternships("Full") as $obj) { ?>
                <tr>
                    <td><?php echo $obj->internshipTitle; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        Short Description:
                    </td>
                    <td><?php echo $obj->shortDescription; ?> </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <!-- -->
                        <form method="GET" action="viewDetail.php">
                            <?php $internshipID = $obj->internshipID ?>
                            <button class="btn btn-danger"><a
                                    href="<?php echo ROOTURL . "/student/internshipdetails/" . $internshipID ?>"
                                    style="color:white;">View Details</a></button>
                        </form>
                    </td>
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
