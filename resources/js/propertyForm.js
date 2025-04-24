function toggleExtraFields() {
    const select = document.getElementById('property_type_id');
    const selectedOption = select.options[select.selectedIndex];
    const type = selectedOption.getAttribute('data-type');

    const showGarage = (type === 'garage');
    const showLocalPiso = (type === 'local' || type === 'vivienda');

    document.getElementById('extraGarageField').style.display = showGarage ? 'block' : 'none';
    document.getElementById('extraLocalPisoFields').style.display = showLocalPiso ? 'block' : 'none';
}


document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('property_type_id');
    if (select) {
        select.addEventListener('change', toggleExtraFields);
        toggleExtraFields();
    }
});