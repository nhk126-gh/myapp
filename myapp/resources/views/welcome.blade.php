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

  <div class="container wellcome">Wellcome</div>
  
</x-main>
