<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/assets') }}/argon/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="{{ url('/assets') }}/argon/img/logo-amti.png" />
    <title>{{ config('app.name') }} | Login</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('/assets') }}/argon/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<style>
.left-pane .card-header h4 {
    font-weight: 600;
    font-size: 1.25rem;
    line-height: 1.3;
    margin-bottom: .25rem;
}

.left-pane .card-header p {
    color: #6b7280;
    font-size: .95rem;
}

.left-pane .form-control.form-control-lg {
    height: 48px;
    border-radius: 12px;
    border-color: #D1D5DB;
}

.left-pane .form-control.form-control-lg:focus {
    border-color: #4F46E5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, .2);
}


.left-pane .g-recaptcha {
    transform: scale(1);
    transform-origin: left top;
}

.left-pane .card-body .mb-3>div {
    width: 100%;
}

.left-pane .btn-primary {
    background: #4F46E5;
    border-color: #4F46E5;
    border-radius: 12px;
    font-weight: 600;
}

.left-pane .btn-primary:hover {
    background: #4338CA;
    border-color: #4338CA;
}

.left-pane .btn-primary:focus {
    box-shadow: 0 0 0 3px rgba(79, 70, 229, .25);
}

.left-pane .card-footer a {
    text-decoration: underline;
}

.hero-rotator {
    position: relative;
    overflow: hidden;
}

.hero-slide {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity .8s ease;
}

.hero-slide.is-active {
    opacity: 1;
}


@media (min-width: 992px) {
    .left-pane .card-plain {
        transform: translateX(-12px);
    }
}
</style>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto left-pane">
                            <div class="card card-plain col-l-2">
                                <div class="card-header pb-0 text-start">
                                    <img src="{{ url('/assets') }}/argon/img/login-amti.png" alt="Logo"
                                        style="height: 75px;" />
                                </div>

                                <div class="card-body">
                                    <form role="form" id="formAuthentication" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus />
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                placeholder="Password" required autocomplete="current-password" />
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div>
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-lg btn-primary w-100 mt-4 mb-0" type="submit">
                                                {{ __('Masuk') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Ada Kendala? Hubungi Admin.
                                        <a href="javascript:;"
                                            class="text-primary text-gradient font-weight-bold">Call</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="col-8 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div id="heroRotator"
                                class="hero-rotator position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                data-interval="5000">
                                <img src="{{ url('/assets') }}/argon/img/slide-login/unpres.png"
                                    class="hero-slide is-active" alt="" />
                                <img src="{{ url('/assets') }}/argon/img/slide-login/jetty.png" class="hero-slide"
                                    alt="" />
                                <img src="{{ url('/assets') }}/argon/img/slide-login/cipali.png" class="hero-slide"
                                    alt="" />
                                <img src="{{ url('/assets') }}/argon/img/slide-login/kaltim.png" class="hero-slide"
                                    alt="" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core JS Files -->
    <script src="{{ url('/assets') }}/argon/js/core/popper.min.js"></script>
    <script src="{{ url('/assets') }}/argon/js/core/bootstrap.min.js"></script>
    <script src="{{ url('/assets') }}/argon/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ url('/assets') }}/laragon/js/plugins/smooth-scrollbar.min.js"></script>

    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        };
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const rotator = document.getElementById('heroRotator');
        if (!rotator) return;

        const slides = Array.from(rotator.querySelectorAll('.hero-slide'));
        if (slides.length <= 1) return;

        const interval = parseInt(rotator.dataset.interval || '5000', 10);
        let i = 0;

        setInterval(() => {
            slides[i].classList.remove('is-active');
            i = (i + 1) % slides.length;
            slides[i].classList.add('is-active');
        }, interval);
    });
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('/assets') }}/argon/js/argon-dashboard.min.js?v=2.1.0"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>