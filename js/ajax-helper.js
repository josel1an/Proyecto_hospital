// Utilidades para llamadas AJAX
const ajaxHelper = {
    post: function(url, data) {
        return $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
            }
        });
    },
    
    loadHtml: function(url, data) {
        return $.ajax({
            url: url,
            type: 'POST',
            data: data,
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
            }
        });
    }
};

export default ajaxHelper;