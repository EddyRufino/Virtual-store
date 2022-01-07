@extends('layouts.app')

@section('title', 'Listado de pedidos')

@section('body-class', 'product-page')

@section('content')

<div class="header header-filter" style="background-image: url('{{ asset('img/city.jpg') }}');">
</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center">
          <h2 class="title">Listado de pedidos</h2>

          <div class="team">
              <div class="row">
                  {{-- <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round">Nuevo producto</a> --}}

                  <table class="table">
                      <thead>
                          <tr>
                              {{-- <th class="text-center">#</th> --}}
                              <th class="text-center">Cliente</th>
                              {{-- <th class="text-center">Dirección</th> --}}
                              <th class="text-center">Teléfono</th>
                              <th class="text-center">Producto</th>
                              {{-- <th class="text-right">Precio</th> --}}
                              <th class="text-right">Cantidad</th>
                              <th class="text-right">Cobrar</th>
                              <th class="text-right">Opciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($pedidos as $pedido)
                          <tr>
                              {{-- <td class="text-center">{{ $pedido->id }}</td> --}}
                              <td>{{ $pedido->user_name }}</td>
                              {{-- <td>{{ $pedido->address }}</td> --}}
                              <td>{{ $pedido->phone }}</td>
                              <td>{{ $pedido->name }}</td>
                              {{-- <td class="text-right">s/. {{ $pedido->price }}</td> --}}
                              <td class="text-right">{{ $pedido->quantity }}</td>
                              <td class="text-right">s/. {{ $pedido->price * $pedido->quantity }}</td>
                              <td class="td-actions text-right">
                                  <form method="post" action="{{ route('pedidos.update', $pedido->detail_id) }}">
                                      {{ csrf_field() }}
                                      {{ method_field('PUT') }}
                                      
                                      {{-- <a href="{{ url('/products/'.$product->id) }}" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs" target="_blank">
                                          <i class="fa fa-info"></i>
                                      </a>
                                      <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" rel="tooltip" title="Editar producto" class="btn btn-success btn-simple btn-xs">
                                          <i class="fa fa-edit"></i>
                                      </a> --}}
                                      {{-- <button type="submit" rel="tooltip" title="Atendido" class="btn btn-danger btn-simple btn-xs">
                                          <i class="fa fa-times"></i>
                                      </button> --}}
                                      <button onclick="return confirm('¿Seguro que ya atendió este pedido?')" type="submit" rel="tooltip" title="Atendido" class="btn btn-danger btn-simple btn-xs">
                                        <i name="state" class="material-icons">done</i>
                                    </button>
                                  </form>                                    
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>

                  {{ $pedidos->links() }}
              </div>
          </div>
      </div>
  </div>

</div>

@include('includes.footer')
@endsection
