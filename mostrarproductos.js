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
                url: 'buscarproducto.php',
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
            url: 'mostrarproducto.php',
            type: 'GET',
            success: function(response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                  <tr taskId="${task.id}">
                  <td>${task.id}</td>
                  <td><a href="#" class="task-item">${task.nameprodcuto}</a></td>
                    <td>${task.descproducto}</td>
                    <td>${task.costoproducto}</td>
                    <td>${task.unidadproducto}</td>
                    <td>${task.stockproducto}</td>
                    <td>${task.marcaproducto}</td>
                    <td>
                    <button class="task-delete btn btn-danger">
                     Eliminar 
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
            nombreP: $('#nameprodcuto').val(),
            descP: $('#descproducto').val(),
            costoP: $('#costoproducto').val(),
            unidadP: $('#unidadproducto').val(),
            stockP: $('#stockproducto').val(),
            marcaP: $('#marcaproducto').val(),
            id: $('#taskId').val()
        };
        const url = edit === false ? 'task-add.php' : 'editarproducto.php';
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
        $.post('productosolo.php', {id}, (response) => {
            const task = JSON.parse(response);
            $('#nameprodcuto').val(task.nombre);
            $('#descproducto').val(task.desc);
            $('#costoproducto').val(task.costo);
            $('#unidadproducto').val(task.unidad);
            $('#stockproducto').val(task.stock);
            $('#marcaproducto').val(task.marca);
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
            $.post('eliminarproducto.php', {id}, (response) => {
                fetchTasks();
            });
        }
    });



});