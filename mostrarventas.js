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
                url: 'buscarcliente.php',
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

    function fetchTasks() {
        $.ajax({
            url: 'mostrarcliente.php',
            type: 'GET',
            success: function(response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                  <tr taskId="${task.id}">
                  <td>${task.id}</td>
                  <td><a href="#" class="task-item">${task.idboleta}</a></td>
                  <td>${task.cliente}</td>
                  <td>${task.total}</td>
<!--                  <td>
                    <button class="task-delete btn btn-danger">
                     Eliminar 
                    </button>
                  </td>-->
                  </tr>
                `
                });
                $('#tasks').html(template);
                console.log(response);
            }
        });
    }
    $('#task-form').submit(e => {
        e.preventDefault();
        const postData = {
            nombre: $('#namecliente').val(),
            direccion: $('#addresscliente').val(),
            ruc: $('#ruccliente').val(),
            correo: $('#emailcliente').val(),
            telefono: $('#phonecliente').val(),
            id: $('#taskId').val()
        };
        const url = edit === false ? 'task-add.php' : 'editarcliente.php';
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
        $.post('clientesolo.php', {id}, (response) => {
            const task = JSON.parse(response);
            $('#namecliente').val(task.namecliente);
            $('#addresscliente').val(task.addresscliente);
            $('#ruccliente').val(task.ruccliente);
            $('#emailcliente').val(task.emailcliente);
            $('#phonecliente').val(task.phonecliente);
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
            $.post('eliminarcliente.php', {id}, (response) => {
                fetchTasks();
            });
        }
    });

});