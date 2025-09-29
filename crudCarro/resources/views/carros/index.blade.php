<html>
<head></head>
<body>
    
    <h1 >Lista do Carro</h1>        
       
<table>
  <tr>
    <th>ID</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Preço</th>
    <th>Ano</th>
    <th>Ações</th>
  </tr>
    @foreach($carros as $carro)
    <tr>
        <td> {{ $carro->id }}</td>
        <td> {{ $carro->brand }}</td>
        <td> {{ $carro->model }}</td>
        <td> {{ $carro->price }}</td>
        <td> {{ $carro->year }}</td>
        <td>
            
        <!-- Botão de Visualizar -->
        <a href="{{ route('carros.show', $carro) }}" >
             Visualizar
        </a>

        <!-- Botão de Editar -->
        <a href="{{ route('carros.edit', $carro) }}" >
             Editar
        </a>


        <form action="{{ route('carros.destroy', $carro) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Deseja excluir este autor?')">
            Excluir
            </button>
        </form>

        </td>
    </tr>
    @endforeach
  
  
  
  
</table>   
</div>
</body>
</html>