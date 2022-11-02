<?php

class InternshipSearchView
{
    private $keyWord;

    public function __construct($keyWord)
    {
        $this->keyWord = $keyWord;
        $this->renderSearch($this->keyWord);

    }

    public function renderSearch($key)
    {

        $name = new Student();
        $fullName = $name->getUserName();
        $userName = $fullName[0]->fullName;

        $department = new Internship();
        $result = $department->getDepartment();

        $html = '
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
                <button type="button" onclick="location.href=\' ' . ROOTURL . '/logout/' . ' \';">Logout</button><span>Welcome
                    
              <label id="student_username" name="student_username"><b> ' . $userName . ' </b>
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
                    <a class="nav-link" href=" ' . ROOTURL . "/student/home/" . '">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" ' . ROOTURL . "/student/profile/" . ' ">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" ' . ROOTURL . "/student/internship/" . ' ">Internship</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" ' . ROOTURL . "/student/myapplications/" . ' ">My Applications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" ' . ROOTURL . "/student/settings/" . ' ">Settings</a>
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
        <b>' . $result[0]->name . ' Department</b>
        <br>
        Here is a list of the availbale internship offers added to the department
    </p>';

        echo $html;

        $recentInternships = new Internship();

        echo '<table class="table table-striped">
        <tbody>';

        foreach ($recentInternships->searchForInternships($key) as $obj) {
            echo '<tr>
                <td>' . $obj->internshipTitle . '</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Short Description:
                </td>
                <td>' . $obj->shortDescription . ' </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <!-- -->
                    <form method="GET" action="viewDetail.php">';
            $internshipID = $obj->internshipID;
            echo '<button class="btn btn-danger"><a
                                    href=" ' . ROOTURL . "/student/internshipdetails/" . $internshipID . ' "
                                    style="color:white;">View Details</a></button>
                    </form>
                </td>
            </tr>';
        }

        echo '
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
        ';

    }

}

?>


