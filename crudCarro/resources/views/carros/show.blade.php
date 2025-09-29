<html>
<head></head>
<body>
    
    <h1 >Detalhes do Carro</h1>        
        <div >
            <p><strong>ID:</strong> {{ $carro->id }}</p>
            <p><strong>Marca:</strong> {{ $carro->brand }}</p>
            <p><strong>Modelo:</strong> {{ $carro->model }}</p>
            <p><strong>Preço:</strong> {{ $carro->price }}</p>
            <p><strong>Disponível:</strong> {{ $carro->available ? 'Sim' : 'Não'}}</p>
            <p><strong>Ano:</strong> {{ $carro->year }}</p>
        </div>
    </div>    
</div>
</body>
</html>