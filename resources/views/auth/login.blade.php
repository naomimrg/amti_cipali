<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --glass: rgba(255, 255, 255, .55);
        --focus: #2563eb;
        --text: #111827;
        --muted: #6b7280;
        --btn: #6e56ff;
        --btn-hover: #5a45ff;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        font-family: 'Open Sans', Arial, sans-serif;
        color: var(--text);
    }

    body {
        overflow: hidden;
    }

    .bg-grid {
        position: fixed;
        inset: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        z-index: -1;
    }

    .bg-grid>div {
        background-size: cover;
        background-position: center;
    }

    .brand {
        position: absolute;
        top: 55px;
        left: 45px;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px 18px;
        background: var(--glass);
        border-radius: 12px;
    }

    .brand img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        display: block;
    }

    .brand-sep {
        width: 3px;
        height: 36px;
        background: #000;
        display: inline-block;
        border-radius: 2px;
    }


    .brand-text {
        /* line-height: 1.1; */
        font-weight: 700;
        font-size: 18px;
        letter-spacing: .22em;
        white-space: pre-line;
        opacity: 0;
        transform: translateX(-14px);
        animation: brandIn .9s cubic-bezier(.23, 1, .32, 1) .05s forwards;
    }

    @keyframes brandIn {
        0% {
            opacity: 0;
            transform: translateX(-14px);
        }

        60% {
            opacity: 1;
            transform: translateX(6px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .login-wrap {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .card {
        width: min(420px, 92vw);
        background: var(--glass);
        border-radius: 20px;
        padding: 36px 24px 28px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .25);
        text-align: center;
    }

    .card h2 {
        margin: 0 0 22px;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: .02em;
    }

    .form {
        width: 100%;
        display: grid;
        gap: 12px;
        place-items: center;
    }

    .input {
        width: 86%;
        height: 48px;
        border-radius: 26px;
        border: 1px solid #d1d5db;
        background: #fff;
        padding: 0 16px;
        font-size: 15px;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .input:focus {
        border-color: var(--focus);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .28);
    }

    .hint {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
    }

    .btn {
        width: 86%;
        height: 48px;
        border: none;
        border-radius: 26px;
        background: var(--btn);
        color: #fff;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: .22em;
        cursor: pointer;
        margin-top: 10px;
        transition: background .15s, transform .06s;
    }

    .btn:hover {
        background: var(--btn-hover);
    }

    .btn:active {
        transform: translateY(1px);
    }

    .btn:disabled {
        opacity: .55;
        cursor: not-allowed;
    }

    @media (max-width:520px) {
        .brand {
            top: 16px;
            left: 16px;
            padding: 10px 14px;
            gap: 12px;
        }

        .brand img {
            width: 30px;
            height: 30px;
        }

        .brand-sep {
            height: 28px;
        }

        .card {
            padding: 28px 16px 22px;
        }
    }
    </style>
</head>

<body>
    <div class="bg-grid">
        <div style="background-image:url('{{ asset('assets/argon/img/slide-login/cipali.JPG') }}')"></div>
        <div style="background-image:url('{{ asset('assets/argon/img/slide-login/unpress.jpg') }}')"></div>
        <div style="background-image:url('{{ asset('assets/argon/img/slide-login/kaltim.jpeg') }}')"></div>
        <div style="background-image:url('{{ asset('assets/argon/img/slide-login/jetty.png') }}')"></div>
    </div>
    <div class="brand">
        <img src="{{ asset('assets/argon/img/logo-amti.png') }}" alt="AMTI">
        <span class="brand-sep" aria-hidden="true"></span>
        <span class="brand-text">ASSET MONITORING
            TEKNOLOGI INDONESIA</span>
    </div>
    <div class="login-wrap">
        <div class="card">
            <h2>SHMS LOGIN</h2>

            <form id="formAuthentication" class="form" method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" id="email" name="email"
                    class="input form-control @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email') }}" required autocomplete="off" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <input type="password" id="password" name="password"
                    class="input form-control @error('password') is-invalid @enderror" placeholder="Password" required
                    autocomplete="off" aria-describedby="password">
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <div style="text-align:center;">
                    <div class="hint">Please validate the captcha below</div>
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                        style="display:inline-block;"></div>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                    @endif
                </div>

                <button id="submitBtn" class="btn" type="submit">LOGIN</button>
            </form>
        </div>
    </div>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formAuthentication');
            const btn = document.getElementById('submitBtn');
            const inputs = form.querySelectorAll('input[type="email"], input[type="password"]');
            let captchaOk = false;

            function sync() {
                const filled = Array.from(inputs).every(i => i.value.trim() !== '');
                btn.disabled = !(filled && captchaOk);
            }
            window.onCaptchaSuccess = function() {
                captchaOk = true;
                sync();
            };
            window.onCaptchaExpired = function() {
                captchaOk = false;
                sync();
            };

            inputs.forEach(i => i.addEventListener('input', sync));
            sync();
        });
    </script> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>