<x-layout title="Userseite">
    <p>Tabelle User </p>
    <table>
        <tr>
        <th>Name</th>
        <th>E mail</th>
        <th>Bild</th>
        </tr>
        @foreach ($users as $user )
            
       
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            
                @if ($user->imagePath)
                    <td>
                    <img src="{{ $user->imagePath }}" alt="{{$user->imageAlt}}" style="width:100px; border-radius:20%;">
                    </td>   
                    <td>
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-soft btn-primary"> Bild bearbeiten</a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Wirklich löschen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-soft btn-primary"> Bild Löschen</button>
                    </form>
                    
                    </td>
                @else
                <td>  <!--                          man kann auch den ganzen user übergeben $user-->
                <a href="{{ route('users.create', ['user' => $user->id]) }}">Anlegen</a>  
                 </td>
                @endif
           
        </tr>
         @endforeach
    </table>
    
</x-layout>