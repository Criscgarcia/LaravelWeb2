<html>
<head></head>
<body>
    
    <h1 >Detalhes do Produto</h1>        
        <div >
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Nome:</strong> {{ $product->name }}</p>
            <p><strong>Descrição:</strong> {{ $product->description }}</p>
            <p><strong>Valor:</strong> {{ $product->value }}</p>
            <p><strong>Validade:</strong> {{ $product->expiration_date }}</p>
            <p><strong>Estoque:</strong> {{ $product->stock }}</p>
        </div>
    </div>    
</div>
</body>
</html>
