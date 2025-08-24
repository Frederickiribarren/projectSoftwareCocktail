<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API - Recetas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-section {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .test-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .test-button:hover {
            background: #0056b3;
        }
        .result {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin: 10px 0;
            font-family: monospace;
            white-space: pre-wrap;
            max-height: 400px;
            overflow-y: auto;
        }
        .success {
            border-color: #28a745;
            background: #d4edda;
        }
        .error {
            border-color: #dc3545;
            background: #f8d7da;
        }
    </style>
</head>
<body>
    <h1>🧪 Test de API - Sistema de Recetas</h1>
    
    <div class="test-section">
        <h2>🔌 Test de Conectividad</h2>
        <button class="test-button" onclick="testConnection()">Probar Conexión a API</button>
        <div id="connection-result" class="result"></div>
    </div>

    <div class="test-section">
        <h2>⭐ Test de Recetas Destacadas</h2>
        <button class="test-button" onclick="testFeaturedRecipes()">Cargar Recetas Destacadas</button>
        <div id="featured-result" class="result"></div>
    </div>

    <div class="test-section">
        <h2>📋 Test de Todas las Recetas</h2>
        <button class="test-button" onclick="testAllRecipes()">Cargar Todas las Recetas (paginado)</button>
        <div id="all-result" class="result"></div>
    </div>

    <div class="test-section">
        <h2>🧪 Test de Ingredientes</h2>
        <button class="test-button" onclick="testIngredients()">Cargar Ingredientes</button>
        <div id="ingredients-result" class="result"></div>
    </div>

    <script>
        const API_BASE = '/api';
        
        function log(elementId, message, isError = false) {
            const element = document.getElementById(elementId);
            element.className = 'result ' + (isError ? 'error' : 'success');
            element.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
        }

        async function testConnection() {
            try {
                log('connection-result', '🔄 Probando conexión...');
                
                const response = await fetch('/');
                if (response.ok) {
                    log('connection-result', '✅ Conexión exitosa al servidor Laravel');
                } else {
                    log('connection-result', `❌ Error de conexión: ${response.status}`, true);
                }
            } catch (error) {
                log('connection-result', `❌ Error de red: ${error.message}`, true);
            }
        }

        async function testFeaturedRecipes() {
            try {
                log('featured-result', '🔄 Cargando recetas destacadas...');
                
                const response = await fetch(`${API_BASE}/recipes/featured?limit=5`);
                const data = await response.json();
                
                if (data.success) {
                    const summary = `✅ Recetas destacadas cargadas exitosamente
📊 Total: ${data.data.length} recetas
📋 Primeras recetas:
${data.data.slice(0, 3).map(r => `  • ${r.name} (${r.ingredients?.length || 0} ingredientes)`).join('\n')}

📦 Datos completos:
${JSON.stringify(data, null, 2)}`;
                    log('featured-result', summary);
                } else {
                    log('featured-result', `❌ Error en respuesta: ${JSON.stringify(data)}`, true);
                }
            } catch (error) {
                log('featured-result', `❌ Error: ${error.message}`, true);
            }
        }

        async function testAllRecipes() {
            try {
                log('all-result', '🔄 Cargando todas las recetas (página 1)...');
                
                const response = await fetch(`${API_BASE}/recipes?per_page=10&page=1`);
                const data = await response.json();
                
                if (data.success) {
                    const summary = `✅ Recetas cargadas exitosamente
📊 Página actual: ${data.pagination.current_page} de ${data.pagination.last_page}
📋 Recetas en esta página: ${data.data.length}
📈 Total en base de datos: ${data.pagination.total || 'N/A'}

🔍 Primeras recetas:
${data.data.slice(0, 5).map(r => `  • ${r.name}`).join('\n')}

📦 Datos de paginación:
${JSON.stringify(data.pagination, null, 2)}`;
                    log('all-result', summary);
                } else {
                    log('all-result', `❌ Error en respuesta: ${JSON.stringify(data)}`, true);
                }
            } catch (error) {
                log('all-result', `❌ Error: ${error.message}`, true);
            }
        }

        async function testIngredients() {
            try {
                log('ingredients-result', '🔄 Cargando ingredientes...');
                
                const response = await fetch(`${API_BASE}/ingredients`);
                const data = await response.json();
                
                if (data.success) {
                    const summary = `✅ Ingredientes cargados exitosamente
📊 Total: ${data.data.length} ingredientes
🍸 Alcohólicos: ${data.data.filter(i => i.is_alcoholic).length}
🥤 No alcohólicos: ${data.data.filter(i => !i.is_alcoholic).length}

🔍 Primeros ingredientes:
${data.data.slice(0, 10).map(i => `  • ${i.name} ${i.is_alcoholic ? '🍸' : '🥤'}`).join('\n')}`;
                    log('ingredients-result', summary);
                } else {
                    log('ingredients-result', `❌ Error en respuesta: ${JSON.stringify(data)}`, true);
                }
            } catch (error) {
                log('ingredients-result', `❌ Error: ${error.message}`, true);
            }
        }

        // Auto-test de conexión al cargar
        window.addEventListener('load', () => {
            testConnection();
        });
    </script>
</body>
</html>
