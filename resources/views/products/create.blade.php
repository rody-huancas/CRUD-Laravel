@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                    <h1>Registrar Producto</h1>
                </div>

                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="name">
                        <label>Descripción (opcional)</label>
                        <textarea cols="10" rows="5" name="description"></textarea>
                        <label>Agregar Imagen</label>
                        <img src="" alt="" class="img-product" id="file-preview" />
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                    </div>
                    <div>
                        <label>Categoría</label>
                        <select name="category" id="">
                            @foreach (json_decode('{"Samsung":"Samsung","Huawei":"Huawei","Apple":"Apple"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Stock</label>
                        <input type="text" name="quantity">
                        <hr>
                        <label>Precio</label>
                        <input type="text" name="price">
                    </div>
                </div>
                <div class="titlebar">
                    <h1></h1>
                    <button>Registrar</button>
                </div>
            </form>
        </section>
    </main>

    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataUrl = reader.result;
                var output = document.getElementById("file-preview");
                output.src = dataUrl;
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
