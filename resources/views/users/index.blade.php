<x-layout title="Userseite">
    <p>Tabelle User mit Foto</p>
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
                    {{$user->imagePath}}   
                @else
                <a href="/users/create{{ $user->id }}" >Anlegen</a>  
                @endif
            </td>
           
        </tr>
         @endforeach
    </table>
    
</x-layout>