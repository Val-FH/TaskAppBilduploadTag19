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
            <td>
                @if ($user->imagePath)
                    <img src="{{ $user->imagePath }}" alt="{{$user->imageAlt}}" style="width: 100px">   
                @else
              <a href="{{ route('users.edit', ['user' => $user->id]) }}">Anlegen</a>  
                @endif
            </td>
           
        </tr>
         @endforeach
    </table>
    
</x-layout>