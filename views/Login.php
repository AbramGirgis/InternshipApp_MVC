<?php

class Login
{
//    constructor
    public function __construct()
    {
        $this->Render();
    }

    private function Render()
    {
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
    <link rel="stylesheet" href="./style/style.css"/>
    <title>Login Page</title>
</head>
<body>
<main>
    <div class="upNav">
        <div class="login-container"></div>
    </div>

    <nav
            class="navbar navbar-expand-sm navbar-dark"
            style="background-color: #db1123; height: 90px"
    >
        <div class="container-fluid">
            <a class="navbar-brand" href="#"
            >&nbsp;&nbsp;
                <span
                        style="padding-left: 40px; padding-right: 150px; font-size: 30px"
                >Vanier College</span
                >
                Welcome To Our Internship Management System</a
            >
            <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav"></ul>
            </div>
        </div>
    </nav>


    <!--     Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100"
             style="background-color: rgba(0, 0, 0, 0.8)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-8">

                        <form class="bg-white rounded-5 shadow-5-strong p-5"
                              method="POST"
                              action="validation.php">

                            <!--                  Choose role/actor-->
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Choose a role:</option>
                                <option value="student">Student</option>
                                <option value="company">Company</option>
                            </select>
                            <br><br><br>
                            <!--                             ID input -->
                            <div class="form-outline mb-4">
                                <input
                                        type="text"
                                        id="login"
                                        name="login"
                                        class="form-control"
                                        required
                                        title="Please enter your ID"
                                />
                                <label class="form-label" for="login">User ID</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        required
                                        title="Please enter your password"
                                />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Sign in -->
                                    <button
                                            type="submit"
                                            class="btn btn-primary btn-block"
                                            style="background-color: #9c000d; width: 175px"
                                    >
                                        Sign in
                                    </button>
                                </div>

                                <div class="col text-center">
                                    <!-- Sign up -->
                                    <a
                                            href=" '; ?>
        <?php

        $html = $html . ROOTURL . "/signup/" . ' "
                                            class="btn btn-primary btn-block"
                                            style="background-color: #9c000d; width: 175px"
                                    >Sign up</a
                                    >
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</main>
<footer class="foot">
    <p style="padding: 10px">
        @ IMS. Montreal, QC, CA <br/>
        Privacy | Terms
    </p>
</footer>
</body>
</html>
        ';

        echo $html;
    }
}

?>








