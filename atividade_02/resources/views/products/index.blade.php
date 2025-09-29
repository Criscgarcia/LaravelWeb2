<html>
<head></head>
<body>
    
    <h1 >Lista do Produto</h1>        
       
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Preço</th>
    <th>Estoque</th>
    <th>Ações</th>
  </tr>
    @foreach($products as $product)
    <tr>
        <td> {{ $product->id }}</td>
        <td> {{ $product->name }}</td>
        <td> {{ $product->value }}</td>
        <td> {{ $product->stock }}</td>
        <td>
            
        <!-- Botão de Visualizar -->
        <a href="{{ route('products.show', $product) }}" >
             Visualizar
        </a>

        <!-- Botão de Editar -->
        <a href="{{ route('products.edit', $product) }}" >
             Editar
        </a>


        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
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