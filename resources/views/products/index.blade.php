@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1>Productos</h1>
                <a href="{{ route('products.create') }}" class="btn-link">Agregar Producto</a>
            </div>
            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                                <p class="table-filter-link link-active">Todos</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="{{ route('products.index') }}" accept-charset="UTF-8" role="search">
                    <div class="table-search">
                        <div>
                            <button class="search-select">
                                Buscar Producto
                            </button>
                            <span class="search-select-arrow">
                                <i class="fas fa-caret-down"></i>
                            </span>
                        </div>
                        <div class="relative">
                            <input class="search-input" type="text" name="search" placeholder="Buscar producto"
                                name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                </form>
                <div class="table-product-head">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Categoría</p>
                    <p>Stock</p>
                    <p>Acciones</p>
                </div>
                <div class="table-product-body">

                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <img src="{{ asset('images/' . $product->image) }}" />
                            <p>{{ $product->name }}</p>
                            <p>{{ $product->category }}</p>
                            <p>{{ $product->quantity }}</p>
                            <div style="display: flex">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-link btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <p>No hay productos registrados.</p>
                    @endif
                </div>
                <div class="table-paginate">
                    {{ $products->links('layouts.panigation') }}
                </div>
            </div>
        </section>
    </main>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;

            Swal.fire({
                title: '¿Estás seguro de eliminar?',
                text: "Si lo eliminas, yo no se podrá recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, quiero eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>

    @if ($message = Session::get('success'))
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        </script>
    @endif


@endsection
