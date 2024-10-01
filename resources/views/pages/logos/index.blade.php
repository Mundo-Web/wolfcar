<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('logos.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">Agregar logo</a>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Logos</h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th class="w-32">Imagen</th>
                <th>Titulo</th>
                {{-- <th>Descripcion</th> --}}
                <th class="w-32">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($logos as $logo)
                <tr>
                  <td class="dark:bg-slate-800"><img class="w-20 object-contain mx-auto" src="{{ asset($logo->url_image) }}"/></td>
                  <td class="dark:bg-slate-800">{{ $logo->title }}</td>
                  {{-- <td class="dark:bg-slate-800">{{ $logo->description }}</td> --}}
                  <td class="dark:bg-slate-800">
                    <form action=" " method="POST">
                      @csrf
                      <a data-idService='{{ $logo->id }} ' href=""
                        class="btn_delete bg-red-600 px-3 py-2 rounded text-white cursor-pointer"><i
                          class="fa-regular fa-trash-can"></i></a>
                      <!-- <a href="" class="bg-red-600 p-2 rounded text-white"><i class="fa-regular fa-trash-can"></i></a> -->
                    </form>
                  </td>
                </tr>
              @endforeach



            </tbody>
            <tfoot>
              <tr>
                <th>Imagen</th>
                <th>Titulo</th>
                {{-- <th>Descripcion</th> --}}
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>

  <script>
    $('document').ready(function() {

      new DataTable('#tabladatos', {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            layout: {
                topStart: 'buttons'
            },
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                
                 "sProcessing":"Procesando...",
            },
            buttons:[ 
           
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
            },
            {
                extend:    'copy',
                text:      '<i class="fas fa-copy"></i> ',
                titleAttr: 'Copiar',
                className: 'btn btn-success',
            },
        ]
        });

      $(".btn_delete").on("click", function(e) {
        e.preventDefault()

        let id = $(this).attr('data-idService');

        Swal.fire({
          title: "Seguro que deseas eliminar?",
          text: "Vas a eliminar un Logo",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({

              url: '{{ route('logos.deleteLogo') }}',
              method: 'POST',
              data: {
                _token: $('input[name="_token"]').val(),
                id: id,

              }

            }).done(function(res) {

              Swal.fire({
                title: res.message,
                icon: "success"
              });

              location.reload();

            })


          }
        });

      });


      /*

         $(".btn_swithc").on("change", function() {

           var status = 0;
           var id = $(this).attr('data-idService');
           var titleService = $(this).attr('data-titleService');
           var field = $(this).attr('data-field');

           if ($(this).is(':checked')) {
             status = 1;
           } else {
             status = 0;
           }



            */



    })
  </script>

</x-app-layout>
