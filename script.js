document.addEventListener('DOMContentLoaded', () => {
    // Registro de usuario
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'register');

            fetch('auth.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    alert('Registro exitoso');
                    // Limpiar el formulario o redirigir
                    registerForm.reset();
                } else {
                    // Mostrar errores
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar el registro.');
            });
        });
    }
});
