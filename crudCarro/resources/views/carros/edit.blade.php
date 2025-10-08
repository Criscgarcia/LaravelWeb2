<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
</head>
<body>
    Editar carro

    <form action="{{ route('carros.update', $carro) }}" method="POST">
        @csrf
        @method('PUT')
        
            
        <div >
            <label for="brand" >Nome do carro</label>
            <input type="text" id="brand" name="brand" value="{{ $carro->brand }}" required>            
        </div>
        <div >
            <label for="model" >Modelo do carro: </label>
            <input type="text" id="model" name="model" value="{{ $carro->model }}" required>            
        </div>

        <div >
            <label for="price" >Preço do carro: </label>
            <input type="number" id="price" name="price" value="{{ $carro->price }}" required>            
        </div>

        <div >
            <label for="available" >Disponível: </label>
            <input type="checkbox" id="available" name="available" value="1" {{ $carro->available ? 'checked' : '' }}>           
        </div>

        <div >
            <label for="year" >Ano: </label>
            <input type="number" id="year" name="year" value="{{ $carro->year }}" required>            
        </div>

        <button type="submit"> Atualizar </button>
        
    </form>
</div>
 
</body>
</html>
