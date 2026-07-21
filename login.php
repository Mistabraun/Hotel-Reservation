<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grand Horizon | Login</title>

    <!-- /* ==== Different Stylesheet Libraries to ===== */ -->
    <!-- Local Bootstrap Grid System -->
    <link class="search" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Local Icons for UI Elements | FOR SOCMED ACCOUNTS-->
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Connection to Main Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <main class="d-flex h-100 justify-content-center align-items-center">
        <div class="w-100 mt-5" style="max-width: 24rem">
            <header class="text-center d-lg-none mb-4">
                <h1 class="h4 mb-0">Grand Horizon</h1>
                <p class="text-muted">Admin Panel</p>
            </header>

            <section class="mb-4">
                <h2 class="fs-4 mb-2">Welcome back</h2>
                <p class="text-muted mb-0">Sign in to access the admin dashboard.</p>
            </section>

            <div class="alert alert-danger p-1 px-2 mt-3 d-none" id="errorMessage">Error message here!</div>

            <form method="post" id="loginForm">
                <div class="mb-4">
                    <label for="email" class="form-label"> Email address </label>
                    <input title="" type="email" class="form-control outline-hover" id="email" name="email" placeholder="example@mail.com" autocomplete="email" required="">
                </div>

                <label for="password" class=""> Password </label>
                <div class="input-group password-group">
                    <input title="" type="password" class="form-control outline-hover rounded z-2" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required="">

                    <button type="button" class="toggle-password">
                        <i class="fa-regular fa-eye"></i>
                    </button>

                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 text-secondary-2 mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember"> Remember me </label>
                    </div>

                    <a href="/" class="text-gray-light text-decoration-underline">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold">
                    <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Sign In
                </button>
            </form>
            <div>
                <div class="border-0 border-top my-4 p-1"></div>
                <div class="d-flex align-items-center gap-2 text-secondary mb-3">
                    <div class="border-0 border-top flex-grow-1" style="height: 1px"></div>
                    <span class="small">Demo credentials</span>
                    <div class="border-0 border-top flex-grow-1" style="height: 1px"></div>
                </div>
                <div class="d-flex flex-column gap-2">
                    <button class="text-start outline-gray rounded p-3 d-flex justify-content-between align-items-center gap-3 btn btn-primary-outline ">
                        <div class="bg-warning rounded-circle d-flex align-items-center">
                            <span class="text-black-50 fw-semibold p-2 text-center extra-small">JC</span>
                        </div>
                        <div class="flex-grow-1" id="demoAdmin">
                            <p class="fw-semibold m-0">Justine Carl</p>
                            <p class="m-0 text-gray-light extra-small">Admin</p>
                        </div>
                        <i class="fa-solid fa-arrow-right opacity-50"></i>
                    </button>

                </div>
            </div>
        </div>
    </main>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>