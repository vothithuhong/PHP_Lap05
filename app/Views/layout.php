<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Lab05 App') ?></title>
    
    <link rel="preconnect" href="[fonts.googleapis.com](https://fonts.googleapis.com)">
    <link rel="preconnect" href="[fonts.gstatic.com](https://fonts.gstatic.com)" crossorigin>
    <link
href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #f0fdff 100%);
            min-height: 100vh;
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 0 1.5rem;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            -webkit-text-fill-color: white;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.4);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--gray-600);
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.08);
        }

        .nav-links a.active {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.12);
        }

        .nav-links a.cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
        }

        .nav-links a.cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        /* ===== MAIN CONTAINER ===== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
        }

        /* ===== ALERTS ===== */
        .alert {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-radius: var(--radius-lg);
            margin-bottom: 2rem;
            animation: slideDown 0.4s ease;
            border: 1px solid transparent;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-color: rgba(16, 185, 129, 0.2);
            color: #047857;
        }

        .alert.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            border-color: rgba(239, 68, 68, 0.2);
            color: #b91c1c;
        }

        .alert.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
            border-color: rgba(245, 158, 11, 0.2);
            color: #b45309;
        }

        .alert-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .alert-message {
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* ===== CONTENT WRAPPER ===== */
        .content-wrapper {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: var(--shadow-lg), 
                        0 0 0 1px rgba(255, 255, 255, 0.5) inset;
            padding: 2rem;
            min-height: 60vh;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .nav-container {
                flex-direction: column;
                height: auto;
                padding: 1rem 0;
                gap: 1rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .content-wrapper {
                padding: 1.25rem;
                border-radius: var(--radius-lg);
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }
    </style>
    
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <span>📊</span> Lab05 </span>
        </div>
        <div class="nav-links">
            <a href="/" class="<?= ($current ?? '') === 'dashboard' ? 'active' : '' ?>">
                🏠 Dashboard
            </a>
            <a href="/students" class="<?= ($current ?? '') === 'Students' ? 'active' : '' ?>">
                👥 Students
            </a>
            <a href="/enrollments" class="<?= ($current ?? '') === 'Enrollments' ? 'active' : '' ?>">
                📦 Enrollments
            </a>
            <a href="/health" class="<?= ($current ?? '') === 'health' ? 'active' : '' ?>">
                💚 Health
            </a>
            <a href="/students/create" class="cta">+ Tạo mới</a>
        </div>
    </div>
</nav>

<main class="container">
    <?php if ($success = flash_get('success')): ?>
        <div class="alert success">
            <span class="alert-icon">✅</span>
            <div class="alert-message"><?= e($success) ?></div>
        </div>
    <?php endif; ?>

    <?php if ($error = flash_get('error')): ?>
        <div class="alert error">
            <span class="alert-icon">❌</span>
            <div class="alert-message"><?= e($error) ?></div>
        </div>
    <?php endif; ?>

    <div class="content-wrapper">
        <?= $content ?? '' ?>
    </div>

    <?php if ($msg = flash_get('success')): ?>
        <div class="alert success">
            <?= e($msg) ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
