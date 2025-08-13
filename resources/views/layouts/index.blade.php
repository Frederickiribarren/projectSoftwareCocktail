<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <h1 class="title">Mi Inventario de Bar</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="inventory-layout">
            <div class="ingredients-list">
                <h2>Ingredientes Disponibles</h2>
                <form action="{{ route('inventory.update') }}" method="POST" id="inventoryForm">
                    @csrf
                    <div class="ingredients-grid">
                        @foreach($ingredients as $ingredient)
                            @if(!in_array($ingredient->id, $userIngredients))
                            <div class="ingredient-card" data-id="{{ $ingredient->id }}">
                                <button type="button" class="add-ingredient" onclick="addToInventory({{ $ingredient->id }}, '{{ $ingredient->name }}')">
                                    <i class='bx bx-plus-circle'></i>
                                </button>
                                <label>{{ $ingredient->name }}</label>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </form>
            </div>

            <div class="user-ingredients">
                <h2>Mi Inventario</h2>
                <div class="user-ingredients-list" id="userIngredientsList">
                    @foreach($ingredients as $ingredient)
                        @if(in_array($ingredient->id, $userIngredients))
                            <div class="user-ingredient-item" data-id="{{ $ingredient->id }}">
                                {{ $ingredient->name }}
                                <button type="button" class="remove-ingredient" onclick="removeFromInventory({{ $ingredient->id }}, '{{ $ingredient->name }}')">
                                    <i class='bx bx-x-circle'></i>
                                </button>
                                <input type="hidden" name="ingredients[]" value="{{ $ingredient->id }}" form="inventoryForm">
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="submit" form="inventoryForm" class="save-button">Guardar Inventario</button>
            </div>
        </div>
    </div>

    <script>
        function addToInventory(id, name) {
            const ingredientCard = document.querySelector(`.ingredient-card[data-id="${id}"]`);
            const userList = document.getElementById('userIngredientsList');
            
            // funcion para crear un nuevo elemento en la lista de mi bar, seguir revisando por mejoras en la logica
            const newItem = document.createElement('div');
            newItem.className = 'user-ingredient-item';
            newItem.setAttribute('data-id', id);
            newItem.innerHTML = `
                ${name}
                <button type="button" class="remove-ingredient" onclick="removeFromInventory(${id}, '${name}')">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="ingredients[]" value="${id}" form="inventoryForm">
            `;
            
            userList.appendChild(newItem);
            ingredientCard.style.display = 'none';
        }

        function removeFromInventory(id, name) {
            const userItem = document.querySelector(`.user-ingredient-item[data-id="${id}"]`);
            const ingredientCard = document.querySelector(`.ingredient-card[data-id="${id}"]`);
            
            userItem.remove();
            ingredientCard.style.display = 'flex';
        }
    </script>

    @include('components.footer')
</body>
</html>