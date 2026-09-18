<x-layout title="User Foto anlegen">
       
    <h1>Bildupload</h1>
     <div class="mb-10">     <!--action womit wollen wir speichern   wichtig weil bildupload muss enctype drin stehen  -->
    <form method="POST" action="{{ route('users.store', $user) }}" enctype="multipart/form-data">
        @csrf <!-- token für formular-->
        
        <input type="hidden" name="user" value="{{ $user->id }}">
     
        <label for="imageAlt" class="floating-label">Alternativ Text</label>
        <input type="text" name="imageAlt" id="imageAlt" class="input input-neutral"
        value="{{ old('imageAlt') }}">
        @error('imageAlt')<p class="text-sm text-error">{{ $message }} </p>@enderror
        <br>

        <label for="image" class="floating-label">Bildauswahl</label>
        <input type="file" name="image" id="image">
        @error('image')<p class="text-sm text-error">{{ $message }} </p>@enderror
        <br>
         
        <br>
        <button class="btn">Senden</button>

    </div> 

    </form>
</x-layout>
