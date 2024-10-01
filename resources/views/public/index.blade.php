@extends('components.public.matrix', ['pagina' => 'index'])

@section('css_importados')

@stop

@php
  $bannersBottom = array_filter($banners, function ($banner) {
      return $banner['potition'] === 'bottom';
  });
  $bannerMid = array_filter($banners, function ($banner) {
      return $banner['potition'] === 'mid';
  });
@endphp

<style>
  @media (max-width: 600px) {
    .fixedWhastapp {
      right: 13px !important;
    }
  }
</style>



@section('content')

   <main class="z-[15] ">
  @if (count($slider) > 0) 
    <section class="">
      <x-swipper-card :items="$slider" />
    </section>
   @endif

   @if (count($logos) > 0) 
    <section class="w-full px-[5%] lg:px-[8%] py-12 lg:py-20 flex flex-col gap-10">
        <div class="text-center">
            {{-- <h3 class="font-Helvetica_Medium text-[#FD1F4A] text-base">Selecciona la marca de tu automóvil</h3> --}}
            <h2 class="font-Helvetica_Bold text-[#010101] text-4xl">Autoradios IOS</h2>
        </div>

        <div class="hidden lg:flex lg:flex-wrap justify-between gap-8 ">
            @foreach ($logos as $logo)
                <img class="w-32 object-contain mx-auto" src="{{ asset($logo->url_image) }}" />
            @endforeach
        </div>
        
        <div class="flex lg:hidden">
          <div class="flex  flex-row swiper logos w-full">
                <div class="swiper-wrapper">
                  @foreach ($logos as $logo)
                    <div class="swiper-slide">
                          <img class="w-32 object-contain mx-auto" src="{{ asset($logo->url_image) }}" /> 
                    </div>
                  @endforeach
                </div>
          </div>
        </div>

    </section>
   @endif

    {{-- seccion Gran Descuento  --}}
    @if (count($bannerMid) > 0)
      <section>
        <x-banner-section-cover :banner="$bannerMid" />
      </section>
    @endif


    {{-- seccion Productos populares  --}}
    @if ($productosPupulares->count() > 0)
      <section>
        <div class="w-full px-[5%] py-14 lg:py-20">
          <div class="flex flex-col md:flex-row justify-between w-full gap-3">
            <div class="flex flex-col">
              <h3 class="text-[#FD1F4A] font-semibold font-Helvetica_Light text-lg">Descuentos especiales</h3>
              <h1 class="text-2xl md:text-3xl font-semibold font-Helvetica_Medium text-[#111] tracking-wide">Los más vendidos</h1>
            </div>
            <div class="flex flex-col items-start md:items-center justify-center">
              <a href="/catalogo" class="bg-[#FD1F4A] text-base font-normal text-white text-center font-Helvetica_Medium px-6 py-3 rounded-3xl flex items-center justify-center w-auto">
                Ver productos</a>
            </div>
          </div>
          @foreach ($productosPupulares->chunk(8) as $taken)
          
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 md:flex-row gap-4 mt-14 w-full">
             
              @foreach ($taken as $item)
                <x-product.container width="w-1/4" bgcolor="bg-[#FFFFFF]" :item="$item" />
                {{-- <x-productos-card width="w-1/4" bgcolor="bg-[#FFFFFF]" :item="$item" /> --}}
              @endforeach
            </div>
          @endforeach
        </div>
      </section>
    @endif
    

    @php
          $categories = $categoriasindex;
          $chunks = $categories->chunk(3);
          $processedCategories = collect();
    @endphp

    @foreach ($chunks as $chunk)
            @if ($chunk->count() == 3)
                <div class="grid grid-cols-1 md:grid-cols-4 px-[5%] gap-8 lg:gap-12 pt-10">
                    @foreach ($chunk as $category)
                      @if ($loop->first) 
                          <div class="w-full md:row-span-2 md:col-span-2">
                            <a href="{{ route('Catalogo.jsx', $category->id) }}">
                              <div class="h-full w-full relative flex flex-col group">
                                  <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                                      class="h-96 md:h-full w-full flex flex-col justify-end items-start object-cover"
                                      onerror="this.src='/images/img/noimagen.jpg';">
                                  <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                                   <div class="absolute bottom-0 flex flex-col gap-5 w-full p-5 lg:p-10 opacity-0  group-hover:opacity-100 transition-opacity duration-300">
                                  <h2 class="text-2xl text-white font-Helvetica_Bold">{{ $category->name }}</h2>
                                  <p class="text-lg text-white font-Helvetica_Light">Donec vehicula, lectus vel pharetra semper, justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                                </div>
                              </div>
                            </a>
                          </div>
                      @else
                          <div class="w-full md:col-span-2">
                            <a href="{{ route('Catalogo.jsx', $category->id) }}">
                              <div class="h-full w-full relative flex flex-col group">
                                <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                                    class="h-60 md:h-64 lg:h-60 xl:h-80 w-full flex flex-col justify-end items-start object-cover"
                                    onerror="this.src='/images/img/noimagen.jpg';">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 flex flex-col gap-5 w-full p-5 lg:p-10 opacity-0  group-hover:opacity-100 transition-opacity duration-300">
                                  <h2 class="text-2xl text-white font-Helvetica_Bold">{{ $category->name }}</h2>
                                  <p class="text-lg text-white font-Helvetica_Light">Donec vehicula, lectus vel pharetra semper, justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                                </div>
                              </div>
                            </a>
                          </div>
                       @endif
                    @endforeach
                </div>
            @endif
          
            @php
                  $processedCategories = $processedCategories->merge($chunk); // Guardamos las categorías procesadas.
            @endphp
    @endforeach 

    @php
        $remainder = $categories->count() % 3;
        $remainderCategories = $categories->diff($processedCategories);
    @endphp
      
    @php
        $remainderCategories = $categories->slice(-$remainder);
    @endphp

    @if ($remainder > 0)
          @if ($remainder == 1)
                <div class="grid grid-cols-1 md:grid-cols-4 px-[5%] gap-8 lg:gap-12 pt-10">
                  @foreach ($remainderCategories as $category)
                    <div class="col-span-4">
                              <a href="{{ route('Catalogo.jsx', $category->id) }}">
                                <div class="h-full w-full relative flex flex-col group">
                                  <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                                      class="h-60 md:h-64 lg:h-60 xl:h-96 w-full flex flex-col justify-end items-start object-cover"
                                      onerror="this.src='/images/img/noimagen.jpg';">
                                  <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                                  <div class="absolute bottom-0 flex flex-col gap-5 w-full p-5 lg:p-10 opacity-0  group-hover:opacity-100 transition-opacity duration-300">
                                    <h2 class="text-2xl text-white font-Helvetica_Bold">{{ $category->name }}</h2>
                                    <p class="text-lg text-white font-Helvetica_Light">Donec vehicula, lectus vel pharetra semper, justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                                  </div>
                                </div>
                              </a>
                      </div>
                    </div>
                  @endforeach
                </div>
 
          @elseif ($remainder == 2)
                <div class="grid grid-cols-1 md:grid-cols-4 px-[5%] gap-8 lg:gap-12 pt-10">
                    @foreach ($remainderCategories as $category)
                        <div class="w-full md:col-span-2">
                                  <a href="{{ route('Catalogo.jsx', $category->id) }}">
                                    <div class="h-full w-full relative flex flex-col group">
                                      <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                                          class="h-60 md:h-64 lg:h-60 xl:h-80 w-full flex flex-col justify-end items-start object-cover"
                                          onerror="this.src='/images/img/noimagen.jpg';">
                                      <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                                      <div class="absolute bottom-0 flex flex-col gap-5 w-full p-5 lg:p-10 opacity-0  group-hover:opacity-100 transition-opacity duration-300">
                                        <h2 class="text-2xl text-white font-Helvetica_Bold">{{ $category->name }}</h2>
                                        <p class="text-lg text-white font-Helvetica_Light">Donec vehicula, lectus vel pharetra semper, justo massa pharetra nunc, non venenatis ante augue quis est.</p>
                                      </div>
                                    </div>
                                  </a>
                        </div>
                    @endforeach
                </div>
          @endif
    @endif


    {{-- seccion Ultimos Productos  --}}
    @if ($ultimosProductos->count() > 0)
    <section>
      <div class="w-full px-[5%] py-14 lg:py-20">
        <div class="flex flex-col md:flex-row justify-between w-full gap-3">
          <div class="flex flex-col">
            <h3 class="text-[#FD1F4A] font-semibold font-Helvetica_Light text-lg">Apúrate que se acaban</h3>
            <h1 class="text-2xl md:text-3xl font-semibold font-Helvetica_Medium text-[#111] tracking-wide">Equipos nuevos</h1>
          </div>
          <div class="flex flex-col items-start md:items-center justify-center">
            <a href="/catalogo" class="bg-[#FD1F4A] text-base font-normal text-white text-center font-Helvetica_Medium px-6 py-3 rounded-3xl flex items-center justify-center w-auto">
              Ver productos</a>
          </div>
        </div>
        @foreach ($ultimosProductos->chunk(4) as $taken)
          <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 md:flex-row gap-6 mt-14 w-full">
            @foreach ($taken as $item)
              <x-product.container width="w-full" bgcolor="bg-[#FFFFFF]" :item="$item" />
              {{-- <x-productos-card width="w-1/4" bgcolor="bg-[#FFFFFF]" :item="$item" /> --}}
            @endforeach
          </div>
        @endforeach
      </div>
    </section>
    @endif


    
    
  

    {{-- Seccion Blog --}}
    {{-- @if ($blogs->count() > 0)
      <section class="w-full px-[5%] py-7 lg:py-14" data-aos="fade-up">
        <div class="flex flex-col md:flex-row justify-between w-full gap-3">
          <h1 class="text-2xl md:text-3xl font-semibold font-Inter_Medium text-[#323232]">Blog & Eventos</h1>
          <a href="/blog/0" class="flex items-center text-base font-Inter_Medium font-semibold text-[#006BF6]">Ver todos
            las Publicaciones <img src="{{ asset('images/img/arrowBlue.png') }}" alt="Icono" class="ml-2 "></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 mt-14 gap-10 sm:gap-5">
          @foreach ($blogs as $post)
            <x-blog.container-post :post="$post" />
          @endforeach
        </div>

      </section>
    @endif --}}


    {{-- gran descuento --}}
    {{-- @if (count($bannersBottom) > 0)
      <section class="w-full px-[5%] mt-7 lg:mt-10 " data-aos="zoom-out-right">
        <div class="bg-gradient-to-b from-gray-50 to-white flex flex-col md:flex-row justify-between bg-[#EEEEEE]">
          <x-banner-section :banner="$bannersBottom" />
        </div>
      </section>
    @endif --}}


    {{-- @if ($benefit->count() > 0)
      <section class="py-10 lg:py-13 bg-[#F8F8F8] w-full px[5%]" data-aos="zoom-out-right">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
          @foreach ($benefit as $item)
            <div class="flex flex-col items-center w-full gap-1 justify-center text-center px-[10%] xl:px-[18%]">
              <img src="{{ asset($item->icono) }}" alt="">
              <h4 class="text-xl font-bold font-Inter_Medium"> {{ $item->titulo }} </h4>
              <div class="text-lg leading-8 text-[#444444] font-Inter_Medium">{!! $item->descripcionshort !!}</div>
            </div>
          @endforeach
        </div>
      </section>
    @endif --}}



  </main>



  <!-- Main modal -->
  <div id="modalofertas" class="modal modalbanner">
    <!-- Modal body -->
    <div class="p-1 ">
      <x-swipper-card-ofertas :items="$popups" id="modalOfertas" />
    </div>
  </div>


@section('scripts_importados')

  <script>
    let pops = @json($popups);

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
    $(document).ready(function() {
      console.log(pops.length)
      if (pops.length > 0) {
        $('#modalofertas').modal({
          show: true,
          fadeDuration: 100
        })

      }


      $(document).ready(function() {
        articulosCarrito = Local.get('carrito') || [];

        // PintarCarrito();
      });

    })


     var swiper = new Swiper(".logos", {
            slidesPerView:3,
            spaceBetween: 20,
            loop: true,
            grabCursor: true,
            centeredSlides: false,
            initialSlide: 0,
            pagination: {
                el: ".swiper-pagination-logos",
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                550: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                680: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                750: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                }
            },
        });
  </script>


@stop

@stop
