<ul class="navigation-menu">

    <!-- Dashboard -->
    <li class="has-submenu">
        <a href="/"><i class="ti-home"></i>Dashboard</a>
    </li>
    <!-- Dashboard - Fin -->

    @can(\App\Stock::canlist())
    <li class="has-submenu">
        <a href="{{ action('StockController@index') }}"><i class="ti-package"></i>stock</a>
    </li>
    @endcan

    <li class="has-submenu">
        <a href="#"><i class="ti-user"></i>Utilisateurs</a>
        <ul class="submenu">
            <li>
                <ul>
                    @can(\App\User::canlist())
                    <li><a href="{{ route('users.index') }}">Lister</a></li>
                    @endcan

                    @can(\App\User::cancreate())
                    <li><a href="{{ route('users.create') }}">Ajouter</a></li>
                    @endcan

                </ul>
            </li>

             <li class="has-submenu">
                <a href="#">Roles</a>
                <ul class="submenu">
                   @can(\App\RoleCustom::canlist())
                    <li><a href="{{ route('roles.index') }}">Lister</a></li>
                    @endcan
                    @can(\App\RoleCustom::cancreate())
                    <li><a href="{{ route('roles.create') }}">Ajouter</a></li>
                    @endcan
                </ul>
            </li>

        </ul>
    </li>
    <!-- Utilisateurs - Fin -->

    <!-- Articles & Types -->
    <li class="has-submenu">
        <a href="#"><i class="ti-package"></i>Articles</a>
        <ul class="submenu">
            <li class="has-submenu">
                <a href="#">Article</a>
                <ul class="submenu">
                    @can(\App\Article::canlist())
                    <li><a href="{{ route('articles.index') }}">Lister</a></li>
                    @endcan

                    @can(\App\Article::cancreate())
                    <li><a href="{{ route('articles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>
            <li class="has-submenu">
                <a href="#">Types</a>
                <ul class="submenu">
                    @can(\App\TypeArticle::canlist())
                    <li><a href="{{ route('typearticles.index') }}">Lister</a></li>
                    @endcan

                    @can(\App\TypeArticle::cancreate())
                    <li><a href="{{ route('typearticles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Marques</a>
                <ul class="submenu">
                    @can(\App\MarqueArticle::canlist())
                    <li><a href="{{ route('marquearticles.index') }}">Lister</a></li>
                    @endcan

                    @can(\App\MarqueArticle::cancreate())
                    <li><a href="{{ route('marquearticles.create') }}">Ajouter</a></li>
                    @endcan
                 </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Affectations</a>
                <ul class="submenu">
                    @can(\App\Affectation::canlist())
                    <li><a href="{{ route('affectations.index') }}">Lister</a></li>
                    @endcan
                 </ul>
            </li>
        </ul>
    </li>
    <!-- Articles & Types - Fin -->

    <!-- Employes & Services -->
    <li class="has-submenu">
        <a href="#"><i class="ti-bookmark-alt"></i>Employes</a>
          <ul class="submenu">
              <li class="has-submenu">
                  <a href="#">Employes</a>
                  <ul class="submenu">
                      @can(\App\Employe::canlist())
                      <li><a href="{{ route('employes.index') }}">Lister</a></li>
                      @endcan

                      @can(\App\Employe::cancreate())
                      <li><a href="{{ route('employes.create') }}">Ajouter</a></li>
                      @endcan
                  </ul>
              </li>

              <li class="has-submenu">
                  <a href="#">Départements</a>
                  <ul class="submenu">
                      @can(\App\Departement::canlist())
                      <li><a href="{{ route('departements.index') }}">Lister</a></li>
                      @endcan

                      @can(\App\Departement::cancreate())
                      <li><a href="{{ route('departements.create') }}">Ajouter</a></li>
                      @endcan
                  </ul>
              </li>

              <li class="has-submenu">
                  <a href="#">Fonctions</a>
                  <ul class="submenu">
                      @can(\App\FonctionEmploye::canlist())
                      <li><a href="{{ route('fonctionemployes.index') }}">Lister</a></li>
                      @endcan

                      @can(\App\FonctionEmploye::cancreate())
                      <li><a href="{{ route('fonctionemployes.create') }}">Ajouter</a></li>
                      @endcan
                  </ul>
              </li>

              @can('commande-xxx')
              <li class="has-submenu">
                  <a href="#">Commandes</a>
                  <ul class="submenu">
                      @can(\App\Commande::canlist())
                      <li><a href="{{ route('commandes.index') }}">Lister</a></li>
                      @endcan

                      @can(\App\Commande::cancreate())
                      <li><a href="{{ route('commandes.create') }}">Faire une Commandes</a></li>
                      @endcan
                  </ul>
              </li>
              @endcan

          </ul>
    </li>
    <!-- Employes & Services - Fin -->

    <!-- Fournisseurs -->
    <li class="has-submenu">
        <a href="#"><i class="ti-truck"></i>Fournisseurs</a>
        <ul class="submenu megamenu">
          <li>
            <ul>
              @can(\App\Fournisseur::canlist())
              <li><a href="{{ route('fournisseurs.index') }}">Lister</a></li>
              @endcan

              @can(\App\Fournisseur::cancreate())
              <li><a href="{{ route('fournisseurs.create') }}">Ajouter</a></li>
              @endcan
            </ul>
          </li>
        </ul>
    </li>
    <!-- Fournisseurs - Fin -->

    <!-- Paramètres -->
    @can(\App\Parametre::canlist())
    <li class="has-submenu">
      <a href="{{ route('parametres.index') }}" style="color:#8B0000"><i class="ti-settings"></i>Paramètres</a>
    </li>
    @endcan
    <!-- Paramètres - Fin -->

    <!-- Paramètres -->
    @can(\App\RecycleBin::canlist())
    <li class="has-submenu">
      <a href="{{ route('recyclebin.index') }}" style="color:#006400"><i class="ti-trash"></i>Corbeille</a>
    </li>
    @endcan
    <!-- Paramètres - Fin -->

</ul>
