<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(
                135deg,
                #667eea,
                #764ba2
            );
        }

        .login-box {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .error {
            background: #ffe5e5;
            color: #d93025;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
        }


        .form-group {
            margin-bottom: 18px;
        }


        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 600;
        }


        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }


        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.4);
        }


        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #667eea;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }


        button:hover {
            background: #5563d8;
        }


        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
            font-size: 13px;
        }

    </style>

</head>


<body>


<div class="login-box">

    <h2>Đăng nhập</h2>

    <div class="subtitle">
        Hệ thống quản lý sinh viên
    </div>


    <?php if (!empty($error)): ?>

        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <form method="post" action="/login">


        <div class="form-group">

            <label>
                Tài khoản
            </label>

            <input
                type="text"
                name="username"
                placeholder="Nhập username"
                value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                required
            >

        </div>



        <div class="form-group">

            <label>
                Mật khẩu
            </label>

            <input
                type="password"
                name="password"
                placeholder="Nhập mật khẩu"
                required
            >

        </div>



        <button type="submit">
            Đăng nhập
        </button>


    </form>


    <div class="footer">
        © 2026 PHP MVC Management System
    </div>


</div>


</body>
</html>