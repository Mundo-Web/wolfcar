@extends('components.public.matrix', ['pagina' => 'catalogo'])

@section('title', 'Producto Detalle | ' . config('app.name', 'Laravel'))

@section('css_importados')

@stop

@section('content')
  <?php
  // Definición de la función capitalizeFirstLetter()
  // function capitalizeFirstLetter($string)
  // {
  //     return ucfirst($string);
  // }
  ?>
  <style>
    /* imagen de fondo transparente para calcar el dise;o */
    .clase_table {
      border-collapse: separate;
      border-spacing: 10;
    }

    .fixedWhastapp {
      right: 2vw !important;
    }

    .clase_table td {
      /* border: 1px solid black; */
      border-radius: 10px;
      -moz-border-radius: 10px;
      padding: 10px;
    }

    .swiper-pagination-bullet-active {
      background-color: #272727;
    }

    .swiper-pagination-bullet:not(.swiper-pagination-bullet-active) {
      background-color: #979693 !important;
    }

    .blocker {
      z-index: 20;
    }


    @media (min-width: 600px) {
      #offers .swiper-slide {
        margin-right: 100px !important;
      }

      #offers .swiper-slide::before {
        content: '+';
        display: block;
        position: absolute;
        top: 50%;
        right: -70px;
        transform: translateY(-50%);
        font-size: 32px;
        font-weight: bolder;
        color: #ffffff;
        padding: 0px 12px;
        background-color: #0d2e5e;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, .125);
      }

      #offers .swiper-slide:last-child::before {
        content: none;
      }

    }
  </style>

  @php
    $images = ['', '_ambiente'];
    $x = $product->toArray();
    $i = 1;
  @endphp
  @php
    $breadcrumbs = [['title' => 'Inicio', 'url' => route('index')], ['title' => 'Producto', 'url' => '']];
  @endphp
  @php
    $StockActual = $product->stock;
    $maxStock = 100; // maximo stock

    if (!is_null($product->max_stock) > 0) {
        $maxStock = $product->max_stock;
    }
    # calculamos en % cuanto queda en base a 100
    $stock = 0;
    if ($maxStock !== 0) {
        $stock = ($StockActual * 100) / $maxStock;
    }

  @endphp
  {{-- @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
  @endcomponent --}}
  <main class="font-Inter_Regular" id="mainSection">
        @csrf
        <section class="w-full px-[5%] md:px-[8%]">
            <div class="grid grid-cols-1 2md:grid-cols-2 gap-10 md:gap-16 pt-8 lg:pt-16">

                <div class="flex flex-col justify-start items-center gap-5">
                    <div id="containerProductosdetail"
                        class="w-full flex justify-center items-center aspect-square overflow-hidden">
                        <img src="{{ asset($product->imagen) }}" alt="computer" class="w-full h-full object-contain"
                            data-aos="fade-up" data-aos-offset="150"
                            onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';">
                    </div>
                    <x-product-slider :product="$product" />
                </div>

                <div class="flex flex-col gap-6  mt-2">
                    @foreach ($atributos as $item)
                     @foreach ($valorAtributo as $value)
                            @if ($value->attribute_id == $item->id)
                              
                                  @isset($valoresdeatributo)
                                      @foreach($valoresdeatributo as $valorat)
                                        @if($valorat->attribute_value_id == $value->id)
                                          <img src={{asset($value->imagen)}} class="w-24 h-12 object-contain"/>
                                        @endif
                                      @endforeach
                                  @endisset
                              
                            @endif
                      @endforeach
                    @endforeach
                    <div class="flex flex-col">
                        <h3 id="nombreproducto" class="font-Helvetica_Medium text-3xl text-[#111111] font-normal tracking-tight">
                            {{ $product->producto }}</h3>
                        {{-- <p class="font-Inter_Regular text-base gap-2">Disponibilidad:
                            @if ($product->stock == 0)
                                <span class="text-[#f6000c]">No hay Stock disponible</span>
                            @else
                                <span class="text-[#006BF6]">Quedan {{ round((float) $product->stock) }} en stock</span>
                            @endif
                        </p> --}}

                        {{-- <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $stock }}%"></div>
                        </div> --}}
                    </div>

                    <div class="flex flex-col gap-3">
                    
                        <div class="flex flex-row gap-3 content-center items-center">
                            @if ($product->descuento == 0)
                                <div class="content-center flex flex-row gap-2 items-center">
                                    <span class="font-Helvetica_Bold text-3xl gap-2 text-[#FD1F4A]">S/
                                        {{ $product->precio }}</span>
                                </div>
                            @else
                                <div class="content-center flex flex-row gap-2 items-center">
                                    <span class="font-Helvetica_Bold text-3xl gap-2 text-[#FD1F4A]">S/
                                        {{ $product->descuento }}</span>
                                    <span class="text-[#111111] font-Helvetica_Medium line-through text-lg">S/
                                        {{ $product->precio }}</span>
                                </div>
                                @php
                                    $descuento = round(
                                        (($product->precio - $product->descuento) * 100) / $product->precio,
                                    );
                                @endphp
                                <span
                                    class="ml-2 font-Helvetica_Medium text-center content-center text-sm gap-2 bg-[#FD1F4A] text-white h-9 w-16 rounded-3xl px-2">
                                    -{{ $descuento }}% </span>
                            @endif
                        </div>
                        
                        <div class="font-medium text-base font-Helvetica_Light w-full mt-4 text-[#444]">
                            {!! $product->description !!}
                        </div>

                        @if ($product->sku)
                            <p class="font-Helvetica_Light text-base gap-2 text-[#444] mt-2">SKU: {{ $product->sku }}
                            </p>
                        @endif
                    </div>
                    
                     @if ($otherProducts->isNotEmpty())
                        <p class="mb-2 "><b>Característica</b>:
                        <span class="block bg-[#F5F5F7] p-3 mt-2" tippy> {{ $product->color }}</span>
                        
                        <p class="-mb-4 "><b>Otras opciones</b>:</p>
                                
                            <div class="flex flex-wrap gap-2">
                                @foreach ($otherProducts as $x)
                                <a class="block bg-[#F5F5F7] hover:bg-[#ebebf2] p-3" href="/producto/{{ $x->id }}" tippy> {{ $x->color }}</a>
                                @endforeach
                            </div>

                    @endif
                    {{-- @if (!$product->attributes->isEmpty())
                        <div class="flex flex-col gap-8 mt-4 font-Inter_Regular text-lg">
                            @php
                                $groupedAttributes = $product->attributes->groupBy('titulo');
                            @endphp

                            @foreach ($groupedAttributes as $titulo => $items)
                                <div class="flex flex-row gap-3 text-center text-base font-Inter_Medium">
                                    <span>{{ $titulo }}:</span>
                                    @foreach ($items as $item)
                                        @php
                                            // Encuentra el objeto en $valorAtributo que tiene el id igual a $item->pivot->attribute_value_id
                                            $atributo = $valorAtributo->firstWhere(
                                                'id',
                                                $item->pivot->attribute_value_id,
                                            );
                                        @endphp
                                        @if ($atributo)
                                            <!-- Muestra el valor del atributo encontrado -->
                                            <span
                                                class="bg-[#006BF6] text-white rounded-md px-5 text-base">{{ $atributo->valor }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif --}}

                    @if (!$especificaciones->isEmpty())
                        <p class="font-Inter_Medium text-base gap-2 ">Especificaciones: </p>
                        <div class="min-w-full divide-y divide-gray-200">
                            <table class=" divide-y divide-gray-200 ">
                                <tbody>
                                    @foreach ($especificaciones as $item)
                                        <tr>
                                            <td class="px-4 py-1 border border-gray-200">
                                                {{ $item->tittle }}
                                            </td>
                                            <td class="px-4 py-1 border border-gray-200">
                                                {{ $item->specifications }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col xl:flex-row gap-5 items-center">
                            <div class="flex">
                                <div
                                    class="flex justify-center items-center bg-[#F5F5F5] cursor-pointer rounded-l-3xl">
                                    <button class="py-2.5 px-5 text-lg font-Helvetica_Bold rounded-full bg-black m-1 text-white" id=disminuir
                                        type="button">-</button>
                                </div>
                                <div id=cantidadSpan
                                    class="py-2.5 px-5 flex justify-center items-center bg-[#F5F5F5] text-lg font-Helvetica_Bold">
                                    <span>1</span>
                                </div>
                                <div
                                    class="flex justify-center items-center bg-[#F5F5F5] cursor-pointer rounded-r-3xl">
                                    <button class="py-2.5 px-5 text-lg font-Helvetica_Bold rounded-full bg-black m-1 text-white" id=aumentar
                                        type="button">+</button>
                                </div>
                            </div>
                            <div class="xl:ml-8 flex flex-row gap-5 justify-start items-center w-full">
                                @if ($product->status == 1 && $product->visible == 1)
                                  <button id="btnAgregarCarritoPr" data-id="{{ $product->id }}"
                                      class="bg-[#FD1F4A] w-full py-3  text-white text-center rounded-full font-Helvetica_Medium tracking-wide text-lg hover:bg-[#e61e45]">
                                      Agregar
                                      al Carrito
                                  </button>
                                @endif
                            </div>
                        </div>
                    </div>
                 

                    <div class="flex flex-col gap-2" data-aos="fade-up">
                         <div class="flex flex-row gap-5 justify-start items-center w-full">
                                <a  target="_blank" id="chatonline"
                                    class="bg-[#25D366] flex justify-center items-center w-full py-3  text-white text-center rounded-full font-Helvetica_Medium tracking-wide text-lg hover:bg-[#1fcf61]">
                                    <span class="text-sm mr-3">Agente {{$general->support_one}}</span>Consulta vía WhatsApp
                                </a>
                          </div>
                          <div class="flex flex-row gap-5 justify-start items-center w-full">
                                <a  target="_blank" id="chatonline2"
                                    class="bg-[#25D366] flex justify-center items-center w-full py-3  text-white text-center rounded-full font-Helvetica_Medium tracking-wide text-lg hover:bg-[#1fcf61]">
                                    <span class="text-sm mr-3">Agente {{$general->support_two}}</span>Consulta vía WhatsApp
                                </a>
                          </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="w-full px-[5%] md:px-[8%] py-12 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
              <div class="flex flex-col gap-4 justify-center">
                   <h3 class="font-Helvetica_Medium text-3xl lg:text-4xl text-[#111111] font-normal tracking-tight">
                            Llamadas, mensajes, música y mucho más ¡Actualiza tu auto!</h3>
                   <p class="font-medium text-base font-Helvetica_Light w-full text-[#444]">
                            Apple CarPlay & Android Auto hace que resulte más fácil que nunca navegar, comunicarse y 
                            reproducir música en la carretera. Solo tienes que conectar tu iPhone para ver todo lo 
                            que quieras en la amplia pantalla táctil.
                    </p>  
                    <img src={{ asset('images/img/logosandroid.png') }} class="w-1/2 h-auto object-contain mt-2"/>      
              </div>

              <div>
                    <img src={{ asset('images/img/portadaproducto.png') }} class="w-full h-96 object-contain mt-2"/>      
              </div>
            </div>
        </section>


         <section class="w-full px-[5%] md:px-[8%] py-12 lg:py-20 bg-[#F5F5F7] space-y-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 lg:gap-10">
              <div class="order-2 lg:order-1">
                    <img src={{ asset('images/img/portadaproducto1.png') }} class="w-full h-80 lg:h-96 object-contain mt-2"/>      
              </div>

              <div class="flex flex-col gap-4 justify-center order-1 lg:order-2">
                   <h3 class="font-Helvetica_Medium text-3xl lg:text-4xl text-[#111111] font-normal tracking-tight">
                            Disfrute de sus aplicaciones favoritas</h3>
                   <p class="font-medium text-base font-Helvetica_Light w-full text-[#444]">
                            ¿Le gusta utilizar Spotify, Apple Music o cualquier otra plataforma en línea? 
                            ¿Navegas con Waze o Google maps?. Apple CarPlay & Android Auto funciona con las 
                            aplicaciones de su smartphone, para que pueda disfrutar de un entretenimiento sin 
                            límites mientras conduce.
                    </p>   
              </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 lg:gap-10">
              <div class="flex flex-col gap-4 justify-center">
                   <h3 class="font-Helvetica_Medium text-3xl lg:text-4xl text-[#111111] font-normal tracking-tight">
                            ¿Necesitas instalación?</h3>
                   <p class="font-medium text-base font-Helvetica_Light w-full text-[#444]">
                            Contamos con Talleres especializados ubicados en los puntos más céntricos de Lima y 
                            Provincias para asegurar su correcta instalación y funcionamiento.
                    </p>  
                    <div class="mt-3">
                      <a 
                        class="bg-[#FD1F4A] px-5 py-3  text-white text-center rounded-full font-Helvetica_Medium tracking-wide text-base hover:bg-[#e61e45]">
                         Ver Talleres Autorizados            
                      </a>                          
                    </div> 
              </div>

              <div>
                    <img src={{ asset('images/img/portadaproducto2.png') }} class="w-full h-80 lg:h-96 object-contain mt-2"/>      
              </div>
            </div>
        </section>




        <section class="bg-white py-10 lg:py-14">
            <div class="w-full px-[5%] md:px-[8%]">
                <div class="flex flex-col">
                    <h3 class="text-lg font-Helvetica_Light tracking-tight text-[#FD1F4A]">Apúrate que se acaban</h3>
                    <h1 class="text-3xl lg:text-4xl font-Helvetica_Medium tracking-tight">También te puede interesar</h1>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-14 w-full">
                    @foreach ($ProdComplementarios->take(4) as $item)
                        {{-- <x-product.container-combinalo width="" height="h-[400px]" bgcolor="bg-[#FFFFFF]"
              textpx="text-[20px]" :item="$item" /> --}}
                        <x-product.container width="col-span-1 " bgcolor="bg-[#FFFFFF]" :item="$item" />
                    @endforeach
                </div>
            </div>
        </section>



    </main>

@section('scripts_importados')

   <script>
        $(document).ready(function() {
            $('#chatonline').click(function() {

                function isMobile() {
                    if (sessionStorage.desktop)
                        return false;
                    else if (localStorage.mobile)
                        return true;
                    var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini',
                        'windows mobile', 'windows phone', 'iemobile'
                    ];
                    for (var i in mobile)
                        if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0)
                            return true;
                    return false;
                }

                setTimeout(function() {

                    telefono2 = '{{$general->whatsapp1}}';
                    nombre2 = $('#nombreproducto').text();
                    mensaje2 = 'send?phone=' + telefono2 +
                        '&text=Hola, quiero comunicarme con un asesor.%0AEstoy interesad@ en el producto *' +
                        nombre2 + '*.';

                    if (isMobile()) {
                        window.open('https://api.whatsapp.com/' + mensaje2, '_blank');
                    } else {
                        window.open('https://web.whatsapp.com/' + mensaje2, '_blank');
                    }
                }, 200);
            });
        });


        $(document).ready(function() {
            $('#chatonline2').click(function() {

                function isMobile() {
                    if (sessionStorage.desktop)
                        return false;
                    else if (localStorage.mobile)
                        return true;
                    var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini',
                        'windows mobile', 'windows phone', 'iemobile'
                    ];
                    for (var i in mobile)
                        if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0)
                            return true;
                    return false;
                }

                setTimeout(function() {

                    telefono3 = '{{$general->whatsapp2}}';
                    nombre3 = $('#nombreproducto').text();
                    mensaje3 = 'send?phone=' + telefono3 +
                        '&text=Hola, quiero comunicarme con un asesor.%0AEstoy interesad@ en el producto *' +
                        nombre2 + '*.';

                    if (isMobile()) {
                        window.open('https://api.whatsapp.com/' + mensaje3, '_blank');
                    } else {
                        window.open('https://web.whatsapp.com/' + mensaje3, '_blank');
                    }
                }, 200);
            });
        });
  </script>

  <script>
    var headerServices = new Swiper(".productos-relacionados", {
      slidesPerView: 4,
      spaceBetween: 10,
      loop: false,
      centeredSlides: false,
      initialSlide: 0, // Empieza en el cuarto slide (índice 3) */
      /* pagination: {
        el: ".swiper-pagination-estadisticas",
        clickable: true,
      }, */
      //allowSlideNext: false,  //Bloquea el deslizamiento hacia el siguiente slide
      //allowSlidePrev: false,  //Bloquea el deslizamiento hacia el slide anterior
      allowTouchMove: true, // Bloquea el movimiento táctil
      autoplay: {
        delay: 5500,
        disableOnInteraction: true,
        pauseOnMouseEnter: true
      },

      breakpoints: {
        0: {
          slidesPerView: 1,
          centeredSlides: true,
          loop: false,
        },
        420: {
          slidesPerView: 2,
          centeredSlides: false,

        },
        700: {
          slidesPerView: 3,
          centeredSlides: false,

        },
        850: {
          slidesPerView: 4,
          centeredSlides: false,

        },
      },
    });
  </script>
  <script>
    // $(document).ready(function() {


    function capitalizeFirstLetter(string) {
      string = string.toLowerCase()
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
    // })
    $('#disminuir').on('click', function() {
      let cantidad = Number($('#cantidadSpan span').text())
      if (cantidad > 0) {
        cantidad--
        $('#cantidadSpan span').text(cantidad)
      }


    })
    // cantidadSpan
    $('#aumentar').on('click', function() {
      let cantidad = Number($('#cantidadSpan span').text())
      cantidad++
      $('#cantidadSpan span').text(cantidad)

    })
  </script>
  <script>
    // let articulosCarrito = [];

    /* 
        function deleteOnCarBtn(id, operacion) {
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


        } */

    function calcularTotal() {
      let articulos = Local.get('carrito')
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

      $('#itemsTotal').text(`S/. ${suma.toFixed(2)} `)

    }

    /*  function addOnCarBtn(id, operacion) {

       const prodRepetido = articulosCarrito.map(item => {
         if (item.id === id) {
           item.cantidad += Number(1);
           return item; // retorna el objeto actualizado 
         } else {
           return item; // retorna los objetos que no son duplicados 
         }

       });
       Local.set('carrito', articulosCarrito)
       // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
       limpiarHTML()
       PintarCarrito()


     } */



    var appUrl = <?php echo json_encode($url_env); ?>;
    $(document).ready(function() {
      articulosCarrito = Local.get('carrito') || [];

      // PintarCarrito();
    });

    function limpiarHTML() {
      //forma lenta 
      /* contenedorCarrito.innerHTML=''; */
      $('#itemsCarrito').html('')


    }

    $('#btnAgregarCombo').on('click', async function() {
      const offerId = this.getAttribute('data-id')
      const res = await fetch(`/api/offers/${offerId}`)
      const data = await res.json()

      let nombre = `<b>${data.producto}</b><ul class="mb-1">`
      data.products.forEach(product => {
        nombre +=
          `<li class="text-xs text-nowrap overflow-hidden text-ellipsis w-[270px]">${product.producto}</li>`
      })
      nombre += '</ul>'

      let newcarrito
      articulosCarrito = Local.get('carrito') ?? []


      const index = articulosCarrito.findIndex(item => item.id == data.id && item.isCombo)

      if (index != -1) {

        articulosCarrito = articulosCarrito.map(item => {
          if (item.isCombo && item.id == data.id) {
            item.nombre = nombre
            item.cantidad++
          }
          return item
        })
      } else {

        articulosCarrito = [...articulosCarrito, {
          "id": data.id,
          "isCombo": true,
          "producto": nombre,
          "descuento": data.descuento,
          "precio": data.precio,
          "imagen": data.imagen ? `${appUrl}${data.imagen}` : `${appUrl}/images/img/noimagen.jpg`,
          "cantidad": 1,
          "color": null
        }]

      }


      Local.set('carrito', articulosCarrito)

      limpiarHTML()
      PintarCarrito()
      mostrarTotalItems()

      Swal.fire({
        icon: "success",
        title: `Combo agregado correctamente`,
        showConfirmButton: true
      });
    })



    $('#addWishlist').on('click', function() {
      $.ajax({
        url: `{{ route('wishlist.store') }}`,
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          product_id: '{{ $product->id }}'
        },
        success: function(response) {

          // Cambiar el color del botón

          if (response.message === 'Producto agregado a la lista de deseos') {
            $('#addWishlist').removeClass('bg-[#99b9eb]').addClass('bg-[#0D2E5E]');
          } else {
            $('#addWishlist').removeClass('bg-[#0D2E5E]').addClass('bg-[#99b9eb]');
          }
          Swal.fire({
            icon: 'success',
            title: response.message,
            showConfirmButton: false,
            timer: 1500
          });
        },
        error: function(error) {
          console.log(error);
        }
      });
    })
  </script>

 


@stop

@stop
