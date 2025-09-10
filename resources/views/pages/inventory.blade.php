@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="header">
            <h1>Mi Inventario</h1>
            <p>Gestiona tus ingredientes y descubre nuevas posibilidades para crear cócteles únicos.</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>24</h3>
                <p>Ingredientes Totales</p>
            </div>
            <div class="stat-card">
                <h3>15</h3>
                <p>Recetas Posibles</p>
            </div>
            <div class="stat-card">
                <h3>8</h3>
                <p>Categorías</p>
            </div>
        </div>

        <div class="inventory-container">
            <div class="filters-section">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Buscar ingredientes..." id="searchInput">
                </div>

                <div class="category-tabs">
                    <div class="category-tab active" data-category="all">Todos</div>
                    <div class="category-tab" data-category="spirits">Spirits</div>
                    <div class="category-tab" data-category="liqueurs">Licores</div>
                    <div class="category-tab" data-category="juices">Jugos</div>
                    <div class="category-tab" data-category="mixers">Mixers</div>
                    <div class="category-tab" data-category="others">Otros</div>
                </div>

                <div class="filter-options">
                    <select class="filter-select" id="brandFilter">
                        <option value="">Todas las Marcas</option>
                        <option value="premium">Premium</option>
                        <option value="standard">Standard</option>
                        <option value="house">Casa</option>
                    </select>
                    <select class="filter-select" id="stockFilter">
                        <option value="">Stock</option>
                        <option value="low">Bajo Stock</option>
                        <option value="out">Sin Stock</option>
                        <option value="ok">Stock OK</option>
                    </select>
                    <div class="toggle-switch">
                        <input type="checkbox" id="alcoholicFilter">
                        <label for="alcoholicFilter">Solo Alcohólicos</label>
                    </div>
                    <button class="btn btn-outline" id="addIngredientBtn">
                        <i class='bx bx-plus'></i> Agregar Nuevo
                    </button>
                </div>
            </div>

            <div class="ingredient-list">
                <div class="ingredient-header">
                    <div class="ingredient-col">Ingrediente</div>
                    <div class="ingredient-col">Marca</div>
                    <div class="ingredient-col">Stock</div>
                    <div class="ingredient-col">Acciones</div>
                </div>
                <!-- Los ingredientes se cargarán dinámicamente aquí -->
            </div>

            <!-- Template para los items de ingredientes -->
            <template id="ingredient-template">
                <div class="ingredient-item">
                    <div class="ingredient-info">
                        <div class="ingredient-icon">
                            <i class='bx bx-drink'></i>
                        </div>
                        <div class="ingredient-details">
                            <h3 class="ingredient-name"></h3>
                            <p class="ingredient-category"></p>
                            <div class="flavor-tags"></div>
                        </div>
                    </div>
                    <div class="ingredient-brand"></div>
                    <div class="stock-control">
                        <div class="quantity-control">
                            <button class="quantity-btn decrease">-</button>
                            <div class="quantity-input-wrapper">
                                <input type="number" class="quantity-input" min="0" step="1">
                                <span class="unit"></span>
                            </div>
                            <button class="quantity-btn increase">+</button>
                        </div>
                        <div class="stock-status"></div>
                    </div>
                    <div class="ingredient-actions">
                        <button class="btn btn-icon" title="Editar">
                            <i class='bx bx-edit-alt'></i>
                        </button>
                        <button class="btn btn-icon" title="Notas">
                            <i class='bx bx-note'></i>
                        </button>
                        <button class="btn btn-icon" title="Eliminar">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Modal para agregar/editar ingrediente -->
        <div class="modal" id="ingredientModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Agregar Ingrediente</h2>
                    <button class="close-modal"><i class='bx bx-x'></i></button>
                </div>
                <form id="ingredientForm">
                    <div class="form-group">
                        <label for="ingredientName">Nombre</label>
                        <input type="text" id="ingredientName" required>
                    </div>
                    <div class="form-group">
                        <label for="ingredientCategory">Categoría</label>
                        <select id="ingredientCategory" required>
                            <option value="spirits">Spirits</option>
                            <option value="liqueurs">Licores</option>
                            <option value="juices">Jugos</option>
                            <option value="mixers">Mixers</option>
                            <option value="others">Otros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientBrand">Marca</label>
                        <input type="text" id="ingredientBrand">
                    </div>
                    <div class="form-group">
                        <label for="ingredientUnit">Unidad de Medida</label>
                        <select id="ingredientUnit" required>
                            <option value="unit">Unidades</option>
                            <option value="ml">Mililitros (ml)</option>
                            <option value="bottle">Botellas</option>
                            <option value="can">Latas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientStock">Stock Inicial</label>
                        <input type="number" id="ingredientStock" min="0" step="1">
                    </div>
                    <div class="form-group">
                        <label for="ingredientFlavors">Sabores (separados por coma)</label>
                        <input type="text" id="ingredientFlavors" placeholder="Ej: Dulce, Cítrico, Amargo">
                    </div>
                    <div class="form-group">
                        <label for="ingredientAlcoholic">¿Contiene Alcohol?</label>
                        <input type="checkbox" id="ingredientAlcoholic">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Estado simple
            let currentIngredients = [];
            let activeFilters = { category:'all', brand:'', stock:'', alcoholic:false, search:'' };
            let editingId = null; // id del ingrediente que se edita

            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            const list = document.querySelector('.ingredient-list');
            const template = document.getElementById('ingredient-template');
            const modal = document.getElementById('ingredientModal');
            const addIngredientBtn = document.getElementById('addIngredientBtn');
            const closeModalBtn = modal.querySelector('.close-modal');
            const form = document.getElementById('ingredientForm');
            const modalTitle = modal.querySelector('h2');

            // Campos
            const fName = document.getElementById('ingredientName');
            const fCategory = document.getElementById('ingredientCategory');
            const fBrand = document.getElementById('ingredientBrand');
            const fUnit = document.getElementById('ingredientUnit');
            const fStock = document.getElementById('ingredientStock');
            const fFlavors = document.getElementById('ingredientFlavors');
            const fAlcoholic = document.getElementById('ingredientAlcoholic');

            function getUnitAbbreviation(unit){ const map={unit:'unidades',ml:'mililitros',bottle:'botellas',can:'latas'}; return map[unit]||unit||''; }
            function statusFrom(stock){ if(stock===0) return 'out'; if(stock<200) return 'low'; return 'ok'; }
            function updateStockStatus(el, stock){ if(stock===0){el.textContent='Sin stock';el.className='stock-status out';} else if(stock<200){el.textContent='Bajo';el.className='stock-status low';} else {el.textContent='OK';el.className='stock-status ok';} }

            function filterIngredients(){
                return currentIngredients.filter(i=>{
                    const c = activeFilters.category==='all' || (i.category||'').toLowerCase()===activeFilters.category;
                    const b = !activeFilters.brand || (i.brand||'').toLowerCase().includes(activeFilters.brand.toLowerCase());
                    const s = !activeFilters.stock || i.status===activeFilters.stock;
                    const a = !activeFilters.alcoholic || !!i.isAlcoholic;
                    const q = !activeFilters.search || i.name.toLowerCase().includes(activeFilters.search.toLowerCase());
                    return c && b && s && a && q;
                });
            }

            function render(){
                const header = list.querySelector('.ingredient-header');
                list.innerHTML='';
                if(header) list.appendChild(header);
                const data = filterIngredients();
                if(!data.length){ const d=document.createElement('div'); d.style.padding='1rem'; d.textContent='No hay ingredientes.'; list.appendChild(d); return; }
                data.forEach(ing=>{
                    const clone = document.importNode(template.content, true);
                    const row = clone.querySelector('.ingredient-item');
                    row.dataset.id = ing.id;
                    clone.querySelector('.ingredient-name').textContent = ing.name;
                    clone.querySelector('.ingredient-category').textContent = ing.category || '-';
                    clone.querySelector('.ingredient-brand').textContent = ing.brand || '-';
                    const qtyInput = clone.querySelector('.quantity-input');
                    qtyInput.value = ing.stock;
                    clone.querySelector('.unit').textContent = getUnitAbbreviation(ing.unit);
                    const tagsBox = clone.querySelector('.flavor-tags');
                    (ing.flavors||[]).forEach(f=>{ if(!f) return; const s=document.createElement('span'); s.className='flavor-tag'; s.textContent=f; tagsBox.appendChild(s); });
                    updateStockStatus(clone.querySelector('.stock-status'), ing.stock);

                    // Botones acciones
                    const buttons = row.querySelectorAll('.ingredient-actions .btn');
                    const editBtn = buttons[0];
                    const deleteBtn = buttons[2];
                    editBtn.addEventListener('click', ()=> startEdit(ing.id));
                    deleteBtn.addEventListener('click', ()=> removeIngredient(ing.id));

                    // Cantidad +/-
                    const dec = row.querySelector('.quantity-btn.decrease');
                    const inc = row.querySelector('.quantity-btn.increase');
                    dec.addEventListener('click', ()=> changeQty(ing.id, Math.max(0, parseInt(qtyInput.value)-1), qtyInput, row));
                    inc.addEventListener('click', ()=> changeQty(ing.id, parseInt(qtyInput.value)+1, qtyInput, row));
                    qtyInput.addEventListener('change', ()=> changeQty(ing.id, Math.max(0, parseInt(qtyInput.value)||0), qtyInput, row));

                    list.appendChild(clone);
                });
            }

            function openModal(edit=false){ if(!edit){ editingId=null; form.reset(); modalTitle.textContent='Agregar Ingrediente'; } modal.classList.add('active'); }
            function closeModal(){ modal.classList.remove('active'); form.reset(); editingId=null; }
            window.closeModal = closeModal; // para botón Cancelar inline

            function startEdit(id){
                const ing = currentIngredients.find(i=>i.id===id);
                if(!ing) return;
                editingId = id;
                modalTitle.textContent='Editar Ingrediente';
                fName.value = ing.name;
                fCategory.value = ing.category || 'others';
                fBrand.value = ing.brand || '';
                fUnit.value = ing.unit || 'unit';
                fStock.value = ing.stock || 0;
                fFlavors.value = (ing.flavors||[]).join(', ');
                fAlcoholic.checked = !!ing.isAlcoholic;
                openModal(true);
            }

            // ----- API sencillas -----
            function api(url, method='GET', body=null){
                return fetch(url, {
                    method,
                    headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},
                    body: body?JSON.stringify(body):null
                }).then(async r=>{ if(!r.ok){ let m='Error'; try{const j=await r.json(); m=j.message||m;}catch{} alert(m); throw new Error(m);} return r.status===204?null:r.json(); });
            }
            function load(){ api('/inventory/ingredients').then(data=>{
                currentIngredients = data.map(d=>({
                    id:d.id,
                    name:d.name,
                    category:d.category,
                    brand:d.brand,
                    unit:d.unit,
                    stock:d.stock,
                    flavors:d.flavors||[],
                    isAlcoholic:d.is_alcoholic,
                    status: statusFrom(d.stock)
                }));
                render();
            }); }
            function saveNew(payload){ return api('/inventory/ingredients','POST',payload); }
            function saveUpdate(id,payload){ return api('/inventory/ingredients/'+id,'PUT',payload); }
            function saveDelete(id){ return api('/inventory/ingredients/'+id,'DELETE'); }

            function changeQty(id,newQty,input,row){
                const ing = currentIngredients.find(i=>i.id===id); if(!ing) return;
                input.value = newQty;
                ing.stock = newQty;
                ing.status = statusFrom(newQty);
                updateStockStatus(row.querySelector('.stock-status'), newQty);
                saveUpdate(id,{stock:newQty});
            }
            function removeIngredient(id){ if(!confirm('¿Eliminar ingrediente?')) return; saveDelete(id).then(()=>{ currentIngredients = currentIngredients.filter(i=>i.id!==id); render(); }); }

            // Submit form (crear / editar)
            form.addEventListener('submit', function(e){
                e.preventDefault();
                const payload = {
                    name: fName.value.trim(),
                    category: fCategory.value,
                    brand: fBrand.value.trim()||null,
                    unit: fUnit.value,
                    stock: parseInt(fStock.value)||0,
                    flavors: fFlavors.value.split(',').map(v=>v.trim()).filter(v=>v.length),
                    is_alcoholic: fAlcoholic.checked?1:0,
                    description: null
                };
                if(editingId){
                    saveUpdate(editingId,payload).then(()=>{ closeModal(); load(); });
                } else {
                    saveNew(payload).then(()=>{ closeModal(); load(); });
                }
            });

            // Filtros
            document.querySelectorAll('.category-tab').forEach(tab=>{
                tab.addEventListener('click', ()=>{
                    document.querySelectorAll('.category-tab').forEach(t=>t.classList.remove('active'));
                    tab.classList.add('active');
                    activeFilters.category = tab.dataset.category;
                    render();
                });
            });
            document.getElementById('brandFilter').addEventListener('change', e=>{ activeFilters.brand=e.target.value; render(); });
            document.getElementById('stockFilter').addEventListener('change', e=>{ activeFilters.stock=e.target.value; render(); });
            document.getElementById('alcoholicFilter').addEventListener('change', e=>{ activeFilters.alcoholic=e.target.checked; render(); });
            document.getElementById('searchInput').addEventListener('input', e=>{ activeFilters.search=e.target.value; render(); });

            // Modal eventos
            addIngredientBtn.addEventListener('click', ()=> openModal(false));
            closeModalBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', e=>{ if(e.target===modal) closeModal(); });

            // Carga inicial
            load();
        });
    </script>
@endsection