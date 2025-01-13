import InputManager from '/input-manager.js';
import TurnoManager from '/turno-manager.js';
import DepartamentoManager from '/departamento-manager.js';

// Inicializar todos los módulos cuando el documento esté listo
$(document).ready(function() {
    // Inicializar el manejo de inputs (funcionalidad existente)
    InputManager.init();
    
    // Inicializar los nuevos módulos
    TurnoManager.init();
    DepartamentoManager.init();
});