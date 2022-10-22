<?php



class CreateStudent
{
    private $html;

//    constructor
    public function __construct()
    {
        $this->Render();
    }

    private function Render()
    {
        $this->html = '
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
    <title>Sign Up</title>
</head>

<body>
<main>
    <div class="upNav">
        <div class="login-container">
            <form action="">
                <button type="button" onclick="location.href=\' '; ?>

                <?php
                $this->html = $this->html.ROOTURL."/login/".' \';" style="width: 90px">Back</button>
                <!-- <span>Welcome</span> -->
            </form>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark"
         style="background-color: #db1123; height: 90px">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><span
                        style="padding-left: 40px; padding-right: 150px; font-size: 30px"
                >Vanier College</span
                >Welcome To Our Internship Management System</a>
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
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="underNav">
        <p style="padding: 18px">
            <label id="percent" name="percent">10%</label>&nbsp; Complete your
            profile to have a higher chance of securing an internship!
        </p>
    </div>
    <div class="container mt-3">


<!--        --><?php
 ?>


        <form name="f" action="status.php" method="POST">
            <br>
            <h3>Sign up</h3>
            <br><br>
            <table>
                <tr>
                    <td><label>First Name:</label></td>
                    <td><input type="text" size="50" required name="firstName" pattern="[A-Z a-z]{2,50}"
                               title="Must contain minimum of 2 letters and maximum of 50 letters."></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>Last Name:</label></td>
                    <td><input type="text" size="50" name="lastName" required pattern="[A-Z a-z]{2,50}"
                               title="Must contain minimum of 2 letters and maximum of 50 letters.">
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>Date of birth:</label></td>
                    <td><input type="Date" size="50" name="dob" required
                               title="Must be a valid date"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>E-mail:</label></td>
                    <td><input type="email" size="50" name="email" required title="Must be a valid email"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>Pasword:</label></td>
                    <td><input type="password" size="50" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                               required></td>

                </tr>
                <tr></tr>
                <tr>
                    <td><label>Confirm Pasword:</label></td>
                    <td><input type="text" size="50" name="passwordC" required
                               title="Must contain match with password text"></td>
                </tr>
                <tr></tr>

                <tr>
                    <td><label>Phone Number:</label></td>
                    <td><input type="tel" size="50" name="phone" required pattern="({1}[0-9]{3}){1}[0-9]{3)_{1}[0-9]{4}"
                               title="Must contain match with this pattern ***_***_****"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>CollegeID:</label></td>
                    <td><input type="number" size="50" name="stdID" required
                               pattern="[0-9]{7,7}" title="Must be 7 digits"></td>

                </tr>
                <tr></tr>
                <tr>
                    <td><label>R-Score:</label></td>
                    <td><input type="text" size="50" name="rscore" required
                               pattern="[0-9]{2,4}" title="Must be between 2 and 4 digits"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>Cohort:</label></td>
                    <td>
                        <input type="text" size="50" name="cohort" required
                               pattern="[A-Z a-z]{4,50}"
                               title="Must contain minimum of 4 letters and maximum of 50 letters.">
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td><label>Department:</label></td>
                    <td><select name="depList" id="lov" required title="Please select a department">
                     '; ?>
<?php


//        $query = "SELECT name FROM department";
//        $statement = $this->con->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll(PDO::FETCH_CLASS);
//$departmentsArray = array();
//foreach($result as $department)
//{
//    $departmentsArray[] = $department->name;
//}
$db_host="localhost";
$db_user = "root";
$db_pw = "root";
$db_name = "internship_db";
$connection = mysqli_connect($db_host, $db_user, $db_pw, $db_name)or die (mysqli_errno($connection));
$sql = "SELECT name FROM `department`;";
$query = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($query)) {
    ?>

    $this->html = $this->html."
    <option><?php echo $row['name']; ?></option>
<?php }
mysqli_close($connection); ?>



                        </select>
                        </td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="text-align:center"><input type="checkbox" name="consent" required></td>
                    <td><label for="consent"> I consent that I am elligible to apply for internship and that I meet all
                            the requirements. </label></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                </tr>
                <tr>
                    <script>
                        function check() {
                            if (document.f.passwordC.value != document.f.password.value) {
                                alert("Password and confirm Password do not match");
                                document.f.passwordC.focus();
                                return false;
                            }
                            if (document.f.lov.selectedIndex < 0) {
                                alert("Please select a cohort.");
                                return false;
                            }
                            if (document.f.rscore.value < 15 || document.f.score.value > 35) {
                                alert("please input an R score between 15 and 35");
                                document.f.rscore.focus();
                                return false;
                            }
                        }
                    </script>
                    <!-- onclick="check(); -->

                    <td></td>
                    <td></td>
                    <td><input type="submit" size="50" value="Register" name="submitSignUp"
                               class="btn btn-primary btn-block" style="background-color: #9c000d; width: 100px"></td>

                    <td><input type="reset" size="50" value="Reset" name="reset" class="btn btn-primary btn-block"
                               style="background-color: #9c000d; width: 100px"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td><br><br><br><br><br></td>
                </tr>
            </table>
        </form>

    </div>

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
         echo $this->html;
    }
}

?>