$(document).ready(function(){

    let edit = false;

    // Testing Jquery
    console.log('jquery is working!');
    fetchTasks();
    $('#task-result').hide();

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'buscarusuarios.php',
                data: {search},
                type: 'POST',
                success: function (response) {
                    let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(task => {
                        template += `<li><a href="#" class="task-item">${task.name}</a></li>`
                    });
                    $('#task-result').show();
                    $('#container').html(template);

                    if(!response.error) {
                        //
                    }
                    // console.log(response);
                }
            })
        }
    });
//  mostrar productos
    function fetchTasks() {
        $.ajax({
            url: 'mostrarusuarios.php',
            type: 'GET',
            success: function(response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                  <tr taskId="${task.id}">
                  <td>${task.id}</td>
                  <td><a href="#" class="task-item">${task.nombreU}</a></td>
                  <td>${task.apellidosU}</td>
                  <td>${task.dniU}</td>
                  <td>${task.direcU}</td>
                  <td>${task.fechaU}</td>
                  <td>${task.telefonoU}</td>
                  <td>${task.tipoU}</td>
                  <td>
                    <button class="task-delete btn btn-danger">
                     Delete 
                    </button>
                  </td>
                  </tr>
                `
                });
                $('#tasks').html(template);
            }
        });
    }

    $('#task-form').submit(e => {
        e.preventDefault();
        const postData = {
            nombre: $('#usuario').val(),
            apellido: $('#apellido').val(),
            clave: $('#clave').val(),
            dni: $('#dni').val(),
            direccion: $('#direccion').val(),
            fecha: $('#fechaingreso').val(),
            telefono: $('#telefono').val(),
            tipo: $('#tipo').val(),
            id: $('#taskId').val()
        };
        const url = edit === false ? 'task-add.php' : 'editarusuarios.php';
        console.log(postData, url);
        $.post(url, postData, (response) => {
            console.log(response);
            $('#task-form').trigger('reset');
            fetchTasks();
        });
    });

    // Get a Single Task by Id
    $(document).on('click', '.task-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
        $.post('usuariosolo.php', {id}, (response) => {
            const task = JSON.parse(response);
            $('#usuario').val(task.nombreU);
            $('#apellido').val(task.apellidosU);
            $('#clave').val(task.claveU);
            $('#dni').val(task.dniU);
            $('#direccion').val(task.direcU);
            $('#fechaingreso').val(task.fechaU);
            $('#telefono').val(task.telefonoU);
            $('#tipo').val(task.tipoU);
            $('#taskId').val(task.id);
            edit = true;
        });
        e.preventDefault();
    });

    // Delete a Single Task
    $(document).on('click', '.task-delete', (e) => {
        if(confirm('¿Estás seguro de que quieres eliminar este elemento?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('taskId');
            $.post('eliminarusuarios.php', {id}, (response) => {
                fetchTasks();
            });
        }
    });



});