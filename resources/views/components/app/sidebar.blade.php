<div>
  <!-- Sidebar backdrop (mobile only) -->
  <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
    :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

  <!-- Sidebar -->
  <div id="sidebar"
    class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

    <!-- Sidebar header -->
    <div class="flex justify-between mb-10 pr-3 sm:px-2">
      <!-- Close button -->
      <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
        aria-controls="sidebar" :aria-expanded="sidebarOpen">
        <span class="sr-only">Close sidebar</span>
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
        </svg>
      </button>
      <!-- Logo -->
      <a class="block" href="{{ route('dashboard') }}">
        <svg width="32" height="32" viewBox="0 0 32 32">
          <defs>
            <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
              <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%" />
              <stop stop-color="#A5B4FC" offset="100%" />
            </linearGradient>
            <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
              <stop stop-color="#38BDF8" stop-opacity="0" offset="0%" />
              <stop stop-color="#38BDF8" offset="100%" />
            </linearGradient>
          </defs>
          <rect fill="#6366F1" width="32" height="32" rx="16" />
          <path
            d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z"
            fill="#4F46E5" />
          <path
            d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z"
            fill="url(#logo-a)" />
          <path
            d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z"
            fill="url(#logo-b)" />
        </svg>
      </a>
    </div>

    <!-- Links -->
    <div class="space-y-8">
      <!-- Pages group -->
      <x-menu.group title="Sistema">
        <x-menu.item id="dashboard" href="{{ route('dashboard') }}" icon="fas fa-home">Dashboard</x-menu.item>
        <x-menu.item id="pedidos" href="{{ route('pedidos.index') }}" icon="fa fa-solid fa-cart-shopping">
          Pedidos
          @if ($salesCount !== 0)
            <x-slot name="tag">
              {{ $salesCount }}
            </x-slot>
          @endif
        </x-menu.item>
        <x-menu.item id="mensajes" href="{{ route('mensajes.index') }}" icon="fas fa-comments">
          Mensajes
          @if ($mensajes !== 0)
            <x-slot name="tag">
              {{ $mensajes }}
            </x-slot>
          @endif
        </x-menu.item>
        <x-menu.item id="reclamo" href="{{ route('reclamo.index') }}" icon="fas fa-comment-dots">
          Reclamaciones
          @if ($reclamo !== 0)
            <x-slot name="tag">
              {{ $reclamo }}
            </x-slot>
          @endif
        </x-menu.item>
        <x-menu.item id="testimonios" href="{{ route('testimonios.index') }}" icon="fas fa-star">
          Testimonios
        </x-menu.item>
      </x-menu.group>

      <x-menu.group title="Productos">
        <x-menu.item id="categorias" href="{{ route('categorias.index') }}"
          icon="fas fa-folder">Categorias</x-menu.item>
        <x-menu.item id="subcategories" href="{{ route('subcategories.index') }}"
          icon="fas fa-folder-open">Subcategorias</x-menu.item>
        {{-- <x-menu.item id="tags" href="{{ route('tags.index') }}" icon="fas fa-tag">Etiquetas</x-menu.item> --}}
        <x-menu.item id="products" href="{{ route('products.index') }}" icon="fas fa-box">Productos</x-menu.item>
        {{-- <x-menu.item id="offers" href="{{ route('Admin/Offers.jsx') }}" icon="fas fa-boxes">Combos</x-menu.item> --}}
      </x-menu.group>

      <x-menu.group title="Datos de la empresa">
        <x-menu.item id="datosgenerales" href="{{ route('datosgenerales.edit', 1) }}" icon="fas fa-address-card">
          Datos Generales
        </x-menu.item>
        {{-- <x-menu.item id="sobrenosotros" href="{{ route('aboutus.index') }}" icon="fas fa-address-card">
          Sobre Nosotros
        </x-menu.item> --}}
        <x-menu.item id="faqs" href="{{ route('faqs.index') }}" icon="fas fa-address-card">
          Preguntas Frecuentes
        </x-menu.item>
        <x-menu.item id="politicas-de-devolucion" href="{{ route('politicas-de-devolucion.edit', 1) }}"
          icon="fas fa-undo-alt">
          Politicas de Devolucion
        </x-menu.item>
        <x-menu.item id="terminos-y-condiciones" href="{{ route('terminos-y-condiciones.edit', 1) }}"
          icon="fas fa-file-contract">
          Terminos y Condiciones
        </x-menu.item>
        <x-menu.item id="politica-datos" href="{{ route('politicadatos.detalle', 1) }}" icon="fas fa-file-contract">
          Terminos Datos
        </x-menu.item>
        {{-- <x-menu.item id="servicios" href="{{ route('servicios.index') }}"
          icon="fas fa-wrench">Servicios</x-menu.item> --}}
        {{-- <x-menu.item id="blog" href="{{ route('blog.index') }}" icon="fas fa-pencil-alt">Blog</x-menu.item> --}}
        <x-menu.item id="logos" href="{{ route('logos.index') }}" icon="fas fa-shapes">Marcas - Portada</x-menu.item>
        {{-- <x-menu.item id="staff" href="{{ route('staff.index') }}" icon="fas fa-users">Personal</x-menu.item> --}}
        {{-- <x-menu.item id="strength" href="{{ route('strength.index') }}">Beneficios</x-menu.item> --}}
        {{-- <x-menu.item id="aboutus" href="{{ route('aboutus.index') }}">Nosotros</x-menu.item> --}}
        <x-menu.item id="attributes" href="{{ route('attributes.index') }}">Atributos</x-menu.item>
        <x-menu.item id="valoresattributes" href="{{ route('valoresattributes.index') }}">
          Valor de atributo
        </x-menu.item>
        <x-menu.item id="prices" href="{{ route('prices.index') }}" icon="fas fa-truck">
          Costos de Envio
        </x-menu.item>
        <x-menu.item id="estados" href="{{ route('estados.index') }}" icon="fas fa-toggle-on">
          Estados de pedidos
        </x-menu.item>
        {{-- <x-menu.item id="faqs" href="{{ route('faqs.index') }}"
          icon="fas fa-question-circle">FAQs</x-menu.item> --}}
        <x-menu.item id="slider" href="{{ route('slider.index') }}" icon="fas fa-sliders-h">Sliders</x-menu.item>
        {{-- <x-menu.item id="popup" href="{{ route('popup.index') }}" icon="fas fa-sliders-h">Popup</x-menu.item> --}}
        <x-menu.item id="banners" href="{{ route('banners.index') }}"
          icon="fa fa-solid fa-image">Banners</x-menu.item>

        {{--   <x-menu.item id="galerie" href="{{ route('galerie.index') }}" icon="fas fa-images">Galerias</x-menu.item> --}}
        {{-- <x-menu.item id="subscripciones" href="{{ route('subscripciones') }}"
          icon="fas fa-images">Subscripciones</x-menu.item> --}}
      </x-menu.group>
    </div>
    <!-- Expand / collapse button -->
    <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
      <div class="px-3 py-2">
        <button @click="sidebarExpanded = !sidebarExpanded" title="Mostrar/Ocultar menu" tippy>
          <span class="sr-only">Mostrar/Ocultar menu</span>
          <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
            <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
            <path class="text-slate-600" d="M3 23H1V1h2z" />
          </svg>
        </button>
      </div>
    </div>

  </div>
</div>
<script>
  tippy('#sidebar [tippy]', {
    arrow: true,
    followCursor: true,
    placement: 'right'
  })
</script>
