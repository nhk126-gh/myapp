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
    @empty($items)
      <h1>Not Found</h1>
    @else
      <h1 class="mt-5">Working process</h1>
      <div class="row">
        <div class="col my-5 d-flex justify-content-center">
          <table class="table table-bordered">
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
                  <td class="col-1 d-flex justify-content-center align-items-center">
                    {{ $loop->index + 1 }}
                  </td>
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
                      <td class="col d-flex flex-column align-items-start">
                        <span>{{$item->address}}</span>
                        <span>{{$item->supplier_code}}</span>
                        <span>{{$item->hinban}}</span>
                        <span>{{$item->store}}</span>
                      </td>
                    @endif
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endempty
  </div>
</x-main>