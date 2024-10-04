@extends('components.public.matrix', ['pagina' => 'contacto'])

@section('css_importados')

@stop

@section('content')



    <main>

        <section
            class="flex relative flex-col justify-center items-center px-[5%] py-28 text-base font-medium min-h-[345px] text-neutral-900 max-md:py-24">
            <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f15375dac970433a2abe3921fa2c31e35c32f7b26a37b841431aaba1861d380?placeholderIfAbsent=true&apiKey=72fae0f4c808496790606e16dad566da"
                alt="" class="object-cover absolute inset-0 size-full opacity-15" />
            <div class="flex relative flex-col max-w-full w-[499px]">
                <h2 class="self-center text-[#FD1F4A] font-Helvetica_Medium">Contacto</h2>
                <h3 class="mt-3 text-5xl text-center max-md:max-w-full font-Helvetica_Medium">Comunícate</h3>
                <p class="mt-3 text-lg font-light text-center max-md:max-w-full ">
                    Donec vehicula, lectus vel pharetra semper, justo massa pharetra nunc, non venenatis ante augue quis
                    est.
                </p>
            </div>
        </section>


        <section class="flex flex-col mt-8 lg:mt-16 font-Helvetica_Light">
            <div class="flex flex-wrap gap-10 items-start px-[5%] lg:px-[8%] w-full">
                <div class="flex flex-col grow shrink min-w-[240px] w-[390px] max-md:max-w-full">
                    <header class="flex flex-col max-w-full text-neutral-900 w-[488px]">
                        <h1 class="text-5xl font-medium max-md:max-w-full font-Helvetica_Medium">A nuestro amable equipo le
                            encantaría saber de
                            usted</h1>
                        <p class="mt-3 text-base font-light max-md:max-w-full">Donec vehicula, lectus vel pharetra semper,
                            justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                    </header>
                    <aside class="flex flex-col mt-12 max-w-full w-full max-md:mt-10">
                        <div class="flex flex-col w-full">
                            <h2 class="text-xl font-medium text-[#FD1F4A] font-Helvetica_Medium">Horario de oficina</h2>
                            <p class="flex flex-col mt-2 max-w-full text-base font-light text-neutral-900 w-full">
                                @if ($general->schedule)
                                    <span>{{ $general->schedule }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="flex flex-col mt-8 w-full">
                            <h2 class="text-xl font-medium text-[#FD1F4A] font-Helvetica_Medium">Nuestra dirección</h2>
                            <address class="flex flex-col mt-2 max-w-full text-base font-light text-neutral-900 w-full">
                                @if ($general->address && is_null($general->inside))
                                    <span>{{ $general->address }}</span>
                                @elseif(is_null($general->address) && $general->inside)
                                    <span>{{ $general->inside }}</span>
                                @elseif($general->address && $general->inside)
                                    <span>{{ $general->address }}, {{ $general->inside }}</span>
                                @endif

                                @if ($general->district && is_null($general->city))
                                    <span>{{ $general->district }}</span>
                                @elseif(is_null($general->district) && $general->city)
                                    <span>{{ $general->city }}</span>
                                @elseif($general->district && $general->city)
                                    <span>{{ $general->district }}, {{ $general->city }}</span>
                                @endif

                            </address>
                        </div>
                        <div class="flex flex-col mt-8 w-full">
                            <h2 class="text-xl font-medium text-[#FD1F4A] font-Helvetica_Medium">Ponerse en contacto</h2>
                            <p class="flex flex-col mt-2 max-w-full text-base font-light text-neutral-900 w-full">
                                @if ($general->cellphone)
                                    <a href="tel:+51{{ $general->cellphone }}">{{ $general->cellphone }}</a>
                                @endif

                                @if ($general->office_phone)
                                    <a href="tel:+51{{ $general->office_phone }}">{{ $general->office_phone }}</a>
                                @endif
                            </p>
                        </div>
                    </aside>
                </div>
                <div class="flex flex-col grow shrink justify-center px-0 lg:px-10 min-w-[240px] w-[494px]">
                    <header class="flex flex-col w-full text-neutral-900 max-md:max-w-full">
                        <h2 class="text-3xl font-medium max-md:max-w-full font-Helvetica_Medium">Ponerse en contacto</h2>
                        <p class="mt-4 text-base font-light max-md:max-w-full">Donec vehicula, lectus vel pharetra semper,
                            justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                    </header>
                    <form class="flex flex-col mt-12 w-full max-md:mt-10 max-md:max-w-full" id="formContactos">
                        <div class="flex flex-wrap gap-4 items-start w-full text-neutral-900 max-md:max-w-full">
                            <div class="flex flex-col flex-1 shrink basis-0 min-w-[240px]">
                                <label for="nombre" class="text-[15px] font-medium font-Helvetica_Medium">Nombre</label>
                                <input id="nombre" type="text" placeholder="Ingresa tu nombre" name="name"
                                    class="px-4 py-3 mt-1.5 w-full text-base font-light bg-white rounded-lg border focus:ring-[#FD1F4A] focus:border-[#FD1F4A] border-gray-300 border-solid shadow-sm"
                                    aria-label="Ingresa tu nombre">
                            </div>
                            <div class="flex flex-col flex-1 shrink basis-0 min-w-[240px]">
                                <label for="apellido" class="text-[15px] font-medium font-Helvetica_Medium">Apellido</label>
                                <input id="apellido" type="text" placeholder="Ingresa tu apellido" name="lastname"
                                    class="px-4 py-3 mt-1.5 w-full text-base font-light bg-white rounded-lg border focus:ring-[#FD1F4A] focus:border-[#FD1F4A] border-gray-300 border-solid shadow-sm"
                                    aria-label="Ingresa tu apellido">
                            </div>
                        </div>
                        <div class="flex flex-col mt-6 w-full text-neutral-900 max-md:max-w-full">
                            <label for="email" class="text-[15px] font-medium font-Helvetica_Medium">E-mail</label>
                            <input id="email" type="email" placeholder="Ingresa tu dirección de correo electrónico"
                                name="email"
                                class="px-4 py-3 mt-1.5 w-full text-base font-light bg-white rounded-lg border focus:ring-[#FD1F4A] focus:border-[#FD1F4A] border-gray-300 border-solid shadow-sm max-md:max-w-full"
                                aria-label="Ingresa tu dirección de correo electrónico">
                        </div>
                        <div class="flex flex-col mt-6 w-full whitespace-nowrap text-neutral-900 max-md:max-w-full">
                            <label for="telefono"
                                class="text-[15px] font-medium max-md:max-w-full font-Helvetica_Medium">Telefono</label>
                            <input id="telefono" type="tel" placeholder="+51..." name="phone"
                                class="px-4 py-3 mt-1.5 w-full text-base font-light bg-white rounded-lg border focus:ring-[#FD1F4A] focus:border-[#FD1F4A] border-gray-300 border-solid shadow-sm max-md:max-w-full"
                                aria-label="Ingresa tu número de teléfono">
                        </div>
                        <div class="flex flex-col mt-6 w-full text-neutral-900 max-md:max-w-full">
                            <label for="mensaje"
                                class="text-[15px] font-medium max-md:max-w-full font-Helvetica_Medium">Escribe un
                                mensaje</label>
                            <textarea id="mensaje" placeholder="Escríbenos tu pregunta aquí" name="message"
                                class="px-4 py-3 mt-1.5 w-full text-base font-light bg-white rounded-lg border focus:ring-[#FD1F4A] focus:border-[#FD1F4A] border-gray-300 border-solid shadow-sm max-md:max-w-full"
                                rows="3" aria-label="Escribe tu mensaje"></textarea>
                        </div>
                        <div class="flex flex-wrap gap-3 items-center mt-6 w-full max-md:max-w-full">
                            <input type="checkbox" id="privacy-policy" required
                                class="w-5 h-5 bg-white rounded-md border border-gray-300 border-solid text-[#FD1F4A] focus:ring-0">
                            <label for="privacy-policy"
                                class="text-[15px] font-light text-neutral-900 font-Helvetica_Light">Usted acepta nuestra
                                amigable política de privacidad.</label>
                        </div>
                       
                            <button type="submit"
                                class="font-Helvetica_Medium tracking-wider cursor-pointer gap-2.5 self-stretch px-4 py-3 mt-8 w-full text-base font-bold text-center text-white bg-[#FD1F4A] rounded-3xl min-h-[43px] max-md:max-w-full">Enviar
                                mensaje</button>
                      
                    </form>
                </div>
            </div>
            <div class="flex flex-row items-start justify-start">
                <img loading="lazy" src="{{ asset('images/img/fondofwc.png') }}"
                    class="object-contain self-center mt-10 lg:-mt-20 max-w-full aspect-[1.84] shadow-[-179px_91px_56px_rgba(0,0,0,0)] w-full lg:w-2/3 "
                    alt="">
            </div>
        </section>

    </main>


@section('scripts_importados')
    <script>
        function alerta(message) {
            Swal.fire({
                title: message,
                icon: "error",
            });
        }

        function validarEmail(value) {
            console.log(value)
            const regex =
                /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

            if (!regex.test(value)) {
                alerta("El campo email no es válido");
                return false;
            }
            return true;
        }

        $('#formContactos').submit(function(event) {
            // Evita que se envíe el formulario automáticamente
            //console.log('evcnto')
            let btnEnviar = $('#btnEnviar');
            btnEnviar.prop('disabled', true);
            btnEnviar.text('Enviando...');
            btnEnviar.css('cursor', 'not-allowed');

            event.preventDefault();
            let formDataArray = $(this).serializeArray();

            if (!validarEmail($('#email').val())) {
                btnEnviar.prop('disabled', false);
                btnEnviar.text('Enviar Mensaje');
                btnEnviar.css('cursor', 'pointer');
                return;
            };


            /* console.log(formDataArray); */
            $.ajax({
                url: '{{ route('guardarContactos') }}',
                method: 'POST',
                data: $(this).serialize(),
                beforeSend: function() {
                    Swal.fire({
                        title: 'Enviando...',
                        text: 'Por favor, espere',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close(); // Close the loading message
                    $('#formContactos')[0].reset();
                    Swal.fire({
                        title: response.message,
                        icon: "success",
                    });

                    if (!window.location.href.includes('#formularioenviado')) {
                        window.location.href = window.location.href.split('#')[0] +
                        '#formularioenviado';
                    }
                    btnEnviar.prop('disabled', false);
                    btnEnviar.text('Enviar Mensaje');
                    btnEnviar.css('cursor', 'pointer');
                },
                error: function(error) {
                    Swal.close(); // Close the loading message
                    const obj = error.responseJSON.message;
                    const keys = Object.keys(error.responseJSON.message);
                    let flag = false;
                    keys.forEach(key => {
                        if (!flag) {
                            const e = obj[key][0];
                            Swal.fire({
                                title: error.message,
                                text: e,
                                icon: "error",
                            });
                            flag = true; // Marcar como mostrado
                        }
                    });
                    btnEnviar.prop('disabled', false);
                    btnEnviar.text('Enviar Mensaje');
                    btnEnviar.css('cursor', 'pointer');
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {


            function capitalizeFirstLetter(string) {
                string = string.toLowerCase()
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        })
        $('#disminuir').on('click', function() {
            console.log('disminuyendo')
            let cantidad = Number($('#cantidadSpan span').text())
            if (cantidad > 0) {
                cantidad--
                $('#cantidadSpan span').text(cantidad)
            }


        })
        // cantidadSpan
        $('#aumentar').on('click', function() {
            console.log('aumentando')
            let cantidad = Number($('#cantidadSpan span').text())
            cantidad++
            $('#cantidadSpan span').text(cantidad)

        })
    </script>
    <script>
        let articulosCarrito = [];


        function deleteOnCarBtn(id, operacion) {
            console.log('Elimino un elemento del carrito');
            console.log(id, operacion)
            const prodRepetido = articulosCarrito.map(item => {
                if (item.id === id && item.cantidad > 0) {
                    item.cantidad -= Number(1);
                    return item; // retorna el objeto actualizado 
                } else {
                    return item; // retorna los objetos que no son duplicados 
                }

            });
            Local.set('carrito', articulosCarrito)
            limpiarHTML()
            PintarCarrito()


        }

        function calcularTotal() {
            let articulos = Local.get('carrito')
            console.log(articulos)
            let total = articulos.map(item => {
                let monto
                if (Number(item.descuento) !== 0) {
                    monto = item.cantidad * Number(item.descuento)
                } else {
                    monto = item.cantidad * Number(item.precio)

                }
                return monto

            })
            const suma = total.reduce((total, elemento) => total + elemento, 0);

            $('#itemsTotal').text(`S/. ${suma} `)

        }

        function addOnCarBtn(id, operacion) {
            console.log('agrego un elemento del cvarrio');
            console.log(id, operacion)

            const prodRepetido = articulosCarrito.map(item => {
                if (item.id === id) {
                    item.cantidad += Number(1);
                    return item; // retorna el objeto actualizado 
                } else {
                    return item; // retorna los objetos que no son duplicados 
                }

            });
            console.log(articulosCarrito)
            Local.set('carrito', articulosCarrito)
            // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
            limpiarHTML()
            PintarCarrito()


        }

        function deleteItem(id) {
            console.log('borrando elemento')
            articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

            Local.set('carrito', articulosCarrito)
            limpiarHTML()
            PintarCarrito()
        }

        var appUrl = <?php echo json_encode($url_env); ?>;
        console.log(appUrl);
        $(document).ready(function() {
            articulosCarrito = Local.get('carrito') || [];

            PintarCarrito();
        });

        function limpiarHTML() {
            //forma lenta 
            /* contenedorCarrito.innerHTML=''; */
            $('#itemsCarrito').html('')


        }



        // function PintarCarrito() {
        //   console.log('pintando carrito ')

        //   let itemsCarrito = $('#itemsCarrito')

        //   articulosCarrito.forEach(element => {
        //     let plantilla = `<div class="flex justify-between bg-white font-Inter_Regular border-b-[1px] border-[#E8ECEF] pb-5">
    //         <div class="flex justify-center items-center gap-5">
    //           <div class="bg-[#F3F5F7] rounded-md p-4">
    //             <img src="${appUrl}/${element.imagen}" alt="producto" class="w-24" />
    //           </div>
    //           <div class="flex flex-col gap-3 py-2">
    //             <h3 class="font-semibold text-[14px] text-[#151515]">
    //               ${element.producto}
    //             </h3>
    //             <p class="font-normal text-[12px] text-[#6C7275]">

    //             </p>
    //             <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
    //               <button type="button" onClick="(deleteOnCarBtn(${element.id}, '-'))" class="  w-8 h-8 flex justify-center items-center ">
    //                 <span  class="text-[20px]">-</span>
    //               </button>
    //               <div class="w-8 h-8 flex justify-center items-center">
    //                 <span  class="font-semibold text-[12px]">${element.cantidad }</span>
    //               </div>
    //               <button type="button" onClick="(addOnCarBtn(${element.id}, '+'))" class="  w-8 h-8 flex justify-center items-center ">
    //                 <span class="text-[20px]">+</span>
    //               </button>
    //             </div>
    //           </div>
    //         </div>
    //         <div class="flex flex-col justify-start py-2 gap-5 items-center pr-2">
    //           <p class="font-semibold text-[14px] text-[#151515]">
    //             S/ ${Number(element.descuento) !== 0 ? element.descuento : element.precio}
    //           </p>
    //           <div class="flex items-center">
    //             <button type="button" onClick="(deleteItem(${element.id}))" class="  w-8 h-8 flex justify-center items-center ">
    //             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    //               <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    //             </svg>
    //             </button>

    //           </div>
    //         </div>
    //       </div>`

        //     itemsCarrito.append(plantilla)

        //   });

        //   calcularTotal()
        // }






        $('#btnAgregarCarrito').on('click', function() {
            let url = window.location.href;
            let partesURl = url.split('/')
            let item = partesURl[partesURl.length - 1]
            let cantidad = Number($('#cantidadSpan span').text())
            item = item.replace('#', '')



            // id='nodescuento'


            $.ajax({

                url: `{{ route('carrito.buscarProducto') }}`,
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    id: item,
                    cantidad

                },
                success: function(success) {
                    console.log(success)
                    let {
                        producto,
                        id,
                        descuento,
                        precio,
                        imagen,
                        color
                    } = success.data
                    let cantidad = Number(success.cantidad)
                    let detalleProducto = {
                        id,
                        producto,
                        descuento,
                        precio,
                        imagen,
                        cantidad,
                        color

                    }
                    let existeArticulo = articulosCarrito.some(item => item.id === detalleProducto.id)
                    if (existeArticulo) {
                        //sumar al articulo actual 
                        const prodRepetido = articulosCarrito.map(item => {
                            if (item.id === detalleProducto.id) {
                                item.cantidad += Number(detalleProducto.cantidad);
                                return item; // retorna el objeto actualizado 
                            } else {
                                return item; // retorna los objetos que no son duplicados 
                            }

                        });
                    } else {
                        articulosCarrito = [...articulosCarrito, detalleProducto]

                    }

                    Local.set('carrito', articulosCarrito)
                    let itemsCarrito = $('#itemsCarrito')
                    let ItemssubTotal = $('#ItemssubTotal')
                    let itemsTotal = $('#itemsTotal')
                    limpiarHTML()
                    PintarCarrito()

                },
                error: function(error) {
                    console.log(error)
                }

            })



            // articulosCarrito = {...articulosCarrito , detalleProducto }
        })
        // $('#openCarrito').on('click', function() {
        //   console.log('abriendo carrito ');
        //   $('.main').addClass('blur')
        // })
        // $('#closeCarrito').on('click', function() {
        //   console.log('cerrando  carrito ');

        //   $('.cartContainer').addClass('hidden')
        //   $('#check').prop('checked', false);
        //   $('.main').removeClass('blur')


        // })
    </script>

    <script src="{{ asset('js/storage.extend.js') }}"></script>
@stop

@stop
