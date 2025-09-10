@extends('layouts.app')

@section('title', 'Políticas de Privacidad - Software Cocktail')

@section('content')
<link rel="stylesheet" href="{{ asset('css/politicasPrivacidad.css') }}">
<div class="privacy-policy-container">
    <div class="container">
        <div class="privacy-content">
            <h1 class="privacy-title">Políticas de Privacidad</h1>
            <p class="last-updated">Última actualización: {{ date('d/m/Y') }}</p>

            <div class="policy-section">
                <h2>1. Información General</h2>
                <p>
                    Bienvenido a Software Cocktail. Esta Política de Privacidad describe cómo recopilamos, usamos, 
                    almacenamos y protegemos su información personal cuando utiliza nuestra plataforma de recetas 
                    de cócteles y servicios relacionados.
                </p>
            </div>

            <div class="policy-section">
                <h2>2. Información que Recopilamos</h2>
                <h3>2.1 Información Personal</h3>
                <ul>
                    <li><strong>Información de Cuenta:</strong> Nombre, dirección de correo electrónico, contraseña encriptada.</li>
                    <li><strong>Información de Perfil:</strong> Foto de perfil opcional, preferencias de cócteles, notas personales.</li>
                    <li><strong>Información de Uso:</strong> Recetas favoritas, búsquedas realizadas, tiempo de uso de la plataforma.</li>
                </ul>

                <h3>2.2 Información Técnica</h3>
                <ul>
                    <li><strong>Datos del Dispositivo:</strong> Tipo de dispositivo, sistema operativo, navegador web.</li>
                    <li><strong>Datos de Conexión:</strong> Dirección IP, ubicación aproximada (ciudad/país).</li>
                    <li><strong>Cookies y Tecnologías Similares:</strong> Para mejorar la experiencia del usuario.</li>
                </ul>

                <h3>2.3 Información de Contenido</h3>
                <ul>
                    <li><strong>Recetas Creadas:</strong> Ingredientes, instrucciones, imágenes subidas por el usuario.</li>
                    <li><strong>Inventario Personal:</strong> Lista de ingredientes disponibles del usuario.</li>
                    <li><strong>Notas y Comentarios:</strong> Anotaciones personales sobre recetas.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>3. Cómo Utilizamos su Información</h2>
                <ul>
                    <li><strong>Provisión del Servicio:</strong> Crear y mantener su cuenta, mostrar recetas personalizadas.</li>
                    <li><strong>Mejora del Servicio:</strong> Análisis de uso para optimizar la plataforma.</li>
                    <li><strong>Comunicación:</strong> Envío de notificaciones importantes sobre el servicio.</li>
                    <li><strong>Seguridad:</strong> Prevención de fraude y actividades maliciosas.</li>
                    <li><strong>Cumplimiento Legal:</strong> Cuando sea requerido por ley.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>4. Base Legal para el Procesamiento</h2>
                <p>Procesamos su información personal basándonos en:</p>
                <ul>
                    <li><strong>Consentimiento:</strong> Para funcionalidades opcionales como notificaciones.</li>
                    <li><strong>Ejecución de Contrato:</strong> Para proporcionar los servicios solicitados.</li>
                    <li><strong>Interés Legítimo:</strong> Para mejorar nuestros servicios y seguridad.</li>
                    <li><strong>Obligación Legal:</strong> Para cumplir con requisitos legales aplicables.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>5. Compartir Información</h2>
                <p><strong>No vendemos ni alquilamos su información personal a terceros.</strong> Podemos compartir información en los siguientes casos:</p>
                <ul>
                    <li><strong>Proveedores de Servicios:</strong> Empresas que nos ayudan a operar la plataforma (hosting, análisis).</li>
                    <li><strong>Cumplimiento Legal:</strong> Cuando sea requerido por autoridades competentes.</li>
                    <li><strong>Protección de Derechos:</strong> Para proteger nuestros derechos legales y los de nuestros usuarios.</li>
                    <li><strong>Transacciones Comerciales:</strong> En caso de fusión, adquisición o venta de activos.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>6. Seguridad de los Datos</h2>
                <p>Implementamos medidas de seguridad técnicas y organizativas para proteger su información:</p>
                <ul>
                    <li>Encriptación de contraseñas usando algoritmos seguros (bcrypt)</li>
                    <li>Conexiones HTTPS para todas las transmisiones de datos</li>
                    <li>Acceso restringido a datos personales solo al personal autorizado</li>
                    <li>Monitoreo regular de vulnerabilidades de seguridad</li>
                    <li>Copias de seguridad regulares con encriptación</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>7. Retención de Datos</h2>
                <ul>
                    <li><strong>Cuentas Activas:</strong> Mantenemos los datos mientras la cuenta esté activa.</li>
                    <li><strong>Cuentas Inactivas:</strong> Los datos se eliminan después de 3 años de inactividad.</li>
                    <li><strong>Datos de Registro:</strong> Se conservan por 12 meses para fines de seguridad.</li>
                    <li><strong>Eliminación de Cuenta:</strong> Los datos se eliminan dentro de 30 días tras la solicitud.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>8. Sus Derechos</h2>
                <p>Usted tiene los siguientes derechos sobre su información personal:</p>
                <ul>
                    <li><strong>Acceso:</strong> Solicitar una copia de su información personal.</li>
                    <li><strong>Rectificación:</strong> Corregir información inexacta o incompleta.</li>
                    <li><strong>Eliminación:</strong> Solicitar la eliminación de su información personal.</li>
                    <li><strong>Portabilidad:</strong> Obtener sus datos en un formato estructurado.</li>
                    <li><strong>Objeción:</strong> Oponerse al procesamiento de sus datos personales.</li>
                    <li><strong>Limitación:</strong> Solicitar la restricción del procesamiento.</li>
                    <li><strong>Retirar Consentimiento:</strong> Para procesamiento basado en consentimiento.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>9. Cookies y Tecnologías de Seguimiento</h2>
                <p>Utilizamos las siguientes tecnologías:</p>
                <ul>
                    <li><strong>Cookies Esenciales:</strong> Necesarias para el funcionamiento básico del sitio.</li>
                    <li><strong>Cookies de Rendimiento:</strong> Para analizar el uso y mejorar la experiencia.</li>
                    <li><strong>Cookies de Personalización:</strong> Para recordar sus preferencias.</li>
                    <li><strong>Local Storage:</strong> Para almacenar preferencias localmente en su dispositivo.</li>
                </ul>
                <p>Puede gestionar las cookies a través de la configuración de su navegador.</p>
            </div>

            <div class="policy-section">
                <h2>10. Transferencias Internacionales</h2>
                <p>
                    Sus datos pueden ser procesados en países fuera de su jurisdicción. En tales casos, 
                    implementamos salvaguardas apropiadas como cláusulas contractuales estándar para 
                    garantizar un nivel adecuado de protección.
                </p>
            </div>

            <div class="policy-section">
                <h2>11. Menores de Edad</h2>
                <p>
                    Nuestros servicios están dirigidos a personas mayores de 18 años. No recopilamos 
                    intencionalmente información personal de menores de edad. Si descubrimos que hemos 
                    recopilado información de un menor, la eliminaremos de inmediato.
                </p>
            </div>

            <div class="policy-section">
                <h2>12. Cambios en esta Política</h2>
                <p>
                    Podemos actualizar esta Política de Privacidad ocasionalmente. Le notificaremos 
                    sobre cambios significativos mediante:
                </p>
                <ul>
                    <li>Notificación en la plataforma</li>
                    <li>Correo electrónico (para cambios importantes)</li>
                    <li>Actualización de la fecha "Última actualización"</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>13. Contacto</h2>
                <p>Si tiene preguntas sobre esta Política de Privacidad o desea ejercer sus derechos, contáctenos:</p>
                <div class="contact-info">
                    <p><strong>Email:</strong> privacy@softwarecocktail.com</p>
                    <p><strong>Responsable de Protección de Datos:</strong> Equipo de Privacidad</p>
                    <p><strong>Tiempo de Respuesta:</strong> 30 días hábiles</p>
                </div>
            </div>

            <div class="policy-section">
                <h2>14. Autoridad de Supervisión</h2>
                <p>
                    Si no está satisfecho con nuestro manejo de sus datos personales, tiene derecho a 
                    presentar una queja ante la autoridad de protección de datos competente en su jurisdicción.
                </p>
            </div>

            <div class="policy-section agreement">
                <h2>15. Aceptación</h2>
                <p>
                    Al utilizar Software Cocktail, usted acepta esta Política de Privacidad y el 
                    procesamiento de su información personal como se describe en este documento.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
