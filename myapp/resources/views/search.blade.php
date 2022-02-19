<x-main>
  <x-slot name="title">
    {{config('app.name')}}
  </x-slot>

  <x-slot name="header">
    <x-header />
  </x-slot>

  <x-slot name="footer">
    <x-footer />
  </x-slot>

  <div class="container">
    @if ($items->isEmpty())
      <h1>Not Found</h1>
    @else
      <h1 class="mt-5">Product List</h1>
      <div class="row">
        <div class="col my-5 d-flex justify-content-center">
          <div class="table-wrap">
            <table class="table table-bordered">
              <thead class="table-dark _sticky">
                <th>Address</th>
                <th>Supplier</th>
                <th>Hinban</th>
                <th>Seban</th>
                <th>Store</th>
                <th>Quantity</th>
                <th>Box</th>
              </thead>
              <tbody>
                @foreach ($items as $item)
                  <tr>
                    <td>
                      <form method="post" name="form_address" id="form_address_{{ $item->id }}" action="/process">
                        @csrf
                        <input type="hidden" name="input" value="{{ $item->address }}">
                        <a href="javascript:form_address_{{ $item->id }}.submit();">{{ $item->address }}</a>
                      </form>
                    </td>
                    @isset($item->supplier->supplier_name)
                      <td>{{$item->supplier->supplier_name}}</td>
                    @else
                      <td></td>
                    @endisset
                    <td>
                      <form method="post" name="form_hinban" id="form_hinban_{{ $item->id }}" action="/search">
                        @csrf
                        <input type="hidden" name="input" value="{{ $item->hinban }}">
                        <a href="javascript:form_hinban_{{ $item->id }}.submit();">{{ $item->hinban }}</a>
                      </form>
                    </td>
                    <td>{{$item->seban}}</td>
                    <td>{{$item->store}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->box_type}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>    
      </div>
    @endif
  </div>
</x-main>