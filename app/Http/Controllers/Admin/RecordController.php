<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RecordController extends Controller
{
    public function show($table, $id)
    {
        try {
            $record = DB::table($table)->find($id);

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'record' => $record
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $table)
    {
        try {
            $data = $request->except(['_token']);
            
            $id = DB::table($table)->insertGetId($data);

            return response()->json([
                'success' => true,
                'message' => 'Registro creado con éxito',
                'id' => $id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $table, $id)
    {
        try {
            $data = $request->except(['_token', '_method']);
            
            DB::table($table)->where('id', $id)->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Registro actualizado con éxito'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($table, $id)
    {
        try {
            DB::table($table)->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado con éxito'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getRelations($name)
    {
        try {
            // Valores para campos enum
            $enumMap = [
                'source' => [
                    ['id' => 'system', 'name' => 'Sistema'],
                    ['id' => 'user_manual', 'name' => 'Manual por Usuario'],
                    ['id' => 'user_ocr', 'name' => 'OCR por Usuario'],
                    ['id' => 'user_ai_generated', 'name' => 'Generado por IA']
                ]
            ];

            // Si es un campo enum, devolver sus opciones
            if (isset($enumMap[$name])) {
                return response()->json([
                    'success' => true,
                    'options' => $enumMap[$name]
                ]);
            }

            // Mapeo de nombres de relación a tablas y campos
            $tableMap = [
                'user' => ['table' => 'users', 'field' => 'name'],
                'recipe' => ['table' => 'recipes', 'field' => 'name'],
                'ingredient' => ['table' => 'ingredients', 'field' => 'name'],
                'category' => ['table' => 'categories', 'field' => 'name'],
                'source_api' => ['table' => 'source_apis', 'field' => 'name'],
                'glass_type' => ['table' => 'glass_types', 'field' => 'name']
            ];

            // Verificar si existe el mapeo para esta relación
            if (!isset($tableMap[$name])) {
                return response()->json([
                    'success' => false,
                    'message' => "Relación no encontrada: {$name}"
                ], 404);
            }

            $config = $tableMap[$name];
            
            // Verificar si la tabla existe
            if (!Schema::hasTable($config['table'])) {
                return response()->json([
                    'success' => false,
                    'message' => "La tabla {$config['table']} no existe"
                ], 404);
            }

            // Obtener los registros
            $records = DB::table($config['table'])
                ->select('id', DB::raw("{$config['field']} as name"))
                ->get();

            return response()->json([
                'success' => true,
                'options' => $records
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar las opciones: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getRelatedTable($name)
    {
        // Normalizar el nombre (convertir guiones bajos a guiones y todo a minúsculas)
        $normalizedName = strtolower(str_replace('_', '', $name));

        // Mapeo específico para casos especiales
        $pluralMap = [
            'sourceapi' => 'source_apis',
            'glasstype' => 'glass_types',
            'user' => 'users',
            'recipe' => 'recipes',
            'ingredient' => 'ingredients',
            'category' => 'categories',
            'inventory' => 'inventories',
            'favorite' => 'user_favorites',
            'note' => 'user_recipe_notes',
            'garnish' => 'garnishes'
        ];

        // Comprobar el mapeo normalizado
        if (isset($pluralMap[$normalizedName])) {
            return $pluralMap[$normalizedName];
        }

        // Si el nombre original contiene guiones bajos, mantenerlos
        if (strpos($name, '_') !== false) {
            $parts = explode('_', $name);
            $lastPart = array_pop($parts);
            
            // Pluralizar solo la última parte
            if (substr($lastPart, -1) === 'y') {
                $lastPart = substr($lastPart, 0, -1) . 'ies';
            } else {
                $lastPart .= 's';
            }
            
            return implode('_', array_merge($parts, [$lastPart]));
        }

        // Si no está en el mapeo, intentar pluralizar
        if (substr($name, -1) === 'y') {
            return substr($name, 0, -1) . 'ies';
        }
        
        // Por defecto, agregar 's'
        return $name . 's';
    }

    private function getDisplayField($table)
    {
        // Mapeo de tablas a campos de visualización
        $fieldMap = [
            'users' => 'name',
            'recipes' => 'name',
            'ingredients' => 'name',
            'categories' => 'name',
            'source_apis' => 'name',
            'glass_types' => 'name',
            'garnishes' => 'name',
            'inventories' => 'quantity',
            'user_favorites' => 'id',
            'user_recipe_notes' => 'notes'
        ];

        // Campos a buscar en orden de preferencia si no hay mapeo específico
        $preferredFields = ['name', 'title', 'description', 'label', 'id'];
        
        // Si hay un mapeo específico, usarlo
        if (isset($fieldMap[$table])) {
            return $fieldMap[$table];
        }
        
        // Si no hay mapeo, intentar encontrar el primer campo preferido que exista
        $columns = Schema::getColumnListing($table);
        foreach ($preferredFields as $field) {
            if (in_array($field, $columns)) {
                return $field;
            }
        }
        
        // Si no se encuentra ningún campo preferido, devolver 'id'
        return 'id';
    }

    public function search(Request $request)
    {
        try {
            $table = session('current_table', 'users');
            $term = $request->get('term');

            $records = DB::table($table)
                ->where(function($query) use ($term) {
                    // Buscar en todas las columnas de texto
                    $columns = Schema::getColumnListing($table);
                    foreach ($columns as $column) {
                        if (in_array(Schema::getColumnType($table, $column), ['string', 'text'])) {
                            $query->orWhere($column, 'LIKE', "%{$term}%");
                        }
                    }
                })
                ->paginate(10);

            return response()->json([
                'success' => true,
                'records' => $records
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda: ' . $e->getMessage()
            ], 500);
        }
    }
}
