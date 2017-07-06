@extends('Painel.templates.template')
@section('content')
  <h1 class="title-pg">Gestão de Produtos</h1>
  @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif
  @if (isset($product))
      <form class="form" action="{{route('produtos.update', $product->id)}}" method="post">
        {!! method_field('PUT') !!}
    @else
      <form class="form" action="{{route('produtos.store')}}" method="post">
  @endif

    {!! csrf_field() !!}
    <div class="form-group">
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'nome'])!!}
    </div>
    <div class="form-group">
        <input class="form-control" type="number" name="number" placeholder="Número" value="{{$product->number or old('number')}}" required>
    </div>
    <div class="form-group">
      <select class="form-control" name="category" required>
        <option value="">Categoria</option>
        @foreach ($categories as $category)
          <option value="{{$category}}"
          {{(isset($product) ? ($product->category == $category ? "selected":""):(old('category') == $category ? "selected":""))}} >
            {{$category}}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>
        <input  type="checkbox" name="active" value="1"{{(isset($product) && $product->active == '1' ? "checked":"")}}>
        Produto Ativo
      </label>
    </div>
    <div class="form-group">
      <textarea class="form-control" name="description" placeholder="Descrição" maxlength="1000">{{$product->description or old('description')}}</textarea>
    </div>
    <button class="btn btn-success" type="submit">Cadstrar</button>
  </form>
@endsection
