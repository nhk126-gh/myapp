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
        @isset($items)
          @php
            $counts = array_map(function ($item) {
                        return count($item);
                      }, $items);
          @endphp
          <table>
            <tr>
              <th>Parent</th>
              @for ($i = 1; $i < max($counts); $i++)
                <th>child{{ $i }}</th>
              @endfor
            </tr>
            @foreach ($items as $row)
              <tr>
                @foreach ($row as $item)
                  @if($item == '-')
                    <td></td>
                  @elseif($item == 'L')
                    <td>L</td>
                  @else
                    <td>{{$item->code}}</td>
                  @endif
                @endforeach
              </tr>
            @endforeach
          </table>
        @else
          <h1>Not Found</h1>
        @endisset
  </div>
</x-main>