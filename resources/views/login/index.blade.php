<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <section class="p-0 d-flex align-items-center position-relative overflow-hidden">

        <div class="container-fluid">
            <div class="row">
                <!-- left -->
                <div
                    class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                    <div class="p-3 p-lg-5">
                        <!-- Title -->
                        <div class="text-center">
                            <h2 class="fw-bold">Welcome to our largest community</h2>
                            <p class="mb-0 h6 fw-light">Let's learn something new today!</p>
                        </div>
                        <!-- SVG Image -->
                        <img src="assets/images/element/02.svg" class="mt-5" alt="">
                        <!-- Info -->
                        <div class="d-sm-flex mt-5 align-items-center justify-content-center">
                            <!-- Avatar group -->
                            <ul class="avatar-group mb-2 mb-sm-0">
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                        alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                        alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg"
                                        alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg"
                                        alt="avatar">
                                </li>
                            </ul>
                            <!-- Content -->
                            <p class="mb-0 h6 fw-light ms-0 ms-sm-3">4k+ Students joined us, now it's your turn.</p>
                        </div>
                    </div>
                </div>

                <!-- Right -->
                <div class="col-12 col-lg-6 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-8 m-auto">
                            <!-- Title -->

                            <h1 class="fs-2">Login into Eduport!</h1>
                            <p class="lead mb-4">Nice to see you! Please log in with your account.</p>

                            <!-- Form START -->
                            <form method="POST" action="{{ route('postLogin') }}">
                                @csrf
                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">Email address *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="bi bi-envelope-fill"></i></span>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                            autocomplete="email" autofocus
                                            class="form-control border-0 bg-light rounded-end ps-1"
                                            placeholder="E-mail">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="inputPassword5" class="form-label">Password *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="fas fa-lock"></i></span>
                                        <input id="password" type="password" name="password"
                                            autocomplete="current-password"
                                            class="form-control border-0 bg-light rounded-end ps-1"
                                            placeholder="password">
                                    </div>
                                    <div id="passwordHelpBlock" class="form-text">
                                        Your password must be 8 characters at least
                                    </div>
                                </div>

                                <div class="align-items-center mt-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form END -->

                        </div>
                    </div> <!-- Row END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>
</body>

</html>
