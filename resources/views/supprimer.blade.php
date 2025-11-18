@extends('somreg')
@section('contenu1')
    <div id="contenu">
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
                @forelse ($visiteurs as $unvisiteur)
                    <tr>
                        <td>{{ $unvisiteur ['id'] }}</td>
                        <td>{{ $unvisiteur ['nom']}}</td>
                        <td>{{ $unvisiteur ['prenom']}}</td>
                        <td>
                            {{-- Formulaire sécurisé de suppression --}}
                            <form action="{{ route('supprimer_visiteur', $unvisiteur['id']) }}" method="POST" 
                                onsubmit="return confirm('Voulez-vous vraiment supprimer {{ $unvisiteur['nom'] }} ?');">
                                @csrf
                                <input type="hidden" name="jsp" value="{{ $unvisiteur['id'] }}">
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