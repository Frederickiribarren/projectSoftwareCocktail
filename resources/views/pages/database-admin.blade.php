@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/database-admin.css') }}">
    <div class="container">
        <div class="page-header">
            <h1>Administración de Base de Datos</h1>
            <p>Gestiona y monitorea las tablas del sistema</p>
        </div>

        <div class="database-grid">
            @foreach($tables as $tableName => $tableInfo)
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas {{ $tableInfo['icon'] }}"></i>
                </div>
                <h3 class="table-name">{{ $tableInfo['name'] }}</h3>
                <p class="table-description">{{ $tableInfo['description'] }}</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: {{ $tableInfo['count'] }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: {{ $tableInfo['last_updated'] }}</span>
                    </div>
                </div>
                <div class="table-actions">
                    <a href="{{ route('table.view', $tableName) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
