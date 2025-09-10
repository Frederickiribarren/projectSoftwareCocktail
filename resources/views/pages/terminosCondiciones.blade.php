@extends('layouts.app')

@section('title', 'Términos y Condiciones - Software Cocktail')

@section('content')
<link rel="stylesheet" href="{{ asset('css/terminoCondiciones.css') }}">
<div class="terms-conditions-container">
    <div class="container">
        <div class="terms-content">
            <h1 class="terms-title">Términos y Condiciones de Uso</h1>
            <p class="last-updated">Última actualización: {{ date('d/m/Y') }}</p>

            <div class="terms-section">
                <h2>1. Aceptación de los Términos</h2>
                <p>
                    Al acceder y utilizar Software Cocktail ("la Plataforma"), usted acepta estar sujeto a estos 
                    Términos y Condiciones de Uso. Si no está de acuerdo con alguna parte de estos términos, 
                    no debe utilizar nuestros servicios.
                </p>
            </div>

            <div class="terms-section">
                <h2>2. Descripción del Servicio</h2>
                <p>Software Cocktail es una plataforma web que ofrece:</p>
                <ul>
                    <li>Base de datos de recetas de cócteles y bebidas</li>
                    <li>Herramientas para crear y gestionar recetas personales</li>
                    <li>Sistema de inventario personal de ingredientes</li>
                    <li>Funciones de búsqueda y filtrado avanzado</li>
                    <li>Comunidad para compartir experiencias y conocimientos</li>
                    <li>Herramientas profesionales para bartenders</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>3. Registro y Cuenta de Usuario</h2>
                <h3>3.1 Requisitos de Registro</h3>
                <ul>
                    <li>Debe ser mayor de 18 años para registrarse</li>
                    <li>Proporcionar información veraz y actualizada</li>
                    <li>Mantener la confidencialidad de sus credenciales</li>
                    <li>Notificar inmediatamente cualquier uso no autorizado</li>
                </ul>

                <h3>3.2 Responsabilidades del Usuario</h3>
                <ul>
                    <li>Es responsable de todas las actividades en su cuenta</li>
                    <li>Debe cumplir con las leyes locales sobre consumo de alcohol</li>
                    <li>No debe compartir su cuenta con menores de edad</li>
                    <li>Debe mantener actualizada su información de contacto</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>4. Uso Aceptable</h2>
                <h3>4.1 Usos Permitidos</h3>
                <ul>
                    <li>Crear y compartir recetas originales de cócteles</li>
                    <li>Buscar y guardar recetas de otros usuarios</li>
                    <li>Participar en la comunidad de manera constructiva</li>
                    <li>Utilizar las herramientas profesionales si es bartender</li>
                </ul>

                <h3>4.2 Usos Prohibidos</h3>
                <ul>
                    <li><strong>Contenido Ilegal:</strong> Subir contenido que viole leyes locales</li>
                    <li><strong>Promoción de Consumo Irresponsable:</strong> Fomentar el abuso del alcohol</li>
                    <li><strong>Spam y Publicidad:</strong> Usar la plataforma para publicidad no autorizada</li>
                    <li><strong>Violación de Derechos:</strong> Infringir propiedad intelectual de terceros</li>
                    <li><strong>Contenido Ofensivo:</strong> Material discriminatorio u ofensivo</li>
                    <li><strong>Actividades Maliciosas:</strong> Intentar dañar la plataforma o otros usuarios</li>
                    <li><strong>Suplantación:</strong> Hacerse pasar por otra persona o entidad</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>5. Contenido del Usuario</h2>
                <h3>5.1 Propiedad del Contenido</h3>
                <p>
                    Usted retiene la propiedad de las recetas originales que crea. Al publicar contenido, 
                    nos otorga una licencia no exclusiva para mostrar, distribuir y promover su contenido 
                    dentro de la plataforma.
                </p>

                <h3>5.2 Responsabilidad del Contenido</h3>
                <ul>
                    <li>Es responsable de la originalidad y legalidad de su contenido</li>
                    <li>Debe respetar los derechos de autor de recetas tradicionales</li>
                    <li>No debe incluir ingredientes peligrosos o ilegales</li>
                    <li>Debe proporcionar instrucciones claras y seguras</li>
                </ul>

                <h3>5.3 Moderación</h3>
                <p>
                    Nos reservamos el derecho de revisar, modificar o eliminar contenido que viole 
                    estos términos sin previo aviso.
                </p>
            </div>

            <div class="terms-section">
                <h2>6. Propiedad Intelectual</h2>
                <h3>6.1 Derechos de la Plataforma</h3>
                <p>
                    Software Cocktail, su diseño, funcionalidades, código fuente y base de datos 
                    son propiedad exclusiva de nuestro equipo y están protegidos por leyes de 
                    propiedad intelectual.
                </p>

                <h3>6.2 Licencia de Uso</h3>
                <p>
                    Le otorgamos una licencia limitada, no exclusiva y revocable para usar la 
                    plataforma según estos términos.
                </p>

                <h3>6.3 Respeto a Derechos de Terceros</h3>
                <p>
                    Respetamos los derechos de propiedad intelectual y esperamos que nuestros 
                    usuarios hagan lo mismo. Implementamos procedimientos para atender reclamaciones 
                    por infracción de derechos.
                </p>
            </div>

            <div class="terms-section">
                <h2>7. Privacidad y Protección de Datos</h2>
                <p>
                    Su privacidad es importante para nosotros. El manejo de sus datos personales 
                    se rige por nuestra <a href="{{ route('politicasPrivacidad') }}" class="link-accent">Política de Privacidad</a>, 
                    que forma parte integral de estos términos.
                </p>
            </div>

            <div class="terms-section">
                <h2>8. Responsabilidad sobre el Consumo de Alcohol</h2>
                <div class="warning-box">
                    <h3>⚠️ Advertencia Importante</h3>
                    <ul>
                        <li><strong>Consumo Responsable:</strong> Esta plataforma es solo para mayores de edad</li>
                        <li><strong>Riesgos para la Salud:</strong> El alcohol puede ser perjudicial para la salud</li>
                        <li><strong>Embarazo y Lactancia:</strong> Se recomienda evitar el alcohol</li>
                        <li><strong>Medicamentos:</strong> Consulte a su médico sobre interacciones</li>
                        <li><strong>Conducción:</strong> Nunca conduzca bajo los efectos del alcohol</li>
                        <li><strong>Límites Legales:</strong> Respete las leyes locales sobre consumo</li>
                    </ul>
                </div>
            </div>

            <div class="terms-section">
                <h2>9. Limitación de Responsabilidad</h2>
                <h3>9.1 Descargo de Garantías</h3>
                <p>
                    La plataforma se proporciona "tal como está" sin garantías de ningún tipo. 
                    No garantizamos que el servicio sea ininterrumpido o libre de errores.
                </p>

                <h3>9.2 Limitación de Daños</h3>
                <ul>
                    <li>No somos responsables por daños indirectos o consecuenciales</li>
                    <li>Nuestra responsabilidad se limita al monto pagado por servicios premium</li>
                    <li>No somos responsables por el mal uso de las recetas</li>
                    <li>Los usuarios asumen la responsabilidad de preparar bebidas seguras</li>
                </ul>

                <h3>9.3 Ingredientes y Alergias</h3>
                <p>
                    No nos responsabilizamos por reacciones alérgicas o problemas de salud 
                    derivados del consumo de ingredientes mencionados en las recetas.
                </p>
            </div>

            <div class="terms-section">
                <h2>10. Suspensión y Terminación</h2>
                <h3>10.1 Terminación por el Usuario</h3>
                <p>
                    Puede cerrar su cuenta en cualquier momento desde la configuración de su perfil 
                    o contactándonos directamente.
                </p>

                <h3>10.2 Terminación por Software Cocktail</h3>
                <p>Podemos suspender o terminar su cuenta por:</p>
                <ul>
                    <li>Violación de estos términos</li>
                    <li>Uso fraudulento o abusivo de la plataforma</li>
                    <li>Inactividad prolongada (más de 3 años)</li>
                    <li>Solicitud de autoridades competentes</li>
                </ul>

                <h3>10.3 Efectos de la Terminación</h3>
                <p>
                    Al terminar la cuenta, se eliminará el acceso pero el contenido público 
                    podrá mantenerse según nuestra política de retención.
                </p>
            </div>

            <div class="terms-section">
                <h2>11. Modificaciones del Servicio</h2>
                <p>
                    Nos reservamos el derecho de modificar, suspender o discontinuar cualquier 
                    aspecto del servicio con o sin previo aviso. Podemos introducir nuevas 
                    funcionalidades o limitar algunas existentes.
                </p>
            </div>

            <div class="terms-section">
                <h2>12. Pagos y Servicios Premium</h2>
                <h3>12.1 Servicios Gratuitos</h3>
                <p>
                    La mayoría de nuestras funcionalidades son gratuitas y financiadas por 
                    la pasión por la coctelería.
                </p>

                <h3>12.2 Funciones Premium (Futuras)</h3>
                <p>
                    Podemos introducir funcionalidades premium en el futuro, las cuales se 
                    regirán por términos adicionales específicos.
                </p>
            </div>

            <div class="terms-section">
                <h2>13. Resolución de Disputas</h2>
                <h3>13.1 Ley Aplicable</h3>
                <p>
                    Estos términos se rigen por las leyes de Chile y cualquier disputa se 
                    resolverá en los tribunales competentes de Santiago.
                </p>

                <h3>13.2 Procedimiento de Quejas</h3>
                <ol>
                    <li>Contactar nuestro soporte técnico</li>
                    <li>Mediación informal cuando sea posible</li>
                    <li>Procedimientos legales como último recurso</li>
                </ol>
            </div>

            <div class="terms-section">
                <h2>14. Disposiciones Generales</h2>
                <h3>14.1 Divisibilidad</h3>
                <p>
                    Si alguna disposición es declarada inválida, el resto de los términos 
                    seguirán siendo válidos y ejecutables.
                </p>

                <h3>14.2 Modificaciones de los Términos</h3>
                <p>
                    Podemos actualizar estos términos ocasionalmente. Los cambios importantes 
                    se notificarán mediante correo electrónico o avisos en la plataforma.
                </p>

                <h3>14.3 Cesión</h3>
                <p>
                    No puede transferir sus derechos bajo estos términos. Nosotros podemos 
                    ceder nuestros derechos en caso de fusión o adquisición.
                </p>
            </div>

            <div class="terms-section">
                <h2>15. Información de Contacto</h2>
                <div class="contact-info">
                    <p><strong>Para consultas sobre estos términos:</strong></p>
                    <p><strong>Email:</strong> legal@softwarecocktail.com</p>
                    <p><strong>Soporte Técnico:</strong> soporte@softwarecocktail.com</p>
                    <p><strong>Tiempo de Respuesta:</strong> 48 horas hábiles</p>
                </div>
            </div>

            <div class="terms-section agreement">
                <h2>16. Aceptación y Reconocimiento</h2>
                <p>
                    <strong>Al utilizar Software Cocktail, usted reconoce que:</strong>
                </p>
                <ul>
                    <li>Ha leído y comprendido estos términos</li>
                    <li>Es mayor de edad según las leyes de su jurisdicción</li>
                    <li>Acepta usar la plataforma de manera responsable</li>
                    <li>Comprende los riesgos asociados con el consumo de alcohol</li>
                    <li>Se compromete a cumplir con todas las disposiciones</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
