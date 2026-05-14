<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Philippine Mythology Almanac')</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; line-height: 1.6; background-color: #f0f2f5; color: #333; }
        header { background: #1a202c; color: #fff; padding: 1.5rem 0; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        header h1 { margin: 0; font-size: 2rem; }
        footer { background: #1a202c; color: #fff; text-align: center; padding: 1rem 0; position: fixed; bottom: 0; width: 100%; font-size: 0.9rem; }
        main { padding: 2rem; max-width: 900px; margin: 2rem auto; background: #fff; min-height: 70vh; margin-bottom: 80px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .item-list { list-style: none; padding: 0; }
        .item-list li { border-bottom: 1px solid #edf2f7; padding: 15px; transition: background 0.2s; }
        .item-list li:hover { background-color: #f7fafc; }
        .item-link { text-decoration: none; color: #2d3748; font-weight: 600; font-size: 1.2rem; }
        .item-link:hover { color: #4a5568; }
        .attribute { font-weight: bold; color: #4a5568; min-width: 100px; display: inline-block; }
        .back-link { display: inline-block; margin-bottom: 20px; text-decoration: none; color: #4a5568; font-weight: 500; }
        .back-link:hover { text-decoration: underline; }
        .details-container { border-top: 2px solid #edf2f7; margin-top: 20px; padding-top: 20px; }
        .detail-item { margin-bottom: 10px; }
    </style>
</head>
<body>
    <header>
        <h1>Philippine Mythology Almanac System</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Philippine Mythology Almanac System. Created for SIA Activity 2.</p>
    </footer>
</body>
</html>
