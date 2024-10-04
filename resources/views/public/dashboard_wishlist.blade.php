@extends('components.public.matrix', ['pagina' => ''])

@section('css_importados')

@stop


@section('content')

  <main>
    {{-- <section class="font-poppins my-12">
            <div class="flex flex-col w-11/12 mx-auto">
                <div class="flex flex-col gap-10 my-5">
                    <div class="flex gap-1">
                        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">Home</a>
                        <span>/</span>
                        <a href="#" class="font-semibold text-[14px] text-[#141718]">Mi cuenta</a>
                    </div>
                </div>
            </div>
        </section> --}}

    <section class="font-poppins my-8 md:my-16">
      <div class="flex flex-col gap-12 md:flex-row md:gap-16 lg:gap-28 w-full md:w-11/12 mx-auto">
        <x-side-section-dashboard :user="$user" />
        <div class="basis-7/12 font-poppins w-11/12 md:w-full mx-auto">
          <h2 class="text-[#151515] font-semibold text-[20px] py-5">
            Lista de deseos
          </h2>
          <!-- para destop tabla -->
          {{-- <div class="hidden md:block">
            <table class="table-auto w-full">
              <thead>
                <tr class="text-left text-[#6C7275] font-normal text-[14px] border-b-[1px] border-[#E8ECEF]">
                  <th></th>
                  <th class="py-4">Producto</th>
                  <th class="py-4">Fecha Agregado </th>

                  <th class="py-4">Precio</th>
                </tr>
              </thead>
              <tbody class="text-[#141718] font-normal text-[14px]">
                @foreach ($wishlistItems as $item)
                  <tr>
                    <td>
                      <img src="{{ asset($item->products->imagen) }}" alt="" class="w-40">
                    </td> <!-- Assuming your Product model has a 'code' attribute -->
                    <td>{{ $item->products->producto }}</td> <!-- Assuming your Product model has a 'code' attribute -->
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>

                    <td>
                      @if ($item->products->descuento > 0)
                        <span class="text-[#fd1f4a] text-base font-bold">S/. {{ $item->products->descuento }}</span>
                        <span class="line-through">{{ $item->products->precio }}</span>
                      @else
                        <span class="text-[#fd1f4a] text-base font-bold">S/. {{ $item->products->precio }}</span>
                      @endif
                    </td> <!-- Assuming your Product model has a 'price' attribute -->
                  </tr>
                @endforeach


              </tbody>
            </table>
          </div> --}}
          <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-3 md:flex-row gap-4 mt-14 w-full items-start">
            @foreach ($productos as $item)
              <x-product.container width="col-span-1" bgcolor="" :item="$item" />
              {{-- <x-productos-card width="w-1/5" bgcolor="" :item="$item" /> --}}
            @endforeach
          </div>


          <!-- para mobiles acordion -->
          <div class="relative ring-gray-900/5 sm:mx-auto sm:rounded-lg block md:hidden">
            <div class="mx-auto">
              <div class="mx-auto grid max-w-[900px] gap-5">
                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>

                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>

                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@section('scripts_importados')
  <script>
    $("#upload_image").change(function() {

      const file = this.files[0];

      if (file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', $('#avatarform input[name="_token"]').val());
        formData.append('id', $('#avatarform input[name="name"]').val());
        $.ajax({

          url: "{{ route('cambiofoto') }}",
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,

          success: function(success) {
            window.location.href = window.location.href;

          },
          error: function(error) {
            console.log(error)
          }

        })
      }

    });
  </script>
@stop

@stop
