document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const listContainer = document.querySelector('.ingredient-list');
    const template = document.getElementById('ingredient-template');
    const addBtn = document.getElementById('addIngredientBtn');
    const modal = document.getElementById('ingredientModal');
    const modalTitle = modal.querySelector('.modal-header h2');
    const closeModalBtn = modal.querySelector('.close-modal');
    const form = document.getElementById('ingredientForm');

    // Form fields
    const fName = document.getElementById('ingredientName');
    const fCategory = document.getElementById('ingredientCategory');
    const fBrand = document.getElementById('ingredientBrand');
    const fUnit = document.getElementById('ingredientUnit');
    const fStock = document.getElementById('ingredientStock');
    const fFlavors = document.getElementById('ingredientFlavors');
    const fAlcoholic = document.getElementById('ingredientAlcoholic');

    let editId = null; // id del ingrediente en edición
    let ingredientsCache = []; // cache local

    function openModal(edit = false) {
        if (!edit) {
            editId = null;
            modalTitle.textContent = 'Agregar Ingrediente';
            form.reset();
        } else {
            modalTitle.textContent = 'Editar Ingrediente';
        }
        modal.classList.add('active');
    }
    function closeModal(){ modal.classList.remove('active'); }
    closeModalBtn.addEventListener('click', closeModal);
    addBtn.addEventListener('click', () => openModal(false));
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

    async function api(url, method='GET', body=null){
        const res = await fetch(url, {
            method,
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept':'application/json', 'Content-Type':'application/json' },
            body: body ? JSON.stringify(body) : null
        });
        if(!res.ok){
            let msg = 'Error';
            try { const j = await res.json(); msg = j.message || JSON.stringify(j); } catch {}
            throw new Error(msg);
        }
        return res.status === 204 ? null : res.json();
    }

    function stockStatusClass(q){
        if(q === 0) return { txt:'Sin stock', cls:'stock-status out' };
        if(q < 3) return { txt:'Bajo', cls:'stock-status low' }; // criterio relativo
        return { txt:'OK', cls:'stock-status ok' };
    }

    function renderList(){
        const header = listContainer.querySelector('.ingredient-header');
        listContainer.innerHTML='';
        if(header) listContainer.appendChild(header);
        ingredientsCache.forEach(ing => {
            const clone = document.importNode(template.content, true);
            const el = clone.querySelector('.ingredient-item');
            el.dataset.id = ing.id;
            clone.querySelector('.ingredient-name').textContent = ing.name;
            clone.querySelector('.ingredient-category').textContent = ing.category;
            clone.querySelector('.ingredient-brand').textContent = ing.brand || '-';
            const qtyInput = clone.querySelector('.quantity-input');
            qtyInput.value = ing.stock;
            clone.querySelector('.unit').textContent = ing.unit || '';
            // sabores
            const tagsBox = clone.querySelector('.flavor-tags');
            (ing.flavors || []).forEach(f => { if(!f) return; const s=document.createElement('span'); s.className='flavor-tag'; s.textContent=f; tagsBox.appendChild(s); });
            // status
            const st = stockStatusClass(ing.stock);
            const stEl = clone.querySelector('.stock-status');
            stEl.textContent = st.txt; stEl.className = st.cls;
            // acciones
            const btns = el.querySelectorAll('.ingredient-actions .btn');
            const [editBtn, notesBtn, delBtn] = btns;
            editBtn.addEventListener('click', () => startEdit(ing.id));
            delBtn.addEventListener('click', () => deleteIngredient(ing.id));
            // control de cantidad +/-
            const decBtn = el.querySelector('.quantity-btn.decrease');
            const incBtn = el.querySelector('.quantity-btn.increase');
            decBtn.addEventListener('click', async () => { updateQuantity(ing, Math.max(0, parseInt(qtyInput.value)-1), stEl, qtyInput); });
            incBtn.addEventListener('click', async () => { updateQuantity(ing, parseInt(qtyInput.value)+1, stEl, qtyInput); });
            qtyInput.addEventListener('change', () => { updateQuantity(ing, Math.max(0, parseInt(qtyInput.value)||0), stEl, qtyInput); });
            listContainer.appendChild(clone);
        });
        if(ingredientsCache.length===0){
            const empty = document.createElement('div');
            empty.style.padding='1rem';
            empty.textContent='No tienes ingredientes.';
            listContainer.appendChild(empty);
        }
    }

    async function load(){
        try {
            const data = await api('/inventory/ingredients');
            ingredientsCache = data;
            renderList();
        } catch(e){ console.error(e); }
    }

    async function updateQuantity(ing, newQty, statusEl, inputEl){
        try {
            inputEl.disabled = true;
            await api(`/inventory/ingredients/${ing.id}`, 'PUT', { stock: newQty });
            ing.stock = newQty;
            const st = stockStatusClass(newQty);
            statusEl.textContent = st.txt; statusEl.className = st.cls;
        } catch(e){ alert(e.message); } finally { inputEl.disabled=false; }
    }

    function startEdit(id){
        const ing = ingredientsCache.find(i=>i.id===id);
        if(!ing) return;
        editId = id;
        fName.value = ing.name;
        fCategory.value = ing.category || 'others';
        fBrand.value = ing.brand || '';
        fUnit.value = ing.unit || 'unit';
        fStock.value = ing.stock || 0;
        fFlavors.value = (ing.flavors||[]).join(', ');
        fAlcoholic.checked = !!ing.is_alcoholic;
        openModal(true);
    }

    async function deleteIngredient(id){
        if(!confirm('¿Eliminar ingrediente de tu inventario?')) return;
        try { await api(`/inventory/ingredients/${id}`, 'DELETE'); }
        catch(e){ alert(e.message); return; }
        ingredientsCache = ingredientsCache.filter(i=>i.id!==id);
        renderList();
    }

    form.addEventListener('submit', async e => {
        e.preventDefault();
        const payload = {
            name: fName.value.trim(),
            category: fCategory.value,
            brand: fBrand.value.trim() || null,
            unit: fUnit.value,
            stock: parseInt(fStock.value)||0,
            flavors: fFlavors.value.split(',').map(v=>v.trim()).filter(v=>v.length),
            is_alcoholic: fAlcoholic.checked ? 1 : 0,
            description: null
        };
        try {
            if(editId){
                await api(`/inventory/ingredients/${editId}`, 'PUT', payload);
            } else {
                await api('/inventory/ingredients', 'POST', payload);
            }
            closeModal();
            await load();
        } catch(e){ alert(e.message); }
    });

    load();
});
