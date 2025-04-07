function addPlateInput() {
    const container = document.getElementById('plates-container');
    const div = document.createElement('div');
    div.classList.add('input-group', 'mb-2');

    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'plates[]';
    input.className = 'form-control';
    input.placeholder = 'Introduce una matrícula';

    div.appendChild(input);
    container.appendChild(div);
}

window.addPlateInput = addPlateInput;
