<x-main>
  <x-slot name="title">
    Myapp
  </x-slot>

  <x-slot name="header">
    <x-header />
  </x-slot>

  <x-slot name="footer">
    <x-footer />
  </x-slot>

  <div class="container">
    <h1 class="mt-5">Product</h1>
        @isset($items)
            <table>
                <tr><th>Code</th><th>Name</th></tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                @endforeach
            </table>
        @else
          <h1>Not Found</h1>
        @endisset
  </div>
</x-main>