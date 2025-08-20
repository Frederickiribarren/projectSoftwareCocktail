<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Models\UserFavorite;
use App\Models\SourceApi; 
use App\Models\Inventory;

class DatabaseAdminController extends Controller
{
    protected $tables = [
        'users' => [
            'model' => User::class,
            'instance' => null,
            'icon' => 'fa-users',
            'description' => 'Gestión de usuarios del sistema, incluyendo roles y permisos.'
        ],
        'recipes' => [
            'model' => Recipe::class,
            'instance' => null,
            'icon' => 'fa-cocktail',
            'description' => 'Colección de recetas de cócteles y bebidas.'
        ],
        'ingredients' => [
            'model' => Ingredient::class,
            'instance' => null,
            'icon' => 'fa-wine-bottle',
            'description' => 'Catálogo de ingredientes disponibles para las recetas.'
        ],
        'recipe_ingredients' => [
            'model' => RecipeIngredient::class,
            'instance' => null,
            'icon' => 'fa-mortar-pestle',
            'description' => 'Relación entre recetas e ingredientes con sus medidas.'
        ],
        'user_favorites' => [
            'model' => UserFavorite::class,
            'instance' => null,
            'icon' => 'fa-heart',
            'description' => 'Recetas favoritas guardadas por los usuarios.'
        ],
        'source_apis' => [
            'model' => SourceApi::class,
            'instance' => null,
            'icon' => 'fa-key',
            'description' => 'Tokens y claves de API para servicios externos.',
            'table_name' => 'source_apis'  // Nombre exacto de la tabla en la base de datos
        ],
        'inventories' => [
            'model' => Inventory::class,
            'instance' => null,
            'icon' => 'fa-boxes',
            'description' => 'Inventario de ingredientes disponibles para los usuarios.'
        ]
    ];

    public function __construct()
    {
        // Inicializar instancias de modelos
        foreach ($this->tables as $key => &$table) {
            $table['instance'] = new $table['model'];
        }
    }

    /**
     * Muestra la vista principal del administrador de base de datos
     */
    public function index()
    {
        $tablesInfo = [];

        foreach ($this->tables as $tableName => $tableData) {
            $model = $tableData['model'];
            $lastRecord = $model::latest()->first();
            
            $tablesInfo[$tableName] = [
                'name' => ucfirst(str_replace('_', ' ', $tableName)),
                'icon' => $tableData['icon'],
                'description' => $tableData['description'],
                'count' => $model::count(),
                'last_updated' => ($lastRecord && $lastRecord->updated_at) ? 
                    $lastRecord->updated_at->diffForHumans() : 
                    'No hay registros',
            ];
        }

        return view('pages.database-admin', ['tables' => $tablesInfo]);
    }

    /**
     * Muestra los registros de una tabla específica
     */
    public function showTable($table)
    {
        if (!array_key_exists($table, $this->tables)) {
            abort(404);
        }

        $tableData = $this->tables[$table];
        $model = $tableData['model'];
        $modelInstance = $tableData['instance'];
        $tableName = $tableData['table_name'] ?? $table;
        $records = $model::paginate(10);
        $columns = Schema::getColumnListing($tableName);

        // Obtener las relaciones disponibles del modelo
        $relationships = [];
        $reflector = new \ReflectionClass($modelInstance);
        $methods = $reflector->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        foreach ($methods as $method) {
            if ($method->class === get_class($modelInstance)) {
                $returnType = $method->getReturnType();
                if ($returnType && 
                    (strpos($returnType, 'belongsTo') !== false || 
                     strpos($returnType, 'hasMany') !== false || 
                     strpos($returnType, 'belongsToMany') !== false)) {
                    $relationships[] = $method->getName();
                }
            }
        }

        return view('pages.table-view', [
            'tableName' => ucfirst(str_replace('_', ' ', $table)),
            'records' => $records,
            'columns' => $columns,
            'relationships' => $relationships
        ]);
    }

    /**
     * Obtiene los registros filtrados de una tabla
     */
    public function getFilteredRecords(Request $request, $table)
    {
        if (!array_key_exists($table, $this->tables)) {
            return response()->json(['error' => 'Tabla no encontrada'], 404);
        }

        $model = $this->tables[$table]['model'];
        $query = $model::query();

        // Aplicar búsqueda
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $columns = Schema::getColumnListing($table);
            
            $query->where(function($q) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$searchTerm}%");
                }
            });
        }

        // Aplicar filtros
        if ($request->has('filters')) {
            foreach ($request->filters as $column => $value) {
                $query->where($column, $value);
            }
        }

        // Ordenamiento
        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->direction ?? 'asc');
        }

        $records = $query->paginate($request->per_page ?? 10);

        return response()->json($records);
    }

    /**
     * Actualiza un registro
     */
    public function updateRecord(Request $request, $table, $id)
    {
        if (!array_key_exists($table, $this->tables)) {
            return response()->json([
                'success' => false,
                'error' => 'Tabla no encontrada'
            ], 404);
        }

        $model = $this->tables[$table]['model'];
        $record = $model::findOrFail($id);

        try {
            $data = $request->all();
            
            // Procesar campos booleanos
            foreach ($data as $key => $value) {
                if (is_string($value) && ($value === 'true' || $value === 'false')) {
                    $data[$key] = $value === 'true';
                }
            }
            
            // Manejar campos de fecha/hora
            if (isset($data['last_used_at'])) {
                $data['last_used_at'] = $data['last_used_at'] ? Carbon::parse($data['last_used_at']) : null;
            }
            
            $data['updated_at'] = Carbon::now();
            
            // Actualizar solo los campos que están en fillable
            $record->fill($data);
            $record->save();
            
            // Recargar el registro para asegurar que los timestamps estén actualizados
            $record = $record->fresh();
            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado con éxito',
                'record' => $record
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al actualizar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina un registro
     */
    public function deleteRecord($table, $id)
    {
        if (!array_key_exists($table, $this->tables)) {
            return response()->json([
                'success' => false,
                'error' => 'Tabla no encontrada'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $model = $this->tables[$table]['model'];
            $record = $model::findOrFail($id);

            // Si es un usuario, primero eliminar sus registros relacionados
            if ($table === 'users') {
                // Eliminar favoritos del usuario
                DB::table('user_favorites')->where('user_id', $id)->delete();
                // Eliminar notas de recetas del usuario
                DB::table('user_recipe_notes')->where('user_id', $id)->delete();
                // Eliminar inventario del usuario
                DB::table('inventories')->where('user_id', $id)->delete();
            }
            
            \Log::info('Eliminando registro:', [
                'table' => $table,
                'id' => $id
            ]);
            
            $record->delete();
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado con éxito'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => 'Registro no encontrado'
            ], 404);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            \Log::error('Error al eliminar registro: ' . $e->getMessage());
            
            $errorMessage = 'No se puede eliminar este registro porque está siendo utilizado en otras partes del sistema.';
            if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                $errorMessage = 'Este registro no se puede eliminar porque tiene elementos relacionados. Por favor, elimine primero los elementos dependientes.';
            }
            
            return response()->json([
                'success' => false,
                'error' => $errorMessage
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al eliminar registro:', [
                'table' => $table,
                'id' => $id,
                'error' => $e->getMessage()
            ]);
                
            return response()->json([
                'success' => false,
                'error' => 'Error al eliminar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crea un nuevo registro
     */
    public function createRecord(Request $request, $table)
    {
        if (!array_key_exists($table, $this->tables)) {
            return response()->json(['error' => 'Tabla no encontrada'], 404);
        }

        try {
            $data = $request->all();
            $modelClass = $this->tables[$table]['model'];
            
            // Crear una nueva instancia del modelo
            $model = new $modelClass();
            
            // Llenar los datos
            $model->fill($data);
            
            // Guardar el modelo (esto manejará automáticamente los timestamps)
            $model->save();
            
            // Log para debugging
            \Log::info('Registro creado:', [
                'table' => $table,
                'data' => $data,
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ]);
            
            // Recargar el modelo para asegurar que tenemos los datos más recientes
            $model = $model->fresh();
            
            return response()->json([
                'success' => true,
                'message' => 'Registro creado con éxito', 
                'record' => $model
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al crear el registro: ' . $e->getMessage()
            ], 500);
        }
    }
}
