<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="vendors/images/apple-touch-icon.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="vendors/images/favicon-32x32.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="vendors/images/favicon-16x16.png"
    />

    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="vendors/styles/icon-font.min.css"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="src/plugins/jquery-steps/jquery.steps.css"
    />
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
</head>

<body class="login-page">
<div class="login-header box-shadow">
    <div
        class="container-fluid d-flex justify-content-between align-items-center"
    >
        <div class="brand-logo">
            <a href="login.html">
                <img src="vendors/images/deskapp-logo.svg" alt="" />
            </a>
        </div>
        <div class="login-menu">
            <ul>
                <li><a href="login.html">Login</a></li>
            </ul>
        </div>
    </div>
</div>
<div
    class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"
>
    <div class="container">
        <div class="row align-items-center">
       @yield('content')
        </div>
    </div>
</div>
<!-- success Popup html Start -->
<button
    type="submit"
    id="success-modal-btn"
    hidden
    data-toggle="modal"
    data-target="#success-modal"
    data-backdrop="static"
>
    Launch modal
</button>
<div
    class="modal fade"
    id="success-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-centered max-width-400"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Form Submitted!</h3>
                <div class="mb-30 text-center">
                    <img src="vendors/images/success.png" />
                </div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod
            </div>
            <div class="modal-footer justify-content-center">
                <a href="login.html" class="btn btn-primary">Done</a>
            </div>
        </div>
    </div>
</div>
<!-- success Popup html End -->

    <div class="text-center mb-1">
        <div>
            <a
                href="https://github.com/dropways/deskapp"
                target="_blank"
                class="btn btn-light btn-block btn-sm"
            >
                <span class="text-danger weight-600">STAR US</span>
                <span class="weight-600">ON GITHUB</span>
                <i class="fa fa-github"></i>
            </a>
        </div>
        <script
            async
            defer="defer"
            src="https://buttons.github.io/buttons.js"
        ></script>
    </div>
    <a
        href="https://github.com/dropways/deskapp"
        target="_blank"
        class="btn btn-success btn-sm mb-0 mb-md-3 w-100"
    >
        DOWNLOAD
        <i class="fa fa-download"></i>
    </a>
    <p class="font-14 text-center mb-1 d-none d-md-block">
        Available in the following technologies:
    </p>
    <div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
        <i class="fa fa-html5"></i>
    </div>
</div>
<button class="welcome-modal-btn">
    <i class="fa fa-download"></i> Download
</button>
<!-- welcome modal end -->
<!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="vendors/scripts/steps-setting.js"></script>
</body>
</html>
