<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap');
        
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #ffffff;
            --accent-color: #ffd700; /* Gold */
            --hover-color: #f0c400;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            height: 80vh;
            margin: 0 auto;
            padding: 20px;
        }

        .container h1 {
            font-weight: bold;
            font-size: 2rem;
            color: var(--accent-color)
        }

        
    </style>
</head>
<body>
    @include('components.navbar')


    <div class="container">
        <h1 class="title">Inventario</h1>
    </div>

    @include('components.footer')

</body>
</html>