<html>
<head></head>
<body>
    Editar Produto

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        
            
        <div >
            <label for="name" >Nome do produto</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>            
        </div>
        <div >
            <label for="description" >Descrição do produto: </label>
            <input type="text" id="description" name="description" value="{{ $product->description }}" required>            
        </div>

        <div >
            <label for="value" >Valor do produto: </label>
            <input type="number" id="value" name="value" value="{{ $product->value }}" required>            
        </div>

        <div >
            <label for="expiration_date" >Validade: </label>
            <input type="date" id="expiration_date" name="expiration_date" value="{{ $product->expiration_date }}" required>            
        </div>

        <div >
            <label for="stock" >Estoque: </label>
            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" required>            
        </div>

        <button type="submit"> Atualizar </button>
        
    </form>
</div>
 
</body>
</html>
