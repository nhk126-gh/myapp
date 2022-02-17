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
    <h1 class="mt-5">Working process</h1>
    @foreach ($results as $items)
    <div class="row my-1">
      <div class="col my-5 d-flex justify-content-center">
        <table class="table table-bordered process-table">
          <thead class="table-dark _sticky container">
            <tr class="row">
              <th class="col-1">#</th>
              <th class="col">Parent</th>
              @for ($i = 1; $i < count($items[0]); $i++)
                <th class="col">Child{{ $i }}</th>
              @endfor
            </tr>
          </thead>
          <tbody class="container">
            @foreach ($items as $row)
              <tr class="row">
                <th class="col-1 d-flex justify-content-center align-items-center bg-dark text-light border-dark">
                  {{ $loop->index + 1 }}
                </th>
                @foreach ($row as $item)
                  @if($item == '-')
                    <td class="col d-flex"></td>
                  @elseif($item == 'L')
                    <td class="col d-flex justify-content-center align-items-center">
                      <i class="fa-solid fa-turn-up rotate"></i>
                    </td>
                  @elseif($item == 'x')
                    <td class="col d-flex"></td>
                  @else
                    @if($id == $item->id)
                    <td class="col d-flex flex-column align-items-start base">
                    @else
                    <td class="col d-flex flex-column align-items-start">
                    @endif
                      <span><span class="title">Address: </span><span>{{$item->address}}</span></span>
                      <span>
                        <span class="title">Supplier: </span>
                        @isset($item->supplier->supplier_name)
                          <span>{{$item->supplier->supplier_name}}</span>
                        @else
                          <span></span>
                        @endisset
                      </span>
                      <span><span class="title">Hinban: </span><span>{{$item->hinban}}</span></span>
                      <span><span class="title">Store: </span><span>{{$item->store}}</span></span>
                      <span><span class="title">Quantity: </span><span>{{$item->quantity}}</span></span>
                    </td>
                  @endif
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endforeach
  </div>
</x-main>