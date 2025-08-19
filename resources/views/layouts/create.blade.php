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
            --accent-color: #ffd700;
            --accent-dark: #cc9900;
            --hover-color: #f0c400;
            --text-color: #e0e0e0;
            --text-dark: #333333;
            --text-muted: #9e9e9e;
            --background-dark: #1a1a1a;
            --background-card: #2a2a2a;
            --background-hover: #333333;
            --border-color: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(255, 215, 0, 0.3);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-dark);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .container h1 {
            text-align: center;
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 2rem;
            font-family: 'Playfair Display', serif;
        }

        
    </style>
</head>
<body>
    @include('components.navbar')


    <div class="container">
        <h1 class="title">Crear Nueva Receta</h1>
        
        <form class="recipe-form">
            <div class="form-section">
                <h2>Información Básica</h2>
                <div class="form-group">
                    <label for="recipeName">Nombre del Cóctel</label>
                    <input type="text" id="recipeName" placeholder="Ej: Margarita Clásica" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" placeholder="Breve descripción de tu cóctel..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="difficulty">Dificultad</label>
                        <select id="difficulty">
                            <option value="facil">Fácil</option>
                            <option value="medio">Intermedio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label for="time">Tiempo de Preparación</label>
                        <input type="number" id="time" placeholder="Minutos" min="1">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Ingredientes</h2>
                <div id="ingredients-list">
                    <div class="ingredient-row">
                        <div class="form-group">
                            <input type="text" placeholder="Ingrediente" class="ingredient-name">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Cantidad" class="ingredient-amount">
                        </div>
                        <div class="form-group">
                            <select class="ingredient-unit">
                                <option value="oz">oz</option>
                                <option value="ml">ml</option>
                                <option value="dash">dash</option>
                                <option value="unidad">unidad</option>
                            </select>
                        </div>
                        <button type="button" class="btn-icon remove-ingredient">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-outline" id="add-ingredient">
                    <i class='bx bx-plus'></i> Agregar Ingrediente
                </button>
            </div>

            <div class="form-section">
                <h2>Preparación</h2>
                <div class="form-group">
                    <label for="preparation">Pasos de Preparación</label>
                    <textarea id="preparation" placeholder="Describe paso a paso cómo preparar el cóctel..." rows="5"></textarea>
                </div>
            </div>

            <div class="form-section">
                <h2>Detalles Adicionales</h2>
                <div class="form-row">
                    <div class="form-group half">
                        <label for="glass">Tipo de Copa</label>
                        <select id="glass">
                            <option value="martini">Copa Martini</option>
                            <option value="highball">Vaso Highball</option>
                            <option value="rocks">Vaso Rocks</option>
                            <option value="hurricane">Copa Hurricane</option>
                            <option value="copper">Taza de Cobre</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label for="category">Categoría</label>
                        <select id="category">
                            <option value="clasico">Clásico</option>
                            <option value="contemporaneo">Contemporáneo</option>
                            <option value="tropical">Tropical</option>
                            <option value="sin-alcohol">Sin Alcohol</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="garnish">Decoración</label>
                    <input type="text" id="garnish" placeholder="Ej: Rodaja de limón, hojas de menta...">
                </div>

                <div class="form-group">
                    <label>Etiquetas</label>
                    <div class="tags-container">
                        <span class="tag">Refrescante<i class='bx bx-x'></i></span>
                        <span class="tag">Cítrico<i class='bx bx-x'></i></span>
                        <input type="text" id="tag-input" placeholder="Agregar etiqueta...">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-outline">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Receta</button>
            </div>
        </form>
    </div>

    @include('components.footer')

    <style>
        .recipe-form {
            background: var(--background-card);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: var(--shadow-md);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-section {
            margin-bottom: 2.5rem;
            background: var(--background-dark);
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .form-section h2 {
            color: var(--accent-color);
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            font-family: 'Playfair Display', serif;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group.half {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--background-card);
            border: 2px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-color);
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .ingredient-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 1rem;
            align-items: start;
            margin-bottom: 1rem;
            padding: 1rem;
            background: var(--background-card);
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .ingredient-row .form-group {
            margin-bottom: 0;
        }

        .btn-icon {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            color: #ff4444;
            background: rgba(255, 68, 68, 0.1);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: rgba(255, 215, 0, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--accent-color);
            color: var(--text-dark);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0.75rem;
            background: var(--background-card);
            border: 2px solid var(--border-color);
            border-radius: 6px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            background: var(--accent-color);
            color: var(--text-dark);
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tag i {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tag i:hover {
            transform: scale(1.2);
        }

        #tag-input {
            border: none;
            background: none;
            padding: 0.25rem;
            color: var(--text-color);
            outline: none;
            min-width: 120px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .ingredient-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>

</body>
</html>