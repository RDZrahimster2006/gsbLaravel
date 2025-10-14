@extends('sommaireg')

@section('menu')
<div id="menuGauche">
    <h2>Suppression d’un visiteur</h2>

    {{-- Message flash --}}
    @if (session('message'))
        <div style="color: green;">
            {{ session('message') }}
        </div>
    @endif

    {{-- Liste des visiteurs --}}
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @forelse ($visiteurs as $visiteur)
                <tr>
                    <td>{{ $visiteur ['id'] }}</td>
                    <td>{{ $visiteur ['nom']}}</td>
                    <td>{{ $visiteur ['prenom']}}</td>
                    <td>
                        {{-- Formulaire sécurisé de suppression --}}
                        <form action="{{ route('supprimer_visiteur', $visiteur['id']) }}" method="POST" 
                              onsubmit="return confirm('Voulez-vous vraiment supprimer {{ $visiteur['nom'] }} ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Aucun visiteur trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
