function toggleExtraFields() {
    var propertyTypeSelect = document.getElementById('property_type_id');
    if (!propertyTypeSelect) return; // Aseguramos que exista el elemento

    var selectedText = propertyTypeSelect.options[propertyTypeSelect.selectedIndex].text.toLowerCase();

    if (selectedText === 'trastero' || selectedText === 'garage') {
        document.getElementById('extraGarageTrasteroFields').style.display = 'block';
        document.getElementById('extraLocalPisoFields').style.display = 'none';
    } else if (selectedText === 'local comercial' || selectedText === 'piso') {
        document.getElementById('extraLocalPisoFields').style.display = 'block';
        document.getElementById('extraGarageTrasteroFields').style.display = 'none';
    } else {
        document.getElementById('extraGarageTrasteroFields').style.display = 'none';
        document.getElementById('extraLocalPisoFields').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var propertyTypeSelect = document.getElementById('property_type_id');
    if(propertyTypeSelect) {
        propertyTypeSelect.addEventListener('change', toggleExtraFields);
        toggleExtraFields();
    }
});