<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Showroom</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <style>
    body {
        background: linear-gradient(135deg, #000000, #333333);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Nunito', sans-serif;
        margin: 0;
        color: #d4af37;
    }

    #auth {
        max-width: 420px;
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0px 4px 25px rgba(212, 175, 55, 0.3);
        position: relative;
        text-align: center;
    }

    h5 {
        font-weight: 700;
        color: #d4af37;
    }

    .form-control {
        border-radius: 30px;
        padding: 12px 20px;
        font-size: 1rem;
        background-color: transparent;
        border: 2px solid #d4af37;
        color: #d4af37;
    }

    .form-control:focus {
        box-shadow: 0 0 10px #d4af37;
        border-color: #ffd700;
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .form-control-icon i {
        color: #d4af37;
    }

    .btn-primary {
        border-radius: 30px;
        background: #d4af37;
        border: none;
        transition: 0.3s;
        font-weight: bold;
        padding: 15px 20px;
        font-size: 1.2rem;
        color: #000;
    }

    .btn-primary:hover {
        background: #ffda44;
        color: #000;
    }

    #math-captcha {
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        border: 1px solid #d4af37;
    }

    .text-gray-600 a {
        color: #d4af37;
        font-weight: bold;
        text-decoration: underline;
    }

    .btn-center, .dropdown-center, .g-recaptcha {
        display: flex;
        justify-content: center;
    }

    ::placeholder {
        color: #d4af37;
        opacity: 0.7;
    }

    h5 {
    font-weight: 700;
    color: #d4af37;
    text-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
}

</style>

</head>

<body>
    <div id="auth">
        <h5 class="text-center mb-4" style="font-weight: 700; color: #5f7f76;">Sistem Manajemen Showroom</h5>
        <form id="login-form" action="<?= base_url('login/aksi_login') ?>" method="post">
            <input type="hidden" name="correct_answer" id="correct-answer">
            <input type="hidden" name="math_answer" id="user-answer">

            <div class="form-group position-relative has-icon-left mb-3">
                <input type="text" name="usn" class="form-control form-control-lg" placeholder="Username" required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <pre></pre>
            <div class="form-group position-relative has-icon-left mb-3">
                <input type="password" name="pswd" class="form-control form-control-lg" placeholder="Password" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
                        <pre></pre>

            <!-- <p class="text-end text-gray-600">
                <a href="<?= base_url('login/resetpass') ?>" class="text-decoration-none">Forgot Password?</a>
            </p> -->

            <div class="g-recaptcha mb-3 d-flex justify-content-center" data-sitekey="6Lcqf3ErAAAAAC8c1wMwKRe7cNh0dNccmOhJ80kY"></div>

            <div id="math-captcha" class="mt-3" style="display: none;">
                <label id="math-question" class="form-label fw-bold"></label>
                <input type="number" id="math-answer" class="form-control" placeholder="Jawaban Anda">
            </div>
            <pre></pre>
            <div class="btn-center">
                <button type="submit" onclick="validateCaptcha()" class="btn btn-primary btn-lg shadow-lg mt-4 w-100" style="text-color: white">
                    Login
                </button>
            </div>

            <div id="google_translate_element" style="position: absolute; top: -9999px;"></div>
        </form>
    </div>

    <script>
        let questions = [
            { a: 2, b: 3, op: '+' },
            { a: 5, b: 2, op: '-' },
            { a: 1, b: 6, op: '+' },
            { a: 8, b: 4, op: '-' }
        ];

        let correctAnswer;

        function generateMathCaptcha() {
            const soal = questions[Math.floor(Math.random() * questions.length)];
            const question = Berapa hasil dari ${soal.a} ${soal.op} ${soal.b}?;
            document.getElementById('math-question').innerText = question;
            correctAnswer = soal.op === '+' ? soal.a + soal.b : soal.a - soal.b;
            document.getElementById('correct-answer').value = correctAnswer;
        }

        function validateCaptcha() {
            if (!navigator.onLine) {
                const userAnswer = parseInt(document.getElementById('math-answer').value);
                document.getElementById('user-answer').value = userAnswer;
                if (isNaN(userAnswer) || userAnswer !== correctAnswer) {
                    alert("Jawaban soal matematika salah. Silakan coba lagi.");
                    generateMathCaptcha();
                } else {
                    document.getElementById('login-form').submit();
                }
            } else {
                const response = grecaptcha.getResponse();
                if (response.length === 0) {
                    alert("Silakan lengkapi CAPTCHA terlebih dahulu.");
                } else {
                    document.getElementById('login-form').submit();
                }
            }
        }

        window.addEventListener('load', function () {
            if (!navigator.onLine) {
                document.getElementById('math-captcha').style.display = 'block';
                generateMathCaptcha();
            }
        });
    </script>
</body>
</html>