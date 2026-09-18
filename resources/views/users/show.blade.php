<x-layout title="{{ $user->name }}">
        <div class="card bg-base-100 w-96 shadow-sm">
        <img src="{{ $user->imagePath }}" alt="{{$user->imageAlt}}" >  
        <div class="card-body">
            <h2 class="{{ $user->name }}">
            {{ $user->name }}
            
            </h2>
            <p>{{ $user->email }}</p>
        </div>
        </div>
</x-layout>