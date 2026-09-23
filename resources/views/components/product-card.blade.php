@props(['nombre', 'descripcion', 'precio', 'imagen' => null])

<article class="product-card">
    {{-- imagen --}}
    <figure class="product-card__image">
        @if ($imagen)
            <img scr="{{ $imagen }}" alt="{{ $nombre }}">
        @else 
            <snap> Imagen del producto  </snap>
        @endif 
            <snap class="product-card__badge"> Nuevo </snap>
    </figure>

    <section class="product-card__body">
        <h3 class="product-card__title">{{ $nombre }}</h3>
        <p class="product-card__descripcion"> {{ $descripcion }}</p>

        <footer class="product-card__footer">
            <span class="product-card__price"> ${{ number_format($precio, 2) }}</sapn>
            <buttom class="product-card__button" aria-label="Agregar al carrito">
                <svg xmlns="https://www.w3.org/2000/svg" widht="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-whith="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </buttom>
        </footer>
    </section>
</article>
