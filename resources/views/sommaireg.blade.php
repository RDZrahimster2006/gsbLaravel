@extends('modeles/visiteur')

    @section('menu')
   
        <div id="menuGauche">

            <div id="infosUtil">
                  
             </div>  
               <ul id="menuList">
                   <li >
                    <strong>Bonjour {{ $visiteur['nom']  }}</strong>
                      
                   </li>

                 <li class="smenu">
                    <a href="{{ route('chemin_supprimer') }}" title="Supprimer un visiteur">
                        Supprimer un visiteur
                    </a>
                    </li>
                    <li class="smenu">
                    <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter">
                        Déconnexion
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    @endsection
